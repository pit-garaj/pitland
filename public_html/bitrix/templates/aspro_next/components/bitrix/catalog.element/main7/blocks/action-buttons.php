<?php
/** @var array $arParams */
/** @var array $arResult */
/** @var array $arItemIDs */
/** @var bool $tehnika */
/** @var bool $showCustomOffer */

$notAvailability = $arResult['AVAILABILITY']['availability_style'] === 'danger';
?>
<div class="row catItemsBtn">
    <?php if ($notAvailability): ?>
      <div class="col-md-6">
        <div class="counter_wrapp">
          <span
            class="btn-lg w_icons to-order btn btn-default white grey transition_bg transparent animate-load"
            data-event="jqm"
            data-param-form_id="TOORDER"
            data-name="toorder"
            data-autoload-product_id="<?=$arResult['ID']?>">
            <i></i><span>Сообщить о наличии</span>
          </span>
        </div>
      </div>
    <?php else: ?>
      <div class="col-md-6">
          <?php if ($arResult["OFFERS"] && $showCustomOffer): ?>
            <div class="offer_buy_block buys_wrapp ownd-offer-buy_button" style="display:none;">
              <div class="counter_wrapp"></div>
            </div>
          <?php endif ?>

        <div class="counter_wrapp">
            <?php
            // fix для отключения колличества у техники
            $arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] = false;
            ?>
            <?php if (($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] && $arAddToBasketData["ACTION"] === "ADD") && $arAddToBasketData["CAN_BUY"]): ?>
              <div
                class="counter_block big_basket"
                data-offers="<?= $arResult['OFFERS'] ? 'Y' : 'N' ?>"
                data-item="<?= $arResult['ID'] ?>" <?= $arResult['OFFERS'] && $arParams['TYPE_SKU'] === 'N' ? "style='display: none;'" : '' ?>>
                <span class="minus" id="<?= $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN'] ?>">-</span>
                <input
                  type="text"
                  class="text"
                  id="<?= $arItemIDs["ALL_ITEM_IDS"]['QUANTITY'] ?>"
                  name="<?= $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
                  value="<?= $arAddToBasketData['MIN_QUANTITY_BUY'] ?>"/>
                <span class="plus" id="<?= $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP'] ?>" <?= $arAddToBasketData['MAX_QUANTITY_BUY'] ? "data-max='" . $arAddToBasketData['MAX_QUANTITY_BUY'] . "'" : '' ?>>+</span>
              </div>
            <?php endif; ?>
          <div
            id="<?= $arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS'] ?>"
            class="button_block <?= $arAddToBasketData['ACTION'] === 'ORDER' || !$arAddToBasketData['CAN_BUY'] || !$arAddToBasketData['OPTIONS']['USE_PRODUCT_QUANTITY_DETAIL'] || ($arAddToBasketData['ACTION'] === 'SUBSCRIBE' && $arResult['CATALOG_SUBSCRIBE'] === 'Y') ? 'wide' : '' ?>"
          >
            <!--noindex--><?=$arAddToBasketData['HTML']?><!--/noindex-->
          </div>
        </div>
      </div>
    <?php endif ?>

    <?php if ($tehnika): ?>
      <div class="col-md-6<?= ($notAvailability) ? ' hidden' : '' ?>">
        <div class="counter_wrapp">
            <span
                class="btn btn-default white btn-lg type_block transition_bg one_click ownd-oneclick-button"
                data-event="jqm"
                data-param-form_id="CALCULATE_CREDIT"
                data-name="cheaper"
                data-autoload-product_name="<?= CNext::formatJsName($arResult['NAME'],) ?>"
                data-autoload-product_link="https://<?= SITE_SERVER_NAME ?><?= $arResult['DETAIL_PAGE_URL'] ?>"
                data-autoload-product_price="<?= $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] ?>"
            >
                <span>Расчет рассрочки/кредита</span>
            </span>
        </div>
      </div>
    <?php else: ?>
      <div class="col-md-6<?= ($notAvailability) ? ' hidden' : '' ?>">
        <div class="counter_wrapp">
            <span
                class="btn btn-default white btn-lg type_block transition_bg one_click ownd-oneclick-button one-click-by-btn"
                data-item="<?= $arResult['ID'] ?>"
                data-iblockID="<?= $arParams['IBLOCK_ID'] ?>"
                data-quantity="<?= $arAddToBasketData['MIN_QUANTITY_BUY'] ?>"
                onclick="oneClickBuy('<?= $arResult['ID'] ?>', '<?= $arParams['IBLOCK_ID'] ?>', this)"
            >
                <span><?= GetMessage('ONE_CLICK_BUY') ?></span>
            </span>
        </div>
      </div>
    <?php endif ?>

    <?php if ($tehnika): ?>
      <div class="col-md-6<?= ($notAvailability) ? ' hidden' : '' ?>">
        <div class="counter_wrapp">
          <span
            class="btn btn-default white btn-lg type_block transition_bg one_click ownd-oneclick-button one-click-by-btn"
            data-item="<?= $arResult['ID'] ?>"
            data-iblockID="<?= $arParams['IBLOCK_ID'] ?>"
            data-quantity="<?= $arAddToBasketData['MIN_QUANTITY_BUY'] ?>"
            onclick="oneClickBuy('<?= $arResult['ID'] ?>', '<?= $arParams['IBLOCK_ID'] ?>', this)"
          >
              <span><?= GetMessage('ONE_CLICK_BUY') ?></span>
          </span>
        </div>
      </div>
      <div class="col-md-6<?= ($notAvailability) ? ' hidden' : '' ?>">
        <div class="counter_wrapp">
          <span
            class="btn btn-default white btn-lg type_block transition_bg one_click"
            data-event="jqm"
            data-param-form_id="CHEAPER"
            data-name="cheaper"
            data-autoload-product_name="<?= CNext::formatJsName($arResult['NAME'],) ?>"
            data-autoload-product_id="<?= $arResult['ID'] ?>"
          >
            <span>Хочу дешевле</span>
          </span>
        </div>
      </div>

      <div class="col-md-6">
        <div class="counter_wrapp">
          <span
            class="btn btn-default white btn-lg type_block transition_bg one_click ownd-oneclick-button"
            data-event="jqm"
            data-param-form_id="TRADE_IN"
            data-name="cheaper"
          >
              <span>TRADE-IN</span>
          </span>
        </div>
      </div>
    <?php endif ?>
</div>


<script>
$(document).ready(function () {
  $('.catalog_detail input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
});
</script>
