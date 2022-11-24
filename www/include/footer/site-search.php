<? $APPLICATION->IncludeComponent("bitrix:search.title", (isset($arTheme["TYPE_SEARCH"]["VALUE"]) ? $arTheme["TYPE_SEARCH"]["VALUE"] : $arTheme["TYPE_SEARCH"]), array(
    "NUM_CATEGORIES" => "1",
    "TOP_COUNT" => "10",
    "ORDER" => "rank",
    "USE_LANGUAGE_GUESS" => "N",
    "CHECK_DATES" => "Y",
    "SHOW_OTHERS" => "Т",
    "PAGE" => CNext::GetFrontParametrValue("CATALOG_PAGE_URL"),
    "CATEGORY_OTHERS_TITLE" => "Товары",
    "CATEGORY_0" => array(
        0 => "iblock_aspro_next_catalog",
    ),
    "CATEGORY_0_TITLE" => "Еще",
    "CATEGORY_0_iblock_aspro_next_catalog" => array(
        0 => "23",
    ),
    "CATEGORY_0_iblock_aspro_next_content" => array(
        0 => "all",
    ),
    "SHOW_INPUT" => "Y",
    "INPUT_ID" => "title-search-input",
    "CONTAINER_ID" => "title-search",
    "PREVIEW_TRUNCATE_LEN" => "",
    "SHOW_PREVIEW" => "Y",
    "PRICE_CODE" => array(
        0 => "Основной тип цен продажи",
    ),
    "CONVERT_CURRENCY" => "Y",
    "CURRENCY_ID" => "RUB",
    "PREVIEW_WIDTH" => "38",
    "PREVIEW_HEIGHT" => "38",
    "COMPOSITE_FRAME_MODE" => "A",
    "COMPOSITE_FRAME_TYPE" => "AUTO",
),
    false, array("HIDE_ICONS" => "Y")
); ?>



