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

$detailPic = $arResult["DETAIL_PICTURE"]["SRC"];
$name = $arResult["NAME"];
$priceValue = $arResult["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"];
$imageGallery = $arResult["DISPLAY_PROPERTIES"]["IMAGE_GALLERY"]["FILE_VALUE"];
$floors = $arResult["DISPLAY_PROPERTIES"]["NUMBER_OF_FLOORS"]["VALUE"];
$bath = $arResult["DISPLAY_PROPERTIES"]["NUMBER_OF_BATHROOMS"]["VALUE"];
$area = $arResult["DISPLAY_PROPERTIES"]["TOTAL_AREA"]["VALUE"];
$garage = $arResult["DISPLAY_PROPERTIES"]["GARAGE_AVAILABILITY"]["VALUE"];
$price = GetMessage('ADS_CURRENCY').$priceValue;
$date = $arResult["DISPLAY_ACTIVE_FROM"];
$arAddMaterials = $arResult["DISPLAY_PROPERTIES"]["ADDITIONAL_MATERIALS"]["FILE_VALUE"];
$arLinks = $arResult["DISPLAY_PROPERTIES"]["LINKS_TO_EXTERNAL_RESOURCES"]["VALUE"];
?>

<div class="site-blocks-cover overlay" style="background-image: url(<?=$detailPic?>);" data-aos="fade"
     data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
                <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded"><?=GetMessage('ADS_PROPERTY_DETAILS_OF')?></span>
                <h1 class="mb-2"><?=$name?></h1>
                <p class="mb-5"><strong class="h2 text-success font-weight-bold"><?=$price?></strong></p>
            </div>
        </div>
    </div>
</div>
<div class="site-section site-section-sm">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" style="margin-top: -150px;">
                <div class="mb-5">
                    <div class="slide-one-item home-slider owl-carousel">
                        <? foreach ($imageGallery as $image): ?>
                        <div><img src="<?=$image["SRC"]?>" alt="<?=$name?>" class="img-fluid"></div>
                        <? endforeach; ?>
                    </div>
                </div>
                <div class="bg-white">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <strong class="text-success h1 mb-3"><?=$price?></strong>
                        </div>
                        <div class="col-md-6">
                            <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                <li>
                                    <span class="property-specs"><?=GetMessage('ADS_DATE')?></span>
                                    <span class="property-specs-number"><?=$date?></span>

                                </li>
                                <li>
                                    <span class="property-specs"><?=GetMessage('ADS_FLOORS')?></span>
                                    <span class="property-specs-number"><?=$floors?></span>

                                </li>
                                <li>
                                    <span class="property-specs"><?=GetMessage('ADS_AREA')?></span>
                                    <span class="property-specs-number"><?=$area?>m<sup>2</sup></span>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text"><?=GetMessage('ADS_BATHS')?></span>
                            <strong class="d-block"><?=$bath?></strong>
                        </div>
                        <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text"><?=GetMessage('ADS_GARAGE')?></span>
                            <strong class="d-block">
                                <? if ($garage): ?>
                                    <?= $garage ?>
                                <? else: ?>
                                    <?= GetMessage("ADS_NO") ?>
                                <? endif; ?>
                            </strong>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3"><?=GetMessage('ADS_MORE_INFO')?></h2>
                        </div>
                        <p><?=$arResult["DETAIL_TEXT"]?></p>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3"><?=GetMessage('ADS_PROPERTY_GALLERY')?></h2>
                        </div>
                        <? foreach ($imageGallery as $image): ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <a href="<?=$image["SRC"]?>" class="image-popup gal-item"><img src="<?=$image["SRC"]?>" alt="<?=$name?>" class="img-fluid"></a>
                        </div>
                        <? endforeach; ?>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3"><?=GetMessage('ADS_ADD_MATERIALS')?></h2>
                        </div>
                        <?php if ($arAddMaterials["ID"]): ?>
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                <a href="<?=$arAddMaterials["SRC"]?>" class="image-popup gal-item"><img src="<?=$arAddMaterials["SRC"]?>" alt="<?=$name?>" class="img-fluid"></a>
                            </div>
                        <?php else: ?>
                            <? foreach ($arAddMaterials as $material): ?>
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <a href="<?=$material["SRC"]?>" class="image-popup gal-item"><img src="<?=$material["SRC"]?>" alt="<?=$name?>" class="img-fluid"></a>
                                </div>
                            <? endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3"><?=GetMessage('ADS_EXT_LINKS')?></h2>
                        </div>
                        <? foreach ($arLinks as $link): ?>
                            <div class="col-12 mb-1">
                                <a href="<?=$link?>" class=""><?=$link?></a>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pl-md-5">

                <div class="bg-white widget border rounded">

                    <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                    <form action="" class="form-contact-agent">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="phone" class="btn btn-primary" value="Send Message">
                        </div>
                    </form>
                </div>

                <div class="bg-white widget border rounded">
                    <h3 class="h4 text-black widget-title mb-3">Paragraph</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit qui explicabo, libero nam, saepe
                        eligendi. Molestias maiores illum error rerum. Exercitationem ullam saepe, minus, reiciendis ducimus quis.
                        Illo, quisquam, veritatis.</p>
                </div>

            </div>

        </div>
    </div>
</div>