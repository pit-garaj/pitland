<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
header('Content-type: text/xml; charset=UTF-8');

/** @var object $APPLICATION */

$APPLICATION->IncludeComponent('sitemap:sitemap', 'main', array(
    'SEF_FOLDER'   => '/sitemap/',
    'CACHE_TYPE'   => 'A',
    'CACHE_TIME'   => '3600000',
    'CACHE_FILTER' => 'N',
    'CACHE_GROUPS' => 'Y',
), false);
