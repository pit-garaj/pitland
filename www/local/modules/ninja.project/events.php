<?php

declare(strict_types=1);

use Bitrix\Main\EventManager;
use Ninja\Project\Search\ModifyIndex;

$eventManager = EventManager::getInstance();

$methodRun = [ModifyIndex::class, 'run'];
$eventManager->addEventHandler('search', 'BeforeIndex', $methodRun);
