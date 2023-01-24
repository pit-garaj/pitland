<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

$city = $_POST['CITY'];

$APPLICATION->set_cookie( 'CITY', $city );
$APPLICATION->set_cookie( 'CITY_CONFIRMED', 'Y' );

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php' );