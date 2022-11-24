<?global $arTheme;?>
<?$APPLICATION->IncludeComponent("bitrix:menu", "top_catalog_wide_custom", Array(
	"ALLOW_MULTI_SELECT" => "Y",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"COMPONENT_TEMPLATE" => "top_catalog_wide",
		"COUNT_ITEM" => "6",
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_SELECTED_ITEMS" => "N",
		"ROOT_MENU_TYPE" => "top_catalog_wide",	// Тип меню для первого уровня
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>