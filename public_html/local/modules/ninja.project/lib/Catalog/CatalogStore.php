<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

use CCatalogStore;
use CCatalogStoreProduct;
use Ninja\Helper\Arr;

class CatalogStore
{
    // Ф_Основной
    public const MAIN_CODE = '96531d2a-c1dc-11ea-8455-2cfda1745e0d';

    // ИП_Декстер
    public const DEXTER_IP_CODE = 'IP_DEXTER';

    // OOO_Декстер
    public const DEXTER_OOO_CODE = 'OOO_DEXTER';

    // ИП_Формула
    public const FORMULA_CODE = 'IP_FORMULA';

    public static array $siteIdByStoreCode = [
        self::MAIN_CODE => 'sm',
        self::DEXTER_IP_CODE => 'sd',
        self::FORMULA_CODE => 'sf',
    ];

    public static function getAmount(array $ids): array
    {
        $stores = CatalogStoreGateway::fetchAll($ids);

        $result = [];
        foreach ($stores as $store) {
            $storeCode = $store['CODE'];
            $storeAmount = (int) $store['PRODUCT_AMOUNT'];

            if (isset($store['PRODUCT_AMOUNT'])) {
                $result[$storeCode] = self::displayAmount($storeAmount);
            }
        }

        return $result;
    }


    public static function update(int $id, array $fields): void
    {
        $stores = CatalogStoreGateway::fetchAll([$fields['PRODUCT_ID']]);
        $ipDexterId = Arr::findInArr($stores, 'CODE', self::DEXTER_IP_CODE, 'ID');
        $oooDexterId = Arr::findInArr($stores, 'CODE', self::DEXTER_OOO_CODE, 'ID');
        $ipFormulaId = Arr::findInArr($stores, 'CODE', self::FORMULA_CODE, 'ID');

        if (!empty($ipDexterId) && !empty($ipFormulaId) && !empty($oooDexterId)) {
            $ipDexterAmount = $stores[$ipDexterId]['PRODUCT_AMOUNT'] ?? 0;
            $ipFormulaAmount = $stores[$ipFormulaId]['PRODUCT_AMOUNT'] ?? 0;
            $oooDexterAmount = $stores[$oooDexterId]['PRODUCT_AMOUNT'] ?? 0;

            if ($ipFormulaId === (int) $fields['STORE_ID'] && $ipFormulaAmount > 0) {
                $resultDexterAmount = $ipDexterAmount + $ipFormulaAmount;

                CCatalogStoreProduct::UpdateFromForm([
                    'PRODUCT_ID' => $fields['PRODUCT_ID'],
                    'STORE_ID'   => $ipDexterId,
                    'AMOUNT'     => $resultDexterAmount,
                ]);

                CCatalogStoreProduct::UpdateFromForm([
                    'PRODUCT_ID' => $fields['PRODUCT_ID'],
                    'STORE_ID'   => $ipFormulaId,
                    'AMOUNT'     => 0,
                ]);
            }

            if ($oooDexterId === (int) $fields['STORE_ID'] && $oooDexterAmount > 0) {
                $resultDexterAmount = $ipDexterAmount + $oooDexterAmount;

                CCatalogStoreProduct::UpdateFromForm([
                    'PRODUCT_ID' => $fields['PRODUCT_ID'],
                    'STORE_ID'   => $ipDexterId,
                    'AMOUNT'     => $resultDexterAmount,
                ]);

                CCatalogStoreProduct::UpdateFromForm([
                    'PRODUCT_ID' => $fields['PRODUCT_ID'],
                    'STORE_ID'   => $oooDexterId,
                    'AMOUNT'     => 0,
                ]);
            }
        }
    }

    public static function displayAmount(int $amount): string
    {
        $suffix = 'шт.';

        switch ($amount) {
            case 0:
            case 1:
            case 2:
                return $amount . '&nbsp;' . $suffix;
            default:
                return 'более 2-х ' . $suffix;
        }
    }
}
