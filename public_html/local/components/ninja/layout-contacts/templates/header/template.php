<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */
?>

<?php if (!empty($arResult['PHONE']['MAIN'])): ?>
  <div class="top-block-item pull-right">
    <div class="phone-block">
      <div class="inline-block">
        <div class="phone<?php if(!empty($arResult['PHONE']['ADDITIONAL'])): ?> with_dropdown<?php endif; ?>">
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
      <?php if(!empty($arResult['PHONE']['REGIONAL'])): ?>
        <div class="inline-block">
          <div class="phone">
            <i class="svg svg-phone"></i>
            <a rel="nofollow" href="tel:<?=$arResult['PHONE']['REGIONAL']['LINK']?>"><?=$arResult['PHONE']['REGIONAL']['TEXT']?></a>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
<?php endif ?>
