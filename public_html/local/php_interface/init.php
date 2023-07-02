<?php

declare(strict_types=1);

use Ninja\Project\Regionality\Cities;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/modules/ninja.project/events.php';

// Check City
$checkCity = Cities::checkCity();

if ($checkCity !== 'city' && Cities::isSubDomain()) {
    LocalRedirect('http://' . SITE_SERVER_NAME);
}



/**
 * Почтовое событие сделать, чтобы поле время отправлялось в виде 07:30, а не 07:30[112]
 *
 * TODO: Вынести отсюда. А лучше вообще избавится
 */
AddEventHandler("main", "OnBeforeEventAdd", array("MyClass", "OnBeforeEventAddHandler"));
class MyClass
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == 'FORM_FILLING_CALLBACK_FOOTER'){
            $pos = strpos($arFields["TIME"], '[');
            $str = substr($arFields["TIME"], 0, $pos);
            $arFields["TIME_CUSTOM"] = $str;
        }
    }
}
