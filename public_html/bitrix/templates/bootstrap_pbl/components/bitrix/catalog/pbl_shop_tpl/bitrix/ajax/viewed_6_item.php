<?
/**
 * Created by PhpStorm.
 * User: Nip4F
 * Date: 01.09.2017
 * Time: 0:23
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$arParams = $_REQUEST;

$APPLICATION->IncludeComponent(
    'bitrix:catalog.products.viewed',
    '',
    array(
        'IBLOCK_MODE' => 'single',
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
        'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
        'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
        'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
        'PROPERTY_CODE_' . $arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
        'PROPERTY_CODE_' . $recommendedData['OFFER_IBLOCK_ID'] => $arParams['LIST_OFFERS_PROPERTY_CODE'],
        'PROPERTY_CODE_MOBILE' . $arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
        'BASKET_URL' => $arParams['BASKET_URL'],
        'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'] . '_cpv',
        'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
        'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
        'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_FILTER' => $arParams['CACHE_FILTER'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
        'PRICE_CODE' => $arParams['PRICE_CODE'],
        'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
        'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
        'PAGE_ELEMENT_COUNT' => 6,
        'SECTION_ELEMENT_ID' => $elementId,

        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "ADD_SECTIONS_CHAIN" => "N",

        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
        'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
        'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
        'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
        'CART_PROPERTIES_' . $arParams['IBLOCK_ID'] => $arParams['PRODUCT_PROPERTIES'],
        'CART_PROPERTIES_' . $recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFERS_CART_PROPERTIES'],
        'ADDITIONAL_PICT_PROP_' . $arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
        'ADDITIONAL_PICT_PROP_' . $recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],

        'SHOW_FROM_SECTION' => 'N',
        'DETAIL_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['element'],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

        'LABEL_PROP_' . $arParams['IBLOCK_ID'] => $arParams['LABEL_PROP'],
        'LABEL_PROP_MOBILE_' . $arParams['IBLOCK_ID'] => $arParams['LABEL_PROP_MOBILE'],
        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
        'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'6','BIG_DATA':false}]",
        'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
        'ENLARGE_PROP_' . $arParams['IBLOCK_ID'] => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

        'OFFER_TREE_PROPS_' . $recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_PROPS'],
        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
        'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
        'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
        'ADD_TO_BASKET_ACTION' => $basketAction,
        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
        'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
        'COMPARE_NAME' => $arParams['COMPARE_NAME']
    ),
    $component

);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>
