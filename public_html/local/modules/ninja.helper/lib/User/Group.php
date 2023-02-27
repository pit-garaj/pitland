<?php

declare(strict_types=1);

namespace Ninja\Helper\User;

use Ninja\Helper\TypeConvert;
use CGroup;

class Group
{

    /**
     * Возвращает список групп
     *
     * @param array{
     *     ORDER_FIELD:string,
     *     ORDER_DIRECTION:string,
     *     FILTER:array,
     *     SELECT:array}|null $params
     * @return array
     */
    public static function getList(array $params = null): array
    {
        $orderField     = $params['ORDER_FIELD'] ?? 'c_sort';
        $orderDirection = $params['ORDER_DIRECTION'] ?? 'asc';

        $resultObject = CGroup::GetList(
            $orderField,
            $orderDirection,
            $params['FILTER'] ?? []
        );

        $result = [];

        while ($item = $resultObject->Fetch()) {
            $result[] = $item;
        }

        // Приведем массив к нужным типам данных
        $typeConverter = new TypeConvert($params['SELECT'] ?? []);
        if ($typeConverter->getTypes()) {
            $result = $typeConverter->convertDataTypes($result);
        }

        return $result;
    }
}
