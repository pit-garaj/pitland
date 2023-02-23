<?php

declare(strict_types=1);

namespace Ninja\Project\Shop;

use Bitrix\Main\SystemException;
use Bitrix\Sale\CompanyTable;

class CompanyGateway
{
    /**
     * @throws SystemException
     */
    public static function fetch(): array
    {
        $params = [
            'select' => ['ID', 'NAME', 'CODE', 'ADDRESS'],
        ];
        $res = CompanyTable::getList($params);

        $result = [];
        while ($item = $res->fetch())
        {
            $result[] = $item;
        }

        return $result;
    }
}
