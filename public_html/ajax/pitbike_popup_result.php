<?php
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

/** @var object $APPLICATION */

CModule::IncludeModule( 'iblock' );

$exp = htmlspecialchars( $_POST['EXP'] );
$height = htmlspecialchars( $_POST['HEIGHT'] );
$low_price = htmlspecialchars( $_POST['low_price'] );
$middle_price = htmlspecialchars( $_POST['middle_price'] );
$high_price = htmlspecialchars( $_POST['high_price'] );

$name = htmlspecialchars( $_POST['NAME'] );
$phone = htmlspecialchars( $_POST['PHONE'] );

$price = array();
if (isset($low_price)) {
	$price[] = $low_price;
}

if (isset($middle_price)) {
	$price[] = $middle_price;
}

if (isset($high_price)) {
	$price[] = $high_price;
}

if ( $exp && $height && $price && $name && $phone )
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
			
			
	$baseUrl = '/catalog/tekhnika/filter/';
	
	
	if ( $height == 'low' )
	{
		//$baseUrl .= 'engine_volume-from-50-to-125/';
		$baseUrl .= 'diametr_koles_pered_zad_dyuym-is-12bf7da0-d452-11e7-93b6-38d5471c55ce-or-83046e1f-d4dd-11e7-93b6-38d5471c55ce/';
		$mailHeight = 'Диаметр колес 125-145 см (10/10 + 12/10)';
	}
	if ( $height == 'mid' )
	{
		$baseUrl .= 'diametr_koles_pered_zad_dyuym-is-12bf7da2-d452-11e7-93b6-38d5471c55ce/';
		$mailHeight = 'Диаметр колес 145-160 см (14/12)';
	}
	
	if ( $height == 'high' )
	{
		$baseUrl .= 'diametr_koles_pered_zad_dyuym-is-12bf7da4-d452-11e7-93b6-38d5471c55ce-or-12bf7da3-d452-11e7-93b6-38d5471c55ce/';
		$mailHeight = 'Диаметр колес 160-180 см (17/14 + 19/16)';
	}

	if ( $height == 'highest' )
	{
		$baseUrl .= 'diametr_koles_pered_zad_dyuym-is-12bf7da5-d452-11e7-93b6-38d5471c55ce-or-12bf7da4-d452-11e7-93b6-38d5471c55ce/';
		$mailHeight = 'Диаметр колес 175-200 см (19/16 + 21/18)
		';
	}

	if (in_array('low_price', $price))
	{
		$baseUrl .= 'price-base-from-80000-to-160000/';
		$mailRoad = 'Цена от 80 до 160 т р';
	
	}
	
	if ( in_array('middle_price', $price) && in_array('high_price', $price)) {
		$baseUrl .= 'price-base-from-140000/';
		$mailRoad = 'Цена от 140';
	}
    elseif (in_array('high_price', $price)) {
		$baseUrl .= 'price-base-from-200000/';
		$mailRoad = 'Цена от 200 т р';
	}
    elseif ( in_array('middle_price', $price)) {
		$baseUrl .= 'price-base-from-140000-to-200000/';
		$mailRoad = 'Цена от 140 до 200 т р';
	}
	
	$baseUrl .= 'apply/?FROM_POPUP=Y';

	if ($exp == 'exp') {
		$mailExp = 'Есть опыт';
	}
	
	$arMailFields = [
        'NAME' => $name,
        'PHONE' => $phone,
        'EXP' => $mailExp,
        'HEIGHT' => $mailHeight,
        'ROAD' => $mailRoad,
    ];
	CEvent::SendImmediate( 'PITBIKE_POPUP', 's1', $arMailFields );

    $APPLICATION->set_cookie( 'DONT_NEED_TO_SHOW_QUIZ', 'Y' );
	
	require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php' );
}
