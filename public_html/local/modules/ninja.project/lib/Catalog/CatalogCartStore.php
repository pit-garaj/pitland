<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

class CatalogCartStore
{
    public const ALLOW_STORE_CODES = [CatalogStore::DEXTER_CODE, CatalogStore::MAIN_CODE];

    /**
     * Метод получает колличество товара для разрешенных складов
     *
     * @param int $productId
     * @return array
     */
    public static function getAllowStoresAmountForProduct(int $productId): array
    {
        $result = [];

        $storeList = CatalogStoreGateway::fetchAll([$productId]);
        foreach ($storeList as $store) {
            if (in_array($store['CODE'], self::ALLOW_STORE_CODES, true)) {
                $result[$store['CODE']] = $store['PRODUCT_AMOUNT'];
            }
        }

        return $result;
    }


    public static function groupProductByStore(array $productIds): array
    {
        $productToStoreAmount = [];

        foreach ($productIds as $productId) {
            $productToStoreAmount[$productId] = self::getAllowStoresAmountForProduct($productId);
        }

        $result = [];
        foreach ($productToStoreAmount as $productId => $storeToAmount) {
            foreach ($storeToAmount as $storeCode => $amount) {
                $result[$storeCode]['full'][$productId] = $amount;

                if ($amount > 0) {
                    $result[$storeCode]['available'][$productId] = $amount;
                }
            }
        }

        return $result;
    }


    /**
     * Метод распределяет товары по складам, в зависимости от наличия
     *
     * @param array $cartItems
     * @return array
     */
    public static function distributeProductsByStores(array $productIds): array
    {
        $cartItemsCnt = count($productIds);
        $groupProductByStore = self::groupProductByStore($productIds);

        $fullStoreCode = '';
        foreach ($groupProductByStore as $storeCode => $items) {
            if (count($items['available']) === $cartItemsCnt) {
                $fullStoreCode = $storeCode;
                break;
            }
        }

        $result = [];
        if (empty($fullStoreCode)) {
            foreach ($productIds as $productId) {
                if ($groupProductByStore[CatalogStore::MAIN_CODE]['available'][$productId] >= $groupProductByStore[CatalogStore::DEXTER_CODE]['available'][$productId]) {
                    $siteId = CatalogStore::$siteIdByStoreCode[CatalogStore::MAIN_CODE];
                } else {
                    $siteId = CatalogStore::$siteIdByStoreCode[CatalogStore::DEXTER_CODE];
                }

                $result[$siteId][] = $productId;
            }
        } else {
            $result[$fullStoreCode] = $groupProductByStore[$fullStoreCode]['available'];
        }

        return $result;
    }
}
