<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Склады");
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.store", 
	".default", 
	array(
		"SEF_MODE" => "Y",
		"PHONE" => "Y",
		"SCHEDULE" => "Y",
		"SET_TITLE" => "Y",
		"TITLE" => "Адреса магазинов",
		"MAP_TYPE" => "0",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"SEF_FOLDER" => "/store/",
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SEF_URL_TEMPLATES" => array(
			"liststores" => "index.php",
			"element" => "#store_id#",
		)
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>