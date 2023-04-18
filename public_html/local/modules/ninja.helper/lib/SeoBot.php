<?php

namespace Ninja\Helper;


class SeoBot
{
    private const PATTERN = 'Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl';

    public static function check(): bool {
        return preg_match('|(' . self::PATTERN . ')|i', $_SERVER['HTTP_USER_AGENT']);
    }
}
