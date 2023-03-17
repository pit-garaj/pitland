<?php

use Bitrix\Main\LoaderException;
use Ninja\Helper\Iblock\Element;
use Ninja\Helper\Iblock\Iblock;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class HeaderBanner extends CBitrixComponent
{
    private const AUTOPLAY = 5000;

    /**
     * @throws LoaderException
     */
    public function executeComponent()
    {
        $banners = $this->getBanners();

        if (!empty($banners['main'])) {
            $this->arResult['BANNERS']['MAIN'] = $banners['main'];
        }

        if (!empty($banners['additional'])) {
            $this->arResult['BANNERS']['ADDITIONAL'] = $banners['additional'];
        }

        $this->arResult['COMPONENT_PATH']  = $this->GetPath();

        $this->includeComponentTemplate();
    }


    /**
     * @throws LoaderException
     */
    private function getBanners(): array
    {
        $params = [
            'SELECT' => [
                'ID:int>id',
                'CODE:string>code',
                'NAME:Typograph>name',
                'DETAIL_PICTURE:Image>picture',
                'PROPERTY_TYPE_BANNERS.CODE:string>type',
                'PROPERTY_URL_STRING:string>link',
                'PROPERTY_TARGETS:EnumCode>target',
                'PROPERTY_AUTOPLAY:float>autoplay',
            ],
            'FILTER' => [
                'IBLOCK_CODE' => 'aspro_next_banners',
                'ACTIVE'    => 'Y',
            ],
            'ORDER'  => [
                'SORT' => 'ASC',
                'ID'   => 'DESC',
            ],
            'GET_ENUM_CODE' => 'Y',
        ];

        $result = [];
        foreach (Element::getListFromCache($params) as $banner) {
            $type = $banner['type'];

            $banner['autoplay'] = !empty($banner['autoplay']) ? $banner['autoplay'] * 1000 : self::AUTOPLAY;

            if (empty($banner['target'])) {
                $banner['target'] = '_self';
            }

            $result[$type][] = $banner;
        }

        return $result;
    }
}
