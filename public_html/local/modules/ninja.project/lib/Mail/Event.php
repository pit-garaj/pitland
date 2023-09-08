<?php

declare(strict_types=1);

namespace Ninja\Project\Mail;


use Ninja\Helper\Arr;
use Ninja\Helper\Cache\CacheManager;
use Ninja\Helper\Cache\CacheSettings;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;
use Ninja\Project\Application;

class Event
{
    public static function updateTime(string &$event, string &$lid, array &$fields): void
    {
        if ($event === 'FORM_FILLING_CALLBACK_FOOTER') {
            $pos = strpos($fields['TIME'], '[');
            $str = substr($fields['TIME'], 0, $pos);
            $fields['TIME_CUSTOM'] = $str;
        }
    }
}
