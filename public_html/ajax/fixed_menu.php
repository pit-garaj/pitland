<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR . "include/menu/menu.top_catalog_wide.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false, array("HIDE_ICONS" => "Y")
);
?>