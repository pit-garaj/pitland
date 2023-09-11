<?php

use Ninja\Project\Regionality\Cities;

$city = Cities::getCityByHost();

$aMenuLinks[] = ['О компании', '/company/', [], [], ''];

if (!empty($city['default'])) {
    $aMenuLinks[] = ['Услуги', '/services/', [], [], ''];
}

$aMenuLinks[] = ['Как купить', '/help/', [], [], ''];
$aMenuLinks[] = ['Производители', '/info/brands/', [], [], ''];
$aMenuLinks[] = ['Оплата', '/help/payment/', [], [], ''];
$aMenuLinks[] = ['Доставка', '/help/delivery/', [], [], ''];
$aMenuLinks[] = ['Акции', '/sale/', [], [], ''];
$aMenuLinks[] = ['Контакты', '/contacts/', [], [], ''];
