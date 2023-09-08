<?php

declare(strict_types=1);

use Bitrix\Main\EventManager;
use Ninja\Project\Catalog\CatalogElements;
use Ninja\Project\Catalog\CatalogStore;
use Ninja\Project\Catalog\Import\CatalogBrands;
use Ninja\Project\Iblock\Import\IblockProperties;
use Ninja\Project\Mail\Event;
use Ninja\Project\Search\ModifyIndex;
use Ninja\Project\Shop\Order;

$eventManager = EventManager::getInstance();

// Добавление Артикула и Keywords в заголовок для поиска
$eventManager->addEventHandler('search', 'BeforeIndex', [ModifyIndex::class, 'run']);

// Заполнение бренда при импорте из 1С
$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementAdd', [CatalogBrands::class, 'fullBrandFrom1C']);
$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementUpdate', [CatalogBrands::class, 'fullBrandFrom1C']);

/**
 * Костыль для 1с (выгрузка множественных свойств)
 * Проблема:
 * При выгрузке из 1с у списока свойств в значении должны стоять ID
 * ID приходит только у 1-го элемента, у остальных XML_ID
 * Поэтому этот костыть преобразуем все XML_ID в ID
 */
$eventManager->addEventHandler('iblock', 'OnBeforeIBlockElementAdd', [IblockProperties::class, 'updateListType']);
$eventManager->addEventHandler('iblock', 'OnBeforeIBlockElementUpdate', [IblockProperties::class, 'updateListType']);

// Обновляет наличие по складам
$eventManager->addEventHandler('catalog', 'OnStoreProductAdd', [CatalogStore::class, 'update']);
$eventManager->addEventHandler('catalog', 'OnStoreProductUpdate', [CatalogStore::class, 'update']);

// Разделение заказа
$eventManager->addEventHandler('sale', 'OnSaleOrderBeforeSaved', [Order::class, 'onSaleOrderBeforeSaved']);

// Обновляет дату начала активности
$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementAdd', [CatalogElements::class, 'eventAddDateActive']);

// Почтовое событие сделать, чтобы поле время отправлялось в виде 07:30, а не 07:30[112]
$eventManager->addEventHandler('main', 'OnBeforeEventAdd', [Event::class, 'updateTime']);
