<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Dbg;
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
