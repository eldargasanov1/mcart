<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["SHOW_SMS_FIELD"] == true) {
    CJSCore::Init('phone_auth');
}
?>

<div class="site-section">
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-md-12 col-lg-8 mb-5">
                <?
                if (!empty($arParams["~AUTH_RESULT"])) {
                    ShowMessage($arParams["~AUTH_RESULT"]);
                }
                ?>
                <? if ($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]): ?>
                    <p><? echo GetMessage("AUTH_EMAIL_SENT") ?></p>
                <? endif; ?>

                <? if (!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
                    <p><? echo GetMessage("AUTH_EMAIL_WILL_BE_SENT") ?></p>
                <? endif ?>
                <noindex>
                    <? if ($arResult["SHOW_SMS_FIELD"] == true): ?>
                        <form method="post" action="<?= $arResult["AUTH_URL"] ?>" name="regform"
                              class="p-5 bg-white border">
                            <input type="hidden" name="SIGNED_DATA"
                                   value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>"/>
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="font-weight-bold" for="sms_code">
                                        <span class="starrequired">*</span>
                                        <?= GetMessage("main_register_sms_code") ?>
                                    </label>
                                    <input type="text" name="SMS_CODE" id="sms_code" class="form-control"
                                           value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" name="code_submit_button"
                                           value="<?= GetMessage("main_register_sms_send") ?>"
                                           class="btn btn-primary py-2 px-4 rounded-0">
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
                    <? elseif (!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]): ?>
                        <form method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform"
                              enctype="multipart/form-data" class="p-5 bg-white border">
                            <input type="hidden" name="AUTH_FORM" value="Y"/>
                            <input type="hidden" name="TYPE" value="REGISTRATION"/>
                            <h2><?= GetMessage("AUTH_REGISTER") ?></h2>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="font-weight-bold"
                                           for="user_name"><?= GetMessage("AUTH_NAME") ?></label>
                                    <input type="text" name="USER_NAME" id="user_name" class="form-control"
                                           value="<?= $arResult["USER_NAME"] ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="font-weight-bold"
                                           for="user_last_name"><?= GetMessage("AUTH_LAST_NAME") ?></label>
                                    <input type="text" name="USER_LAST_NAME" id="user_last_name" class="form-control"
                                           value="<?= $arResult["USER_LAST_NAME"] ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="user_login">
                                        <span class="starrequired">*</span>
                                        <?= GetMessage("AUTH_LOGIN_MIN") ?>
                                    </label>
                                    <input type="text" name="USER_LOGIN" id="user_login" class="form-control"
                                           value="<?= $arResult["USER_LOGIN"] ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="user_password">
                                        <span class="starrequired">*</span>
                                        <?= GetMessage("AUTH_PASSWORD_REQ") ?>
                                    </label>
                                    <input type="password" name="USER_PASSWORD" id="user_password" class="form-control"
                                           value="<?= $arResult["USER_PASSWORD"] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="user_confirm_password">
                                        <span class="starrequired">*</span>
                                        <?= GetMessage("AUTH_CONFIRM") ?>
                                    </label>
                                    <input type="password" name="USER_CONFIRM_PASSWORD" id="user_confirm_password"
                                           class="form-control"
                                           value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" autocomplete="off">
                                </div>
                            </div>
                            <? if ($arResult["EMAIL_REGISTRATION"]): ?>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="font-weight-bold" for="user_email">
                                            <? if ($arResult["EMAIL_REQUIRED"]): ?>
                                                <span class="starrequired">*</span>
                                            <? endif ?>
                                            <?= GetMessage("AUTH_EMAIL") ?>
                                        </label>
                                        <input type="text" name="USER_EMAIL" id="user_email" class="form-control"
                                               value="<?= $arResult["USER_EMAIL"] ?>">
                                    </div>
                                </div>
                            <? endif ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <div class="font-weight-bold">
                                        <span class="starrequired">*</span>
                                        <?= GetMessage("USER_ROLE") ?>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="USER_ROLE" id="buyer">
                                        <label class="form-check-label" for="buyer">
                                            Покупатель
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="USER_ROLE" id="seller" checked>
                                        <label class="form-check-label" for="seller">
                                            Продавец
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <? if ($arResult["PHONE_REGISTRATION"]): ?>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="font-weight-bold" for="user_phone_number">
                                            <? if ($arResult["PHONE_REQUIRED"]): ?>
                                                <span class="starrequired">*</span>
                                            <? endif ?>
                                            <?= GetMessage("main_register_phone_number") ?>
                                        </label>
                                        <input type="text" name="USER_PHONE_NUMBER" id="user_phone_number"
                                               class="form-control"
                                               value="<?= $arResult["USER_PHONE_NUMBER"] ?>">
                                    </div>
                                </div>
                            <? endif ?>
                            <? if ($arResult["USE_CAPTCHA"] == "Y"): ?>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="font-weight-bold" for="captcha_word">
                                            <?= GetMessage("CAPTCHA_REGF_TITLE") ?>
                                        </label>
                                        <input type="hidden" name="captcha_sid"
                                               value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                        <br>
                                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                             width="180" height="40" alt="CAPTCHA"/>
                                        <br>
                                        <span class="starrequired">*</span><?= GetMessage("CAPTCHA_REGF_PROMT") ?>:
                                        <input type="text" name="captcha_word" id="captcha_word" class="form-control"
                                               autocomplete="off">
                                    </div>
                                </div>
                            <? endif; ?>
                            <? $APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
                                array(
                                    "ID" => COption::getOptionString("main", "new_user_agreement", ""),
                                    "IS_CHECKED" => "Y",
                                    "AUTO_SAVE" => "N",
                                    "IS_LOADED" => "Y",
                                    "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                                    "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                                    "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                                    "REPLACE" => array(
                                        "button_caption" => GetMessage("AUTH_REGISTER"),
                                        "fields" => array(
                                            rtrim(GetMessage("AUTH_NAME"), ":"),
                                            rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                            rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                            rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                            rtrim(GetMessage("AUTH_EMAIL"), ":"),
                                        )
                                    ),
                                )
                            ); ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" name="Register" value="<?= GetMessage("AUTH_REGISTER") ?>"
                                           class="btn btn-primary py-2 px-4 rounded-0">
                                </div>
                            </div>
                            <p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
                            <p><span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?></p>
                            <p><a href="<?= $arResult["AUTH_AUTH_URL"] ?>"
                                  rel="nofollow"><b><?= GetMessage("AUTH_AUTH") ?></b></a></p>
                        </form>
                        <script type="text/javascript">
                            document.bform.USER_NAME.focus();
                        </script>
                    <? endif ?>
                </noindex>
            </div>
        </div>
    </div>
</div>