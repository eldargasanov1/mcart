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

<div class="rew-footer-carousel">
    <?foreach($items as $item):?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        $canDisplay = [
            'DETAIL_PAGE' => !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($item["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])
        ];

        $resizeImage = CFile::ResizeImageGet(
            $item["PREVIEW_PICTURE"]['ID'],
            Array("width" => 39, "height" => 39),
            BX_RESIZE_IMAGE_EXACT,
            false
        );
        $linkImage = $resizeImage ? $resizeImage["src"] : SITE_TEMPLATE_PATH.'/img/rew/no_photo.jpg';
        $linkDetailPage = $item["DETAIL_PAGE_URL"];
        $name = $item["NAME"];
        $imageAlt = $canDisplay['PREVIEW_PICTURE'] ? $item["PREVIEW_PICTURE"]['ALT'] : $name;
        $position = $item["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"];
        $company = $item["DISPLAY_PROPERTIES"]["COMPANY"]["VALUE"];
        $description = $position.', "'.$company.'"';
        $previewText = strlen($item["PREVIEW_TEXT"]) < 150 ? '"'.$item["PREVIEW_TEXT"].'"' : '"'.$item["PREVIEW_TEXT"];
        ?>
        <div class="item" id="<?=$this->GetEditAreaId($item['ID']);?>">
            <div class="side-block side-opin">
                <div class="inner-block">
                    <div class="title">
                        <div class="photo-block">
                            <img src="<?=$linkImage?>" alt="<?=$imageAlt?>">
                        </div>
                        <div class="name-block">
                            <? if ($canDisplay['DETAIL_PAGE']): ?>
                                <a href="<?=$linkDetailPage?>"><?=$name?></a>
                            <? else: ?>
                                <span><?=$name?></span>
                            <? endif; ?>
                        </div>
                        <div class="pos-block"><?=$description?></div>
                    </div>
                    <div class="text-block"><?=$previewText?></div>
                </div>
            </div>
        </div>
    <?endforeach;?>
</div>