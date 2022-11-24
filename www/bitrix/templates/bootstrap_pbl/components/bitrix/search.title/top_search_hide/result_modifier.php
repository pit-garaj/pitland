<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$PREVIEW_WIDTH = intval($arParams["PREVIEW_WIDTH"]);
if ($PREVIEW_WIDTH <= 0)
	$PREVIEW_WIDTH = 75;

$PREVIEW_HEIGHT = intval($arParams["PREVIEW_HEIGHT"]);
if ($PREVIEW_HEIGHT <= 0)
	$PREVIEW_HEIGHT = 75;

$arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";

$arCatalogs = false;

$arResult["ELEMENTS"] = array();
$arResult["SEARCH"] = array();
foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
{
	foreach($arCategory["ITEMS"] as $i => $arItem)
	{
		if(isset($arItem["ITEM_ID"]))
		{
			$arResult["SEARCH"][] = &$arResult["CATEGORIES"][$category_id]["ITEMS"][$i];
			if (
				$arItem["MODULE_ID"] == "iblock"
				&& substr($arItem["ITEM_ID"], 0, 1) !== "S"
			)
			{
				if ($arCatalogs === false)
				{
					$arCatalogs = array();
					if (CModule::IncludeModule("catalog"))
					{
						$rsCatalog = CCatalog::GetList(array(
							"sort" => "asc",
						));
						while ($ar = $rsCatalog->Fetch())
						{
							if ($ar["PRODUCT_IBLOCK_ID"])
								$arCatalogs[$ar["PRODUCT_IBLOCK_ID"]] = 1;
							else
								$arCatalogs[$ar["IBLOCK_ID"]] = 1;
						}
					}
				}

				if (array_key_exists($arItem["PARAM2"], $arCatalogs))
				{
					$arResult["ELEMENTS"][$arItem["ITEM_ID"]] = $arItem["ITEM_ID"];
				}
			}
		}
	}
}

if (!empty($arResult["ELEMENTS"]) && CModule::IncludeModule("catalog"))
{
	$arConvertParams = array();
	if ('Y' == $arParams['CONVERT_CURRENCY'])
	{
		if (!CModule::IncludeModule('currency'))
		{
			$arParams['CONVERT_CURRENCY'] = 'N';
			$arParams['CURRENCY_ID'] = '';
		}
		else
		{
			$arCurrencyInfo = CCurrency::GetByID($arParams['CURRENCY_ID']);
			if (!(is_array($arCurrencyInfo) && !empty($arCurrencyInfo)))
			{
				$arParams['CONVERT_CURRENCY'] = 'N';
				$arParams['CURRENCY_ID'] = '';
			}
			else
			{
				$arParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
				$arConvertParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
			}
		}
	}

	$obParser = new CTextParser;

	if (is_array($arParams["PRICE_CODE"]))
		$arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices(0, $arParams["PRICE_CODE"]);
	else
		$arResult["PRICES"] = array();


	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"PREVIEW_TEXT",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
	);
	$arFilter = array(
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"MIN_PERMISSION" => "R",
	);
	foreach($arResult["PRICES"] as $value)
	{
		$arSelect[] = $value["SELECT"];
		$arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = 1;
	}
	$arFilter["=ID"] = $arResult["ELEMENTS"];
	$arResult["ELEMENTS"] = array();
	$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while($arElement = $rsElements->Fetch())
	{

		//$arElement["PRICES"] = CIBlockPriceTools::GetItemPrices(3, $arResult["PRICES"], $arElement, $arParams['PRICE_VAT_INCLUDE'], $arConvertParams);
		//$arElement["PRICES"] = CPrice::GetByID($arElement['ID']);
		$arElement["PRICES"] = getFinalPriceInCurrency($arElement['ID']);
		if($arParams["PREVIEW_TRUNCATE_LEN"] > 0)
			$arElement["PREVIEW_TEXT"] = $obParser->html_cut($arElement["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);

		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
		//echo '<pre>';print_r($arElement["PRICES"]);echo '</pre>';
	}
}

foreach($arResult["SEARCH"] as $i=>$arItem)
{
	switch($arItem["MODULE_ID"])
	{
		case "iblock":
			if(array_key_exists($arItem["ITEM_ID"], $arResult["ELEMENTS"]))
			{
				$arElement = &$arResult["ELEMENTS"][$arItem["ITEM_ID"]];

				if ($arParams["SHOW_PREVIEW"] == "Y")
				{
					if ($arElement["PREVIEW_PICTURE"] > 0)
						$arElement["PICTURE"] = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array("width"=>$PREVIEW_WIDTH, "height"=>$PREVIEW_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					elseif ($arElement["DETAIL_PICTURE"] > 0)
						$arElement["PICTURE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width"=>$PREVIEW_WIDTH, "height"=>$PREVIEW_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				}
			}
			break;
	}

	$arResult["SEARCH"][$i]["ICON"] = true;
}


/***Как посчитать стоимость товара или предложения со всеми скидками***/
function getFinalPriceInCurrency($item_id, $sale_currency = 'RUB') {
CModule::IncludeModule("iblock"); 
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");   
    global $USER;
 
    $currency_code = 'RUB';
 
    // Проверяем, имеет ли товар торговые предложения?
    if(CCatalogSku::IsExistOffers($item_id)) {
 
        // Пытаемся найти цену среди торговых предложений
        $res = CIBlockElement::GetByID($item_id);
 
        if($ar_res = $res->GetNext()) {
 
            if(isset($ar_res['IBLOCK_ID']) && $ar_res['IBLOCK_ID']) {
 
                // Ищем все тогровые предложения
                $offers = CIBlockPriceTools::GetOffersArray(array(
                    'IBLOCK_ID' => $ar_res['IBLOCK_ID'],
                    'HIDE_NOT_AVAILABLE' => 'Y',
                    'CHECK_PERMISSIONS' => 'Y'
                ), array($item_id), null, null, null, null, null, null, array('CURRENCY_ID' => $sale_currency), $USER->getId(), null);
				$temp_final_price = array();
                foreach($offers as $offer) {
                    $price = CCatalogProduct::GetOptimalPrice($offer['ID'], 1, $USER->GetUserGroupArray(), 'N');
					//echo '<pre>';print_r($price);'</pre>';
					if(isset($price['PRICE'])) {
 
                        $temp_final_price[] = $price['PRICE']['PRICE'];
                        $currency_code = $price['PRICE']['CURRENCY'];
 
                        // Ищем скидки и высчитываем стоимость с учетом найденных
                        $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N");
                        if(is_array($arDiscounts) && sizeof($arDiscounts) > 0) {
                            $temp_final_price[] = CCatalogProduct::CountPriceWithDiscount($price['PRICE']['PRICE'], $currency_code, $arDiscounts);
                        }
                    }
				//echo '<pre>';print_r($temp_final_price);'</pre>';
				$final_price = min($temp_final_price);
				// Конец цикла, используем найденные значения
					//break;
                }
            }
        }

    } else {
 
        // Простой товар, без торговых предложений (для количества равному 1)
        $price = CCatalogProduct::GetOptimalPrice($item_id, 1, $USER->GetUserGroupArray(), 'N');
 
        // Получили цену?
        if(!$price || !isset($price['PRICE'])) {
            return false;
        }
 
        // Меняем код валюты, если нашли
        if(isset($price['CURRENCY'])) {
            $currency_code = $price['CURRENCY'];
        }
        if(isset($price['PRICE']['CURRENCY'])) {
            $currency_code = $price['PRICE']['CURRENCY'];
        }
 
        // Получаем итоговую цену
        $final_price = $price['PRICE']['PRICE'];
 
        // Ищем скидки и пересчитываем цену товара с их учетом
        $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N", 2);
        if(is_array($arDiscounts) && sizeof($arDiscounts) > 0) {
            $final_price = CCatalogProduct::CountPriceWithDiscount($final_price, $currency_code, $arDiscounts);
        }
 
    }
 
    // Если необходимо, конвертируем в нужную валюту
    if($currency_code != $sale_currency) {
        $final_price = CCurrencyRates::ConvertCurrency($final_price, $currency_code, $sale_currency);
    }
 
    return $final_price;
 
}
?>