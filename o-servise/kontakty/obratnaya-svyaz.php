<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?>
    <div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8 mb-5">
                <? $APPLICATION->IncludeComponent(
                    "home:main.feedback",
                    "",
                    array(
                        "EMAIL_TO" => "eldarforwork1@gmail.com",
                        "EVENT_MESSAGE_ID" => array("7"),
                        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                        "REQUIRED_FIELDS" => array("NAME", "EMAIL", "SUBJECT", "MESSAGE"),
                        "USE_CAPTCHA" => "Y"
                    )
                ); ?>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/contact_info.php"
                )
            ); ?>
        </div>
    </div>
    </div>
    <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>