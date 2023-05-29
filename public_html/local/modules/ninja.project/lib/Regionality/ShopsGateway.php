<?php

declare(strict_types=1);

namespace Ninja\Project\Regionality;


use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Project\Application;

class ShopsGateway
{
    private const IBLOCK_CODE = 'SHOPS';
    public const CACHE_DIR = '/' . self::IBLOCK_CODE;

    public static function getData(): array
    {
        $params = [
            'SELECT' => self::getSelectFields(),
            'FILTER' => [
                'IBLOCK_ID' => Iblock::getIblockIdByCode(self::IBLOCK_CODE),
                'ACTIVE' => 'Y',
            ],
            'ORDER' => ['ID' => 'ASC'],
            'GET_ENUM_CODE' => 'Y',
            'AS_ARRAY' => 'Y',
        ];

        $callback = static function () use ($params) {
            $list = Element::getList($params);
            return [
                'list' => $list,
                'cityToItemList' => self::getCityToItemList($list),
            ];
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR, $params, $callback))
            ->setUseTags()
            ->setSkipCache(true)
            ->setTtl(Application::CACHE_TIME);

        return CacheManager::getDataCache($cacheSettings);
    }

    private static function getCityToItemList(array $list): array
    {
        $result = [];

        foreach ($list as $item) {
            $cityCode = $item['city'];

            $result[$cityCode][] = $item;
        }

        return $result;
    }

    private static function getSelectFields(): array
    {
        return [
            'ID:int>id',
            'CODE:string>code',
            'NAME:string>name',
            'DETAIL_PICTURE:Image>detailPicture',
            'DETAIL_TEXT:Html>detailText',
            'PROPERTY_CITY.CODE:string>city',
            'PROPERTY_ADDRESS:string>address',
            'PROPERTY_PHONE:string[]>phone',
            'PROPERTY_EMAIL:string>email',
            'PROPERTY_WORK:string[]>work',
            'PROPERTY_ROUTE:string[]>route',
            'PROPERTY_MAP:Map>map',
        ];
    }
}
