<?php

use Ninja\Project\Regionality\Cities;
use Ninja\Project\Regionality\ShopsGateway;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContactsDetail extends CBitrixComponent
{
    public function executeComponent(): void
    {
        $this->loadData();
    }

    protected function loadData(): void
    {
        $this->getResultData();
        $this->includeComponentTemplate();
    }

    private function getResultData(): void
    {
        $city = Cities::getCityByHost();
        $shops = ShopsGateway::getData()['cityToItemList'][$city['code']] ?? [];

        $this->arResult['city'] = $city;
        $this->arResult['shops'] = $shops;
        $this->arResult['shopsMap'] = $this->getShopsMap($shops);
    }

    private function getShopsMap(array $shops): array
    {
        $result = [];

        foreach ($shops as $shop) {
            if ($shop['map']) {
                $result[] = [
                    'id' => $shop['id'],
                    'point' => implode(', ', $shop['map']),
                    'hint' => $this->getHint($shop),
                ];
            }
        }

        return $result;
    }

    private function getHint(array $shop): string
    {
        $result = [];

        if (!empty($shop['address'])) {
            $result[] = '<b>Адрес салона:</b><br />' . $shop['address'];
        }

        if (!empty($shop['email'])) {
            $result[] = '<b>E-mail:</b><br />' . $shop['email'];
        }

        if (!empty($shop['phone'])) {
            $result[] = '<b>Телефоны:</b><br />' . implode('<br />', $shop['phone']);
        }

        if (!empty($shop['work'])) {
            $result[] = '<b>Время работы:</b><br />' . implode('<br />', $shop['work']);
        }

        return implode('<br />', $result);
    }
}
