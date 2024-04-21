<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arResult["SHOW_SMS_FIELD"] == true) {
    CJSCore::Init('phone_auth');
}
?>

<div class="site-section">
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-md-12 col-lg-8 mb-5">
                <? if ($USER->IsAuthorized()): ?>
                    <p><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>
                <? else: ?>
                    <?
                    if (!empty($arResult["ERRORS"])):
                        foreach ($arResult["ERRORS"] as $key => $error)
                            if (intval($key) == 0 && $key !== 0)
                                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

                        ShowError(implode("<br />", $arResult["ERRORS"]));

                    elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
                        ?>
                        <p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p>
                    <? endif ?>

                    <? if ($arResult["SHOW_SMS_FIELD"] == true): ?>
                        <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" class="p-5 bg-white border">
                            <?
                            if ($arResult["BACKURL"] <> ''):
                                ?>
                                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                            <?
                            endif;
                            ?>
                            <input type="hidden" name="SIGNED_DATA" value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>"/>
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="font-weight-bold" for="sms_code"><? echo GetMessage("main_register_sms") ?><span class="starrequired">*</span></label>
                                    <input type="text" name="SMS_CODE" id="sms_code" class="form-control" value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" name="code_submit_button" value="<? echo GetMessage("main_register_sms_send") ?>" class="btn btn-primary  py-2 px-4 rounded-0">
                                </div>
                            </div>
                        </form>
                        <script>
                            new BX.PhoneAuth({
                                containerId: 'bx_register_resend',
                                errorContainerId: 'bx_register_error',
                                interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                                data:
                                    <?=CUtil::PhpToJSObject([
                                        'signedData' => $arResult["SIGNED_DATA"],
                                    ])?>,
                                onError:
                                    function (response) {
                                        var errorDiv = BX('bx_register_error');
                                        var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
                                        errorNode.innerHTML = '';
                                        for (var i = 0; i < response.errors.length; i++) {
                                            errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
                                        }
                                        errorDiv.style.display = '';
                                    }
                            });
                        </script>
                        <div id="bx_register_error" style="display:none"><? ShowError("error") ?></div>
                        <div id="bx_register_resend"></div>
                    <? else: ?>
                        <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data" class="p-5 bg-white border">
                            <?
                            if ($arResult["BACKURL"] <> ''):
                                ?>
                                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                            <?
                            endif;
                            ?>
                            <h2><?= GetMessage("AUTH_REGISTER") ?></h2>
                            <? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
                                <div class="row form-group">
                                    <div class="col-md-12 mb-3 mb-md-0">
                                        <label class="font-weight-bold" for="<?="REGISTER_FIELD_" . $FIELD?>">
                                            <?= GetMessage("REGISTER_FIELD_" . $FIELD) ?><? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?><span class="starrequired">*</span><? endif ?>:
                                        </label>
                                        <input
                                                size="30"
                                                type="<?= $FIELD == 'PASSWORD' || $FIELD == 'CONFIRM_PASSWORD' ? 'password' : 'text' ?>"
                                                name="REGISTER[<?= $FIELD ?>]"
                                                id="<?="REGISTER_FIELD_" . $FIELD?>"
                                                value="<?= $arResult["VALUES"][$FIELD] ?>"
                                                autocomplete="<?= ($FIELD == 'PASSWORD' || $FIELD == 'CONFIRM_PASSWORD') ? 'off' : '' ?>"
                                                class="form-control"
                                        />
                                    </div>
                                </div>
                            <? endforeach ?>
                            <? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
                                <? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
                                    <div class="row form-group">
                                        <div class="col-md-12 mb-3 mb-md-0">
                                            <label class="font-weight-bold" for="<?=$FIELD_NAME?>">
                                                <?= $arUserField["EDIT_FORM_LABEL"] ?><? if ($arUserField["MANDATORY"] == "Y"): ?><span class="starrequired">*</span><? endif; ?>:
                                            </label>
                                            <br>
                                            <? $APPLICATION->IncludeComponent(
                                                "bitrix:system.field.edit",
                                                $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                                array(
                                                    "bVarsFromForm" => $arResult["bVarsFromForm"],
                                                    "arUserField" => $arUserField,
                                                    "form_name" => "regform"
                                                ),
                                                null,
                                                array("HIDE_ICONS" => "Y")
                                            );
                                            ?>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            <? endif; ?>
                            <? if ($arResult["USE_CAPTCHA"] == "Y"): ?>
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="font-weight-bold" for="captcha"><?= GetMessage("REGISTER_CAPTCHA_TITLE") ?><span class="starrequired">*</span>:</label>
                                    <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                    <br>
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                         width="180" height="40" alt="CAPTCHA"
                                    />
                                    <br>
                                    <span><?= GetMessage("REGISTER_CAPTCHA_PROMT") ?></span>
                                    <input type="text" id="captcha" name="captcha_word" class="form-control" maxlength="50" value="" autocomplete="off">
                                </div>
                            </div>
                            <? endif; ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>" class="btn btn-primary  py-2 px-4 rounded-0">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
                                    <p><span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?></p>
                                </div>
                            </div>
                            <p>
                                <a href="/auth/login.php" rel="nofollow">
                                    <?= GetMessage("AUTH_AUTH") ?>
                                </a>
                            </p>
                        </form>
                    <? endif ?>
                <? endif ?>
            </div>
        </div>
    </div>
</div>