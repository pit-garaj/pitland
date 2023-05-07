<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
?>
<?php if ($arParams['CITY']['map']): ?>
  <div class="contacts-page-map">
    <div class="container-fluid">
      <div id="contacts-ya-map" style="height:475px"></div>
    </div>
  </div>

  <div class="contacts contacts-page-map-overlay maxwidth-theme">
    <div class="contacts-wrapper" itemscope itemtype="http://schema.org/Organization">
      <div class="row">
        <div class="col-md-3 col-sm-3 print-6">
          <table cellpadding="0" cellspasing="0">
            <tr>
              <td align="left" valign="top"><i class="fa big-icon s45 fa-map-marker"></i></td>
              <td align="left" valign="top">
                <span class="dark_table">Адрес</span><br />
                  <?php if($arParams['CITY']['address']): ?>
                    <span itemprop="address">
                        <?php foreach ($arParams['CITY']['address'] as $item): ?>
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
                  <?php if($arParams['CITY']['phone']): ?>
                    <span itemprop="telephone">
                        <?php foreach ($arParams['CITY']['phone'] as $item): ?>
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
                  <?php if($arParams['CITY']['email']): ?>
                    <span itemprop="email">
                        <?php foreach ($arParams['CITY']['email'] as $item): ?>
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
                  <?php if($arParams['CITY']['work']): ?>
                    <span>
                        <?php foreach ($arParams['CITY']['work'] as $item): ?>
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

  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
  <script type="text/javascript">
  ymaps.ready(init);
  var myMap;
  var myPlacemark;

  function init() {
    var myMap = new ymaps.Map("contacts-ya-map", {
      center: [<?=implode(', ', $arParams['CITY']['map'])?>],
      zoom: <?=$arParams['CITY']['mapZoom'] ?? 9?>,
      controls: ['zoomControl','fullscreenControl']
    });

      <?php foreach ($arParams['SHOPS_MAP'] as $item): ?>
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
