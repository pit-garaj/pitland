<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */
/** @var array $arParams */
/** @var array $arDiscount */
/** @var object $USER */
/** @var object $APPLICATION */

?>


<?
$this->setFrameMode(true);
$currencyList = '';
if (!empty($arResult['CURRENCIES'])){
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'STORES' => array(
        "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
        "SCHEDULE" => $arParams["SCHEDULE"],
        "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
        "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
        "ELEMENT_ID" => $arResult["ID"],
        "STORE_PATH"  =>  $arParams["STORE_PATH"],
        "MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
        "MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
        "USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
        "SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
        "SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
        "USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
        "USER_FIELDS" => $arParams['USER_FIELDS'],
        "FIELDS" => $arParams['FIELDS'],
        "STORES_FILTER_ORDER" => $arParams['STORES_FILTER_ORDER'],
        "STORES_FILTER" => $arParams['STORES_FILTER'],
        "STORES" => $arParams['STORES'] = array_diff($arParams['STORES'], array('')),
    )
);
unset($currencyList, $templateLibrary);


$arSkuTemplate = array();
if (!empty($arResult['SKU_PROPS'])){
    $arSkuTemplate = CNext::GetSKUPropsArray($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], "list", $arParams["OFFER_HIDE_NAME_PROPS"]);
}
$strMainID = $this->GetEditAreaId($arResult['ID']);

$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

$arResult["strMainID"] = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = CNext::GetItemsIDs($arResult, "Y");
$totalCount = CNext::GetTotalCount($arResult, $arParams);

$arQuantityData = CNext::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"], "Y");

$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());
$useStores = $arParams["USE_STORE"] == "Y" && $arResult["STORES_COUNT"] && $arQuantityData["RIGHTS"]["SHOW_QUANTITY"];
$showCustomOffer=(($arResult['OFFERS'] && $arParams["TYPE_SKU"] !="N") ? true : false);
if($showCustomOffer){
    $templateData['JS_OBJ'] = $strObName;
}
$strMeasure='';
$arAddToBasketData = array();
if($arResult["OFFERS"]){
    $strMeasure=$arResult["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
    $templateData["STORES"]["OFFERS"]="Y";
    foreach($arResult["OFFERS"] as $arOffer){
        $templateData["STORES"]["OFFERS_ID"][]=$arOffer["ID"];
    }
	$arAddToBasketData = CNext::GetAddToBasketArray($arResult, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'btn-lg w_icons', $arParams);
}else{
    if (($arParams["SHOW_MEASURE"]=="Y")&&($arResult["CATALOG_MEASURE"])){
        $arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arResult["CATALOG_MEASURE"]), false, false, array())->GetNext();
        $strMeasure=$arMeasure["SYMBOL_RUS"];
    }
    $arAddToBasketData = CNext::GetAddToBasketArray($arResult, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'btn-lg w_icons', $arParams);
}
$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

// save item viewed
$arFirstPhoto = reset($arResult['MORE_PHOTO']);
$arItemPrices = $arResult['MIN_PRICE'];
if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX'])
{
    $rangSelected = $arResult['ITEM_QUANTITY_RANGE_SELECTED'];
    $priceSelected = $arResult['ITEM_PRICE_SELECTED'];
    if(isset($arResult['FIX_PRICE_MATRIX']) && $arResult['FIX_PRICE_MATRIX'])
    {
        $rangSelected = $arResult['FIX_PRICE_MATRIX']['RANGE_SELECT'];
        $priceSelected = $arResult['FIX_PRICE_MATRIX']['PRICE_SELECT'];
    }
    $arItemPrices = $arResult['ITEM_PRICES'][$priceSelected];
    $arItemPrices['VALUE'] = $arItemPrices['BASE_PRICE'];
    $arItemPrices['PRINT_VALUE'] = \Aspro\Functions\CAsproItem::getCurrentPrice('BASE_PRICE', $arItemPrices);
    $arItemPrices['DISCOUNT_VALUE'] = $arItemPrices['PRICE'];
    $arItemPrices['PRINT_DISCOUNT_VALUE'] = \Aspro\Functions\CAsproItem::getCurrentPrice('PRICE', $arItemPrices);
}
$arViewedData = array(
    'PRODUCT_ID' => $arResult['ID'],
    'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    'NAME' => $arResult['NAME'],
    'DETAIL_PAGE_URL' => $arResult['DETAIL_PAGE_URL'],
    'PICTURE_ID' => $arResult['PREVIEW_PICTURE'] ? $arResult['PREVIEW_PICTURE']['ID'] : ($arFirstPhoto ? $arFirstPhoto['ID'] : false),
    'CATALOG_MEASURE_NAME' => $arResult['CATALOG_MEASURE_NAME'],
    'MIN_PRICE' => $arItemPrices,
    'CAN_BUY' => $arResult['CAN_BUY'] ? 'Y' : 'N',
    'IS_OFFER' => 'N',
    'WITH_OFFERS' => $arResult['OFFERS'] ? 'Y' : 'N',
);
?>
<script type="text/javascript">
    setViewedProduct(<?= $arResult['ID'] ?>, <?= CUtil::PhpToJSObject($arViewedData, false) ?>);
</script>

<div class="item_main_info item_main_info_razmeru <?= !$showCustomOffer ? 'noffer' : '' ?> <?= $arParams['SHOW_UNABLE_SKU_PROPS'] != 'N' ? 'show_un_props' : 'unshow_un_props' ?>" id="<?= $arItemIDs[
    'strMainID'
] ?>">
    <div class="img_wrapper swipeignore">
        <? if(!empty($arResult['PROPERTIES']['VIDEO_YOUTUBE']['LINK'])): ?>
			<a href="https://www.youtube.com/embed/<?= $arResult['PROPERTIES']['VIDEO_YOUTUBE'][
       'LINK'
   ] ?>" class="catItemVideo catItemVideo--big utPopUp fancybox.iframe" target="_blank">Youtube</a>
		<? endif; ?>

        <div class="item_slider">
            <?if(($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y") || (strlen($arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer))):?>
                <div class="like_wrapper">
                    <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"):?>
                        <div class="like_icons iblock">
                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                <?if(!$arResult["OFFERS"]):?>
                                    <div class="wish_item text" <?= $arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"' ?> data-item="<?= $arResult[
     'ID'
 ] ?>" data-iblock="<?= $arResult['IBLOCK_ID'] ?>">
                                        <span class="value" title="<?= GetMessage('CT_BCE_CATALOG_IZB') ?>" ><i></i></span>
                                        <span class="value added" title="<?= GetMessage('CT_BCE_CATALOG_IZB_ADDED') ?>"><i></i></span>
                                    </div>
                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !empty($arResult['OFFERS_PROP'])):?>
                                    <div class="wish_item text " <?= $arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"' ?> data-item="" data-iblock="<?= $arResult[
     'IBLOCK_ID'
 ] ?>" <?= !empty($arResult['OFFERS_PROP']) ? 'data-offers="Y"' : '' ?> data-props="<?= $arOfferProps ?>">
                                        <span class="value <?= $arParams['TYPE_SKU'] ?>" title="<?= GetMessage('CT_BCE_CATALOG_IZB') ?>"><i></i></span>
                                        <span class="value added <?= $arParams['TYPE_SKU'] ?>" title="<?= GetMessage('CT_BCE_CATALOG_IZB_ADDED') ?>"><i></i></span>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                <?if(!$arResult["OFFERS"] || ($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !$arResult["OFFERS_PROP"])):?>
                                    <div data-item="<?= $arResult['ID'] ?>" data-iblock="<?= $arResult['IBLOCK_ID'] ?>" data-href="<?= $arResult[
    'COMPARE_URL'
] ?>" class="compare_item text <?= $arResult['OFFERS'] ? $arParams['TYPE_SKU'] : '' ?>" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['COMPARE_LINK']; ?>">
                                        <span class="value" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE') ?>"><i></i></span>
                                        <span class="value added" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE_ADDED') ?>"><i></i></span>
                                    </div>
                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1'):?>
                                    <div data-item="" data-iblock="<?= $arResult['IBLOCK_ID'] ?>" data-href="<?= $arResult[
    'COMPARE_URL'
] ?>" class="compare_item text <?= $arParams['TYPE_SKU'] ?>">
                                        <span class="value" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE') ?>"><i></i></span>
                                        <span class="value added" title="<?= GetMessage('CT_BCE_CATALOG_COMPARE_ADDED') ?>"><i></i></span>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                        </div>
                    <?endif;?>
                </div>
            <?endif;?>

            <?reset($arResult['MORE_PHOTO']);
            $arFirstPhoto = current($arResult['MORE_PHOTO']);
            $viewImgType=$arParams["DETAIL_PICTURE_MODE"];?>
            <div class="slides">
                <?if($showCustomOffer && !empty($arResult['OFFERS_PROP'])){?>
                    <div class="offers_img wof">
                        <?$alt=$arFirstPhoto["ALT"];
                        $title=$arFirstPhoto["TITLE"];?>
                        <?if($arFirstPhoto["BIG"]["src"]){?>
                            <a href="<?= $viewImgType == 'POPUP' ? $arFirstPhoto['BIG']['src'] : 'javascript:void(0)' ?>" class="<?= $viewImgType == 'POPUP'
    ? 'popup_link'
    : 'line_link' ?>" title="<?= $title ?>">
                                <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?= $arFirstPhoto['SMALL']['src'] ?>" <?= $viewImgType == 'MAGNIFIER'
    ? 'data-large="" xpreview="" xoriginal=""'
    : '' ?> alt="<?= $alt ?>" title="<?= $title ?>" itemprop="image">
                                <div class="zoom"></div>
                            </a>
                        <?}else{?>
                            <a href="javascript:void(0)" class="" title="<?= $title ?>">
                                <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?= $arFirstPhoto['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" itemprop="image">
                                <div class="zoom"></div>
                            </a>
                        <?}?>
                    </div>
                <?}else{
                    if($arResult["MORE_PHOTO"]){
                        $bMagnifier = ($viewImgType=="MAGNIFIER");?>
                        <ul>
                            <?foreach($arResult["MORE_PHOTO"] as $i => $arImage){
                                if($i && $bMagnifier):?>
                                    <?continue;?>
                                <?endif;?>
                                <?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
                                <?
                                $alt=$arImage["ALT"];
                                $title=$arImage["TITLE"];
                                ?>
                                <li id="photo-<?= $i ?>" <?= !$i ? 'class="current"' : 'style="display: none;"' ?>>
                                    <?if(!$isEmpty){?>
                                        <a href="<?= $viewImgType == 'POPUP' ? $arImage['BIG']['src'] : 'javascript:void(0)' ?>" <?= $bIsOneImage
    ? ''
    : 'data-fancybox-group="item_slider"' ?> class="<?= $viewImgType == 'POPUP' ? 'popup_link fancy' : 'line_link' ?>" title="<?= $title ?>">
                                            <img  src="<?= $arImage['SMALL']['src'] ?>" <?= $viewImgType == 'MAGNIFIER' ? "class='zoom_picture'" : '' ?> <?= $viewImgType ==
 'MAGNIFIER'
     ? 'xoriginal="' . $arImage['BIG']['src'] . '" xpreview="' . $arImage['THUMB']['src'] . '"'
     : '' ?> alt="<?= $alt ?>" title="<?= $title ?>"<?= !$i ? ' itemprop="image"' : '' ?>/>
                                            <div class="zoom"></div>
                                        </a>
                                    <?}else{?>
                                        <img  src="<?= $arImage['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
                                    <?}?>
                                </li>
                            <?}?>
                        </ul>
                    <?}
                }?>
            </div>
            <?/*thumbs*/?>
            <?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])){
            if(count($arResult["MORE_PHOTO"]) > 1):?>
                <div class="wrapp_thumbs xzoom-thumbs">
                    <div class="thumbs flexslider" data-plugin-options='{"animation": "slide", "selector": ".slides_block > li", "directionNav": true, "itemMargin":10, "itemWidth": 100, "controlsContainer": ".thumbs_navigation", "controlNav" :false, "animationLoop": true, "slideshow": false}' style="max-width:<?= ceil(
                        (count($arResult['MORE_PHOTO']) <= 4 ? count($arResult['MORE_PHOTO']) : 4) * 110 - 10,
                    ) ?>px;">
                        <ul class="slides_block" id="thumbs">
                            <?foreach($arResult["MORE_PHOTO"]as $i => $arImage):?>
                                <li <?= !$i ? 'class="current"' : '' ?> data-big_img="<?= $arImage['BIG']['src'] ?>" data-small_img="<?= $arImage['SMALL']['src'] ?>">
                                    <span><img class="xzoom-gallery" width="100" xpreview="<?= $arImage['SMALL']['src'] ?>" src="<?= $arImage['SMALL']['src'] ?>" alt="<?= $arImage[
    'ALT'
] ?>" title="<?= $arImage['TITLE'] ?>" /></span>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <span class="thumbs_navigation custom_flex"></span>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $('.item_slider .thumbs li').first().addClass('current');
                        $('.item_slider .thumbs .slides_block').delegate('li:not(.current)', 'click', function(){
                            var slider_wrapper = $(this).parents('.item_slider'),
                                index = $(this).index();
                            $(this).addClass('current').siblings().removeClass('current')//.parents('.item_slider').find('.slides li').fadeOut(333);
                            if(arNextOptions['THEME']['DETAIL_PICTURE_MODE'] == 'MAGNIFIER')
                            {
                                var li = $(this).parents('.item_slider').find('.slides li');
                                li.find('img').attr('src', $(this).data('small_img'));
                                li.find('img').attr('xoriginal', $(this).data('big_img'));
                            }
                            else
                            {
                                slider_wrapper.find('.slides li').removeClass('current').hide();
                                slider_wrapper.find('.slides li:eq('+index+')').addClass('current').show();
                            }
                        });
                    })
                </script>
            <?endif;?>
            <?}else{?>
                <div class="wrapp_thumbs">
                    <div class="sliders">
                        <div class="thumbs" style="">
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
        <?/*mobile*/?>
        <?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])){?>
            <div class="item_slider color-controls flex flexslider" data-plugin-options='{"animation": "slide", "directionNav": false, "controlNav": true, "animationLoop": false, "slideshow": false, "slideshowSpeed": 10000, "animationSpeed": 600}'>
                <ul class="slides">
                    <?if($arResult["MORE_PHOTO"]){
                        foreach($arResult["MORE_PHOTO"] as $i => $arImage){?>
                            <?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
                            <li id="mphoto-<?= $i ?>" <?= !$i ? 'class="current"' : 'style="display: none;"' ?>>
                                <?
                                $alt=$arImage["ALT"];
                                $title=$arImage["TITLE"];
                                ?>
                                <?if(!$isEmpty){?>
                                    <a href="<?= $arImage['BIG']['src'] ?>" data-fancybox-group="item_slider_flex" class="fancy popup_link" title="<?= $title ?>" >
                                        <img src="<?= $arImage['SMALL']['src'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
                                        <div class="zoom"></div>
                                    </a>
                                <?}else{?>
                                    <img  src="<?= $arImage['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
                                <?}?>
                            </li>
                        <?}
                    }?>
                </ul>
            </div>
        <?}else{?>
            <div class="item_slider flex color-controls"></div>
        <?}?>
    </div>

    <div>
        <?if($arResult["DETAIL_TEXT"]) {?>
            <?=$arResult["DETAIL_TEXT"]?>
        <?}?>
    </div>
</div>

