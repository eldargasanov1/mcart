<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$canDisplay = [
    'DETAIL_PICTURE' => $arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"]),
];

$linkDetailImage = $canDisplay['DETAIL_PICTURE'] ? $arResult["DETAIL_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH.'/img/rew/no_photo.jpg';
$linkPdfIcon = SITE_TEMPLATE_PATH.'/img/icons/pdf_ico_40.png';
$name = $arResult["NAME"];
$altDetailImage = $canDisplay['DETAIL_PICTURE'] ? $arResult["DETAIL_PICTURE"]['ALT'] : $name;
$activeFrom = $arResult["DISPLAY_ACTIVE_FROM"];
$position = $arResult["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"];
$company = $arResult["DISPLAY_PROPERTIES"]["COMPANY"]["VALUE"];
$files = $arResult["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"];
$hasOneFile = $files['ID'];
$author = $name.', '.$activeFrom.' г., '.$position.', '.$company;
$previewText = $arResult["PREVIEW_TEXT"];
$detailText = $arResult["DETAIL_TEXT"];

$APPLICATION->SetPageProperty('title', 'Отзыв – '.$name);
$APPLICATION->SetTitle('Отзыв – '.$name.' – '.$company);
$APPLICATION->SetPageProperty('keywords', 'лучшие, отзывы, '.$company);
$APPLICATION->SetPageProperty('description', $previewText);
?>

<div class="review-block">
    <div class="review-text">
        <div class="review-text-cont"><?=$detailText?></div>
        <div class="review-autor"><?=$author?></div>
    </div>
    <div style="clear: both;" class="review-img-wrap">
        <img src="<?=$linkDetailImage?>" alt="<?=$altDetailImage?>">
    </div>
</div>
<? if ($files): ?>
<div class="exam-review-doc">
    <p>Документы:</p>
    <? if ($hasOneFile): ?>
        <div  class="exam-review-item-doc">
            <img class="rew-doc-ico" src="<?=$linkPdfIcon?>">
            <a href="<?=$files['SRC']?>"><?=$files['ORIGINAL_NAME']?></a>
        </div>
    <? else: ?>
        <? foreach ($files as $file): ?>
            <div  class="exam-review-item-doc">
                <img class="rew-doc-ico" src="<?=$linkPdfIcon?>">
                <a href="<?=$file['SRC']?>"><?=$file['ORIGINAL_NAME']?></a>
            </div>
        <? endforeach; ?>
    <? endif; ?>
</div>
<? endif; ?>