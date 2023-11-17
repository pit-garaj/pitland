<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
$page = $APPLICATION->GetCurPage();

/** @var array $arResult */
/** @var array $arParams */
/** @var object $APPLICATION */
?>
<?php $this->setFrameMode(true); ?>
<?php if(count($arResult["ITEMS"] ) >= 1) { ?>
    <?php if(($arParams["AJAX_REQUEST"] === "N") || !isset($arParams["AJAX_REQUEST"])): ?>
        <?php if(isset($arParams["TITLE"]) && $arParams["TITLE"]): ?>
          <hr/><h5><?=$arParams['TITLE']?></h5>
        <?php endif ?>
      <div class="top_wrapper row margin0 <?=($arParams["SHOW_UNABLE_SKU_PROPS"] !== "N" ? "show_un_props" : "unshow_un_props")?>">
      <div class="catalog_block items block_list">
    <?php endif ?>

    <?php
		$currencyList = '';
		if (!empty($arResult['CURRENCIES'])){
			$templateLibrary[] = 'currency';
			$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
		}
		$templateData = array(
			'TEMPLATE_LIBRARY' => $templateLibrary,
			'CURRENCIES' => $currencyList
		);
		unset($currencyList, $templateLibrary);

		$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());
		$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);


		switch ($arParams["LINE_ELEMENT_COUNT"]){
			case '1':
			case '2':
				$col=2;
				break;
			case '3':
				$col=3;
				break;
			case '5':
				$col=5;
				break;
			default:
				$col=4;
				break;
		}
		if($arParams["LINE_ELEMENT_COUNT"] > 5)
			$col = 5;?>
		<?foreach($arResult["ITEMS"] as $arItem){?>
				<?//if($USER->IsAdmin()): echo '<pre>';print_r($arItem);echo '</pre>'; endif;?>
				<div class="item_block col-<?=$col;?> col-md-<?=ceil(12/$col);?> col-sm-<?=ceil(12/round($col / 2))?> col-xs-6">
				<div class="catalog_item_wrapp item">
            <? if(!empty($arItem['PROPERTIES']['VIDEO_YOUTUBE']['LINK'])): ?>
                <?/*<a href="https://www.youtube.com/embed/<?=$arItem['PROPERTIES']['VIDEO_YOUTUBE']['LINK']?>" class="catItemVideo utPopUp fancybox.iframe" target="_blank">Youtube</a>*/?>
              <a class="catItemVideo">Youtube</a>
            <? endif; ?>

					<div class="basket_props_block" id="bx_basket_div_<?=$arItem["ID"];?>" style="display: none;">
						<?if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])){
							foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo){?>
								<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
								<?if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
									unset($arItem['PRODUCT_PROPERTIES'][$propID]);
							}
						}
						$arItem["EMPTY_PROPS_JS"]="Y";
						$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
						if (!$emptyProductProperties){
							$arItem["EMPTY_PROPS_JS"]="N";?>
							<div class="wrapper">
								<table>
									<?foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo){?>
										<tr>
											<td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
											<td>
												<?php if ('L' === $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' === $arItem['PROPERTIES'][$propID]['LIST_TYPE']) {
													foreach($propInfo['VALUES'] as $valueID => $value){?>
														<label>
															<input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
														</label>
													<?}
												}else{?>
													<select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
														foreach($propInfo['VALUES'] as $valueID => $value){?>
															<option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
														<?}?>
													</select>
												<?}?>
											</td>
										</tr>
									<?}?>
								</table>
							</div>
							<?
						}?>
					</div>
					<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

					$arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
					$arItemIDs=CNext::GetItemsIDs($arItem);

					$totalCount = CNext::GetTotalCount($arItem, $arParams);
					$arQuantityData = CNext::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"]);

					$bLinkedItems = (isset($arParams["LINKED_ITEMS"]) && $arParams["LINKED_ITEMS"]);
					if($bLinkedItems)
						$arItem["FRONT_CATALOG"]="Y";

					$item_id = $arItem["ID"];
					$strMeasure = '';
					$arAddToBasketData;
					if (!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1') {
						if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]) {
							$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
							$strMeasure = $arMeasure["SYMBOL_RUS"];
						}
						$arAddToBasketData = CNext::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], ($bLinkedItems ? true : false), $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
					}
					elseif($arItem["OFFERS"]){
						$strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
					}
					
					if ( trim( $strMeasure ) == 'шт' ) {
						$strMeasure = '';
					}

					$elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);
					?>
					<div class="catalog_item main_item_wrapper item_wrap <?=(($_GET['q'])) ? 's' : ''?>" id="<?=$arItemIDs["strMainID"];?>">
						<div>
							<div class="image_wrapper_block">
								<div class="stickers">
									<?$prop = ($arParams["STIKERS_PROP"] ? $arParams["STIKERS_PROP"] : "HIT");?>
									<?foreach(CNext::GetItemStickers($arItem["PROPERTIES"][$prop]) as $arSticker):?>
										<?if($arSticker['CLASS']!="sticker_new") {?>
											<div><div class="<?=$arSticker['CLASS']?>"><?=$arSticker['VALUE']?></div></div>
										<?}?>
									<?endforeach;?>

									<?if($page=="new" or $page=="/new/index.php") {?>
									 	<div><div class="sticker_new">Новинка</div></div>
									<?} else {?>
										<? if (strpos( $arItem['DETAIL_PAGE_URL'], '/tekhnika/' ) ) {   //если раздел Техника
											if($arItem["DATE_ACTIVE_FROM"]) {
												$DateCreate = $arItem["DATE_ACTIVE_FROM"];
												$CurDate = date("d.m.Y H:i:s");
												$Difference = intval(abs(
													strtotime($CurDate) - strtotime($DateCreate)
												));
												$DiffDates = $Difference / (3600 * 24);

												if ($DiffDates <= 90) {   // 90 дней
													echo '<div class="sticker_new">Новинка</div>';
												}
											}
										}
									}?>

									<?php if ($arParams['SALE_STIKER'] && $arItem['PROPERTIES'][$arParams['SALE_STIKER']]['VALUE']): ?>
										<div><div class="sticker_sale_text"><?=$arItem['PROPERTIES'][$arParams['SALE_STIKER']]['VALUE']?></div></div>
									<?php endif ?>

									<?php if ($page === 'discount' or $page === '/discount/index.php'): ?>
										<div class="stickers_friday"></div>
									<?php endif ?>
									
								</div>
								<?if($arParams["DISPLAY_WISH_BUTTONS"] !== "N" || $arParams["DISPLAY_COMPARE"] === "Y"):?>
									<div class="like_icons">
										<?if($arParams["DISPLAY_WISH_BUTTONS"] !== "N"):?>
											<?if(!$arItem["OFFERS"]):?>
												<div class="wish_item_button" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?>>
													<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
													<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
												</div>
											<?elseif($arItem["OFFERS"] && !empty($arItem['OFFERS_PROP'])):?>
												<div class="wish_item_button" style="display: none;">
													<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to <?=$arParams["TYPE_SKU"];?>" data-item="" data-iblock="<?=$arItem["IBLOCK_ID"]?>" data-offers="Y" data-props="<?=$arOfferProps?>"><i></i></span>
													<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="" data-iblock="<?=$arOffer["IBLOCK_ID"]?>"><i></i></span>
												</div>
											<?endif;?>
										<?endif;?>
										<?php if($arParams["DISPLAY_COMPARE"] !== "N"):?>
											<?if(!$arItem["OFFERS"] || ($arParams["TYPE_SKU"] !== 'TYPE_1' || ($arParams["TYPE_SKU"] === 'TYPE_1' && !$arItem["OFFERS_PROP"]))):?>
												<div class="compare_item_button">
													<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i></span>
													<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i></span>
												</div>
											<?elseif($arItem["OFFERS"]):?>
												<div class="compare_item_button">
													<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to <?=$arParams["TYPE_SKU"];?>" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="" ><i></i></span>
													<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item=""><i></i></span>
												</div>
											<?endif;?>
										<?endif;?>
									</div>
								<?endif;?>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb shine" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
									<?
									$a_alt = ($arItem["PREVIEW_PICTURE"] && strlen($arItem["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arItem["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] ));
									$a_title = ($arItem["PREVIEW_PICTURE"] && strlen($arItem["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arItem["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] ));
									?>
									<?php if( !empty($arItem["PREVIEW_PICTURE"]) ): ?>
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<?php elseif( !empty($arItem["DETAIL_PICTURE"])): ?>
										<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 170, "height" => 170 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
										<img src="<?=$img["src"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<?php else: ?>
										<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<?php endif ?>
									<?php if($fast_view_text_tmp = CNext::GetFrontParametrValue('EXPRESSION_FOR_FAST_VIEW'))
										$fast_view_text = $fast_view_text_tmp;
									else
										$fast_view_text = GetMessage('FAST_VIEW');?>
								</a>
								

							</div>
							<div class="item_info <?=$arParams["TYPE_SKU"]?>">
                <div class="catalog-item-availability">
                  <span class="catalog-item-availability_<?=$arItem['AVAILABILITY']['availability_style']?>"><?=$arItem['AVAILABILITY']['availability']?></span>
                </div>
								<div class="item-title">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="dark_link"><span><?=$elementName;?></span></a>
								</div>

								<?php
								if ($APPLICATION->GetCurDir() === '/catalog/tekhnika/mototsikly/'):
									$arProps = Array(
										'Мощность двигателя' => 'MOSHCHNOST_L_S',
										'Кубатура' => 'OBEM_DVIGATELYA',
										'Размер колес' => 'DIAMETR_KOLES_PERED_ZAD_DYUYM',
										'Коробка передач' => 'TIP_KPP',
										'Колесная база' => 'BAZA_MM',
										'Высота по седлу' => 'VYSOTA_PO_SEDLU_MM',
									);
									?>
										<ul class="ownd-catalog-props">
											<?php
											foreach ( $arProps as $propName => $propCode ) {
												$propValue = $arItem['PROPERTIES'][$propCode]['VALUE'];
												
												if (is_array($propValue)) {
													$propValue = array_shift( $propValue );
												}
												
												if (!$propValue) {
													continue;
												}
												?>
													<li>
														<span><?=$propName?>:</span>
														<span><?=$propValue?></span>
													</li>
												<?
											}
											?>
										</ul>
                <?php endif ?>

								<div class="cost prices clearfix">
									<?php if ( strpos( $arQuantityData['HTML'], 'Нет в наличии' ) && strpos( $arItem['DETAIL_PAGE_URL'], '/tekhnika/' ) ): ?>
											<div class="price_matrix_block">
												<div class="price_matrix_wrapper ">
													<div class="price">
														<span>
															<span class="values_wrapper">
																<span class="price_value">Под заказ</span>
															</span>
														</span>
													</div>
												</div>
											</div>
                  <?php else: ?>
										<?php if ($arItem["OFFERS"]): ?>
											<div class="with_matrix <?=($arParams["SHOW_OLD_PRICE"] === "Y" ? 'with_old' : '')?>" style="display:none;">
												<div class="price price_value_block"><span class="values_wrapper"></span></div>
												<?php if($arParams["SHOW_OLD_PRICE"] === "Y"): ?>
													<div class="price discount"></div>
												<?php endif; ?>
												<?php if($arParams["SHOW_DISCOUNT_PERCENT"] === "Y"): ?>
													<div class="sale_block matrix" style="display:none;">
														<div class="sale_wrapper">
														<span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
														<div class="text"><span class="values_wrapper"></span></div>
														<div class="clearfix"></div></div>
													</div>
												<?php endif ?>
											</div>
											<?php \Aspro\Functions\CAsproSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, $arItemIDs, 'Y'); ?>
										<?php else: ?>
											<?php
											$item_id = $arItem["ID"];
											if(isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) { // USE_PRICE_COUNT
                        ?>
												<?php if($arItem['ITEM_PRICE_MODE'] === 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1): ?>
													<?=CNext::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY"))?>
												<?php endif ?>
												<?=CNext::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData);?>
												<?php
                          $arMatrixKey = array_keys($arItem['PRICE_MATRIX']['MATRIX']);
                          $min_price_id=current($arMatrixKey);
                        ?>
											<?php
											}
											else
											{
												$arCountPricesCanAccess = 0;
												$min_price_id=0;
												\Aspro\Functions\CAsproItem::showItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id, 'Y');
                        ?>
											<?php } ?>
										<?php endif ?>
									<?php endif ?>
								</div>
								<?php if($arParams["SHOW_DISCOUNT_TIME"] === "Y" && $arParams['SHOW_COUNTER_LIST'] !== 'N'): ?>
									<?$arUserGroups = $USER->GetUserGroupArray();?>
									<?php if($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] !== 'Y' || ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] === 'Y' && !$arItem['OFFERS'])): ?>
										<?$arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $arUserGroups, "N", $min_price_id, SITE_ID);
										$arDiscount=array();
										if($arDiscounts)
											$arDiscount=current($arDiscounts);
										if($arDiscount["ACTIVE_TO"]){?>
											<div class="view_sale_block <?=($arQuantityData["HTML"] ? '' : 'wq');?>">
												<div class="count_d_block">
													<span class="active_to hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
													<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
													<span class="countdown values"><span class="item"></span><span class="item"></span><span class="item"></span><span class="item"></span></span>
												</div>
												<?if($arQuantityData["HTML"]):?>
													<div class="quantity_block">
														<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
														<div class="values">
															<span class="item">
																<span class="value" <?=((count( $arItem["OFFERS"] ) > 0 && $arParams["TYPE_SKU"] == 'TYPE_1' && $arItem["OFFERS_PROP"]) ? 'style="opacity:0;"' : '')?>><?=$totalCount;?></span>
																<span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
															</span>
														</div>
													</div>
												<?endif;?>
											</div>
										<?}?>
									<?else:?>
										<?php
                        if($arItem['JS_OFFERS']) {
                          foreach($arItem['JS_OFFERS'] as $keyOffer => $arTmpOffer2) {
                            $active_to = '';
                            $arDiscounts = CCatalogDiscount::GetDiscountByProduct( $arTmpOffer2['ID'], $arUserGroups, "N", array(), SITE_ID );

                            if($arDiscounts) {
                              foreach($arDiscounts as $arDiscountOffer) {
                                if($arDiscountOffer['ACTIVE_TO']) {
                                  $active_to = $arDiscountOffer['ACTIVE_TO'];
                                  break;
                                }
                              }
                            }

                            $arItem['JS_OFFERS'][$keyOffer]['DISCOUNT_ACTIVE'] = $active_to;
                          }
                        }
                        ?>
										<div class="view_sale_block" style="display:none;">
											<div class="count_d_block">
													<span class="active_to_<?=$arItem["ID"]?> hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
													<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
													<span class="countdown countdown_<?=$arItem["ID"]?> values"></span>
											</div>
											<?if($arQuantityData["HTML"]):?>
												<div class="quantity_block">
													<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
													<div class="values">
														<span class="item">
															<span class="value"><?=$totalCount;?></span>
															<span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
														</span>
													</div>
												</div>
											<?endif;?>
										</div>
									<?endif;?>
								<?php endif ?>
							</div>
							
							
							<?
							if ( $APPLICATION->GetCurDir() == '/catalog/tekhnika/pitbayki/' )
							{
                // $arAddToBasketData['HTML'] = '<button>' . $arAddToBasketData['HTML'] . '</button>';
								// $arAddToBasketData['HTML'] .= '<button style="margin-left: 10px;" data-item="' . $arItem['ID'] . '" data-iblockid="23" data-quantity="1" onclick="oneClickBuy(' . $arItem['ID'] . ', 23, this )"><span class="small btn btn-default transition_bg animate-load">Купить в 1 клик</span></button>';
							}
							?>
							
							
							<div class="footer_button">
								<div class="sku_props">
									<?if($arItem["OFFERS"]){?>
										<?if(!empty($arItem['OFFERS_PROP'])){?>
											<div class="bx_catalog_item_scu wrapper_sku" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>">
												<?$arSkuTemplate = array();?>
												<?$arSkuTemplate=CNext::GetSKUPropsArray($arItem['OFFERS_PROPS_JS'], $arResult["SKU_IBLOCK_ID"], $arParams["DISPLAY_TYPE"], $arParams["OFFER_HIDE_NAME_PROPS"]);?>
												<?foreach ($arSkuTemplate as $code => $strTemplate){
													if (!isset($arItem['OFFERS_PROP'][$code]))
														continue;
													echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate), '</div>';
												}?>
											</div>
											<?php
                      $arItemJSParams = CNext::GetSKUJSParams($arResult, $arParams, $arItem);
                      ?>
											<script type="text/javascript">
												var <?=$arItemIDs["strObName"]?> = new JCCatalogSection(<?=CUtil::PhpToJSObject($arItemJSParams, false, true)?>);
											</script>
										<?}?>
									<?}?>
								</div>
                  <?php require('blocks/action-buttons.php'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?}?>
	<?if(($arParams["AJAX_REQUEST"]=="N") || !isset($arParams["AJAX_REQUEST"])){?>
			</div>
		</div>
	<?}?>
	<?if($arParams["AJAX_REQUEST"]=="Y"){?>
		<div class="wrap_nav">
	<?}?>
	<div class="bottom_nav <?=$arParams["DISPLAY_TYPE"];?>" <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
		<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
	</div>
	<?if($arParams["AJAX_REQUEST"]=="Y"){?>
		</div>
	<?}?>
<?}else{?>
	<script>
		// $(document).ready(function(){
			$('.sort_header').animate({'opacity':'1'}, 500);
		// })
	</script>
	<div class="no_goods catalog_block_view">
		<div class="no_products">
			<div class="wrap_text_empty">
				<?php if($_REQUEST["set_filter"]): ?>
					<?php $APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR'))); ?>
				<?php else: ?>
					<?php $APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR'))); ?>
				<?php endif ?>
			</div>
		</div>
		<?php if($_REQUEST["set_filter"]): ?>
			<span class="button wide"><?=GetMessage('RESET_FILTERS');?></span>
		<?php endif ?>
	</div>
<?}?>

<script>
	BX.message({
		QUANTITY_AVAILIABLE: '<?=COption::GetOptionString("aspro.next", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID)?>',
		QUANTITY_NOT_AVAILIABLE: '<?=COption::GetOptionString("aspro.next", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID)?>',
		ADD_ERROR_BASKET: '<?=GetMessage("ADD_ERROR_BASKET")?>',
		ADD_ERROR_COMPARE: '<?=GetMessage("ADD_ERROR_COMPARE")?>',
	})
	sliceItemBlock();
</script>
