<?php

use Ninja\Helper\Phone;
use Ninja\Project\Regionality\Cities;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class HeaderPhones extends CBitrixComponent
{

    public function executeComponent()
    {
        $city = Cities::getCityByHost();
        if (!empty($city['phone'])) {

            $mainPhone = Phone::modifyTextToLink($city['phone'][0]);
            $mainPhone['CLASS'] = $this->getPhoneClass($city['phoneType'][0] ?? '');

            $this->arResult['PHONE']['MAIN'] = $mainPhone;
            $countPhones = count($city['phone']);
            if ($countPhones > 1) {
                for ($i = 1; $i < $countPhones; $i++) {
                    $phone = Phone::modifyTextToLink($city['phone'][$i]);
                    $phone['CLASS'] = $this->getPhoneClass($city['phoneType'][$i] ?? '');
                    $this->arResult['PHONE']['ADDITIONAL'][] = $phone;
                }
            }

            $this->arResult['PHONE']['REGIONAL'] = Phone::modifyTextToLink('8 (800) 600 57 90');

            if (!empty($city['email'][0])) {
                $this->arResult['EMAIL'] = $city['email'][0];
            }
        }

        $this->includeComponentTemplate();
    }

    private function getPhoneClass(string $type): string {
        if ($type === 'whatsapp') {
            return 'fa-whatsapp';
        }

        return 'fa-phone';
    }

}
