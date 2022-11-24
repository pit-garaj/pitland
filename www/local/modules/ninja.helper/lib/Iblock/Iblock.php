<?php

namespace Ninja\Helper\Iblock;

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use CIBlock;
use CIBlockType;
use Ninja\Helper\Arr;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\CacheManager;
use Ninja\Helper\TypeConvert;
use RuntimeException;

class Iblock
{
    private const CACHE_DIR = '/IBLOCKS';

    /**
     * Функция возвращает массив с инфоблоками
     *
     * @param array $params Параметры выборки
     *
     * @return array
     * @throws LoaderException
     */
    public static function getList(array $params): array
    {
        self::checkModule();

        // Определение полей выборки
        $typeConverter = new TypeConvert($params['SELECT'] ?: ['ID:int>id']);

        // Определение направления сортировки
        $params['ORDER'] = $params['ORDER'] ?: [];

        // Определение фильтра
        $params['FILTER'] = $params['FILTER'] ?: [];

        // Возвращать ли количество элементов
        $params['CNT'] = (bool)$params['CNT'];

        // Выборка результата из базы
        $res = CIBlock::GetList($params['ORDER'], $params['FILTER'], $params['CNT']);

        // Выборка результата из базы
        $elements = [];
        while ($item = $res->Fetch()) {
            $key = $item['ID'];
            $elements[$key] = $item;
        }

        // Результирующий массив
        $result = [];

        // Приведем массив к нужным типам данных
        if ($typeConverter->getTypes()) {
            $result = $typeConverter->convertDataTypes($elements);
        }

        return $result;
    }

    /**
     * Функция возвращает массив с типаим инфоблоков
     *
     * @param array $params Параметры выборки
     *
     * @return array
     * @throws LoaderException
     */
    public static function getTypes(array $params = []): array
    {
        self::checkModule();

        // Определение полей выборки
        $typeConverter = new TypeConvert($params['SELECT'] ?: ['NAME:string>name']);

        // Определение направления сортировки
        $params['ORDER'] = $params['ORDER'] ?: ['SORT' => 'ASC'];

        // Определение фильтра
        $params['FILTER'] = $params['FILTER'] ?: [];

        // Выборка результата из базы
        $res = CIBlockType::GetList($params['ORDER'], $params['FILTER']);
        $elements = [];
        while ($item = $res->Fetch()) {
            if ($ibType = CIBlockType::GetByIDLang($item['ID'], LANG)) {
                $item['NAME'] = htmlspecialcharsEx($ibType['NAME']);
            }
            $elements[$item['ID']] = $item;
        }

        // Результирующий массив
        $result = [];

        // Приведем массив к нужным типам данных
        if ($typeConverter->getTypes()) {
            $result = $typeConverter->convertDataTypes($elements);
        }

        return $result;
    }

    /**
     * Метод возвращает символьный код инфоблока по его ID
     *
     * @param int $id
     * @return string|null
     */
    public static function getIblockCodeById(int $id): ?string
    {
        $code = Arr::findInArr(self::getListFromCache(), 'id', $id, 'code');
        return $code !== false ? $code : null;
    }

    /**
     * Метод возвращает ID инфоблока по коду
     *
     * @param string $code
     * @return int|null
     * @throws LoaderException
     */
    public static function getIblockIdByCode(string $code): ?int
    {
        $items = self::getIblockIdAndCode();

        $id = Arr::findInArr($items, 'code', $code, 'id');
        return $id !== false ? $id : null;
    }

    /**
     * Возвращает список идентификаторов и кодов инфоблоков
     *
     * @return array
     * @throws LoaderException
     */
    private static function getIblockIdAndCode(): array
    {
        self::checkModule();

        $params = [
            'FILTER' => [
                'ACTIVE' => 'Y',
                'CHECK_PERMISSIONS' => 'N',
            ],
            'SELECT' => ['ID:int>id', 'CODE:string>code'],
        ];

        return self::getList($params);
    }

    /**
     * Проверяет наличие модуля в системе
     * @throws LoaderException
     */
    public static function checkModule(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Для работы API необходимо наличие модуля «iblock»');
        }
    }
}
