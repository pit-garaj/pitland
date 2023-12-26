<?php
global $arTheme;

/** @var object $APPLICATION */

use Ninja\Project\Regionality\Cities;

$city = Cities::getCityByHost();


$rootMenuType = !empty($city['default']) ? 'top' : 'top-regional';

$APPLICATION->IncludeComponent('bitrix:menu', 'top_content_row', [
    'ALLOW_MULTI_SELECT' => 'N',
    'CHILD_MENU_TYPE' => 'left',
    'COMPONENT_TEMPLATE' => 'top_content_row',
    'COUNT_ITEM' => '6',
    'DELAY' => 'N',
    'MAX_LEVEL' => 1,
    'MENU_CACHE_GET_VARS' => array(),
    'MENU_CACHE_TIME' => '3600000',
    'MENU_CACHE_TYPE' => 'N',
    'MENU_CACHE_USE_GROUPS' => 'N',
    'CACHE_SELECTED_ITEMS' => 'N',
    'ROOT_MENU_TYPE' => $rootMenuType,
    'USE_EXT' => 'Y'
]);
