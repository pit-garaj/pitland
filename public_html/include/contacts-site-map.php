<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?> <?/*$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.754619520794115;s:10:\"yandex_lon\";d:37.62022412333155;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.620438700053;s:3:\"LAT\";d:55.753445723095;s:4:\"TEXT\";s:10:\"Наша фирма\";}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
*/?> <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script> <script type="text/javascript">
    ymaps.ready(init);
    var myMap,
        myPlacemark;

    function init(){
        myMap = new ymaps.Map("contacts-ya-map", {
            center: [55.857796, 37.701645],
            zoom: 9,
            controls: ['zoomControl','fullscreenControl']
        });

        FormylaX = new ymaps.Placemark([55.576661, 37.695604], {
            hintContent: 'PitLand',
            balloonContent: '<b>Адрес салона:</b><br> МКАД 27 км ТЦ «Формула Х»<br> <b>E-mail:</b><br> info@pitland.ru<br> <b>Телефоны:</b><br> +7 (495) 363 52 99<br>+7 (985) 055 67 88<br> <b>Время работы:</b><br> Каждый день с 10-00 до 21-00'
        });

        Dexter = new ymaps.Placemark([55.893127, 37.501205], {
            hintContent: 'PitLand',
            balloonContent: '<b>Адрес салона:</b><br> МКАД, 78-й км ТЦ «DEXTER»<br> <b>E-mail:</b><br> info@pitland.ru<br> <b>Телефоны:</b><br> +7 (968) 998 46 16<br> <b>Время работы:</b><br> Каждый день с 10-00 до 21-00'
        });

       FormylaX.options.set({
            iconLayout: 'default#image',
            iconImageHref: '/upload/img/map-point-ico.png',
            iconImageSize: [36, 49],
            iconImageOffset: [-18, -47],
        });

        Dexter.options.set({
            iconLayout: 'default#image',
            iconImageHref: '/upload/img/map-point-ico.png',
            iconImageSize: [36, 49],
            iconImageOffset: [-18, -47],
        });

        myMap.geoObjects.add(FormylaX);
        myMap.geoObjects.add(Dexter);

        myMap.behaviors.disable('scrollZoom');
    }
</script>
<div class="container-fluid">
	<div id="contacts-ya-map" style="height:475px">
	</div>
</div>
<br>