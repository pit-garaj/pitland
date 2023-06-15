<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
	<div class="sections_wrapper sections_razmeru">
		<div class="list items">
			<div class="row margin0 flexbox">
				<?foreach($arResult["ITEMS"] as $arItem){?>
					<div class="col-md-3 col-sm-4 col-xs-6">
						<div class="item">
							<div class="img shine">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb shine" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
									<?
									$a_alt = ($arItem["PREVIEW_PICTURE"] && strlen($arItem["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arItem["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] ));
									$a_title = ($arItem["PREVIEW_PICTURE"] && strlen($arItem["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arItem["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] ));
									?>
									<?if( !empty($arItem["PREVIEW_PICTURE"]) ) {?>
										<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array( "width" => 250, "height" => 100 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
										<img src="<?=$img['src']?>" height="<?=$img['height']?>" width="<?=$img['width']?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<? } else {?>
										<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<?}?>
									<?if($fast_view_text_tmp = CNext::GetFrontParametrValue('EXPRESSION_FOR_FAST_VIEW'))
										$fast_view_text = $fast_view_text_tmp;
									else
										$fast_view_text = GetMessage('FAST_VIEW');?>
								</a>
							</div>
						</div>
					</div>
				<?}?>
			</div>
		</div>
	</div>
<?} else {?>
	<script>
		// $(document).ready(function(){
			$('.sort_header').animate({'opacity':'1'}, 500);
		// })
	</script>
	<div class="no_goods catalog_block_view">
		<div class="no_products">
			<div class="wrap_text_empty">
				<?if($_REQUEST["set_filter"]){?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}else{?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}?>
			</div>
		</div>
		<?if($_REQUEST["set_filter"]){?>
			<span class="button wide"><?=GetMessage('RESET_FILTERS');?></span>
		<?}?>
	</div>
<?}?>

