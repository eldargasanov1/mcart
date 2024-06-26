<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <nav class="main-menu">

        <? $previousLevel = 0; ?>
        <? foreach ($arResult as $arItem): ?>

            <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
                <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
            <? endif ?>

            <? if ($arItem["IS_PARENT"]): ?>

                <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                    <li class="item">
                        <div class="title-block"><?= $arItem["TEXT"] ?></div>
                        <ul>
                <? else: ?>
                    <li>
                        <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                        <ul>
                <? endif ?>

            <? else: ?>

                <? if ($arItem["PERMISSION"] > "D"): ?>

                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                        <li class="item">
                            <div class="title-block"><?= $arItem["TEXT"] ?></div
                        </li>
                    <? else: ?>
                        <li>
                            <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                        </li>
                    <? endif ?>

                <? endif ?>

            <? endif ?>

        <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

        <? endforeach ?>

        <? if ($previousLevel > 1)://close last item tags?>
            <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
        <? endif ?>

    </nav>
<? endif ?>