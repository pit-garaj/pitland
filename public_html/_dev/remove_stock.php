<?
/*require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

CModule::IncludeModule( 'catalog' );


$arFilter = Array(
	'>AMOUNT' => 0,
	'!STORE_ID' => 17
);
$arSelect = Array(
	'ID'
);
$dbStock = CCatalogStoreProduct::GetList( Array(), $arFilter, false, false, $arSelect );
while ( $arStock = $dbStock->Fetch() )
{
	CCatalogStoreProduct::Delete( $arStock['ID'] );
	
	?><pre><? print_R( $arStock ) ?></pre><?
}*/
?>
done!