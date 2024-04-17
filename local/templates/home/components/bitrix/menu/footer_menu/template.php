<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="row mb-5">
    <div class="col-md-12">
        <h3 class="footer-heading mb-4"><?= GetMessage("FOOTER_MENU_TITLE")?></h3>
    </div>

<?php
    $countOfRows = ceil(count($arResult) / 4);
    $copiedArr = $arResult;
    $counter = 0;
?>

<?php for ($i = 0; $i < $countOfRows; $i++): ?>
    <div class="col-md-6 col-lg-6">
        <ul class="list-unstyled">
            <?php foreach ($copiedArr as $item): ?>
                <li><a href="<?=$item["LINK"]?>"><?=$item["TEXT"]?></a></li>
                <?php
                    $counter++;
                    if ($counter % 4 == 0) {
                        array_splice($copiedArr, $counter - 4, 4);
                        break;
                    }
                ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endfor ?>

</div>
<?endif?>