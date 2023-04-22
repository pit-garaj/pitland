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

    private static function getCityCode(): ?string
    {
        $parts = explode('.', self::getHost());
        return (count($parts) === 3) ? $parts[0] : null;
    }

    private static function getHost(): string
    {
        return Context::getCurrent()->getServer()->getHttpHost();
    }
}
