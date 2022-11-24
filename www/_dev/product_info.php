<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

CModule::IncludeModule( 'iblock' );

$productId = 13239;



$arFilter = [
	'IBLOCK_ID' => 23,
	'ID' => $productId
];
$arSelect = [
	'CATALOG_GROUP_1'
];
$dbProduct = CIBlockElement::GetList( [], $arFilter, false, false, $arSelect );
$arProduct = $dbProduct->Fetch()
?>
<pre><? print_r( $arProduct ) ?></pre>