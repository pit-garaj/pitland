<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
/** @var object $APPLICATION */
?>
<?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => $arResult['path'] . "/templates/shared/map.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        'CITY' => $arResult['city'],
        'SHOPS_MAP' => $arResult['shopsMap'],
    ),
    false
); ?>
