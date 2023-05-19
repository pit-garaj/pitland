<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */
?>

<?php if (!empty($arResult['MAIN'])): ?>
  <div class="top-block-item pull-right">
    <div class="phone-block">
      <div class="inline-block">
        <div class="phone<?php if(!empty($arResult['ADDITIONAL'])): ?> with_dropdown<?php endif; ?>">
          <i class="svg svg-phone"></i>
          <a rel="nofollow" href="tel:<?=$arResult['MAIN']['LINK']?>"><?=$arResult['MAIN']['TEXT']?></a>
            <?php if(!empty($arResult['ADDITIONAL'])): ?>
              <div class="dropdown">
                <div class="wrap">
                  <?php foreach($arResult['ADDITIONAL'] as $phone): ?>
                    <div class="more_phone"><a rel="nofollow" href="tel:<?=$phone['LINK']?>"><i class="fa <?=$phone['CLASS']?>"></i> <?=$phone['TEXT']?></a></div>
                  <?php endforeach ?>

                  <!--<div class="more_phone"><a rel="nofollow" href="tel:+79689984612"><i class="svg svg-phone"></i> +7 (968) 998 46 12</a></div>-->
                </div>
              </div>
            <?php endif; ?>
        </div>
      </div>
      <?php if(!empty($arResult['REGIONAL'])): ?>
        <div class="inline-block">
          <div class="phone">
            <i class="svg svg-phone"></i>
            <a rel="nofollow" href="tel:<?=$arResult['REGIONAL']['LINK']?>"><?=$arResult['REGIONAL']['TEXT']?></a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php endif ?>
