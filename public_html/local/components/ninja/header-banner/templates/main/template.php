<?php

use Ninja\Helper\User\User;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */

$userId = User::getAuthenticatedId();
?>

<?php if ($userId === 1445): ?>
<?php /* ?>
 <pre><?php print_r($arResult['BANNERS']); ?></pre>
<?php */ ?>
<?php endif; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<div class="maxwidth-theme">
  <div class="header-banners-wrapper">
    <div class="header-banners-item">
      <div class="swiper header-banners header-banners__main">
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

        <div class="header-banners-nav header-banners-nav__prev">
          <div class="header-banners-nav__icon"></div>
        </div>
        <div class="header-banners-nav header-banners-nav__next">
          <div class="header-banners-nav__icon"></div>
        </div>
      </div>
    </div>
    <div class="header-banners-item">
      <div class="swiper header-banners header-banners__additional">
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

        <div class="header-banners-nav header-banners-nav__prev">
          <div class="header-banners-nav__icon"></div>
        </div>
        <div class="header-banners-nav header-banners-nav__next">
          <div class="header-banners-nav__icon"></div>
        </div>
      </div>
    </div>
  </div>
</div>
