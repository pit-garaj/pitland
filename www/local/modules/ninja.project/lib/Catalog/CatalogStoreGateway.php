<?php

declare(strict_types=1);

namespace Ninja\Project\Catalog;

use CCatalogStore;
use Ninja\Helper\Arr;

class CatalogStoreGateway
{
    public static function fetchAll(?array $productIds = null): array
    {
        $result = [];

        $filter = ['ACTIVE' => 'Y'];
        $select = ['ID', 'CODE', 'TITLE', 'XML_ID'];

        if ($productIds !== null) {
            $filter['PRODUCT_ID'] = $productIds;
            $select[] = 'PRODUCT_AMOUNT';
        }

        $res = CCatalogStore::GetList([], $filter, false, false, $select);
        while ($item = $res->Fetch()) {
            $id = $item['ID'];
            $result[$id] = $item;
        }

        return $result;
    }

    public static function getIdByCode(string $code): ?int
    {
        return Arr::findInArr(self::fetchAll(), 'CODE', $code, 'ID');
    }
}
