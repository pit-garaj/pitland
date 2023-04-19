<?php

use Ninja\Helper\Dbg;
use Ninja\Project\Catalog\CatalogCart;

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

$city = \Ninja\Project\Regionality\Cities::getCityByHost();

Dbg::show($city);
