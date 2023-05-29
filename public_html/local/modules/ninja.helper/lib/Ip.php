<?php

namespace Ninja\Helper;


use Bitrix\Main\Application;

class Ip
{
    public static function get(): ?string
    {
        $ips    = [];
        $server = Application::getInstance()->getContext()->getServer();

        if ($server->get('HTTP_X_FORWARDED_FOR')) {
            $ips[] = trim(strtok($server->get('HTTP_X_FORWARDED_FOR'), ','));
        }

        if ($server->get('HTTP_CLIENT_IP')) {
            $ips[] = $server->get('HTTP_CLIENT_IP');
        }

        if ($server->get('REMOTE_ADDR')) {
            $ips[] = $server->get('REMOTE_ADDR');
        }

        if ($server->get('HTTP_X_REAL_IP')) {
            $ips[] = $server->get('HTTP_X_REAL_IP');
        }

        foreach ($ips as $ip) {
            if (self::isValid($ip)) {
                return $ip;
            }
        }

        return null;
    }

    public static function isValid(string $ip): bool
    {
        return self::isV4($ip) || self::isV6($ip);
    }

    public static function isV4(string $ip): bool
    {
        return (bool)preg_match("#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#", $ip);
    }

    public static function isV6(string $ip): bool
    {
        return (bool)preg_match("#((^|:)([0-9a-fA-F]{0,4})){1,8}$#", $ip);
    }
}
