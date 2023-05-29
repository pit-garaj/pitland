<?php

use Ninja\Helper\Dbg;
use Ninja\Project\Catalog\CatalogCart;

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

// $data = \Ninja\Project\Regionality\Cities::getCityByHost();
// $data = \Ninja\Project\Regionality\ShopsGateway::getData();
$data =\Ninja\Project\Landing\LandingGateway::getList();

Dbg::show($data);
