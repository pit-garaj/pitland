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
                $result[$store['CODE']] = (int) $store['PRODUCT_AMOUNT'];
            }
        }

        arsort($result);

        return $result;
    }


    public static function groupProductByStore(array $productsData): array
    {
        // Сортирует склады
        $storeCodeToQuantityMap = self::sortSoreByQuantity($productsData);

        $productToStoreAmount = [];
        foreach ($productsData as $productId => $productData) {
            $productToStoreAmount[$productId] = $productData['stores'];
        }

        // Выводит наличие на складах
        $preResult = [];
        foreach ($productToStoreAmount as $productId => $storeToAmount) {
            foreach ($storeToAmount as $storeCode => $quantity) {
                if ($quantity > 0) {
                    $preResult[$storeCode][$productId] = min($productsData[$productId]['quantity'], $quantity);
                }
            }
        }

        // Выводит отсортированное наличие на складах
        $preResultSort = [];
        foreach ($storeCodeToQuantityMap as $storeCode => $quantity) {
            $preResultSort[$storeCode] = $preResult[$storeCode];
        }

        /**
         * Делает промежуточный массив отсортированный по наличию товара
         */
        $storeToAmountMap = [];
        foreach ($preResultSort as $storeCode => $items) {
            $storeToAmountMap[$storeCode] = !empty($items) ? array_sum($items) : 0;
        }
        arsort($storeToAmountMap);

        /**
         * Сортирует главный массив по наличию товара.
         * Первый стоит склад с наибольшим колличеством
         */
        $result = [];
        foreach ($storeToAmountMap as $storeCode => $count) {
            $result[$storeCode] = $preResultSort[$storeCode];
        }

        return $result;
    }


    /**
     * Метод распределяет товары по складам, в зависимости от наличия
     *
     * @param array $productIdToQuantityMap
     * @return array
     */
    public static function distributeProductsByStores($productsData): array
    {
        $groupProductByStore = self::groupProductByStore($productsData);

        $resultTest = [];

        $productIdToQuantityMap = array_map(static function ($item) {
            return $item['quantity'];
        }, $productsData);

        // Находим склад на котором есть все продукты
        $storeCodeHasAllProducts = null;
        foreach ($groupProductByStore as $storeCode => $items) {
            if ($items === $productIdToQuantityMap) {
                $storeCodeHasAllProducts = $storeCode;
                break;
            }
        }

        // Если он есть то закидываем все в него
        if ($storeCodeHasAllProducts !== null) {
            $siteId = CatalogStore::$siteIdByStoreCode[$storeCodeHasAllProducts];

            $resultTest[$siteId] = $productIdToQuantityMap;

            return $resultTest;
        }

        // Иначе распределяем по складам
        foreach ($groupProductByStore as $storeCode => $items) {
            foreach ($productIdToQuantityMap as $productId => $productQuantity) {
                $storeQuantity = $items[$productId];

                if ($productQuantity > 0 && $storeQuantity > 0) {
                    $siteId = CatalogStore::$siteIdByStoreCode[$storeCode];

                    if ($storeQuantity < $productQuantity) {
                        $resultTest[$siteId][$productId] = $storeQuantity;
                        $productIdToQuantityMap[$productId] = $productQuantity - $storeQuantity;
                    }
                    else {
                        $resultTest[$siteId][$productId] = $productQuantity;
                        $productIdToQuantityMap[$productId] = 0;
                    }
                }
            }
        }

        return $resultTest;
    }

    /**
     * Метод сортирует склады по колличеству товара
     *
     * @param array $productsData
     * @return array
     */
    private static function sortSoreByQuantity(array $productsData): array
    {
        $storeCodeToQuantitiesMap = [];
        foreach ($productsData as $productId => $productData) {
            foreach ($productData['stores'] as $storeCode => $quantity) {
                $storeCodeToQuantitiesMap[$storeCode][$productId] = $quantity;
            }
        }

        $storeCodeToQuantityMap = [];
        foreach ($storeCodeToQuantitiesMap as $storeCode => $quantities) {
            $storeCodeToQuantityMap[$storeCode] = array_sum($quantities);
        }
        arsort($storeCodeToQuantityMap);

        return $storeCodeToQuantityMap;
    }
}
