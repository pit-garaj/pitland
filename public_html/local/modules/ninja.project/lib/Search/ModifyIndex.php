<?php

declare(strict_types=1);

namespace Ninja\Project\Search;

use Bitrix\Iblock\InheritedProperty\ElementValues;
use Bitrix\Main\LoaderException;
use CIBlockElement;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Project\Catalog\CatalogGateway;

class ModifyIndex
{
    /**
     * @throws LoaderException
     */
    public static function run(array $fields): array
    {
        if (empty($fields['ITEM_ID'])) {
            return $fields;
        }

        $iblockId = Iblock::getIblockIdByCode(CatalogGateway::IBLOCK_CODE);

        if ($iblockId === (int)$fields['PARAM2']) {
            $article = self::getArticle($iblockId, $fields['ITEM_ID']);
            if (!empty($article)) {
                $fields['TITLE'] .= ' ' . $article;
            }

            $keywords = self::getKeywords($iblockId, $fields['ITEM_ID']);
            if (!empty($keywords)) {
                $fields['TITLE'] .= ' ' . $keywords;
            }
        }

        return $fields;
    }

    private static function getArticle(int $iblockId, $itemId): string
    {
        $article = '';

        $res = CIBlockElement::GetProperty($iblockId, $itemId, [], ['CODE' => 'CML2_ARTICLE']);
        if ($item = $res->Fetch()) {
            $article = $item['VALUE'] ? trim($item['VALUE']) : '';
        }

        return $article;
    }

    private static function getKeywords(int $iblockId, $itemId): string
    {
        $props  = new ElementValues($iblockId, $itemId);
        $values = $props->getValues();

        return $values['ELEMENT_META_KEYWORDS'] ?: $values['SECTION_META_KEYWORDS'] ?: '';
    }

}
