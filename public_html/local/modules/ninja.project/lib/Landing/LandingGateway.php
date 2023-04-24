<?php

declare(strict_types=1);

namespace Ninja\Project\Landing;


use Ninja\Helper\Arr;
use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Project\Application;

class LandingGateway
{
    private const IBLOCK_CODE = 'aspro_next_landing';
    public const CACHE_DIR = '/' . self::IBLOCK_CODE;

    public static function getList(): array
    {
        $params = [
            'SELECT' => self::getSelectFields(),
            'FILTER' => [
                'IBLOCK_ID' => Iblock::getIblockIdByCode(self::IBLOCK_CODE),
                'ACTIVE' => 'Y',
            ],
            'ORDER' => ['PROPERTY_LINK_REGION' => 'DESC'],
            'GET_ENUM_CODE' => 'Y',
            'AS_ARRAY' => 'Y',
        ];

        $callback = static function () use ($params) {
            $items = Element::getList($params);

            foreach ($items as $key => $item) {
                $items[$key]['seo'] = Element::getSeo($params['FILTER']['IBLOCK_ID'], $item['id'], $item['name']);
            }

            return $items;
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR, $params, $callback))
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
            'DETAIL_TEXT:Html>detailText',
            'PROPERTY_FILTER_URL:string>filterUrl',
            'PROPERTY_LINK_REGION:int[]>regions',
        ];
    }
}
