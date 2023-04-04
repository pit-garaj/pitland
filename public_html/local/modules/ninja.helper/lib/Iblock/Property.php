<?php

namespace Ninja\Helper\Iblock;

use Bitrix\Main\LoaderException;
use CIBlockProperty;
use CIBlockPropertyEnum;
use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Dbg;
use Ninja\Project\Application;
use RuntimeException;

class Property
{
    private const CACHE_DIR = '/PROPERTY';
    public const CACHE_TIME = 3600;


    /**
     * @throws LoaderException
     */
    public static function getList(string $iblockCode): array
    {
        $iblockId = Iblock::getIblockIdByCode($iblockCode);

        if ($iblockId === null) {
            throw new RuntimeException('Не найден инфоблок с кодом «' . $iblockCode . '»');
        }

        $filter = ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'];

        $callback = static function () use ($filter) {
            $result = [];

            $res = CIBlockProperty::GetList([], $filter);
            while ($item = $res->GetNext())
            {
                $id = $item['ID'];
                $result[$id] = [
                    'id' => $item['ID'],
                    'code' => $item['CODE'],
                    'name' => $item['NAME'],
                    'xmlId' => $item['XML_ID'],
                    'sort' => $item['SORT'],
                    'type' => $item['PROPERTY_TYPE'],
                ];
            }

            return $result;
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR . '/LIST', $filter, $callback))
            ->setUseTags()
            ->setTtl(self::CACHE_TIME);

        return CacheManager::getDataCache($cacheSettings);
    }


    public static function getValueXmlIdToIdMap(string $iblockCode): array
    {
        $iblockId = Iblock::getIblockIdByCode($iblockCode);

        if ($iblockId === null) {
            throw new RuntimeException('Не найден инфоблок с кодом «' . $iblockCode . '»');
        }

        $filter = ['IBLOCK_ID' => $iblockId];


        $callback = static function () use ($filter) {
            $result = [];

            $res = CIBlockPropertyEnum::GetList([], $filter);
            while ($item = $res->Fetch())
            {
                $xmlId = $item['XML_ID'];
                $result[$xmlId] = $item['ID'];
            }

            return $result;
        };

        $cacheSettings = (new CacheSettings(self::CACHE_DIR . '/VALUES', $filter, $callback))
            ->setUseTags()
            ->setTtl(self::CACHE_TIME);


        return CacheManager::getDataCache($cacheSettings);
    }
}
