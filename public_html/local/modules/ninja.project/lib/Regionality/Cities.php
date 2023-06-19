<?php

declare(strict_types=1);

namespace Ninja\Project\Regionality;


use Bitrix\Main\Context;
use Ninja\Helper\Dbg;

class Cities
{
    public static function getCityByHost(): array
    {
        $citiesData = CitiesGateway::getData();
        $cityCode = self::getCityCode() ?? $citiesData['default'];

        return $citiesData['codeToItemMap'][$cityCode];
    }

    public static function checkCity(): string
    {
        $citiesData = CitiesGateway::getData();
        $cityCode = self::getCityCode() ?? $citiesData['default'];
        $currentCity = $citiesData['codeToItemMap'][$cityCode];

        if ($currentCity === NULL) {
            return 'undefined';
        }

        if ($currentCity['default'] === true) {
            return 'default';
        }

        return 'city';

    }

    public static function isSubDomain(): bool
    {
        $getHost = self::getHost();
        $parts = $getHost ? explode('.', $getHost) : [];
        return count($parts) === 3;
    }

    public static function redirectPathToDefaultCity(): void
    {
        $city = self::getCityByHost();

        if (empty($city['default'])) {
            $requestUri = str_replace('index.php', '', $_SERVER['REQUEST_URI']);
            LocalRedirect('https://'. SITE_SERVER_NAME . $requestUri, false, '301 Moved permanently');
        }
    }

    private static function getCityCode(): ?string
    {
        $getHost = self::getHost();
        $parts = $getHost ? explode('.', $getHost) : [];
        return self::isSubDomain() ? $parts[0] : null;
    }

    private static function getHost(): ?string
    {
        return Context::getCurrent()->getServer()->getHttpHost();
    }
}
