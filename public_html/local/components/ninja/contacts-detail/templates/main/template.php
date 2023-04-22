<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
/** @var object $APPLICATION */
?>

<?php if ($arResult['city']['map']): ?>
  <div class="contacts-page-map">
    <div class="container-fluid">
        <div id="contacts-ya-map" style="height:475px">
        </div>
    </div>
  </div>
<?php endif ?>
<?php if ($arResult['city']): ?>
  <div class="contacts contacts-page-map-overlay maxwidth-theme">
    <div class="contacts-wrapper" itemscope itemtype="http://schema.org/Organization">
      <div class="row">
        <div class="col-md-3 col-sm-3 print-6">
          <table cellpadding="0" cellspasing="0">
            <tr>
              <td align="left" valign="top"><i class="fa big-icon s45 fa-map-marker"></i></td>
              <td align="left" valign="top">
                <span class="dark_table">Адрес</span><br />
                  <?php if($arResult['city']['address']): ?>
                    <span itemprop="address">
                        <?php foreach ($arResult['city']['address'] as $item): ?>
                          <span><?=$item?></span><br />
                        <?php endforeach ?>
                    </span>
                  <?php endif ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-4 col-sm-4 print-6">
          <table cellpadding="0" cellspasing="0">
            <tr>
              <td align="left" valign="top"><i class="fa big-icon s45 fa-phone"></i></td>
              <td align="left" valign="top">
                <span class="dark_table">Телефон</span><br />
                  <?php if($arResult['city']['phone']): ?>
                    <span itemprop="telephone">
                        <?php foreach ($arResult['city']['phone'] as $item): ?>
                          <p><?=$item?></p>
                        <?php endforeach ?>
                    </span>
                  <?php endif ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-2 col-sm-2 print-6">
          <table cellpadding="0" cellspasing="0">
            <tr>
              <td align="left" valign="top"><i class="fa big-icon s45 fa-envelope"></i></td>
              <td align="left" valign="top">
                <span class="dark_table">E-mail</span><br />
                  <?php if($arResult['city']['email']): ?>
                    <span itemprop="email">
                        <?php foreach ($arResult['city']['email'] as $item): ?>
                          <p><?=$item?></p>
                        <?php endforeach ?>
                    </span>
                  <?php endif ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-3 col-sm-3 print-6">
          <table cellpadding="0" cellspasing="0">
            <tr>
              <td align="left" valign="top"><i class="fa big-icon s45 fa-clock-o"></i></td>
              <td align="left" valign="top">
                <span class="dark_table">Режим работы</span><br />
                  <?php if($arResult['city']['work']): ?>
                    <span>
                        <?php foreach ($arResult['city']['work'] as $item): ?>
                          <p><?=$item?></p>
                        <?php endforeach ?>
                    </span>
                  <?php endif ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row1">
    <div class="contacts maxwidth-theme top-cart">
      <div class="cols-md-12" itemprop="description">
        <div class="contacts-shops">
            <?php foreach ($arResult['shops'] as $item): ?>
              <h2>Как добраться до «<?=$item['name']?>»</h2>
                <?php if ($item['route']): ?>
                <ul class="how-get-list unstyled clearfix" style="list-style: none;">
                    <?php foreach ($item['route'] as $route): ?>
                      <li class="col-xs-6 col-sm-4 how-get-list__item"><?=$route?></li>
                    <?php endforeach ?>
                </ul>
                <?php endif ?>

                <?php if ($item['detailPicture']['src']): ?>
                <div style="text-align: center; margin-top: 30px;">
                  <img alt="<?=$item['name']?>" src="<?=$item['detailPicture']['src']?>" style="display: block;width: auto;height: auto;max-width: 100%;margin: 0 auto;" title="<?=$item['name']?>" />
                    <?php if ($item['address']): ?>
                      <span style="font-size: 20px; text-align: Center; display: block; margin-top: 10px;"><?=$item['address']?></span>
                    <?php endif ?>
                    <?php if ($item['detailText']): ?><?=$item['detailText']?><?php endif ?>
                </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>

    <?php
    global $arTheme;

    Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("contacts-form-block");
    $APPLICATION->IncludeComponent("bitrix:form.result.new", "inline", Array(
        "WEB_FORM_ID" => "3",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "USE_EXTENDED_ERRORS" => "Y",
        "SEF_MODE" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600000",
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "?send=ok",
        "SHOW_LICENCE" => $arTheme["SHOW_LICENCE"]["VALUE"],
        "HIDDEN_CAPTCHA" => CNext::GetFrontParametrValue('HIDDEN_CAPTCHA'),
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "VARIABLE_ALIASES" => Array(
            "WEB_FORM_ID" => "WEB_FORM_ID",
            "RESULT_ID" => "RESULT_ID"
        )
    ));
    Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("contacts-form-block", "");
    ?>
<?php endif ?>

<?php if ($arResult['city']['map']): ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
    ymaps.ready(init);
    var myMap;
    var myPlacemark;

    function init() {
      var myMap = new ymaps.Map("contacts-ya-map", {
        center: [<?=implode(', ', $arResult['city']['map'])?>],
        zoom: <?=$arResult['city']['mapZoom'] ?? 9?>,
        controls: ['zoomControl','fullscreenControl']
      });

      <?php foreach ($arResult['shopsMap'] as $item): ?>

      var shop<?=$item['id']?> = new ymaps.Placemark([<?=$item['point']?>], {
        hintContent: 'PitLand',
        balloonContent: '<?=$item['hint']?>'
      });

      shop<?=$item['id']?>.options.set({
        iconLayout: 'default#image',
        iconImageHref: '/upload/img/map-point-ico.png',
        iconImageSize: [36, 49],
        iconImageOffset: [-18, -47],
      });
      myMap.geoObjects.add(shop<?=$item['id']?>);

      <?php endforeach ?>
      myMap.behaviors.disable('scrollZoom');
    }
    </script>
<?php endif ?>
