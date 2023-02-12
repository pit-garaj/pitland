<?php

namespace Ninja\Helper;


use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use CCatalogMeasure;
use Exception;

class Catalog {
    public const QUANTITY_TRACE_INHERIT = 'D';

    public const QUANTITY_TRACE_ON = 'Y';

    public const QUANTITY_TRACE_OFF = 'N';

    public const CAN_BUY_ZERO_INHERIT = 'D';

    public const CAN_BUY_ZERO_ON = 'Y';

    public const CAN_BUY_ZERO_OFF = 'N';

    /**
     * @param array $params - Параметры выборки
     * @return array - Массив единицы измерений
     */
    public static function getMeasureList(array $params): ?array {
        try {
            Loader::includeModule('catalog');

            // Определение полей выборки
            $typeConverter = new TypeConvert($params['SELECT'] ?: []);
            $select = $typeConverter->getSelect();

            $resultRows = CCatalogMeasure::getList(
                $params['ORDER'] ?: [],
                $params['FILTER'] ?: [],
                $params['GROUP_BY'] ?: false,
                $params['NAV_START'] ?: false,
                $select
            );

            $result = [];
            while ($row = $resultRows->Fetch()) {
                $result[] = $row;
            }

            // Приведем массив к нужным типам данных
            if ($typeConverter->getTypes()) {
                $result = $typeConverter->convertDataTypes($result);
            }

            return $result;
        } catch (LoaderException $e) {
            return null;
        }
    }

    /**
     * Возвращает признак включенного количественного учета
     *
     * @return bool
     */
    public static function isQuantityTrace(): bool {
        try {
            return Option::get('catalog', 'default_quantity_trace', 'N') === 'Y';
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * Возвращает признак разрешения покупки при недостаточном количестве
     *
     * @return bool
     */
    public static function isCanBuyZero(): bool {
        try {
            return Option::get('catalog', 'default_can_buy_zero', 'Y') === 'Y';
        } catch (Exception $exception) {
            return false;
        }
    }

}
