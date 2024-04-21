<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_PWD_SUCCESS');
	return;
}
?>

<div class="site-section">
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-md-12 col-lg-8 mb-5">
                <?if ($arResult['ERRORS']):?>
                    <div class="alert alert-danger">
                        <? foreach ($arResult['ERRORS'] as $error)
                        {
                            echo $error;
                        }
                        ?>
                    </div>
                <?elseif ($arResult['SUCCESS']):?>
                    <div class="alert alert-success">
                        <?= $arResult['SUCCESS'];?>
                    </div>
                <?endif;?>
                <h3 class="bx-title"><?= Loc::getMessage('MAIN_AUTH_PWD_HEADER');?></h3>
                <p class="bx-authform-content-container"><?= Loc::getMessage('MAIN_AUTH_PWD_NOTE');?></p>
                <form name="bform" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>" class="p-5 bg-white border">
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="font-weight-bold" for="login"><?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_LOGIN');?></label>
                            <input type="text" name="<?= $arResult['FIELDS']['login'];?>" id="login" class="form-control" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>">
                        </div>
                    </div>
                    <span class="font-weight-bold"><?= Loc::getMessage('MAIN_AUTH_PWD_OR');?></span>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="font-weight-bold" for="email"><?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_EMAIL');?></label>
                            <input type="text" name="<?= $arResult['FIELDS']['email'];?>" id="email" class="form-control" value="">
                        </div>
                    </div>
                    <?if ($arResult['CAPTCHA_CODE']):?>
                        <input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="captha"><?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_CAPTCHA');?></label>
                                <div><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
                                <input type="text" name="captcha_word" id="captha" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    <?endif;?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_SUBMIT');?>" class="btn btn-primary  py-2 px-4 rounded-0">
                        </div>
                    </div>
                    <?if ($arResult['AUTH_AUTH_URL'] || $arResult['AUTH_REGISTER_URL']):?>
                        <hr class="bxe-light">
                        <noindex>
                            <?if ($arResult['AUTH_AUTH_URL']):?>
                                <div class="bx-authform-link-container">
                                    <a href="<?= $arResult['AUTH_AUTH_URL'];?>" rel="nofollow">
                                        <?= Loc::getMessage('MAIN_AUTH_PWD_URL_AUTH_URL');?>
                                    </a>
                                </div>
                            <?endif;?>
                            <?if ($arResult['AUTH_REGISTER_URL']):?>
                                <div class="bx-authform-link-container">
                                    <a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow">
                                        <?= Loc::getMessage('MAIN_AUTH_PWD_URL_REGISTER_URL');?>
                                    </a>
                                </div>
                            <?endif;?>
                        </noindex>
                    <?endif;?>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	document.bform.<?= $arResult['FIELDS']['login'];?>.focus();
</script>
