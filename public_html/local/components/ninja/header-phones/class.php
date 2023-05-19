<?php

use Ninja\Helper\Phone;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class HeaderPhones extends CBitrixComponent
{

    public function executeComponent()
    {
        $phones = $this->arParams['PHONES'];
        if (!empty($phones)) {

            $mainPhone = Phone::modifyTextToLink($phones[0]);
            $mainPhone['CLASS'] = $this->getPhoneClass($this->arParams['PHONES_TYPES'][0] ?? '');

            $this->arResult['MAIN'] = $mainPhone;
            $countPhones = count($phones);
            if ($countPhones > 1) {
                for ($i = 1; $i < $countPhones; $i++) {
                    $phone = Phone::modifyTextToLink($phones[$i]);
                    $phone['CLASS'] = $this->getPhoneClass($this->arParams['PHONES_TYPES'][$i] ?? '');
                    $this->arResult['ADDITIONAL'][] = $phone;
                }
            }

            $this->arResult['REGIONAL'] = Phone::modifyTextToLink('8 (800) 600 57 90');
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
