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
