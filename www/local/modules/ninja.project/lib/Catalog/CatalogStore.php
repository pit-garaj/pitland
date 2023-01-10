<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

use CCatalogStoreProduct;
use Ninja\Helper\Arr;

class CatalogStore
{
    public static function update(int $id, array $fields): void
    {
        $stores = CatalogStoreGateway::fetchAll([$fields['PRODUCT_ID']]);
        $ipDexterId = Arr::findInArr($stores, 'CODE', 'IP_DEXTER', 'ID');
        $ipFormulaId = Arr::findInArr($stores, 'CODE', 'IP_FORMULA', 'ID');

        if (!empty($ipDexterId) && !empty($ipFormulaId)) {
            $ipDexterAmount = $stores[$ipDexterId]['PRODUCT_AMOUNT'] ?? 0;
            $ipFormulaAmount = $stores[$ipFormulaId]['PRODUCT_AMOUNT'] ?? 0;

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
        }
    }
}
