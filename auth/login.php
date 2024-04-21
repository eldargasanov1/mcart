<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"login",
	Array(
		"FORGOT_PASSWORD_URL" => "/auth/forgot-password.php",
		"PROFILE_URL" => "/",
		"REGISTER_URL" => "/auth/registration.php",
		"SHOW_ERRORS" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>