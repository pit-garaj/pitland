<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arResult */

CModule::IncludeModule( 'iblock' );


if ($arResult['query'] ) {
	$arFilter = Array(
		'IBLOCK_ID' => 23,
		'ACTIVE' => 'Y',
		'NAME' => $arResult['query']
	);
	$arSelect = Array(
		'NAME',
		'SECTION_PAGE_URL',
		'PICTURE',
	);
	$dbSection = CIBlockSection::GetList( Array(), $arFilter, false, $arSelect );
	$arSection = $dbSection->GetNext();
}


if (empty($arResult["CATEGORIES"]) && !isset( $arSection )) {
    return;
}
?>
<div class="bx_searche scrollbar">

	<?php if ($arSection['NAME']) { ?>
			<a class="bx_item_block others_result" href="<?=$arSection["SECTION_PAGE_URL"]?>">
				<div class="maxwidth-theme">
					<div class="bx_img_element">
						<?php if($arSection["PICTURE"]): ?>
							<?php
							$arSection["PICTURE"] = CFile::ResizeImageGet( $arSection["PICTURE"], Array( 'width' => 80, 'height' => 80 ) );
							?>
							<img src="<?=$arSection["PICTURE"]['src']?>">
						<?php endif; ?>
					</div>
					<div class="bx_item_element">
						<span><?=$arSection["NAME"]?></span>
					</div>
					<div style="clear:both;"></div>
				</div>
			</a>
  <?php } ?>

	<?php foreach($arResult["CATEGORIES"] as $category_id => $arCategory): ?>
		<?php foreach($arCategory["ITEMS"] as $i => $arItem): ?>
			<?php if($category_id === "all"): ?>
				<div class="bx_item_block all_result">
					<div class="maxwidth-theme">
						<div class="bx_item_element">
							<a class="all_result_title btn btn-default white bold" href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
			<?php elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
				$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
				<a class="bx_item_block" href="<?=$arItem["URL"]?>">
					<div class="maxwidth-theme">
						<div class="bx_img_element">
							<?php if(is_array($arElement["PICTURE"])): ?>
								<img src="<?=$arElement["PICTURE"]["src"]?>">
							<?php else: ?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_small.png" width="38" height="38">
							<?php endif; ?>
						</div>
						<div class="bx_item_element">
							<span><?=$arItem["NAME"]?></span>
              <?php if ($arElement['CATALOG_AVAILABLE'] === 'Y'): ?>
							<div class="price cost prices">
								<div class="title-search-price">
									<?php if ($arElement["MIN_PRICE"]) { ?>
										<?php if ($arElement["MIN_PRICE"]["DISCOUNT_VALUE"] < $arElement["MIN_PRICE"]["VALUE"]): ?>
											<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?></div>
											<div class="price discount">
												<strike><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></strike>
											</div>
										<?php else: ?>
											<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></div>
										<?php endif; ?>
									<?php } else { ?>
										<?php foreach($arElement["PRICES"] as $code=>$arPrice): ?>
											<?php if ($arPrice["CAN_ACCESS"]):?>
												<?php if (count($arElement["PRICES"]) > 1): ?>
													<div class="price_name"><?=$arResult["PRICES"][$code]["TITLE"];?></div>
												<?php endif; ?>
												<?php if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
													<div class="price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
													<div class="price discount">
														<strike><?=$arPrice["PRINT_VALUE"]?></strike>
													</div>
												<?php else: ?>
													<div class="price"><?=$arPrice["PRINT_VALUE"]?></div>
												<?php endif; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php } ?>
								</div>
							</div>
              <?php endif; ?>
						</div>
						<div style="clear:both;"></div>
					</div>
				</a>
			<?php else: ?>
				<?php if ($arItem["MODULE_ID"]): ?>
					<a class="bx_item_block others_result" href="<?=$arItem["URL"]?>">
						<div class="maxwidth-theme">
							<div class="bx_item_element">
								<span><?=$arItem["NAME"]?></span>
							</div>
							<div style="clear:both;"></div>
						</div>
					</a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>
