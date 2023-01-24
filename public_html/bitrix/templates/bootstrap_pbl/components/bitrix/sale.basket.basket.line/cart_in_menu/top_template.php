<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>	<li style="font-size:15px;line-height: 49px;display:block;text-align: center;">
	<a href="<?= $arParams['PATH_TO_BASKET'] ?>"><?
		if (!$arResult["DISABLE_USE_BASKET"])
		{
			?><i style="vertical-align: sub;" class="fa fa-shopping-cart fa-2x"></i>
			<?
		}
		if (!$compositeStub)
		{
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
			{
				echo $arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)'];
			}
			if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
			| <span>
				<? if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'):?>
					<strong><?= str_replace("руб.", "<i class='fa fa-rub' aria-hidden='true'></i>", $arResult['TOTAL_PRICE'] );?>  </strong>
				<?endif ?>
			</span>
			<?endif;?>
			<?
		}?>
	</a>
	</li>