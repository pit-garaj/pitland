<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */
?>

<div class="info contacts_block_footer">
    <span class="white_middle_text">Наши контакты</span>
    <?php if (!empty($arResult['PHONE']['MAIN'])): ?>
        <div class="phone blocks">
            <div class="phone with_dropdown">
                <i class="svg svg-phone"></i>
                <a rel="nofollow" href="tel:<?=$arResult['PHONE']['MAIN']['LINK']?>"><?=$arResult['PHONE']['MAIN']['TEXT']?></a>
                <?php if(!empty($arResult['PHONE']['ADDITIONAL'])): ?>
                    <div class="dropdown">
                        <div class="wrap">
                            <?php foreach($arResult['PHONE']['ADDITIONAL'] as $phone): ?>
                                <div class="more_phone"><a rel="nofollow" href="tel:<?=$phone['LINK']?>"><i class="fa <?=$phone['CLASS']?>"></i> <?=$phone['TEXT']?></a></div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>

    <?php if(!empty($arResult['PHONE']['REGIONAL'])): ?>
        <div class="phone blocks">
            <div class="phone">
                <i class="svg svg-phone"></i>
                <a rel="nofollow" href="tel:<?=$arResult['PHONE']['REGIONAL']['LINK']?>"><?=$arResult['PHONE']['REGIONAL']['TEXT']?></a>
            </div>
        </div>
    <?php endif ?>

    <?php if (!empty($arResult['EMAIL'])): ?>
        <div class="email blocks">
            <a href="mailto:<?=$arResult['EMAIL']?>"><?=$arResult['EMAIL']?></a>
        </div>
    <?php endif ?>

    <div class="address blocks">
        <!--noindex--><a rel="nofollow" href="https://pitland.ru/contacts/">Контакты</a><!--/noindex-->
    </div>
</div>
