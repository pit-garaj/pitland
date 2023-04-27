<?php

namespace Ninja\Helper;


class Price
{
    /**
     * Приводим стоимость к нужному формату.
     *
     * @param $price - Цена
     * @param $suffix - Суфикс
     *
     * @return string
     */
    public static function format($price, string $suffix=''): string
    {
        return number_format($price, 0, ',', ' ') . $suffix;
    }
}
