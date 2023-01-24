<?php

declare(strict_types=1);

namespace Ninja\Project\Shop;

use Bitrix\Main\LoaderException;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Helper\Iblock\Section;
use Ninja\Project\Catalog\CatalogGateway;

class SectionAvailable
{
    /**
     * Обновляет кол-во досттупных товаров в UF_COUNT_ELEMENTS
     *
     * @throws LoaderException
     */
    public static function updateCountElements(): string
    {
        $iblockId = Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE);

        foreach (self::getSections($iblockId) as $sectionId => $section) {
            $countElements = self::getAvailableCount($iblockId, $sectionId);
        }

        return '\Ninja\Project\Shop\SectionAvailable::updateCountElements();';
    }


    /**
     * @throws LoaderException
     */
    private static function update(int $sectionId, int $countElements): array
    {
        return Section::update($sectionId, ['UF_COUNT_ELEMENTS' => $countElements]);
    }


    /**
     * @throws LoaderException
     */
    private static function getAvailableCount(int $iblockId, int $sectionId): int
    {
        $filter = [
            'IBLOCK_ID'           => $iblockId,
            "SECTION_ID"          => $sectionId,
            'ACTIVE'              => 'Y',
            'INCLUDE_SUBSECTIONS' => 'Y',
            'SUBSECTION'          => 'Y',
            'CATALOG_AVAILABLE'   => 'Y',
            '>CATALOG_QUANTITY'   => 0,
        ];

        return Element::getCount($filter);
    }


    /**
     * @throws LoaderException
     */
    private static function getSections(int $iblockId): array
    {
        return Section::getList([
            'FILTER' => [
                'IBLOCK_ID' => $iblockId,
            ],
            'SELECT' => [
                'ID',
            ]
        ]);
    }
}
