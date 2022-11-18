<?php
$nTotalPrice = 0;
$percent = 0;
?>
<div class="basket-bottom-progressbar-left">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        //Процентное соотношение цены подарков к общей
        $nTotalPrice = (int)ceil($arItem['TOTAL_PRICE']);
        $percent = (floatval($arItem['PRICE']) / $nTotalPrice) * 100;
        ?>
        <div class="basket-bottom-progressbar-left-gift" style="left: <?=$percent?>%;" data-margin="<?=$percent?>">
            <div class="basket-bottom-progressbar-left-gift__title"><?=$arItem['NAME']?></div>
            <div class="basket-bottom-progressbar-left-gift__circle"></div>
        </div>
    <? endforeach; ?>
    <?if($arResult["ITEMS"] != '' || !empty($arResult["ITEMS"])):?>
        <div class="basket-bottom-progressbar-left-progressbar" data-progressbar-price="<?=$nTotalPrice;?>">
            <div class="basket-bottom-progressbar-left-progressbar__active-line"></div>
        </div>
    <?endif;?>
</div>