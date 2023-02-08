<?php

declare(strict_types=1);

use Bitrix\Main\EventManager;
use Ninja\Project\Catalog\CatalogStore;
use Ninja\Project\Catalog\Import\CatalogBrands;
use Ninja\Project\Search\ModifyIndex;
use Ninja\Project\Shop\Order;

$eventManager = EventManager::getInstance();

// Добавление Артикула и Keywords в заголовок для поиска
$eventManager->addEventHandler('search', 'BeforeIndex', [ModifyIndex::class, 'run']);

// Заполнение бренда при импорте из 1С
$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementAdd', [CatalogBrands::class, 'fullBrandFrom1C']);
$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementUpdate', [CatalogBrands::class, 'fullBrandFrom1C']);

//
// $eventManager->addEventHandler('catalog', 'OnStoreProductUpdate', [CatalogStore::class, 'update']);


// $eventManager->addEventHandler('sale', 'OnSaleOrderBeforeSaved', [Order::class, 'onSaleOrderBeforeSaved']);
