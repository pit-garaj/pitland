<?php

namespace Ninja\Helper;


use Bitrix\Main\UserTable;
use CUser;
use Exception;

class User {
    public static function getList($arParams): array {

        // Определение фильтра
        if ($arParams['FILTER']) {
            $arFilter = $arParams['FILTER'];

        } else {
            $arFilter = [];

        }
        // ---------------------------------------------------------------------


        // Определение полей выборки
        if ($arParams['SELECT']) {
            $arSelect = $arParams['SELECT'];

        } else {
            $arSelect = [];

        }
        $arSelect['FIELDS'][] = 'ID'; // Выбрать ID обязательно
        // ---------------------------------------------------------------------


        // Выборка результата из базы
        $resUserList = CUser::GetList(
            ($by = 'id'), ($order = 'asc'),
            $arFilter,
            $arSelect
        );
        // ---------------------------------------------------------------------


        // Формирование результата
        $arResult = [];
        while ($arUser = $resUserList->Fetch()) {
            $arResult[$arUser['ID']] = $arUser;
        }

        // ---------------------------------------------------------------------


        return $arResult;
    }


    /**
     * Возвращает идентификатор авторизованного пользователя
     *
     * @return int|null
     */
    public static function getAuthorizedId(): ?int {
        global $USER;

        $userId = (int)$USER->GetID();

        return $userId === 0 ? null : $userId;
    }


    /**
     * Возвращает идентификатор пользователя по e-mail
     *
     * @param string $email
     * @return int|null
     */
    public static function getIdByEmail(string $email): ?int {
        try {
            $user = UserTable::getRow([
                'filter' => [
                    '=EMAIL' => $email,
                ],
                'select' => [
                    'ID',
                ],
                'limit'  => 1,
            ]);

            return !empty($user['ID']) ? (int)$user['ID'] : null;

        } catch (Exception $exception) {
            return null;
        }
    }

}
