<?php

use Ninja\Project\Regionality\Cities;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$city = Cities::getCityByHost();

/*$aMenuLinks[] = [
    "Супер скидки",
    "/discount/",
    [],
    [],
    "",
];*/

if (!empty($city['default'])) {
    $aMenuLinks[] = [
        "Услуги",
        "/services/",
        [],
        [],
        "",
    ];
}

$aMenuLinks[] = [
    "Контакты",
    "/contacts/",
    [],
    [],
    "",
];
