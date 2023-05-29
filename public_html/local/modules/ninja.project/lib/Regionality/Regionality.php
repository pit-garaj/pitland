<?php

declare(strict_types=1);

namespace Ninja\Project\Regionality;


use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
use CNextRegionality;
use Ninja\Helper\Arr;
use Ninja\Helper\Ip;
use Ninja\Project\Services\Dadata\Dadata;

class Regionality
{
    public const DEFAULT_CITY_CODE = 'msk';
    public const COOKIE_CITY_CODE = 'CITY';
    public const COOKIE_CITY_CONFIRMED_CODE = 'CITY_CONFIRMED';

    public static function getRegions(): array
    {
        return CNextRegionality::getRegions() ?? [];
    }


    public static function getCityNameByIp()
    {
        $cityName = self::getCityNameFromCookie(self::COOKIE_CITY_CODE);

        if (!$cityName) {
            $ip = Ip::get();
            $getLocaleByIp = (new Dadata())->getLocaleByIp($ip);
            $cityName = $getLocaleByIp['city'] ?? self::getDefaultCityName();
            self::setCityNameToCookie($cityName);
        }

        return $cityName;
    }

    private static function getDefaultCityName(): string
    {
        $regions = self::getRegions();
        $defaultKey = Arr::findInArr($regions, 'CODE', self::DEFAULT_CITY_CODE, 'ID');

        return $regions[$defaultKey]['NAME'] ?? '';
    }


    public static function getCityNameFromCookie(string $cookieName): ?string
    {
        return Application::getInstance()->getContext()->getRequest()->getCookie($cookieName);
    }


    private static function setCityNameToCookie(string $cityName): void
    {
        $application = Application::getInstance();
        $context = $application->getContext();

        $cookie = new Cookie(self::COOKIE_CITY_CODE, $cityName, time() + 60 * 60 * 24 * 60);
        $cookie->setDomain($context->getServer()->getHttpHost());
        $cookie->setHttpOnly(false);

        $context->getResponse()->addCookie($cookie);
        $context->getResponse()->flush('');
    }

}
