<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>

<div class="site-section site-section-sm bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <div class="site-section-title">
                    <h2><?= GetMessage("NEW_PROPERTIES_TITLE") ?></h2>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <? if (is_array($arItem["PREVIEW_PICTURE"])): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="col-md-6 col-lg-4 mb-4">
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="prop-entry d-block">
                            <figure>
                                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>" class="img-fluid blog-img">
                            </figure>
                            <div class="prop-text">
                                <div class="inner">
                                    <span class="price rounded"><?= GetMessage("NEW_PROPERTIES_CURRENCY") ?><?= $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] ?></span>
                                    <h3 class="title"><?= $arItem['NAME'] ?></h3>
                                    <p class="location"><?= $arItem['PREVIEW_TEXT'] ?></p>
                                </div>
                                <div class="prop-more-info">
                                    <div class="inner d-flex">
                                        <div class="col">
                                            <span><?= GetMessage("NEW_PROPERTIES_AREA") ?>:</span>
                                            <strong><?= $arItem['DISPLAY_PROPERTIES']['TOTAL_AREA']['VALUE'] ?>
                                                m<sup>2</sup></strong>
                                        </div>
                                        <div class="col">
                                            <span><?= GetMessage("NEW_PROPERTIES_FLOORS") ?>:</span>
                                            <strong><?= $arItem['DISPLAY_PROPERTIES']['NUMBER_OF_FLOORS']['VALUE'] ?></strong>
                                        </div>
                                        <div class="col">
                                            <span><?= GetMessage("NEW_PROPERTIES_BATHS") ?>:</span>
                                            <strong><?= $arItem['DISPLAY_PROPERTIES']['NUMBER_OF_BATHROOMS']['VALUE'] ?></strong>
                                        </div>
                                        <div class="col">
                                            <span><?= GetMessage("NEW_PROPERTIES_GARAGE") ?>:</span>
                                            <strong>
                                                <? if ($arItem['DISPLAY_PROPERTIES']['GARAGE_AVAILABILITY']['VALUE']): ?>
                                                    <?= $arItem['DISPLAY_PROPERTIES']['GARAGE_AVAILABILITY']['VALUE'] ?>
                                                <? else: ?>
                                                    <?= GetMessage("NEW_PROPERTIES_GARAGE_NO") ?>
                                                <? endif; ?>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <? endif ?>
            <? endforeach; ?>
        </div>
        <?= $arResult["NAV_STRING"]?>
    </div>
</div>