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
    public const IN_STOCK = 'В наличии';
    public const IN_STORE = 'На складе';
    public const OUT_OF_STOCK = 'Нет в наличии';
    public const DELIVERY_TIME = [
        '57' => '5-7 дней',
    ];
    public const AVAILABILITY_STYLE = [
        'danger' => 'danger',
        'warning' => 'warning',
        'success' => 'success',
    ];

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
     * Метод на входе принимаеи ланные из $arResult / $arResult['ITEMS']
     * На выходе выдает массив ID элемента + ID предложений
     *
     * @param array $item
     * @return array
     */
    public static function getItemIdAndOfferIds(array $item): array
    {
        $itemId = $item['ID'];

        if (empty($item['OFFERS'])) {
            return [$itemId];
        }

        $offerIds = [];
        foreach ($item['OFFERS'] as $offer) {
            $offerIds[] = $offer['ID'];
        }

        return array_merge([$itemId], $offerIds);
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

    public static function modifyItemForAvailability(array &$item): void
    {
        $ids = self::getItemIdAndOfferIds($item);
        $storesData = CatalogStore::getProductIdToStoreCodeToAmountMap($ids);
        CatalogStore::modifyStoreDataByCross($storesData);

        if (!empty($item['OFFERS'])) {
            $offerIds = array_map(static function ($offer) {
                return $offer['ID'];
            }, $item['OFFERS']);
            $item['AVAILABILITY'] = self::getAvailabilityDataForItemOffers($offerIds, $storesData);
        } else {
            $productId = $item['ID'];
            $availabilityData = self::getAvailabilityDataForItem($storesData[$productId] ?? []);
            $item['AVAILABILITY'] = $availabilityData;
            $item['CATALOG_QUANTITY'] = $availabilityData['quantity'];
        }
    }

    public static function getAvailabilityDataForItem(array $storeToAmountMap): array
    {
        if (
            $storeToAmountMap[CatalogStore::DEXTER_IP_CODE] > 0 ||
            $storeToAmountMap[CatalogStore::MAIN_CODE] > 0
        ) {
            $availability = self::IN_STOCK;
            $availabilityStyle = self::AVAILABILITY_STYLE['success'];
            $deliveryTime = null;
        }
        elseif ($storeToAmountMap[CatalogStore::CROSS_CODE] > 0) {
            $availability = self::IN_STORE;
            $availabilityStyle = self::AVAILABILITY_STYLE['warning'];
            $deliveryTime = self::DELIVERY_TIME['57'];
        }
        else {
            $availability = self::OUT_OF_STOCK;
            $availabilityStyle = self::AVAILABILITY_STYLE['danger'];
            $deliveryTime = null;
        }

        return [
            'availability' => $availability,
            'availability_style' => $availabilityStyle,
            'deliveryTime' => $deliveryTime,
            /*
            'quantity' => array_sum([
                $storeToAmountMap[CatalogStore::GRISHINUD_CODE] ?? 0,
                $storeToAmountMap[CatalogStore::TVOYGARAJ_CODE] ?? 0,
                $storeToAmountMap[CatalogStore::GVMZ_CODE] ?? 0,
            ]),
            */
        ];
    }

    public static function getAvailabilityDataForItemOffers(array $offerIds, array $storesData): array
    {
        $success = null;
        $warning = null;
        $danger = null;

        foreach ($offerIds as $offerId) {
            $getAvailabilityDataForItem = self::getAvailabilityDataForItem($storesData[$offerId] ?? []);

            if ($getAvailabilityDataForItem['availability_style'] === 'success') {
                $success = $getAvailabilityDataForItem;
            }

            if ($getAvailabilityDataForItem['availability_style'] === 'warning') {
                $warning = $getAvailabilityDataForItem;
            }

            $danger = $getAvailabilityDataForItem;
        }

        return $success ?? $warning ?? $danger;
    }
}
