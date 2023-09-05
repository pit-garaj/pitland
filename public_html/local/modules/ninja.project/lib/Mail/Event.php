<?php

declare(strict_types=1);

namespace Ninja\Project\Mail;


class Event
{
    /**
     * При отправке почтового события модифицирует время
     * Было: 07:30[112] - стало 07:30
     *
     * @param string $event
     * @param string $lid
     * @param array $fields
     * @return void
     */
    public static function updateTime(string &$event, string &$lid, array &$fields): void
    {
        if ($event === 'FORM_FILLING_CALLBACK_FOOTER'){
            $pos = strpos($fields["TIME"], '[');
            $str = substr($fields["TIME"], 0, $pos);
            $fields["TIME_CUSTOM"] = $str;
        }
    }
}
