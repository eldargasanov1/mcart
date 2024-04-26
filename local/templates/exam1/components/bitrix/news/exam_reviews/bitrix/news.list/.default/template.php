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

$showNav = $arParams["DISPLAY_BOTTOM_PAGER"];
$nav = $arResult["NAV_STRING"];
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

$canDisplay = [
    'DETAIL_PAGE' => !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"]),
    'PREVIEW_PICTURE' => is_array($arItem["PREVIEW_PICTURE"]),
];

$linkDetailPage = $arItem["DETAIL_PAGE_URL"];
$linkImage = $canDisplay['PREVIEW_PICTURE'] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH.'/img/rew/no_photo.jpg';
$name = $arItem["NAME"];
$activeFrom = $arItem["DISPLAY_ACTIVE_FROM"];
$position = ucfirst($arItem['DISPLAY_PROPERTIES']['POSITION']['VALUE']);
$company = $arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE'];
$previewText = $arItem["PREVIEW_TEXT"];

$description = $activeFrom.' г., '.$position.', '.$company;
?>

<div class="review-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
    <div class="review-text">
        <div class="review-block-title">
            <span class="review-block-name">
                <? if ($canDisplay['DETAIL_PAGE']): ?>
                    <a href="<?= $linkDetailPage ?>"><?= $name ?></a>
                <? else: ?>
                    <?= $name ?>
                <? endif; ?>
            </span>
            <span class="review-block-description"><?= $description ?></span>
        </div>
        <div class="review-text-cont">
            <?= $previewText ?>
        </div>
    </div>
    <div class="review-img-wrap">
        <? if ($canDisplay['DETAIL_PAGE']): ?>
            <a href="<?= $linkDetailPage ?>"><img src="<?= $linkImage ?>" alt="<?= $arItem["NAME"] ?>"></a>
        <? else: ?>
            <img src="<?= $linkImage ?>" alt="<?= $arItem["NAME"] ?>">
        <? endif; ?>
    </div>
</div>
<?endforeach;?>
<? if ($showNav): ?>
    <br />
    <?=$nav?>
<? endif; ?>