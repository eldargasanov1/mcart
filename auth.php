<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$id = $_GET['id'];

global $USER;
$USER->Authorize($id);

header('Location: https://gasanov.study.mcart.ru/');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>