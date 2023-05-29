<?php

namespace Ninja\Helper;

class Phone
{
    public static function modifyTextToLink(string $phone): array
    {
        $phone = str_replace(array("- ", " -"), "-", $phone);
        $updatePhone = str_replace(array("-", " ", "(", ")"), "", $phone);
        //
        return array(
            'LINK' => trim($updatePhone),
            'TEXT' => trim($phone),
        );
    }
}
