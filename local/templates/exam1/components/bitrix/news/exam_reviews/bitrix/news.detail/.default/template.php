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
    'DOCUMENTS' => isset($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']),
];

$previewText = $arResult["PREVIEW_TEXT"];
$detailText = $arResult["DETAIL_TEXT"];
$name = $arResult["NAME"];
$activeFrom = $arResult["DISPLAY_ACTIVE_FROM"];
$position = ucfirst($arResult['DISPLAY_PROPERTIES']['POSITION']['VALUE']);
$company = $arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE'];
$linkDetailImage = $canDisplay['DETAIL_PICTURE'] ? $arResult["DETAIL_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH.'/img/rew/no_photo.jpg';
$linkPdfImage = SITE_TEMPLATE_PATH.'/img/icons/pdf_ico_40.png';
$author = $name.', '.$activeFrom.' г., '.$position.', '.$company.'.';
$files = $arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE'];
$oneFile = isset($files['ID']);
?>

<div class="review-block">
    <div class="review-text">
        <div class="review-text-cont"><?= $detailText ?></div>
        <div class="review-autor"><?= $author ?></div>
    </div>
    <div style="clear: both;" class="review-img-wrap"><img src="<?= $linkDetailImage ?>" alt="<?= $name ?>"></div>
</div>
<? if ($canDisplay['DOCUMENTS']): ?>
<div class="exam-review-doc">
    <p><?= GetMessage('ER_DOCUMENTS') ?>:</p>
    <? if ($oneFile): ?>
        <div  class="exam-review-item-doc">
            <img class="rew-doc-ico" src="<?= $linkPdfImage ?>">
            <a href="<?= $files['SRC'] ?>"><?= $files['ORIGINAL_NAME'] ?></a>
        </div>
    <? else: ?>
        <? foreach ($files as $file): ?>
            <div  class="exam-review-item-doc">
                <img class="rew-doc-ico" src="<?= $linkPdfImage ?>">
                <a href="<?= $file['SRC'] ?>"><?= $file['ORIGINAL_NAME'] ?></a>
            </div>
        <? endforeach; ?>
    <? endif; ?>
</div>
<? endif; ?>
<hr>