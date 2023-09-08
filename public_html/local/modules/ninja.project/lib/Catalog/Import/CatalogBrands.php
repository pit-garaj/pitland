<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog\Import;

use Bitrix\Main\LoaderException;
use Ninja\Helper\Dbg;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Helper\Translit;
use Ninja\Project\Catalog\CatalogBrandGateway;
use Ninja\Project\Catalog\CatalogGateway;

class CatalogBrands
{
    /**
     * @throws LoaderException
     */
    public static function fullBrandFrom1C(array $fields): void
    {
        $catalogIbIdId = Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE);
        $brandsIbId    = Iblock::getIblockIdByCode(CatalogBrandGateway::IBLOCK_CODE);

        if ($catalogIbIdId === (int)$fields['IBLOCK_ID']) {
            $itemId = (int)$fields['ID'];

            $item = self::getItem($catalogIbIdId, $itemId);

            $brandName = $item['brand1C'];
            if (!empty($brandName)) {
                $brandId = self::getBrandId($brandsIbId, $brandName);

                if ($brandId !== null) {
                    Element::updateProperty($itemId, ['BRAND' => $brandId]);
                } else {
                    $result = Element::add([
                        'IBLOCK_ID' => $brandsIbId,
                        'ACTIVE'    => 'Y',
                        'NAME'      => $brandName,
                        'CODE'      => Translit::code($brandName),

                    ]);

                    if ($result['type'] === 'success') {
                        Element::updateProperty($itemId, ['BRAND' => $result['id']]);
                    }
                }
            }
        }
    }

    /**
     * @throws LoaderException
     */
    private static function getItem(int $iblockId, int $id): ?array
    {
        $params = [
            'FILTER' => [
                'IBLOCK_ID' => $iblockId,
                'ID'        => $id,
            ],
            'SELECT' => ['ID:int>id', 'PROPERTY_PROIZVODITEL_1:string>brand1C']
        ];
        $item   = Element::getRow($params);

        return !empty($item) ? $item : null;
    }


    /**
     * @throws LoaderException
     */
    private static function getBrandId(int $iblockId, string $brantName): ?int
    {
        $params = [
            'FILTER' => [
                'IBLOCK_ID' => $iblockId,
                'NAME'      => $brantName
            ],
            'SELECT' => ['ID:int>id']
        ];
        $item   = Element::getRow($params);

        return $item['id'] ?? null;
    }
}
