<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

CModule::IncludeModule( 'iblock' );


$arSort = [
	'TIMESTAMP_X' => 'ASC'
];
$arFilter = [
	'IBLOCK_ID' => 23
];
$arNav = [
	'nTopCount' => 500
];
$arSelect = [
	'ID',
	'NAME'
];
$dbProducts = CIBlockElement::GetList( $arSort, $arFilter, false, $arNav, $arSelect );
while ( $arProduct = $dbProducts->Fetch() )
{
	$element = new CIBlockElement;
	$element->Update( $arProduct['ID'], ['NAME' => $arProduct['NAME']] );
}
?>
done!