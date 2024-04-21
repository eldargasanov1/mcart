<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>

<div class="site-section">
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-md-12 col-lg-8 mb-5">
                <?
                if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE'])) {
                    ShowMessage($arResult['ERROR_MESSAGE']);
                }
                ?>
                <? if ($arResult["FORM_TYPE"] == "login"): ?>
                    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
                          action="<?= $arResult["AUTH_URL"] ?>" class="p-5 bg-white border">
                        <? if ($arResult["BACKURL"] <> ''): ?>
                            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                        <? endif ?>
                        <? foreach ($arResult["POST"] as $key => $value): ?>
                            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                        <? endforeach ?>
                        <input type="hidden" name="AUTH_FORM" value="Y"/>
                        <input type="hidden" name="TYPE" value="AUTH"/>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="login"><?= GetMessage("AUTH_LOGIN") ?></label>
                                <input type="text" name="USER_LOGIN" id="login" class="form-control">
                                <script>
                                    BX.ready(function () {
                                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                        if (loginCookie) {
                                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                            var loginInput = form.elements["USER_LOGIN"];
                                            loginInput.value = loginCookie;
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold"
                                       for="password"><?= GetMessage("AUTH_PASSWORD") ?></label>
                                <input type="password" name="USER_PASSWORD" id="password" autocomplete="off"
                                       class="form-control">
                            </div>
                            <div class="col-md-12">
                                <noindex><a href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>"
                                            rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a></noindex>
                            </div>
                        </div>
                        <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y"/>
                                    <label for="USER_REMEMBER_frm"
                                           title="<?= GetMessage("AUTH_REMEMBER_ME") ?>"><? echo GetMessage("AUTH_REMEMBER_SHORT") ?></label>
                                </div>
                            </div>
                        <? endif ?>
                        <? if ($arResult["CAPTCHA_CODE"]): ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                                    <input type="hidden" name="captcha_sid"
                                           value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                         width="180" height="40" alt="CAPTCHA"/><br/><br/>
                                    <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                                </div>
                            </div>
                        <? endif ?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"
                                       class="btn btn-primary py-2 px-4 rounded-0">
                            </div>
                        </div>
                        <? if ($arResult["NEW_USER_REGISTRATION"] == "Y"): ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <noindex>
                                        <a href="<?= $arResult["AUTH_REGISTER_URL"] ?>"
                                           rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a>
                                    </noindex>
                                </div>
                            </div>
                        <? endif ?>
                    </form>
                <?
                else:
                    ?>
                    <form action="<?= $arResult["AUTH_URL"] ?>">
                        <table width="95%">
                            <tr>
                                <td align="center">
                                    <?= $arResult["USER_NAME"] ?><br/>
                                    [<?= $arResult["USER_LOGIN"] ?>]<br/>
                                    <a href="<?= $arResult["PROFILE_URL"] ?>"
                                       title="<?= GetMessage("AUTH_PROFILE") ?>"><?= GetMessage("AUTH_PROFILE") ?></a><br/>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <? foreach ($arResult["GET"] as $key => $value): ?>
                                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                                    <? endforeach ?>
                                    <?= bitrix_sessid_post() ?>
                                    <input type="hidden" name="logout" value="yes"/>
                                    <input type="submit" name="logout_butt"
                                           value="<?= GetMessage("AUTH_LOGOUT_BUTTON") ?>"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                <? endif ?>
            </div>
        </div>
    </div>
</div>