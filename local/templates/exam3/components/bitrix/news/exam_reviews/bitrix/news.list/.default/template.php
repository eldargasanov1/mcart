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

$items = $arResult["ITEMS"];
?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($items as $item):?>
    <?
    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $canDisplay = [
        'PREVIEW_PICTURE' => $arParams["DISPLAY_PICTURE"]!="N" && is_array($item["PREVIEW_PICTURE"]),
        'DETAIL_PAGE' => !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($item["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])
    ];

    $resizeImage = CFile::ResizeImageGet(
        $item["DETAIL_PICTURE"]['ID'],
        Array("width" => 68, "height" => 50),
        BX_RESIZE_IMAGE_EXACT,
        false
    );
    $linkImage = $resizeImage ? $resizeImage["src"] : SITE_TEMPLATE_PATH.'/img/rew/no_photo.jpg';
    $linkDetailPage = $item["DETAIL_PAGE_URL"];
    $activeFrom = $item["DISPLAY_ACTIVE_FROM"];
    $name = $item["NAME"];
    $imageAlt = $canDisplay['PREVIEW_PICTURE'] ? $item["PREVIEW_PICTURE"]['ALT'] : $name;
    $position = $item["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"];
    $company = $item["DISPLAY_PROPERTIES"]["COMPANY"]["VALUE"];
    $description = $activeFrom.' г., '.$position.', '.$company;
    $previewText = $item["PREVIEW_TEXT"];
    ?>
    <div class="review-block" id="<?=$this->GetEditAreaId($item['ID']);?>">
        <div class="review-text">
            <div class="review-block-title">
            <span class="review-block-name">
                <? if ($canDisplay['DETAIL_PAGE']): ?>
                    <a href="<?=$linkDetailPage?>"><?=$name?></a>
                <? else: ?>
                    <span><?=$name?></span>
                <? endif; ?>
            </span>
                <span class="review-block-description"><?=$description?></span>
            </div>
            <div class="review-text-cont"><?=$previewText?></div>
        </div>
        <div class="review-img-wrap">
            <? if ($canDisplay['DETAIL_PAGE']): ?>
                <a href="<?=$linkDetailPage?>">
                    <img src="<?=$linkImage?>" alt="<?=$imageAlt?>">
                </a>
            <? else: ?>
                <img src="<?=$linkImage?>" alt="<?=$imageAlt?>">
            <? endif; ?>
        </div>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>