<?php

use Bitrix\Sale\Location\LocationTable;
use Bitrix\Sale\Order;

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );


$dbRes = Order::getList([
    'select' => ['*'],
    'filter' => [
        // ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date("n"), 1, date("Y"))), //по дате
    ],
    'order' => ['ID' => 'DESC'],
    'limit' => 10
]);

$orderList = [];

$locationCodes = [];
while ($qq = $dbRes->fetch()){

    $order = Order::load($qq['ID']);

    $propertyCollection = $order->getPropertyCollection();

    $locationCode = $propertyCollection->getItemByOrderPropertyId(6)->getValue();

    $year = $qq['DATE_INSERT']->format('Y');
    $month = $qq['DATE_INSERT']->format('M');

    $locationCodes[$locationCode] = $locationCode;

    $orderList[] = [
        'location' => $locationCode,
        'year' => $year,
        'month' => $month,
        'price' => $order->getPrice(),
    ];
}

$res = LocationTable::getList([
    'filter' => ['=CODE' => array_values($locationCodes), '=NAME.LANGUAGE_ID' => LANGUAGE_ID,],
    'select' => [
        '*', 'NAME_RU' => 'NAME.NAME'
    ]
]);

$locations = [];
while ($item = $res->fetch()) {
    $code = $item['CODE'];
    $name = $item['NAME_RU'];

    $locations[$code] = $name;
}


$result = [];
foreach ($orderList as $order) {
    $location = $order['location'];
    $year = $order['year'];
    $month = $order['month'];
    $price = $order['price'];
    $locationName = $locations[$location];
    $result[$year][$month][$locationName][] = $price;
}


foreach ($result as $year => $yearData) {

    echo '<h2>' . $year . '</h2>';

    foreach ($yearData as $month => $monthData) {
        echo '<h3>' . $month . '</h3>';
        foreach ($monthData as $city => $amount) {
            echo '<div>' . $city . ': ' . array_sum($amount) . '</div>';
        }
    }
}



/*echo '<pre>';
print_r($result);
echo '</pre>';*/
