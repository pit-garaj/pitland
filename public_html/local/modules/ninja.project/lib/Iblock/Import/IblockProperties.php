<?php

declare(strict_types=1);

namespace Ninja\Project\Iblock\Import;

use Bitrix\Main\LoaderException;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Helper\Iblock\Property;
use Ninja\Project\Catalog\CatalogGateway;

class IblockProperties
{
    /**
     * @throws LoaderException
     */
    public static function updateListType(array &$fields): void
    {
        $catalogIbIdId = Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE);

        if ($catalogIbIdId === (int)$fields['IBLOCK_ID']) {
            $properties = Property::getList(CatalogGateway::IBLOCK_CODE);
            $propertyValues = Property::getValueXmlIdToIdMap('aspro_next_catalog');

            foreach ($fields['PROPERTY_VALUES'] as $valueId => $valueList) {
                if ($properties[$valueId]['type'] === 'L') {

                    foreach ($valueList as $valueKey => $valueItem) {
                        $value = $valueItem['VALUE'];
                        if (!empty($value) && !is_numeric($value) && $propertyId = $propertyValues[$value]) {
                            $fields['PROPERTY_VALUES'][$valueId][$valueKey]['VALUE'] = $propertyId;
                        }
                    }
                }
            }
        }
    }
}
