<?php

declare(strict_types=1);

namespace Ninja\Project\Regionality;


use Ninja\Helper\Arr;
use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Project\Application;

class CitiesGateway
{
    private const IBLOCK_CODE = 'aspro_next_regions';
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
            foreach ($list as $key => $item) {
                if ($item['default'] === true) {
                    $list[$key]['domain'] = 'https://' . SITE_SERVER_NAME;
                } else {
                    $list[$key]['domain'] = 'https://' . $item['code'] . '.' . SITE_SERVER_NAME;
                }
            }

            return [
                'default' => self::getDefaultCityCode($list),
                'list' => $list,
                'idToItemMap' => Arr::codeToItemMap($list, 'id'),
                'codeToItemMap' => Arr::codeToItemMap($list, 'code'),
            ];
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR, $params, $callback))
            ->setUseTags()
            ->setSkipCache(true)
            ->setTtl(Application::CACHE_TIME);

        return CacheManager::getDataCache($cacheSettings);
    }

    public static function getItemByCode(string $code): array
    {
        return self::getData()['codeToItemMap'][$code] ?? [];
    }

    private static function getDefaultCityCode(array $list): string
    {
        $result = null;

        foreach ($list as $item) {
            if ($item['default'] === true) {
                $result = $item['code'];
                break;
            }
        }

        return $result ?? $list[0]['code'];
    }

    private static function getSelectFields(): array
    {
        return [
            'ID:int>id',
            'CODE:string>code',
            'NAME:string>name',
            'PROPERTY_NAME_RP:string>nameRp',
            'PROPERTY_NAME_PP:string>namePp',
            'PROPERTY_NAME_TP:string>nameTp',
            'PROPERTY_NAME_DP:string>nameDp',
            'PROPERTY_DEFAULT:EnumBool>default',
            'PROPERTY_ADDRESS:string[]>address',
            'PROPERTY_PHONE:string[]>phone',
            'PROPERTY_EMAIL:string[]>email',
            'PROPERTY_WORK:string[]>work',
            'PROPERTY_MAP:Map>map',
            'PROPERTY_MAP_ZOOM:int>mapZoom',
        ];
    }
}
