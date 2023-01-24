<?
// $arParams['SECTION_ID']


if ( $this->StartResultCache( 86400000 ) )
{
	CModule::IncludeModule( 'iblock' );
	
	
	$arFilter = Array(
		'IBLOCK_ID' => 23,
		'ID' => $arParams['SECTION_ID']
	);
	$arSelect = Array(
		'ID',
		'UF_SEO_LINKS'
	);
	$dbSection = CIBlockSection::GetList( Array(), $arFilter, false, $arSelect );
	$arSection = $dbSection->Fetch();
		
	$arResult['LINKS_HTML'] = $arSection['UF_SEO_LINKS'];

	
	
	$this->EndResultCache();
}



$this->IncludeComponentTemplate();