<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>

<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <?php

    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addString("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500'>");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/fonts/icomoon/style.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/magnific-popup.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery-ui.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owl.carousel.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owl.theme.default.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap-datepicker.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/mediaelementplayer.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/animate.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/fonts/flaticon/font/flaticon.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fl-bigmug-line.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/aos.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css");
    ?>
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<div class="site-loader"></div>
<div class="site-wrap">
    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    <div class="border-bottom bg-white top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-md-6">
                    <p class="mb-0">
                        <a href="#" class="mr-3">
                            <span class="text-black fl-bigmug-line-phone351"></span>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/phone.php"
                                ),
                                false
                            ); ?>
                        </a>
                        <a href="#">
                            <span class="text-black fl-bigmug-line-email64"></span>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/mail.php"
                                ),
                                false
                            ); ?>
                        </a>
                    </p>
                </div>
                <div class="col-6 col-md-6 text-right">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/social_networks.php"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="site-navbar">
        <div class="container py-1">
            <div class="row align-items-center">
                <div class="col-8 col-md-8 col-lg-4">
                    <h1 class="">
                        <a href="/" class="h5 text-uppercase text-black">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/logo.php"
                                ),
                                false
                            ); ?>
                        </a>
                    </h1>
                </div>
                <div class="col-4 col-md-4 col-lg-8">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"header_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "3",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "header_menu"
	),
	false
); ?>
                </div>
            </div>
        </div>
    </div>
</div>