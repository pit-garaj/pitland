<?php

declare(strict_types=1);

use Ninja\Project\Landing\LandingGateway;
use Ninja\Project\Regionality\Cities;
use Ninja\Project\Regionality\Seo;
use Ninja\Project\Regionality\ShopsGateway;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class Landing extends CBitrixComponent
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
        global $APPLICATION;

        $city = Cities::getCityByHost();
        $currentPage = $APPLICATION->GetCurPage(false);

        $landings = array_filter(LandingGateway::getList(), static function($item) use ($currentPage, $city) {
            return $item['filterUrl'] === $currentPage && (in_array($city['id'], $item['regions'] ?? [], true) || empty($item['regions']));
        });

        if (!empty($landings)) {
            $landing = array_values($landings)[0];

            if (!empty($landing['detailText'])) {
                $landing['detailText'] = Seo::modifySeoText($landing['detailText'], $city);
            }

            if (!empty($landing['seo'])) {
                foreach ($landing['seo'] as $seoKey => $seoValue) {
                    if (!empty($seoValue)) {
                        $landing['seo'][$seoKey] = Seo::modifySeoText($seoValue, $city);
                    }
                }
            }
        }
        else {
            $landing = [];
        }

        if (!empty($landing['seo'])) {
            Seo::updateSeoData($landing['seo']);
        }

        $this->arResult = $landing;
    }
}
