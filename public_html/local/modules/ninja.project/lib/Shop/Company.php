<?php

declare(strict_types=1);

namespace Ninja\Project\Shop;

use Bitrix\Main\SystemException;
use Ninja\Helper\Arr;

class Company
{
    /**
     * @throws SystemException
     */
    public static function getIdByCode(string $code): ?int
    {
        return Arr::findInArr(CompanyGateway::fetch(), 'CODE', $code, 'ID');
    }
}
