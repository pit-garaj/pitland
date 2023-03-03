<?php

use Ninja\Helper\User\User;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */

$userId = User::getAuthenticatedId();

$this->addExternalCss('https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css');
$this->addExternalJS("https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js");
?>

<div class="maxwidth-theme">
  <div class="header-banners-wrapper">
      <?php if(!empty($arResult['BANNERS']['MAIN'])): ?>
        <div class="header-banners-item">
          <div class="swiper header-banners header-banners__main<?php if(count($arResult['BANNERS']['MAIN']) > 1): ?> header-slider-main<?php endif; ?>">
            <div class="swiper-wrapper">
                <?php foreach($arResult['BANNERS']['MAIN'] as $banner): ?>
                  <div class="swiper-slide header-banner-item" data-swiper-autoplay="<?=$banner['autoplay']?>">
                      <?php if ($banner['link']): ?>
                        <a href="<?=$banner['link']?>" target="<?=$banner['target']?>"><img src="<?=$banner['picture']['src']?>" class="header-banner-item__picture" alt="" /></a>
                      <?php else: ?>
                        <img src="<?=$banner['picture']['src']?>" class="header-banner-item__picture" alt="" />
                      <?php endif; ?>
                  </div>
                <?php endforeach; ?>
            </div>
              <?php if(count($arResult['BANNERS']['MAIN']) > 1): ?>
                <div class="header-banners-nav header-banners-nav__prev">
                  <div class="header-banners-nav__icon"></div>
                </div>
                <div class="header-banners-nav header-banners-nav__next">
                  <div class="header-banners-nav__icon"></div>
                </div>
              <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if(!empty($arResult['BANNERS']['ADDITIONAL'])): ?>
        <div class="header-banners-item">
          <div class="swiper header-banners header-banners__additional<?php if(count($arResult['BANNERS']['ADDITIONAL']) > 1): ?> header-slider-additional<?php endif; ?>">
            <div class="swiper-wrapper">
                <?php foreach($arResult['BANNERS']['ADDITIONAL'] as $banner): ?>
                  <div class="swiper-slide header-banner-item" data-swiper-autoplay="<?=$banner['autoplay']?>">
                      <?php if ($banner['link']): ?>
                        <a href="<?=$banner['link']?>" target="<?=$banner['target']?>"><img src="<?=$banner['picture']['src']?>" class="header-banner-item__picture" alt="" /></a>
                      <?php else: ?>
                        <img src="<?=$banner['picture']['src']?>" class="header-banner-item__picture" alt="" />
                      <?php endif; ?>
                  </div>
                <?php endforeach; ?>
            </div>
              <?php if(count($arResult['BANNERS']['ADDITIONAL']) > 1): ?>
                <div class="header-banners-nav header-banners-nav__prev">
                  <div class="header-banners-nav__icon"></div>
                </div>
                <div class="header-banners-nav header-banners-nav__next">
                  <div class="header-banners-nav__icon"></div>
                </div>
              <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
  </div>
</div>
