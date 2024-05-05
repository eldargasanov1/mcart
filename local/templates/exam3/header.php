<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);

use Bitrix\Main\Page\Asset;

$isMainPage = $APPLICATION->GetCurPage() == '/s4/';
$time = date('G', time())
?>

<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">

<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?
    Asset::getInstance()->addString('<link rel="icon" type="image/vnd.microsoft.icon" href="'.SITE_TEMPLATE_PATH.'/img/favicon.ico">');
    Asset::getInstance()->addString('<link rel="shortcut icon" href="'.SITE_TEMPLATE_PATH.'favicon.ico">');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/reset.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/owl.carousel.css');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/owl.carousel.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/scripts.js');
    ?>
    <?$APPLICATION->ShowHead()?>
</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel()?></div>
<!-- wrap -->
<div class="wrap">
    <!-- header -->
    <header class="header">
        <div class="inner-wrap">
            <div class="logo-block"><a href="" class="logo">Мебельный магазин</a>
            </div>
            <? if ($time > 9 && $time < 18): ?>
            <div class="main-phone-block">
                <a href="tel:84952128506" class="phone">8 (495) 212-85-06</a>
                <div class="shedule">время работы с 9-00 до 18-00</div>
            </div>
            <? else: ?>
            <div class="main-phone-block">
                <a href="mailto:store@store.ru" class="phone">store@store.ru</a>
                <div class="shedule">время работы с 9-00 до 18-00</div>
            </div>
            <? endif; ?>
            <div class="actions-block">
                <form action="/" class="main-frm-search">
                    <input type="text" placeholder="Поиск">
                    <button type="submit"></button>
                </form>
                <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"demo", 
	array(
		"FORGOT_PASSWORD_URL" => "/s4/login/",
		"PROFILE_URL" => "/s4/login/user.php",
		"REGISTER_URL" => "/s4/login/",
		"SHOW_ERRORS" => "N",
		"COMPONENT_TEMPLATE" => "demo"
	),
	false
);?>
            </div>
        </div>
    </header>
    <!-- /header -->
    <!-- nav -->
    <?$APPLICATION->IncludeComponent("bitrix:menu", "exam_top_menu", Array(
        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        "DELAY" => "N",	// Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "3",	// Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
        "MENU_CACHE_TIME" => "36000",	// Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
        "COMPONENT_TEMPLATE" => "horizontal_multilevel"
    ),
        false
    );?>
    <!-- /nav -->
    <? if (!$isMainPage): ?>
    <!-- breadcrumbs -->
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "exam_breadcrumb", Array(
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s4",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    );?>
    <!-- /breadcrumbs -->
    <? endif; ?>
    <!-- page -->
    <div class="page">
        <!-- content box -->
        <div class="content-box">
            <!-- content -->
            <div class="content">
                <div class="cnt">
                    <? if (!$isMainPage): ?>
                    <header>
                        <h1><?$APPLICATION->ShowTitle(false)?></h1>
                    </header>
                    <hr>
                    <? endif; ?>
                    <? if ($isMainPage): ?>
                        <p>«Мебельная компания» осуществляет производство мебели на высококлассном оборудовании с применением минимальной доли ручного труда, что позволяет обеспечить высокое качество нашей продукции. Налажен производственный процесс как массового и индивидуального характера, что с одной стороны позволяет обеспечить постоянную номенклатуру изделий и индивидуальный подход – с другой.
                        </p>
                        <!-- index column -->
                        <div class="cnt-section index-column">
                            <div class="col-wrap">

                                <!-- main actions box -->
                                <div class="column main-actions-box">
                                    <div class="title-block">
                                        <h2>Новинки</h2>
                                        <hr>
                                    </div>
                                    <div class="items-wrap">
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title-block att">
                                                    Угловой диван!
                                                </div>
                                                <br>
                                                <div class="inner-block">
                                                    <a href="" class="photo-block">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/img/new01.jpg" alt="">
                                                    </a>
                                                    <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
                                                        <a href="" class="btn-arr"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title-block att">
                                                    Угловой диван!
                                                </div>
                                                <br>
                                                <div class="inner-block">
                                                    <a href="" class="photo-block">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/img/new02.jpg" alt="">
                                                    </a>
                                                    <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
                                                        <a href="" class="btn-arr"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title-block att">
                                                    Угловой диван!
                                                </div>
                                                <br>
                                                <div class="inner-block">
                                                    <a href="" class="photo-block">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/img/new03.jpg" alt="">
                                                    </a>
                                                    <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
                                                        <a href="" class="btn-arr"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="btn-next">Все новинки</a>
                                </div>
                                <!-- /main actions box -->
                                <!-- main news box -->
                                <div class="column main-news-box">
                                    <div class="title-block">
                                        <h2>Новости</h2>
                                    </div>
                                    <hr>
                                    <div class="items-wrap">
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title"><a href="">29 августа 2012</a>
                                                </div>
                                                <div class="text"><a href="">Поступление лучших офисных кресел из Германии </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title"><a href="">29 августа 2012</a>
                                                </div>
                                                <div class="text"><a href="">Мастер-класс дизайнеров  из Италии для производителей мебели </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title"><a href="">29 августа 2012</a>
                                                </div>
                                                <div class="text"><a href="">Поступление лучших офисных кресел из Германии </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-wrap">
                                            <div class="item">
                                                <div class="title"><a href="">29 августа 2012</a>
                                                </div>
                                                <div class="text"><a href="">Наша дилерская сеть расширилась теперь ассортимент наших товаров доступен в Казани </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="btn-next">Все новости</a>
                                </div>
                                <!-- /main news box -->

                            </div>
                        </div>
                        <!-- /index column -->
                        <!-- afisha box -->
                        <div class="cnt-section afisha-box">
                            <div class="section-title-block">
                                <h2 class="second-ttile">Ближайшие мероприятия</h2>
                                <a href="" class="btn-next">все мероприятия</a>
                            </div>
                            <hr>
                            <div class="items-wrap">
                                <div class="item-wrap">
                                    <div class="item">
                                        <div class="title"><a href="">29 августа 2012, Москва</a>
                                        </div>
                                        <div class="text"><a href="">Семинар производителей мебели России и СНГ, Обсуждение тенденций.</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-wrap">
                                    <div class="item">
                                        <div class="title"><a href="">29 августа 2012, Москва</a>
                                        </div>
                                        <div class="text"><a href="">Открытие шоу-рума на Невском проспекте. Последние модели в большом ассортименте.</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-wrap">
                                    <div class="item">
                                        <div class="title"><a href="">29 августа 2012, Москва</a>
                                        </div>
                                        <div class="text"><a href="">Открытие нового магазина в нашей  дилерской сети.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /afisha box -->
                    <? endif; ?>
