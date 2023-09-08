<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скидки на аксессуары");?>

<?/*получить список всех подразделов раздела Аксессуары*/
$sect_array = array();
$res = CIBlockSection::GetList(
    Array(
        'name'  =>  'asc'
    ),
    Array(
        'IBLOCK_ID'     =>  "23",
        'ACTIVE'        =>  'Y',
        'CODE'          => 'aksessuary'
    )
);
if($row = $res->GetNext())
{
        $result[$row['ID']] = $row['ID'];
        $rsParentSection = CIBlockSection::GetByID($row['ID']);
        if ($arParentSection = $rsParentSection->GetNext())
        {
                $arFilter = array(
                    'IBLOCK_ID'         => $arParentSection['IBLOCK_ID'],
                    '>LEFT_MARGIN'      => $arParentSection['LEFT_MARGIN'],
                    '<RIGHT_MARGIN'     => $arParentSection['RIGHT_MARGIN'],
                    '>DEPTH_LEVEL'      => $arParentSection['DEPTH_LEVEL']
                );
                $rsSect = CIBlockSection::GetList(
                    array(
                        'left_margin' => 'asc'
                    ),
                    $arFilter
                );
                while ($arSect = $rsSect->GetNext())
                {
                        $result[$arSect['ID']] = $arSect['ID'];
                        $sect_array[] = $result[$arSect['ID']];
                }
        }
}


global $NEXT_SMART_FILTER;
$NEXT_SMART_FILTER = Array(
    '>CATALOG_PRICE_3' => 0,
    Array(
        'LOGIC' => 'AND',
        Array(
            '>CATALOG_QUANTITY' => 0
        ),
        Array(
            'SECTION_ID' => $sect_array
        ),
    )
);
?>


<?$APPLICATION->IncludeComponent(
    "bitrix:catalog",
    "discount",
    array(
        "IBLOCK_TYPE" => "aspro_next_catalog",
        "IBLOCK_ID" => "23",
        "HIDE_NOT_AVAILABLE" => "L",
        "BASKET_URL" => "/basket/",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "SEF_MODE" => "N",
        "SEF_FOLDER" => "/catalog/",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "N",
        "SET_TITLE" => "Y",
        "SET_STATUS_404" => "N",
        "USE_ELEMENT_COUNTER" => "Y",
        "USE_FILTER" => "Y",
        "FILTER_NAME" => "NEXT_SMART_FILTER",
        "FILTER_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(
            0 => "CML2_ARTICLE",
            1 => "IN_STOCK",
            2 => "",
        ),
        "FILTER_PRICE_CODE" => array(
            0 => "Цена до скидки",
            1 => "Основной тип цен продажи",
        ),
        "FILTER_OFFERS_FIELD_CODE" => array(
            0 => "NAME",
            1 => "",
        ),
        "FILTER_OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "CML2_LINK",
            2 => "COLOR",
            3 => "",
        ),
        "USE_REVIEW" => "Y",
        "MESSAGES_PER_PAGE" => "10",
        "USE_CAPTCHA" => "Y",
        "REVIEW_AJAX_POST" => "Y",
        "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
        "FORUM_ID" => "2",
        "URL_TEMPLATES_READ" => "",
        "SHOW_LINK_TO_FORUM" => "Y",
        "POST_FIRST_MESSAGE" => "N",
        "USE_COMPARE" => "Y",
        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
        "COMPARE_FIELD_CODE" => array(
            0 => "NAME",
            1 => "TAGS",
            2 => "SORT",
            3 => "PREVIEW_PICTURE",
            4 => "",
        ),
        "COMPARE_PROPERTY_CODE" => array(
            0 => "BRAND",
            1 => "CML2_ARTICLE",
            2 => "CML2_BASE_UNIT",
            3 => "CML2_MANUFACTURER",
            4 => "PROP_2033",
            5 => "COLOR_REF2",
            6 => "PROP_159",
            7 => "PROP_2052",
            8 => "PROP_2027",
            9 => "PROP_2053",
            10 => "PROP_2083",
            11 => "PROP_2049",
            12 => "PROP_2026",
            13 => "PROP_2044",
            14 => "PROP_162",
            15 => "PROP_2065",
            16 => "PROP_2054",
            17 => "PROP_2017",
            18 => "PROP_2055",
            19 => "PROP_2069",
            20 => "PROP_2062",
            21 => "PROP_2061",
            22 => "",
        ),
        "COMPARE_OFFERS_FIELD_CODE" => array(
            0 => "NAME",
            1 => "PREVIEW_PICTURE",
            2 => "",
        ),
        "COMPARE_OFFERS_PROPERTY_CODE" => array(
            0 => "ARTICLE",
            1 => "VOLUME",
            2 => "SIZES",
            3 => "COLOR_REF",
            4 => "",
        ),
        "COMPARE_ELEMENT_SORT_FIELD" => "shows",
        "COMPARE_ELEMENT_SORT_ORDER" => "asc",
        "DISPLAY_ELEMENT_SELECT_BOX" => "N",
        "PRICE_CODE" => array(
            0 => "Основной тип цен продажи",
            1 => "Акция",
        ),
        "USE_PRICE_COUNT" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "PRODUCT_PROPERTIES" => array(
        ),
        "USE_PRODUCT_QUANTITY" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "OFFERS_CART_PROPERTIES" => array(
            0 => "RAZMER_OBUVI",
            1 => "TSVET"
        ),
        "SHOW_TOP_ELEMENTS" => "Y",
        "SECTION_COUNT_ELEMENTS" => "Y",
        "SECTION_TOP_DEPTH" => "2",
        "SECTIONS_LIST_PREVIEW_PROPERTY" => "UF_SECTION_DESCR",
        "SHOW_SECTION_LIST_PICTURES" => "Y",
        "PAGE_ELEMENT_COUNT" => "28",
        "LINE_ELEMENT_COUNT" => "4",
        "ELEMENT_SORT_FIELD" => "price",
        "ELEMENT_SORT_ORDER" => "desc",
        "ELEMENT_SORT_FIELD2" => "shows",
        "ELEMENT_SORT_ORDER2" => "asc",
        "LIST_PROPERTY_CODE" => array(
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
            21 => "",
        ),
        "INCLUDE_SUBSECTIONS" => "Y", //"A",
        "LIST_META_KEYWORDS" => "-",
        "LIST_META_DESCRIPTION" => "UF_SECTION_DESCR",
        "LIST_BROWSER_TITLE" => "-",
        "LIST_OFFERS_FIELD_CODE" => array(
            0 => "NAME",
            1 => "CML2_LINK",
            2 => "DETAIL_PAGE_URL",
            3 => "",
        ),
        "LIST_OFFERS_PROPERTY_CODE" => array(
            0 => "ARTICLE",
            1 => "VOLUME",
            2 => "SIZES",
            3 => "COLOR_REF",
            4 => "",
        ),
        "LIST_OFFERS_LIMIT" => "10",
        "SORT_BUTTONS" => array(
            0 => "POPULARITY",
            1 => "NAME",
            2 => "PRICE",
        ),
        "SORT_PRICES" => "Основной тип цен продажи",
        "DEFAULT_LIST_TEMPLATE" => "block",
        "SECTION_DISPLAY_PROPERTY" => "UF_SECTION_TEMPLATE",
        "LIST_DISPLAY_POPUP_IMAGE" => "Y",
        "SECTION_PREVIEW_PROPERTY" => "DESCRIPTION",
        "SHOW_SECTION_PICTURES" => "Y",
        "SHOW_SECTION_SIBLINGS" => "Y",
        "DETAIL_PROPERTY_CODE" => array(
            0 => "BRAND",
            1 => "SISTEMA_PITANIYA",
            2 => "MOSHCHNOST_L_S",
            3 => "KOL_VO_TAKTOV",
            4 => "EXPANDABLES",
            5 => "CML2_ARTICLE",
            6 => "VIDEO_YOUTUBE",
            7 => "KOL_VO_TSILINDROV",
            8 => "PROP_2033",
            9 => "CML2_ATTRIBUTES",
            10 => "COLOR_REF2",
            11 => "KLAPANOV_NA_TSILINDR",
            12 => "OKHLAZHDENIE",
            13 => "ZAZHIGANIE",
            14 => "SPOSOB_ZAPUSKA",
            15 => "TIP_KPP",
            16 => "KOL_VO_STUPENEY_SKHEMA",
            17 => "TIP_STSEPLENIYA",
            18 => "TIP_PRIVODA",
            19 => "KHOD_PEREDNEY_PODVESKI_MM",
            20 => "IZMENENIE_PREDNATYAGA_PRUZHINY_PER_AMORTIZATORA_",
            21 => "REGULIROVKA_SKOROSTI_OTBOYA_PER_AMORTIZATORA",
            22 => "KHOD_ZADNEY_PODVESKI_MM",
            23 => "IZMENENIE_PREDNATYAGA_PRUZHINY_ZAD_AMORTIZATORA_",
            24 => "REGULIROVKA_SKOROSTI_OTBOYA_ZAD_AMORTIZATORA_",
            25 => "DIAMETR_KOLES_PERED_ZAD_DYUYM",
            26 => "MATERIAL_OBODA",
            27 => "KOLICHESTVO_SPITS_PERED_ZAD",
            28 => "NALICHIE_BUKSATORA_PERED_ZAD",
            29 => "PRIVOD_PEREDNEGO_TORMOZA",
            30 => "DIAMETR_PEREDNEGO_TORM_DISKA_MM",
            31 => "DIAMETR_ZADNEGO_TORM_DISKA_MM",
            32 => "PRIVOD_ZADNEGO_TORMOZA",
            33 => "DLINA_S_BEZ_UPAKOVKI_MM",
            34 => "VYSOTA_S_BEZ_UPAKOVKI_MM",
            35 => "VYSOTA_PO_SEDLU_MM",
            36 => "BAZA_MM",
            37 => "MASSA_BEZ_NAGRUZKI_S_BEZ_UPAKOVKI_KG",
            38 => "OBEM_TOPLIVNOGO_BAKA_L",
            39 => "SHIRINA_S_BEZ_UPAKOVKI_MM",
            40 => "REGULIROVKA_SKOROSTI_SZHATIYA_PER_AMORTIZATORA",
            41 => "REGULIROVKA_SKOROSTI_SZHATIYA_ZAD_AMORTIZATORA",
            42 => "FARA",
            43 => "TOPLIVO",
            44 => "RAZMER_PEREDNEY_SHINY",
            45 => "RAZMER_ZADNEY_SHINY",
            46 => "MODEL_DVIGATELYA",
            47 => "OBEM_DVIGATELYA",
            48 => "TIP",
            49 => "PROP_159",
            50 => "PROP_2052",
            51 => "PROP_2027",
            52 => "PROP_2053",
            53 => "PROP_2083",
            54 => "PROP_2049",
            55 => "PROP_2026",
            56 => "PROP_2044",
            57 => "PROP_162",
            58 => "PROP_2065",
            59 => "PROP_2054",
            60 => "PROP_2017",
            61 => "PROP_2055",
            62 => "PROP_2069",
            63 => "PROP_2062",
            64 => "PROP_2061",
            65 => "RECOMMEND",
            66 => "NEW",
            67 => "STOCK",
            68 => "VIDEO",
            69 => "",
        ),
        "DETAIL_META_KEYWORDS" => "-",
        "DETAIL_META_DESCRIPTION" => "-",
        "DETAIL_BROWSER_TITLE" => "-",
        "DETAIL_OFFERS_FIELD_CODE" => array(
            0 => "NAME",
            1 => "PREVIEW_PICTURE",
            2 => "DETAIL_PICTURE",
            3 => "DETAIL_PAGE_URL",
            4 => "",
        ),
        "DETAIL_OFFERS_PROPERTY_CODE" => array(
            0 => "ARTICLE",
            1 => "VOLUME",
            2 => "SIZES",
            3 => "COLOR_REF",
            4 => "FRAROMA",
            5 => "SPORT",
            6 => "VLAGOOTVOD",
            7 => "AGE",
            8 => "RUKAV",
            9 => "KAPUSHON",
            10 => "FRCOLLECTION",
            11 => "FRLINE",
            12 => "FRFITIL",
            13 => "FRMADEIN",
            14 => "FRELITE",
            15 => "TALL",
            16 => "FRFAMILY",
            17 => "FRSOSTAVCANDLE",
            18 => "FRTYPE",
            19 => "FRFORM",
        ),
        "PROPERTIES_DISPLAY_LOCATION" => "DESCRIPTION",
        "SHOW_BRAND_PICTURE" => "Y",
        "SHOW_ASK_BLOCK" => "Y",
        "ASK_FORM_ID" => "2",
        "SHOW_ADDITIONAL_TAB" => "N",
        "PROPERTIES_DISPLAY_TYPE" => "TABLE",
        "SHOW_KIT_PARTS" => "Y",
        "SHOW_KIT_PARTS_PRICES" => "Y",
        "LINK_IBLOCK_TYPE" => "aspro_next_content",
        "LINK_IBLOCK_ID" => "",
        "LINK_PROPERTY_SID" => "",
        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
        "USE_ALSO_BUY" => "Y",
        "ALSO_BUY_ELEMENT_COUNT" => "5",
        "ALSO_BUY_MIN_BUYES" => "2",
        "USE_STORE" => "Y",
        "USE_STORE_PHONE" => "Y",
        "USE_STORE_SCHEDULE" => "Y",
        "USE_MIN_AMOUNT" => "Y",
        "MIN_AMOUNT" => "10",
        "STORE_PATH" => "/contacts/stores/#store_id#/",
        "MAIN_TITLE" => "Наличие на складах",
        "MAX_AMOUNT" => "20",
        "USE_ONLY_MAX_AMOUNT" => "Y",
        "OFFERS_SORT_FIELD" => "shows",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_FIELD2" => "shows",
        "OFFERS_SORT_ORDER2" => "asc",
        "PAGER_TEMPLATE" => "main",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Товары",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "IBLOCK_STOCK_ID" => "25",
        "SHOW_QUANTITY" => "Y",
        "SHOW_MEASURE" => "Y",
        "SHOW_QUANTITY_COUNT" => "Y",
        "USE_RATING" => "Y",
        "DISPLAY_WISH_BUTTONS" => "Y",
        "DEFAULT_COUNT" => "1",
        "SHOW_HINTS" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
        "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
        "STORES" => array(
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "4",
            4 => "",
        ),
        "USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "FIELDS" => array(
            0 => "ADDRESS",
            1 => "",
        ),
        "SHOW_EMPTY_STORE" => "Y",
        "SHOW_GENERAL_STORE_INFORMATION" => "N",
        "TOP_ELEMENT_COUNT" => "8",
        "TOP_LINE_ELEMENT_COUNT" => "4",
        "TOP_ELEMENT_SORT_FIELD" => "shows",
        "TOP_ELEMENT_SORT_ORDER" => "asc",
        "TOP_ELEMENT_SORT_FIELD2" => "shows",
        "TOP_ELEMENT_SORT_ORDER2" => "asc",
        "TOP_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "COMPONENT_TEMPLATE" => "main",
        "DETAIL_SET_CANONICAL_URL" => "Y",
        "SHOW_DEACTIVATED" => "N",
        "TOP_OFFERS_FIELD_CODE" => array(
            0 => "ID",
            1 => "",
        ),
        "TOP_OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "TOP_OFFERS_LIMIT" => "10",
        "SECTION_TOP_BLOCK_TITLE" => "Лучшие предложения",
        "OFFER_TREE_PROPS" => array(
            0 => "RAZMER_OBUVI",
            1 => "TSVET"
        ),
        "USE_BIG_DATA" => "Y",
        "BIG_DATA_RCM_TYPE" => "personal",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_OLD_PRICE" => "Y",
        "VIEWED_ELEMENT_COUNT" => "20",
        "VIEWED_BLOCK_TITLE" => "Ранее вы смотрели",
        "ELEMENT_SORT_FIELD_BOX" => "name",
        "ELEMENT_SORT_ORDER_BOX" => "asc",
        "ELEMENT_SORT_FIELD_BOX2" => "id",
        "ELEMENT_SORT_ORDER_BOX2" => "desc",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
        "SKU_DETAIL_ID" => "oid",
        "USE_MAIN_ELEMENT_SECTION" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "AJAX_FILTER_CATALOG" => "Y",
        "SECTION_BACKGROUND_IMAGE" => "-",
        "DETAIL_BACKGROUND_IMAGE" => "-",
        "DISPLAY_ELEMENT_SLIDER" => "10",
        "SHOW_ONE_CLICK_BUY" => "Y",
        "USE_GIFTS_DETAIL" => "N",
        "USE_GIFTS_SECTION" => "N",
        "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
        "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "8",
        "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
        "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
        "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "8",
        "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
        "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
        "GIFTS_SHOW_OLD_PRICE" => "Y",
        "GIFTS_SHOW_NAME" => "Y",
        "GIFTS_SHOW_IMAGE" => "Y",
        "GIFTS_MESS_BTN_BUY" => "Выбрать",
        "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "8",
        "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
        "OFFER_HIDE_NAME_PROPS" => "N",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
        "SECTION_PREVIEW_DESCRIPTION" => "Y",
        "SECTIONS_LIST_PREVIEW_DESCRIPTION" => "Y",
        "SALE_STIKER" => "SALE_TEXT",
        "SHOW_DISCOUNT_TIME" => "N",
        "SHOW_RATING" => "N",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "DETAIL_OFFERS_LIMIT" => "0",
        "DETAIL_EXPANDABLES_TITLE" => "Аксессуары",
        "DETAIL_ASSOCIATED_TITLE" => "Похожие товары",
        "DETAIL_PICTURE_MODE" => "MAGNIFIER",
        "SHOW_UNABLE_SKU_PROPS" => "Y",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "DETAIL_STRICT_SECTION_CHECK" => "Y",
        "COMPATIBLE_MODE" => "Y",
        "TEMPLATE_THEME" => "blue",
        "LABEL_PROP" => "",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "COMMON_SHOW_CLOSE_POPUP" => "N",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "SHOW_MAX_QUANTITY" => "N",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_COMPARE" => "Сравнение",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "SIDEBAR_SECTION_SHOW" => "Y",
        "SIDEBAR_DETAIL_SHOW" => "N",
        "SIDEBAR_PATH" => "",
        "USE_SALE_BESTSELLERS" => "Y",
        "FILTER_VIEW_MODE" => "VERTICAL",
        "FILTER_HIDE_ON_MOBILE" => "N",
        "INSTANT_RELOAD" => "N",
        "COMPARE_POSITION_FIXED" => "Y",
        "COMPARE_POSITION" => "top left",
        "USE_RATIO_IN_RANGES" => "Y",
        "USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
        "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
        "TOP_ADD_TO_BASKET_ACTION" => "ADD",
        "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
        "DETAIL_ADD_TO_BASKET_ACTION" => array(
            0 => "BUY",
        ),
        "DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
            0 => "BUY",
        ),
        "TOP_PROPERTY_CODE_MOBILE" => "",
        "TOP_VIEW_MODE" => "SECTION",
        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
        "TOP_ENLARGE_PRODUCT" => "STRICT",
        "TOP_SHOW_SLIDER" => "Y",
        "TOP_SLIDER_INTERVAL" => "3000",
        "TOP_SLIDER_PROGRESS" => "N",
        "SECTIONS_VIEW_MODE" => "LIST",
        "SECTIONS_SHOW_PARENT_NAME" => "Y",
        "LIST_PROPERTY_CODE_MOBILE" => "",
        "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
        "LIST_ENLARGE_PRODUCT" => "STRICT",
        "LIST_SHOW_SLIDER" => "Y",
        "LIST_SLIDER_INTERVAL" => "3000",
        "LIST_SLIDER_PROGRESS" => "N",
        "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => "",
        "DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE" => "",
        "DETAIL_USE_VOTE_RATING" => "N",
        "DETAIL_USE_COMMENTS" => "N",
        "DETAIL_BRAND_USE" => "N",
        "DETAIL_DISPLAY_NAME" => "Y",
        "DETAIL_IMAGE_RESOLUTION" => "16by9",
        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
        "DETAIL_SHOW_SLIDER" => "N",
        "DETAIL_DETAIL_PICTURE_MODE" => array(
            0 => "POPUP",
            1 => "MAGNIFIER",
        ),
        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
        "MESS_PRICE_RANGES_TITLE" => "Цены",
        "MESS_DESCRIPTION_TAB" => "Описание",
        "MESS_PROPERTIES_TAB" => "Характеристики",
        "MESS_COMMENTS_TAB" => "Комментарии",
        "LAZY_LOAD" => "N",
        "LOAD_ON_SCROLL" => "N",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "DETAIL_DOCS_PROP" => "-",
        "STIKERS_PROP" => "HIT",
        "USE_SHARE" => "Y",
        "TAB_OFFERS_NAME" => "",
        "TAB_DESCR_NAME" => "",
        "TAB_CHAR_NAME" => "",
        "TAB_VIDEO_NAME" => "",
        "TAB_REVIEW_NAME" => "",
        "TAB_FAQ_NAME" => "",
        "TAB_STOCK_NAME" => "",
        "TAB_DOPS_NAME" => "",
        "BLOCK_SERVICES_NAME" => "",
        "BLOCK_DOCS_NAME" => "",
        "CHEAPER_FORM_NAME" => "",
        "DIR_PARAMS" => CNext::GetDirMenuParametrs(__DIR__),
        "SHOW_CHEAPER_FORM" => "Y",
        "LANDING_TITLE" => "Популярные категории",
        "LANDING_SECTION_COUNT" => "7",
        "SECTIONS_TYPE_VIEW" => "sections_1",
        "SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_1",
        "ELEMENT_TYPE_VIEW" => "FROM_MODULE",
        "SHOW_ARTICLE_SKU" => "Y",
        "SORT_REGION_PRICE" => "Основной тип цен продажи",
        "SHOW_MEASURE_WITH_RATIO" => "N",
        "SHOW_COUNTER_LIST" => "Y",
        "SHOW_DISCOUNT_TIME_EACH_SKU" => "N",
        "USER_CONSENT" => "Y",
        "USER_CONSENT_ID" => "1",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "SHOW_HOW_BUY" => "Y",
        "TITLE_HOW_BUY" => "Как купить",
        "SHOW_DELIVERY" => "Y",
        "TITLE_DELIVERY" => "Доставка",
        "SHOW_PAYMENT" => "Y",
        "TITLE_PAYMENT" => "Оплата",
        "SHOW_GARANTY" => "Y",
        "TITLE_GARANTY" => "Условия гарантии",
        "USE_FILTER_PRICE" => "N",
        "DISPLAY_ELEMENT_COUNT" => "Y",
        "RESTART" => "Y",
        "USE_LANGUAGE_GUESS" => "N",
        "NO_WORD_LOGIC" => "Y",
        "SHOW_SECTION_DESC" => "Y",
        "TITLE_SLIDER" => "Рекомендуем",
        "VIEW_BLOCK_TYPE" => "N",
        "SHOW_SEND_GIFT" => "N",
        "SEND_GIFT_FORM_NAME" => "",
        "USE_ADDITIONAL_GALLERY" => "N",
        "BLOCK_LANDINGS_NAME" => "",
        "BLOG_IBLOCK_ID" => "",
        "BLOCK_BLOG_NAME" => "",
        "RECOMEND_COUNT" => "5",
        "VISIBLE_PROP_COUNT" => "4",
        "STORES_FILTER" => "AMOUNT",
        "STORES_FILTER_ORDER" => "SORT_ASC",
        "FILE_404" => "",
        "ALT_TITLE_GET" => "SEO",
        "BUNDLE_ITEMS_COUNT" => "3",
        "SEF_URL_TEMPLATES" => array(
            "sections" => "",
            "section" => "#SECTION_CODE_PATH#/",
            "element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
            "compare" => "compare.php?action=#ACTION_CODE#",
            "smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
        ),
        "VARIABLE_ALIASES" => array(
            "compare" => array(
                "ACTION_CODE" => "action",
            ),
        )
    ),
    false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
