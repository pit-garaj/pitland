<?php
/** @var array $arItem */
/** @var array $arParams */
/** @var array $arItemIDs */
/** @var array $arAddToBasketData */
?>
<?php if (!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'): ?>
  <div class="counter_wrapp <?= ($arItem["OFFERS"] && $arParams["TYPE_SKU"] === "TYPE_1" ? 'woffers' : '') ?>">
      <?php if ($arItem['AVAILABILITY']['availability_style'] !== 'danger'): ?>
          <?php if (($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] === "ADD") && $arAddToBasketData["CAN_BUY"]): ?>
          <div class="counter_block" data-offers="<?= ($arItem["OFFERS"] ? "Y" : "N"); ?>" data-item="<?= $arItem["ID"]; ?>">
            <span class="minus" id="<?= $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN'] ?>">-</span>
            <input type="text" class="text" id="<?= $arItemIDs["ALL_ITEM_IDS"]['QUANTITY'] ?>" name="<?= $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>" value="<?= $arAddToBasketData["MIN_QUANTITY_BUY"] ?>"/>
            <span class="plus" id="<?= $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP'] ?>" <?= ($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='" . $arAddToBasketData["MAX_QUANTITY_BUY"] . "'" : "") ?>>+</span>
          </div>
          <?php endif ?>
        <div id="<?= $arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS'] ?>" class="action_block"><?= $arAddToBasketData["HTML"] ?></div>
        <div class="action_block">
          <button
            class="small btn btn-default white transition_bg animate-load"
            data-item="<?= $arItem['ID'] ?>"
            data-iblockid="<?= $arItem['IBLOCK_ID'] ?>"
            data-quantity="1"
            onclick="oneClickBuy(<?= $arItem['ID'] ?>, <?= $arItem['IBLOCK_ID'] ?>, this)">
            <span>Купить в 1 клик</span>
          </button>
        </div>
      <?php else: ?>
        <div class="action_block">
          <button class="btn-lg w_icons to-order btn btn-default transition_bg transparent animate-load" data-event="jqm" data-param-form_id="TOORDER" data-name="toorder" data-autoload-product_id="<?= $arItem['ID'] ?>">
            <i></i><span>Сообщить о наличии</span>
          </button>
        </div>
        <div class="action_block">
          <button class="btn-lg w_icons to-order btn btn-default white grey transition_bg transparent animate-load" data-event="jqm" data-param-form_id="TOORDER" data-name="toorder" data-autoload-product_id="<?= $arItem['ID'] ?>">
            <i></i><span>Под заказ</span>
          </button>
        </div>
      <?php endif ?>
  </div>
    <?php if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']): ?>
        <?php if ($arItem['ITEM_PRICE_MODE'] === 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1): ?>
            <?php $arOnlyItemJSParams = array(
                "ITEM_PRICES"          => $arItem["ITEM_PRICES"],
                "ITEM_PRICE_MODE"      => $arItem["ITEM_PRICE_MODE"],
                "ITEM_QUANTITY_RANGES" => $arItem["ITEM_QUANTITY_RANGES"],
                "MIN_QUANTITY_BUY"     => $arAddToBasketData["MIN_QUANTITY_BUY"],
                "ID"                   => $arItemIDs["strMainID"],
            ) ?>
      <script type="text/javascript">
      var <?=$arItemIDs["strObName"]?>el = new JCCatalogSectionOnlyElement(<?=CUtil::PhpToJSObject($arOnlyItemJSParams, false, true)?>);
      </script>
        <?php endif ?>
    <?php endif ?>
<?php elseif ($arItem["OFFERS"]): ?>
    <?php if (empty($arItem['OFFERS_PROP'])): ?>
    <div class="offer_buy_block buys_wrapp woffers">
        <?php
        $arItem["OFFERS_MORE"] = "Y";
        $arAddToBasketData = CNext::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small read_more1', $arParams); ?>
      <!--noindex-->
        <?= $arAddToBasketData["HTML"] ?>
      <!--/noindex-->
    </div>
    <?php else: ?>
    <div class="offer_buy_block buys_wrapp woffers" style="display:none;">
      <div class="counter_wrapp"></div>
    </div>
    <?php endif ?>
<?php endif ?>
