<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

foreach($arResult["ITEMS"] as $key => $arItem)
{
	if($arItem["CODE"]=="IN_STOCK"){
		sort($arResult["ITEMS"][$key]["VALUES"]);
		if($arResult["ITEMS"][$key]["VALUES"])
			$arResult["ITEMS"][$key]["VALUES"][0]["VALUE"]=$arItem["NAME"];
	}

	if ($arItem['CODE']=='BRAND'){
        foreach($arItem["VALUES"] as $val => $ar){
            $resBrend = CIBlockElement::GetByID($ar["FACET_VALUE"]);
            if($ar_resBrend = $resBrend->GetNext())
                $arResult["ITEMS"][$key]["VALUES"][$val]["IMG"] = CFile::GetPath($ar_resBrend['PREVIEW_PICTURE']);;
        }
    }
}