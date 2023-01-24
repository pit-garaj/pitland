<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?global $arTheme, $isShowCatalogSections;?>
<?if($isShowCatalogSections):?>
	<?$APPLICATION->IncludeComponent("aspro:catalog.section.list.next", "front_sections_theme_custom", Array(
	"IBLOCK_TYPE" => "aspro_next_catalog",	// Тип инфоблока
		"IBLOCK_ID" => "23",	// Инфоблок
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"FILTER_NAME" => "arrPopularSections",	// Имя фильтра
		"TOP_DEPTH" => "",	// Максимальная отображаемая глубина разделов
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"VIEW_MODE" => "",
		"SHOW_PARENT_NAME" => "N",
		"HIDE_SECTION_NAME" => "N",
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"SHOW_SECTIONS_LIST_PREVIEW" => "N",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "N",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "N",
		"SHOW_SECTION_LIST_PICTURES" => "N",
		"TEMPLATE" => $arTheme["FRONT_PAGE_SECTIONS"]["VALUE"],
		"DISPLAY_PANEL" => "N",
		"COMPONENT_TEMPLATE" => "front_sections_theme",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_FIELDS" => array(	// Поля разделов
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
			0 => "",
			1 => "",
		),
		"TITLE_BLOCK" => "Популярные категории",	// Заголовок блока
		"TITLE_BLOCK_ALL" => "Весь каталог",	// Заголовок на все новости
		"ALL_URL" => "catalog/",	// Ссылка на все новости
	),
	false
);?>
<?endif;?>