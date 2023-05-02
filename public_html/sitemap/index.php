<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
// header('Content-type: text/xml; charset=UTF-8');

/** @var object $APPLICATION */

$APPLICATION->IncludeComponent('sitemap:sitemap', 'main', array(
    // 'CITY_ID'      => CURRENT_CITY_ID,
    // 'CITY_CODE'    => CURRENT_CITY_CODE,
    'SEF_FOLDER'   => '/sitemap/',
    'CACHE_TYPE'   => 'A',
    'CACHE_TIME'   => '3600000',
    'CACHE_FILTER' => 'N',
    'CACHE_GROUPS' => 'Y',
), false);
