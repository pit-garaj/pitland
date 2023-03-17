<?php

declare(strict_types=1);

namespace Ninja\Helper\User;

use Ninja\Helper\TypeConvert;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\Security\Password;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
use CUser;
use Exception;
use RangeException;

class User
{
    public const CAPTCHA_ERROR_CODE = 'captcha';

    /**
     * Возвращает список пользователей. Если выполняется сложная фильтрация выборка ID обязательна!
     *
     * @param array{
     *     FILTER: string[],
     *     SELECT: array{
     *          FIELDS: array,
     *          SELECT: array
     *     },
     *     NAV_PARAMS: array{
     *          nTopCount: int,
     *          nPageSize: int
     *      },
     *      ORDER: array
     * } $params
     * @param string|null $useResultDataKeysFieldName
     * @return array
     */
    public static function getList(array $params = [], string $useResultDataKeysFieldName = null): array
    {
        // Определение фильтра
        $filter = [];
        if (!empty($params['FILTER'])) {
            $filter = $params['FILTER'];

            if (is_array($filter['ID'])) {
                $filter['ID'] = implode(' | ', $filter['ID']);
            }
        }

        // Определение полей выборки
        $select = $params['SELECT'] ?? [];

        // Разбираем поля для выборки
        $selectToBd = [];
        foreach ($select as $key => $selectItem) {
            $selectToBd[$key] = (new TypeConvert($selectItem))->getSelect();
        }

        $by = $params['ORDER'] ?? 'timestamp_x';
        $order = 'desc';

        if (!empty($params['NAV'])) {
            $selectToBd['NAV_PARAMS'] = $params['NAV'];
        }

        $userList = CUser::GetList(
            $by,
            $order,
            $filter,
            $selectToBd
        );

        // Формирование результата
        $result = [];

        while ($user = $userList->Fetch()) {
            if ($useResultDataKeysFieldName) {
                $result[$user[$useResultDataKeysFieldName]] = $user;
            } else {
                $result[] = $user;
            }
        }

        // Приведем массив к нужным типам данных
        $selectAll = array_merge(
            $select['FIELDS'] ?? [],
            $select['SELECT'] ?? []
        );

        $typeConverter = new TypeConvert($selectAll);

        if ($typeConverter->getTypes()) {
            $result = $typeConverter->convertDataTypes($result);
        }

        return $result;
    }

    /**
     * Возвращает список пользователей, используя D7
     *
     * @param array $params
     * @param string|null $fieldToResultKey
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getListD7(array $params = [], string $fieldToResultKey = null): array
    {
        // Определение полей выборки
        $typeConverter = new TypeConvert($params['select'] ?? []);

        $select = $typeConverter->getSelect();

        // Готовим запрос
        $paramsQuery = array_merge($params, ['select' => $select]);

        $users = UserTable::getList($paramsQuery);

        // Формируем данные результата
        $result = [];

        while ($user = $users->Fetch()) {
            if ($fieldToResultKey === null) {
                $result[] = $user;
            } else {
                $result[$user[$fieldToResultKey]] = $user;
            }
        }

        if ($typeConverter->getTypes()) {
            $result = $typeConverter->convertDataTypes($result);
        }

        return $result;
    }

    /**
     * Возвращает идентификаторы групп пользователя
     *
     * @return array
     */
    public static function getCurrentUserGroups(): array
    {
        global $USER;

        return array_map('intval', $USER->GetUserGroupArray());
    }

    /**
     * Возвращает идентификатор аутентифицированного пользователя
     *
     * @return int|null
     */
    public static function getAuthenticatedId(): ?int
    {
        global $USER;

        $userId = (int)$USER->GetID();

        return $userId === 0 ? null : $userId;
    }

    public static function isAuthenticated(): bool
    {
        return self::getAuthenticatedId() !== null;
    }

    /**
     * Возвращает статус авторизации
     *
     * @return bool
     */
    public static function isAuthorized(): bool
    {
        global $USER;

        return $USER->IsAuthorized();
    }

    /**
     * Авторизует пользователя
     *
     * @param string $login
     * @param string $password
     * @param bool $remember сохраняем ли данные для аутентификации в куки
     * @param array{sid: string, value: string}|null $captcha
     * @return array
     */
    public static function authorizeByLogin(string $login, string $password, bool $remember = true, array $captcha = null): array
    {
        global $USER;

        // Данные капчи передаются в Битриксе в суперглобальном массиве $_REQUEST
        if ($captcha) {
            $_REQUEST['captcha_word'] = $captcha['value'];
            $_REQUEST['captcha_sid'] = $captcha['sid'];
        }

        $result = $USER->Login($login, $password, $remember ? 'Y' : 'N', 'Y');

        if ($result === true) {
            $out['success'] = true;
        } else {
            $out = [
                'success'   => false,
                'errorType' => $result['ERROR_TYPE'],
                'message'   => $result['MESSAGE'],
            ];
        }

        return $out;
    }

    public static function authorizeById(int $userId, bool $remember = true): bool
    {
        global $USER;

        return $USER->Authorize($userId, $remember);
    }

    /**
     * Проверяет необходима ли капча для авторизации пользователю
     *
     * @param string $login
     * @return bool
     */
    public static function isCaptchaAuthorization(string $login): bool
    {
        global $APPLICATION;

        return $APPLICATION->NeedCAPTHAForLogin($login) === true;
    }

    /**
     * Разлогинивает пользователя
     */
    public static function logout(): void
    {
        global $USER;

        $USER->Logout();
    }

    /**
     * Обновляет данные пользователя
     *
     * @param int $userId
     * @param array $update
     * @return void
     */
    public static function update(int $userId, array $update): void
    {
        $user = new CUser();

        $is = $user->Update($userId, $update);

        if (!$is) {
            throw new RangeException('Error update user: ' . $user->LAST_ERROR);
        }
    }

    /**
     * Проверяет уникальность e-mail
     *
     * @param string $email
     * @return int|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function findIdByEmail(string $email): ?int
    {
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
    }

    /**
     * Проверяет уникальность логина
     *
     * @param string $login
     * @return int|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function findIdByLogin(string $login): ?int
    {
        $user = UserTable::getRow([
            'filter' => [
                '=LOGIN' => $login,
            ],
            'select' => [
                'ID',
            ],
            'limit'  => 1,
        ]);

        return !empty($user['ID']) ? (int)$user['ID'] : null;
    }

    /**
     * Отправляет запрос восстановления пароля по логину пользователя
     *
     * @param string $login
     * @param array{value: string, sid: string}|null $captcha
     * @param string|null $siteId
     * @return array
     */
    public static function requestChangePasswordByLogin(string $login, array $captcha = null, string $siteId = SITE_ID): array
    {
        $params = [
            'login'  => $login,
            'siteId' => $siteId,
        ];

        if ($captcha !== null) {
            $params['captcha'] = $captcha;
        }

        return self::requestChangePassword($params);
    }

    /**
     * Отправляет запрос восстановления пароля по e-mail пользователя
     *
     * @param string|null $email
     * @param array{value: string, sid: string}|null $captcha
     * @param string|null $siteId
     * @return array
     */
    public static function requestChangePasswordByEmail(string $email, array $captcha = null, string $siteId = SITE_ID): array
    {
        $params = [
            'email'  => $email,
            'siteId' => $siteId,
        ];

        if ($captcha !== null) {
            $params['captcha'] = $captcha;
        }

        return self::requestChangePassword($params);
    }

    /**
     * Отправляет запрос восстановления пароля
     *
     * @param array{login: string, email: string, siteId: string: captcha: array{value: string, sid: string}} $params
     * @return array
     */
    private static function requestChangePassword(array $params = []): array
    {
        $login = $params['login'] ?? '';
        $email = $params['email'] ?? '';
        $captchaValue = $params['captcha']['value'] ?? '';
        $captchaSid = $params['captcha']['sid'] ?? '';
        $siteId = $params['siteId'] ?? SITE_ID;

        $status = CUser::SendPassword($login, $email, $siteId, $captchaValue, $captchaSid);

        $success = $status['TYPE'] === 'OK';
        $message = $status['MESSAGE'];
        $result = [
            'success' => $success,
            'message' => $message,
        ];

        if (!$success && strpos($message, Loc::getMessage('main_user_captcha_error')) !== false) {
            $result['typeError'] = self::CAPTCHA_ERROR_CODE;
        }

        return $result;
    }

    /**
     * Изменяет пароль пользователя
     *
     * @param string $login
     * @param string $checkword
     * @param string $password
     * @param array{value: string, sid: string} $captcha
     * @param string $siteId
     * @return array
     */
    public static function changePassword(string $login, string $checkword, string $password, array $captcha = null, string $siteId = SITE_ID): array
    {
        $captchaValue = $captcha['value'] ?? '';
        $captchaSid = $captcha['sid'] ?? '';

        $user = new CUser();

        $status = $user->ChangePassword($login, $checkword, $password, $password, $siteId, $captchaValue, $captchaSid);

        return [
            'success' => $status['TYPE'] === 'OK',
            'message' => $status['MESSAGE'],
        ];
    }

    /**
     * Проверяет необходимость использования капчи для восстановления пароля
     *
     * @return bool
     * @throws ArgumentNullException
     * @throws ArgumentOutOfRangeException
     */
    public static function isCaptchaChangePassword(): bool
    {
        return Option::get('main', 'captcha_restoring_password', 'N') === 'Y';
    }

    /**
     * Возвращает время жизни сессии
     *
     * @return int
     */
    public static function getSessionLifeTime(): int
    {
        global $USER;

        $arPolicy = $USER->GetSecurityPolicy();

        // Получаем время жизни сессии установленное в PHP
        $sessionTimeout = (int)ini_get('session.gc_maxlifetime');

        // Получаем время жизни сессии настроенное в админ. панели
        if ($arPolicy['SESSION_TIMEOUT'] > 0 && $arPolicy['SESSION_TIMEOUT'] < $sessionTimeout) {
            $sessionTimeout = $arPolicy['SESSION_TIMEOUT'] * 60;
        }

        return $sessionTimeout;
    }

    /**
     * Добавляет пользователя
     *
     * @param array $data
     * @return int
     */
    public static function add(array $data): int
    {
        $user = new  CUser();

        $id = (int)$user->Add($data);

        if (!$id) {
            throw new RangeException('Error added user: ' . $user->LAST_ERROR);
        }

        return $id;
    }

    public static function comparePasswordAndPasswordHash(string $password, string $hashFromBd): bool
    {
        return Password::equals($hashFromBd, $password, true);
    }

    public static function getUserGroups(int $userId): array
    {
        return array_map('intval', CUser::GetUserGroup($userId));
    }

    /**
     * @param int $id
     * @param string|mixed $lang
     * @return string
     */
    public static function getAdminEditPageUri(int $id, string $lang = LANGUAGE_ID): string
    {
        $params = [
            'ID'   => $id,
            'lang' => $lang,
        ];

        return '/bitrix/admin/user_edit.php?' . http_build_query($params);
    }
}
