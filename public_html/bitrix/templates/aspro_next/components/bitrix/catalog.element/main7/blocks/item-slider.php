<?php
/** @var array $arParams */
/** @var array $arResult */
/** @var bool $showCustomOffer */
/** @var array $arItemIDs */
/** @var array $arAddToBasketData */
/** @var string $arOfferProps */
?>
<div class="item_slider">
    <?php if (($arParams["DISPLAY_WISH_BUTTONS"] !== "N" || $arParams["DISPLAY_COMPARE"] === "Y") || (strlen($arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer))): ?>
      <div class="like_wrapper">
          <?php if($arParams["DISPLAY_WISH_BUTTONS"] !== "N" || $arParams["DISPLAY_COMPARE"] === "Y"): ?>
            <div class="like_icons iblock">
                <?php if($arParams["DISPLAY_WISH_BUTTONS"] !== "N"): ?>
                    <?php if(!$arResult["OFFERS"]): ?>
                    <div class="wish_item text" <?=$arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"'?> data-item="<?=$arResult['ID']?>" data-iblock="<?=$arResult['IBLOCK_ID']?>">
                      <span class="value" title="<?= GetMessage('CT_BCE_CATALOG_IZB') ?>" ><i></i></span>
                      <span class="value added" title="<?= GetMessage('CT_BCE_CATALOG_IZB_ADDED') ?>"><i></i></span>
                    </div>
                    <?php elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !empty($arResult['OFFERS_PROP'])): ?>
                    <div class="wish_item text " <?= $arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"' ?> data-item="" data-iblock="<?= $arResult['IBLOCK_ID'] ?>" <?= !empty($arResult['OFFERS_PROP']) ? 'data-offers="Y"' : '' ?> data-props="<?= $arOfferProps ?>">
                      <span class="value <?= $arParams['TYPE_SKU'] ?>" title="<?= GetMessage('CT_BCE_CATALOG_IZB') ?>"><i></i></span>
                      <span class="value added <?= $arParams['TYPE_SKU'] ?>" title="<?= GetMessage('CT_BCE_CATALOG_IZB_ADDED') ?>"><i></i></span>
                    </div>
                    <?php endif ?>
                <?php endif ?>
                <?php if($arParams["DISPLAY_COMPARE"] === "Y"): ?>
                    <?php if(!$arResult["OFFERS"] || ($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !$arResult["OFFERS_PROP"])): ?>
                    <div data-item="<?= $arResult['ID'] ?>" data-iblock="<?= $arResult['IBLOCK_ID'] ?>" data-href="<?= $arResult['COMPARE_URL'] ?>" class="compare_item text <?= $arResult['OFFERS'] ? $arParams['TYPE_SKU'] : '' ?>" id="<?=$arItemIDs["ALL_ITEM_IDS"]['COMPARE_LINK']?>">
                      <span class="value" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE') ?>"><i></i></span>
                      <span class="value added" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE_ADDED') ?>"><i></i></span>
                    </div>
                    <?php elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1'): ?>
                    <div data-item="" data-iblock="<?= $arResult['IBLOCK_ID'] ?>" data-href="<?= $arResult['COMPARE_URL'] ?>" class="compare_item text <?= $arParams['TYPE_SKU'] ?>">
                      <span class="value" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE') ?>"><i></i></span>
                      <span class="value added" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE_ADDED') ?>"><i></i></span>
                    </div>
                    <?php endif ?>
                <?php endif ?>
            </div>
          <?php endif ?>
      </div>
    <?php endif ?>

    <?php
    reset($arResult['MORE_PHOTO']);
    $arFirstPhoto = current($arResult['MORE_PHOTO']);
    $viewImgType=$arParams["DETAIL_PICTURE_MODE"];?>
  <div class="slides">
      <?php if($showCustomOffer && !empty($arResult['OFFERS_PROP'])): ?>
        <div class="offers_img wof">
            <?
            $alt=$arFirstPhoto["ALT"];
            $title=$arFirstPhoto["TITLE"];
            ?>
            <?php if($arFirstPhoto["BIG"]["src"]): ?>
              <a href="<?= $viewImgType == 'POPUP' ? $arFirstPhoto['BIG']['src'] : 'javascript:void(0)' ?>" class="<?= $viewImgType == 'POPUP' ? 'popup_link' : 'line_link' ?>" title="<?= $title ?>">
                <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?= $arFirstPhoto['SMALL']['src'] ?>" <?= $viewImgType == 'MAGNIFIER' ? 'data-large="" xpreview="" xoriginal=""' : '' ?> alt="<?= $alt ?>" title="<?= $title ?>" itemprop="image">
                <div class="zoom"></div>
              </a>
            <?php else: ?>
              <a href="javascript:void(0)" class="" title="<?= $title ?>">
                <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?= $arFirstPhoto['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" itemprop="image">
                <div class="zoom"></div>
              </a>
            <?php endif ?>
        </div>
      <?php else: ?>
          <?php if ($arResult["MORE_PHOTO"]): ?>
              <?php
              $bMagnifier = ($viewImgType === "MAGNIFIER");?>
          <ul>
              <?php foreach($arResult["MORE_PHOTO"] as $i => $arImage): ?>
                  <?php
                  if($i && $bMagnifier) {
                      continue;
                  }
                  $isEmpty= !$arImage["SMALL"]["src"];
                  $alt=$arImage["ALT"];
                  $title=$arImage["TITLE"];
                  ?>
                <li id="photo-<?= $i ?>" <?= !$i ? 'class="current"' : 'style="display: none;"' ?>>
                    <?php if(!$isEmpty): ?>
                      <a href="<?= $viewImgType === 'POPUP' ? $arImage['BIG']['src'] : 'javascript:void(0)' ?>" <?= $bIsOneImage ? '' : 'data-fancybox-group="item_slider"' ?> class="<?= $viewImgType === 'POPUP' ? 'popup_link fancy' : 'line_link' ?>" title="<?= $title ?>">
                        <img  src="<?= $arImage['SMALL']['src'] ?>" <?= $viewImgType === 'MAGNIFIER' ? "class='zoom_picture'" : '' ?> <?= $viewImgType === 'MAGNIFIER' ? 'xoriginal="' . $arImage['BIG']['src'] . '" xpreview="' . $arImage['THUMB']['src'] . '"' : '' ?> alt="<?= $alt ?>" title="<?= $title ?>"<?= !$i ? ' itemprop="image"' : '' ?>/>
                        <div class="zoom"></div>
                      </a>
                    <?php else: ?>
                      <img  src="<?= $arImage['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
                    <?php endif ?>
                </li>
              <?php endforeach ?>
          </ul>
          <?php endif ?>
      <?php endif ?>
  </div>

    <?php /*thumbs*/ ?>
    <?php if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])): ?>
        <?php if(count($arResult["MORE_PHOTO"]) > 1):?>
      <div class="wrapp_thumbs xzoom-thumbs">
        <div class="thumbs flexslider" data-plugin-options='{"animation": "slide", "selector": ".slides_block > li", "directionNav": true, "itemMargin":10, "itemWidth": 100, "controlsContainer": ".thumbs_navigation", "controlNav" :false, "animationLoop": true, "slideshow": false}' style="max-width:<?= ceil((count($arResult['MORE_PHOTO']) <= 4 ? count($arResult['MORE_PHOTO']) : 4) * 110 - 10,) ?>px;">
          <ul class="slides_block" id="thumbs">
              <?php foreach($arResult["MORE_PHOTO"]as $i => $arImage): ?>
                <li <?= !$i ? 'class="current"' : '' ?> data-big_img="<?= $arImage['BIG']['src'] ?>" data-small_img="<?= $arImage['SMALL']['src'] ?>">
                  <span><img class="xzoom-gallery" width="100" xpreview="<?= $arImage['SMALL']['src'] ?>" src="<?= $arImage['SMALL']['src'] ?>" alt="<?= $arImage['ALT'] ?>" title="<?= $arImage['TITLE'] ?>" /></span>
                </li>
              <?php endforeach ?>
          </ul>
          <span class="thumbs_navigation custom_flex"></span>
        </div>
      </div>
      <script>
      $(document).ready(function(){
        $('.item_slider .thumbs li').first().addClass('current');
        $('.item_slider .thumbs .slides_block').delegate('li:not(.current)', 'click', function(){
          var slider_wrapper = $(this).parents('.item_slider');
          var index = $(this).index();
          $(this).addClass('current').siblings().removeClass('current')//.parents('.item_slider').find('.slides li').fadeOut(333);
          if(arNextOptions['THEME']['DETAIL_PICTURE_MODE'] === 'MAGNIFIER') {
            var li = $(this).parents('.item_slider').find('.slides li');
            li.find('img').attr('src', $(this).data('small_img'));
            li.find('img').attr('xoriginal', $(this).data('big_img'));
          } else {
            slider_wrapper.find('.slides li').removeClass('current').hide();
            slider_wrapper.find('.slides li:eq('+index+')').addClass('current').show();
          }
        });
      })
      </script>
    <?php endif ?>
    <?php else: ?>
      <div class="wrapp_thumbs">
        <div class="sliders">
          <div class="thumbs" style="">
          </div>
        </div>
      </div>
    <?php endif ?>
</div>
<?php /*mobile*/ ?>
<?php if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])): ?>
  <div class="item_slider color-controls flex flexslider" data-plugin-options='{"animation": "slide", "directionNav": false, "controlNav": true, "animationLoop": false, "slideshow": false, "slideshowSpeed": 10000, "animationSpeed": 600}'>
    <ul class="slides">
        <?php if ($arResult['MORE_PHOTO']):  ?>
            <?php foreach ($arResult["MORE_PHOTO"] as $i => $arImage): ?>
                <?php
                $isEmpty= !$arImage["SMALL"]["src"];
                ?>
              <li id="mphoto-<?= $i ?>" <?= !$i ? 'class="current"' : 'style="display: none;"' ?>>
                  <?php
                  $alt=$arImage["ALT"];
                  $title=$arImage["TITLE"];
                  ?>
                  <?php if(!$isEmpty): ?>
                    <a href="<?= $arImage['BIG']['src'] ?>" data-fancybox-group="item_slider_flex" class="fancy popup_link" title="<?= $title ?>" >
                      <img src="<?= $arImage['SMALL']['src'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
                      <div class="zoom"></div>
                    </a>
                  <?php else: ?>
                    <img src="<?= $arImage['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
                  <?php endif ?>
              </li>
            <?php endforeach ?>
        <?php endif ?>
    </ul>
  </div>
<?php else: ?>
  <div class="item_slider flex color-controls"></div>
<?php endif ?>
