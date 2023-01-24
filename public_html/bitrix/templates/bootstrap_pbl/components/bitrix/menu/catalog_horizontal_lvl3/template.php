<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if (empty($arResult["ALL_ITEMS"]))
	return;

CUtil::InitJSCore();

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["MENU_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["MENU_THEME"].'/colors.css');

//echo "<pre>";print_r($arResult["ALL_ITEMS"]);echo "<pre/>";
$menuBlockId = "catalog_menu_".$this->randString();
?>
<div class="bx-top-nav bx-<?=$arParams["MENU_THEME"]?>" id="<?=$menuBlockId?>">
	<nav class="main_menu " data-spy="affix" data-offset-top="366" id="cont_<?=$menuBlockId?>">
		<ul class="menu left-menu bx-nav-list-1-lvl" id="ul_<?=$menuBlockId?>">
		<?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>     <!-- first level-->
			<li
				class="bx-nav-1-lvl bx-nav-list-<?=($existPictureDescColomn) ? count($arColumns)+1 : count($arColumns)?>-col <?if($arResult["ALL_ITEMS"][$itemID]["SELECTED"]):?>bx-active<?endif?><?if (is_array($arColumns) && count($arColumns) > 0):?> bx-nav-parent<?endif?>"
				<?if (is_array($arColumns) && count($arColumns) > 0):?>
					data-role="bx-menu-item"
				<?endif?>
				onclick="if (BX.hasClass(document.documentElement, 'bx-touch')) obj_<?=$menuBlockId?>.clickInMobile(this, event);"
			>
				<a
					href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"				>
					<span>
						<?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?>
						<?if (is_array($arColumns) && count($arColumns) > 0):?><i class="fa fa-angle-down"></i><?endif?>
					</span>
				</a>
			<?if (is_array($arColumns) && count($arColumns) > 0):?>
				<span class="bx-nav-parent-arrow" onclick="obj_<?=$menuBlockId?>.toggleInMobile(this)"><i class="fa fa-angle-left"></i></span> <!-- for mobile -->
					<?foreach($arColumns as $key=>$arRow):?>
						<ul class="second_menu bx-nav-list-2-lvl">
						<?foreach($arRow as $itemIdLevel_2=>$arLevel_3):?>  <!-- second level-->
							<li class="sm_no_bg bx-nav-2-lvl">
								<a
									href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>"
									<?if($arResult["ALL_ITEMS"][$itemIdLevel_2]["SELECTED"]):?>class="bx-active"<?endif?>
								>
									<span><?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?></span>
								</a>
							<?if (is_array($arLevel_3) && count($arLevel_3) > 0):?>
								<div class="sm_box">
									<ul class="bx-nav-list-3-lvl">
									<?foreach($arLevel_3 as $itemIdLevel_3):?>	<!-- third level-->
										<li class="item bx-nav-3-lvl">
											<a
												href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>"
												<?if($arResult["ALL_ITEMS"][$itemIdLevel_3]["SELECTED"]):?>class="bx-active"<?endif?>
											>
												<span><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></span>
											</a>
										</li>
									<?endforeach;?>
									</ul>
								</div>
							<?endif?>
							</li>
						<?endforeach;?>
						</ul>
					<?endforeach;?>
			<?endif?>
			</li>
		<?endforeach;?>
		</ul>

		<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "cart_in_menu", Array(
	"PATH_TO_BASKET" => SITE_DIR."personal/cart/",	// Страница корзины
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
		"SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
		"SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
		"SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
		"SHOW_PRODUCTS" => "N",	// Показывать список товаров
		"POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
		"SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
		"PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
		"PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
		"COMPONENT_TEMPLATE" => ".default",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",	// Страница оформления заказа
		"SHOW_EMPTY_VALUES" => "Y",	// Выводить нулевые значения в пустой корзине
		"PATH_TO_AUTHORIZE" => "",	// Страница авторизации
		"HIDE_ON_BASKET_PAGES" => "N",	// Не показывать на страницах корзины и оформления заказа
	),
	false
);?>

		<ul style="float: right; -webkit-padding-start: 0px; margin-left: -40px;">
<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"top_search_hide", 
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "",
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "search",
		"CONTAINER_ID" => "sb-search",
		"PRICE_CODE" => array(
			0 => "Основной тип цен продажи",
		),
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "N",
		"COMPONENT_TEMPLATE" => "top_search_hide",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"CATEGORY_0_iblock_offers" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_1c_catalog" => array(
			0 => "5",
			1 => "6",
		)
	),
	false
);?>


	</ul>


		<div style="clear: both;"></div>
	</nav>
</div>

<script>
	BX.ready(function () {
		window.obj_<?=$menuBlockId?> = new BX.Main.Menu.CatalogHorizontal('<?=CUtil::JSEscape($menuBlockId)?>', <?=CUtil::PhpToJSObject($arResult["ITEMS_IMG_DESC"])?>);
	});
</script>