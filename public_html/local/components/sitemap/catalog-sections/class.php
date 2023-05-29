<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class CatalogSections extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult['city'] = \Ninja\Project\Regionality\Cities::getCityByHost();
        $this->arResult['list'] = $this->getList();
        $this->includeComponentTemplate();
    }

    private function getList(): array
    {
        $resultSections = [];
        $resultSectionsForSiteMap = [];

        $sections = \Ninja\Project\Catalog\CatalogSections::getList();

        foreach ($sections['list'] as $item) {
            $resultSections[] = $this->arResult['city']['domain'] . $item['url'];
            if (!empty($item['cnt'])) {
                $resultSectionsForSiteMap[] = $this->arResult['city']['domain'] . '/sitemap/catalog/' . $item['code'] . '/elements.xml';
            }
        }

        return array_merge($resultSections, $resultSectionsForSiteMap);
    }
}
