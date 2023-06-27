<div class="search-wrapper">
	<?$APPLICATION->IncludeComponent(
		//"bitrix:search.title",
		//"corp",
		"arturgolubev:search.title",
		".default",
		array(
			"CATEGORY_0" => array(
				0 => "iblock_aspro_next_catalog",
			),
			"CATEGORY_0_TITLE" => "Товары",
			"CATEGORY_0_iblock_aspro_next_catalog" => array(
				0 => "23",
			),
			"CATEGORY_0_iblock_aspro_next_content" => array(
				0 => "all",
			),
			"CATEGORY_OTHERS_TITLE" => "Еще",
			"CHECK_DATES" => "Y",
			"COMPONENT_TEMPLATE" => "corp",
			"COMPOSITE_FRAME_MODE" => "N",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"CONTAINER_ID" => "title-search_fixed",
			"CONVERT_CURRENCY" => "Y",
			"CURRENCY_ID" => "RUB",
			"INPUT_ID" => "title-search-input_fixed",
			"NUM_CATEGORIES" => "1",
			"ORDER" => "rank",
			"PAGE" =>  "/search/", //CNext::GetFrontParametrValue("CATALOG_PAGE_URL"),
			"PREVIEW_HEIGHT" => "38",
			"PREVIEW_TRUNCATE_LEN" => "50",
			"PREVIEW_WIDTH" => "38",
			"PRICE_CODE" => array(
				0 => "Основной тип цен продажи",
			),
			"PRICE_VAT_INCLUDE" => "Y",
			"SHOW_ANOUNCE" => "N",
			"SHOW_INPUT" => "Y",
			"SHOW_INPUT_FIXED" => "Y",
			"SHOW_OTHERS" => "N",
			"SHOW_PREVIEW" => "Y",
			"TOP_COUNT" => "999999",
			"USE_LANGUAGE_GUESS" => "N"
		),
		false,
		array(
			"ACTIVE_COMPONENT" => "Y"
		)
	);?>
</div>
