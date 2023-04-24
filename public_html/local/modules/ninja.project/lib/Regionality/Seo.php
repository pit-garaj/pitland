<?php

declare(strict_types=1);

namespace Ninja\Project\Regionality;

use Ninja\Helper\Dbg;

class Seo
{
    public static function updateSeoData(array $seoData): void
    {
        global $APPLICATION;

        if (isset($seoData['caption'])) {
            $APPLICATION->SetTitle($seoData['caption']);
        }

        if (isset($seoData['title'])) {
            $APPLICATION->SetPageProperty('title', $seoData['title']);
        }

        if (isset($seoData['description'])) {
            $APPLICATION->SetPageProperty('description', $seoData['description']);
        }

        if (isset($seoData['keywords'])) {
            $APPLICATION->SetPageProperty('keywords', $seoData['keywords']);
        }
    }


    public static function modifySeoData(array $seoData): array
    {
        $result = [];

        $currentCity = Cities::getCityByHost();

        foreach ($seoData as $key => $value) {
            $result[$key] = self::modifySeoText($value ?? '', $currentCity);
        }

        return $result;
    }

    public static function modifySeoText(string $text, array $currentCity): string
    {
        preg_match_all("|{(.*)}|U", $text, $blocks);

        foreach($blocks[1] as $block) {
            switch($block) {
                case 'city.name':
                    $text = str_replace("{" . $block . "}", $currentCity['name'], $text);
                    break;
                case 'city.nameRp':
                    $text = str_replace("{" . $block . "}", $currentCity['nameRp'], $text);
                    break;
                case 'city.namePp':
                    $text = str_replace("{" . $block . "}", $currentCity['namePp'], $text);
                    break;
                case 'city.nameTp':
                    $text = str_replace("{" . $block . "}", $currentCity['nameTp'], $text);
                    break;
                case 'city.nameDp':
                    $text = str_replace("{" . $block . "}", $currentCity['nameDp'], $text);
                    break;
            }
        }

        $text = preg_replace('|{.*}|', '', $text);
        return trim($text);
    }
}
