<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

use CIBlockElement;
use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Project\Application;

class CatalogElements
{
    public static function getList(array $filter = []): array
    {
        $params = [
            'SELECT' => self::getSelectFields(),
            'FILTER' => array_merge([
                'IBLOCK_ID' => Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE),
                'ACTIVE' => 'Y',
            ], $filter),
            'ORDER' => ['ID' => 'ASC'],
            'GET_NEXT' => 'Y',
            'AS_ARRAY' => 'Y',
        ];

        $callback = static function () use ($params) {
            $list = Element::getList($params);
            return [
                'list' => $list,
            ];
        };

        $cacheSettings = (new CacheSettings(CatalogGateway::CACHE_DIR, $params, $callback))
            ->setUseTags()
            ->setSkipCache(true)
            ->setTtl(Application::CACHE_TIME);

        return CacheManager::getDataCache($cacheSettings);
    }

    /**
     * Обновляет дату начала активности элемента в каталоге при добавлении
     *
     * @param array $fields
     * @return void
     */
    public static function eventAddDateActive(array &$fields): void
    {
        $catalogIbIdId = Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE);
        if ($catalogIbIdId === (int)$fields['IBLOCK_ID']) {
            (new CIBlockElement)->Update($fields['ID'], [
                'DATE_ACTIVE_FROM' => date('d.m.Y H:i:s')
            ]);
        }
    }

    private static function getSelectFields(): array
    {
        return [
            'ID:int>id',
            'CODE:string>code',
            'NAME:string>name',
            'DETAIL_PAGE_URL:string>url',
        ];
    }
}
