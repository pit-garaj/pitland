<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?>
<?$APPLICATION->IncludeComponent("arturgolubev:catalog.search", "catalog", Array(
	"RESTART" => "Y",
		"NO_WORD_LOGIC" => "Y",
		"CHECK_DATES" => "Y",	// Искать только в активных по дате документах
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"arrFILTER" => array(
			0 => "iblock_aspro_next_catalog",
			1 => "iblock_aspro_next_content",
		),
		"arrFILTER_iblock_aspro_next_catalog" => array(
			0 => "all",
		),
		"arrFILTER_iblock_aspro_next_content" => array(
			0 => "all",
		),
		"SHOW_WHERE" => "N",
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "50",
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Результаты поиска",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"ADD_PROPERTIES_TO_BASKET" => "Y",
	    "PARTIAL_PRODUCT_PROPERTIES"  => "Y",
		"PAGER_TEMPLATE" => "main",	// Шаблон постраничной навигации
	    "USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
		"USE_SUGGEST" => "N",
		"SHOW_RATING" => "",
	    "OFFER_HIDE_NAME_PROPS" => "N",
		"SHOW_MEASURE" => "Y",
		"RATING_TYPE" => "",
		"PATH_TO_USER_PROFILE" => "",
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "aspro_next_catalog",	// Тип инфоблока
		"IBLOCK_ID" => "23",	// Инфоблок
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"HIDE_NOT_AVAILABLE" => "L",	// Недоступные товары
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
	    "SHOW_UNABLE_SKU_PROPS" => "Y",
		"PAGE_ELEMENT_COUNT" => "25",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "5",	// Количество элементов выводимых в одной строке таблицы
		"SEF_URL_TEMPLATES" => array (
			"sections" => "#SECTION_CODE_PATH#/",
            "element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
            "compare" => "compare.php?action=#ACTION_CODE#",
	        "smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/"
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "BRAND",
			1 => "CML2_ARTICLE",
			2 => "PROP_2033",
			3 => "COLOR_REF2",
			4 => "PROP_159",
			5 => "PROP_2052",
			6 => "PROP_2027",
 			7 => "PROP_2053",
			8 => "PROP_2083",
			9 => "PROP_2049",
			10 => "PROP_2026",
			11 => "PROP_2044",
			12 => "PROP_162",
			13 => "PROP_2065",
			14 => "PROP_2054",
			15 => "PROP_2017",
			16 => "PROP_2055",
			17 => "PROP_2069",
			18 => "PROP_2062",
			19 => "PROP_2061",
			20 => "CML2_LINK",

			),
		"OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "NAME",
			1 => "CML2_LINK",
			3 => "DETAIL_PAGE_URL"
		),
		"OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "ARTICLE",
			1 => "VOLUME",
			2 => "SIZES",
			3 => "COLOR_REF"
		),
		"OFFERS_SORT_FIELD" => "shows",	// По какому полю сортируем предложения товара
		"OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
		"OFFERS_SORT_FIELD2" => "shows",	// Поле для второй сортировки предложений товара
		"OFFERS_SORT_ORDER2" => "asc",	// Порядок второй сортировки предложений товара
		"OFFERS_LIMIT" => "10",	// Максимальное количество предложений для показа (0 - все)
		"SECTION_URL" => "", //"#SECTION_CODE_PATH#/",	// URL, ведущий на страницу с содержимым раздела
		"DETAIL_URL" => "", //"#SECTION_CODE_PATH#/#ELEMENT_ID#/",	// URL, ведущий на страницу с содержимым элемента раздела
		"BASKET_URL" => "/basket/",	// URL, ведущий на страницу с корзиной покупателя
		"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
		"PRICE_CODE" => array(	// Тип цены
			0 => "Основной тип цен продажи",
			1 => "Акция"
		),
		"SHOW_DISCOUNT_TIME_EACH_SKU" => "N",
     	"USE_COMPARE" => "N",
	    "SHOW_COUNTER_LIST" => "Y",
	    "OFFER_TREE_PROPS" => array (
			0 => "RAZMER_OBUVI",
			3 => "RAZMER"
		),
		"USE_PRICE_COUNT" => "Y",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"CURRENCY_ID" => "RUB",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "RAZMER_OBUVI",
			1 => "TSVET",
			2 => "RAZMER_PERCHATOK",
			3 => "RAZMER"
		),// Свойства предложений добавляемые в корзину
		"INPUT_PLACEHOLDER" => "",	// Текст в поле ввода поискового запроса (placeholder)
		"SHOW_HISTORY" => "N",	// Показывать историю запросов
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>