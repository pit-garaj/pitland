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

        foreach ($productIds as $productId => $productQuantity) {
            $productToStoreAmount[$productId] = self::getAllowStoresAmountForProduct($productId);
        }

        $preResult = [];
        foreach ($productToStoreAmount as $productId => $storeToAmount) {
            foreach ($storeToAmount as $storeCode => $amount) {
                if ($amount > 0) {
                    $preResult[$storeCode][$productId] = $amount;
                }
            }
        }

        /**
         * Делает промежуточный массив отсортированный по наличию товара
         */
        $storeToAmountMap = [];
        foreach ($preResult as $storeCode => $items) {
            $storeToAmountMap[$storeCode] = !empty($items) ? array_sum($items) : 0;
        }
        arsort($storeToAmountMap);

        /**
         * Сортирует главный массив по наличию товара.
         * Первый стоит склад с наибольшим колличеством
         */
        $result = [];
        foreach ($storeToAmountMap as $storeCode => $count) {
            $result[$storeCode] = $preResult[$storeCode];
        }

        return $result;
    }


    /**
     * Метод распределяет товары по складам, в зависимости от наличия
     *
     * @param array $productIds
     * @return array
     */
    public static function distributeProductsByStores(array $productIds): array
    {
        $groupProductByStore = self::groupProductByStore($productIds);

        $resultTest = [];
        foreach ($groupProductByStore as $storeCode => $items) {
            foreach ($productIds as $productId => $productQuantity) {
                $storeQuantity = $items[$productId];

                if ($productQuantity > 0 && $storeQuantity > 0) {
                    $siteId = CatalogStore::$siteIdByStoreCode[$storeCode];

                    if ($storeQuantity < $productQuantity) {
                        $resultTest[$siteId][$productId] = $storeQuantity;
                        $productIds[$productId] = $productQuantity - $storeQuantity;
                    }
                    else {
                        $resultTest[$siteId][$productId] = $productQuantity;
                        $productIds[$productId] = 0;
                    }
                }
            }
        }

        return $resultTest;
    }
}
