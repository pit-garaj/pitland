<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

CModule::IncludeModule( 'iblock' );


$exp = htmlspecialchars( $_POST['EXP'] );
$height = htmlspecialchars( $_POST['HEIGHT'] );
$road = htmlspecialchars( $_POST['ROAD'] );
$name = htmlspecialchars( $_POST['NAME'] );
$phone = htmlspecialchars( $_POST['PHONE'] );


if ( $exp && $height && $road && $name && $phone )
{
	$mailExp = 'Нет опыта';
	$mailHeight = '90-140';
	$mailRoad = 'Бездорожье';
	
	
	
	$arFilter = Array(
		'IBLOCK_ID' => 23,
		'ACTIVE' => 'Y',
		'PROPERTY_ENGINE_VOLUME' => false
	);
	$arSelect = Array(
		'ID',
		'PROPERTY_OBEM_DVIGATELYA'
	);
	$dbItems = CIBlockElement::GetList( Array(), $arFilter, false, false, $arSelect );
	while ( $arItem = $dbItems->Fetch() )
	{
		$volume = intval( $arItem['PROPERTY_OBEM_DVIGATELYA_VALUE'] );
		
		CIBlockElement::SetPropertyValuesEx( $arItem['ID'], 23, Array( 'ENGINE_VOLUME' => $volume ) );
	}
			
			
	$baseUrl = '/catalog/tekhnika/pitbayki/filter/';
	
	
	if ( $height == 'low' )
	{
		$baseUrl .= 'engine_volume-from-50-to-125/';
		$baseUrl .= 'diametr_koles_pered_zad_dyuym-is-10-10-or-12-10-or-12-12-or-14-12/';
	}
	else
	{
		if ( $exp == 'noexp' )
		{
			$baseUrl .= 'engine_volume-to-125/';
		}
		
		
		if ( $height == 'mid' )
		{
			$baseUrl .= 'vysota_po_sedlu_mm-to-870/';
			$mailHeight = '140-170';
		}
		elseif ( $height == 'high' )
		{
			$baseUrl .= 'vysota_po_sedlu_mm-from-870/';
			$mailHeight = 'от 170';
		}
	}
	
	
	if ( $road == 'road' )
	{
		$baseUrl .= 'price-base-from-70000/';
		$mailRoad = 'Спорт. трасса';
	}
	
	$baseUrl .= 'apply/?FROM_POPUP=Y';
	
	
	
	
	if ( $exp == 'exp' )
	{
		$mailExp = 'Есть опыт';
	}
	
	$arMailFields = Array(
		'NAME' => $name,
		'PHONE' => $phone,
		'EXP' => $mailExp,
		'HEIGHT' => $mailHeight,
		'ROAD' => $mailRoad,
	);
	CEvent::SendImmediate( 'PITBIKE_POPUP', 's1', $arMailFields );
	
	
	
	$APPLICATION->set_cookie( 'DONT_NEED_TO_SHOW_QUIZ', 'Y' );
	
	echo $baseUrl;
	
	require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php' );
}