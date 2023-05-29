<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Helper\Iblock\Section;
use Ninja\Project\Application;

class CatalogSections
{
    public static function getList(): array
    {
        $params = [
            'SELECT' => self::getSelectFields(),
            'FILTER' => [
                'IBLOCK_ID' => Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE),
                'ACTIVE' => 'Y',
            ],
            'ORDER' => ['ID' => 'ASC'],
            'GET_NEXT' => 'Y',
            'AS_ARRAY' => 'Y',
            'bIncCnt' => true,
        ];

        $callback = static function () use ($params) {
            $list = Section::getList($params);
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
            'SECTION_PAGE_URL:string>url',
            'ELEMENT_CNT:int>cnt',
        ];
    }
}
