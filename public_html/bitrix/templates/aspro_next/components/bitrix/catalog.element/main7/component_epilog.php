<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
?>
<?if($arResult["ID"]):?>
	<?if($arParams["USE_REVIEW"] == "Y" && IsModuleInstalled("forum")):?>
		<div id="reviews_content">
			<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area");?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:forum.topic.reviews",
					"main",
					Array(
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
						"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
						"FORUM_ID" => $arParams["FORUM_ID"],
						"ELEMENT_ID" => $arResult["ID"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
						"SHOW_RATING" => "N",
						"SHOW_MINIMIZED" => "Y",
						"SECTION_REVIEW" => "Y",
						"POST_FIRST_MESSAGE" => "Y",
						"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
						"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
						"SHOW_AVATAR" => "N",
						"SHOW_LINK_TO_FORUM" => "N",
						"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
					),	false
				);?>
			<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("area", "");?>
		</div>
	<?endif;?>
	<?if(($arParams["SHOW_ASK_BLOCK"] == "Y") && (intVal($arParams["ASK_FORM_ID"]))):?>
		<div id="ask_block_content" class="hidden">
			<?$APPLICATION->IncludeComponent(
				"bitrix:form.result.new",
				"inline",
				Array(
					"WEB_FORM_ID" => $arParams["ASK_FORM_ID"],
					"IGNORE_CUSTOM_TEMPLATE" => "N",
					"USE_EXTENDED_ERRORS" => "N",
					"SEF_MODE" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600000",
					"LIST_URL" => "",
					"EDIT_URL" => "",
					"SUCCESS_URL" => "?send=ok",
					"CHAIN_ITEM_TEXT" => "",
					"CHAIN_ITEM_LINK" => "",
					"VARIABLE_ALIASES" => Array("WEB_FORM_ID" => "WEB_FORM_ID", "RESULT_ID" => "RESULT_ID"),
					"AJAX_MODE" => "Y",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"SHOW_LICENCE" => CNext::GetFrontParametrValue('SHOW_LICENCE'),
				)
			);?>
		</div>
	<?endif;?>
	<script type="text/javascript">
		if($("#ask_block_content").length && $("#ask_block").length){
			$("#ask_block_content").appendTo($("#ask_block"));
			$("#ask_block_content").removeClass("hidden");
		}
		if($(".gifts").length && $("#reviews_content").length){
			$(".gifts").insertAfter($("#reviews_content"));
		}
		if($("#reviews_content").length && (!$(".tabs .tab-content .active").length) || $('.product_reviews_tab.active').length){
			$(".shadow.common").hide();
			$("#reviews_content").show();
		}
		if(!$(".stores_tab").length){
			$('.item-stock .store_view').removeClass('store_view');
		}
		viewItemCounter('<?=$arResult["ID"];?>','<?=current($arParams["PRICE_CODE"]);?>');
	</script>
<?endif;?>
<?if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY'])){
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency){?>
		<script type="text/javascript">
			BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
		</script>
	<?}
}?>
<script type="text/javascript">
	var viewedCounter = {
		path: '/bitrix/components/bitrix/catalog.element/ajax.php',
		params: {
			AJAX: 'Y',
			SITE_ID: "<?= SITE_ID ?>",
			PRODUCT_ID: "<?= $arResult['ID'] ?>",
			PARENT_ID: "<?= $arResult['ID'] ?>"
		}
	};
	BX.ready(
		BX.defer(function(){
			$('body').addClass('detail_page');
			<?//if(!isset($templateData['JS_OBJ'])){?>
				BX.ajax.post(
					viewedCounter.path,
					viewedCounter.params
				);
			<?//}?>
			if( $('.stores_tab').length ){
				var objUrl = parseUrlQuery(),
				add_url = '';
				if('clear_cache' in objUrl)
				{
					if(objUrl.clear_cache == 'Y')
						add_url = '?clear_cache=Y';
				}
				$.ajax({
					type:"POST",
					url:arNextOptions['SITE_DIR']+"ajax/productStoreAmount.php"+add_url,
					data:<?=CUtil::PhpToJSObject($templateData["STORES"], false, true, true)?>,
					success: function(data){
						var arSearch=parseUrlQuery();
						$('.tab-content .tab-pane .stores_wrapp').html(data);
						if("oid" in arSearch)
							$('.stores_tab .sku_stores_'+arSearch.oid).show();
						else
							$('.stores_tab .stores_wrapp > div:first').show();

					}
				});
			}
		})
		
	);
</script>
<?if($_REQUEST && isset($_REQUEST['formresult'])):?>
	<script>
	$(document).ready(function() {
		if($('#ask_block .form_result').length){
			$('.product_ask_tab').trigger('click');
		}
	});
	</script>
<?endif;?>
<?if(isset($_GET["RID"])){?>
	<?if($_GET["RID"]){?>
		<script>
			$(document).ready(function() {
				$("<div class='rid_item' data-rid='<?=htmlspecialcharsbx($_GET["RID"]);?>'></div>").appendTo($('body'));
			});
		</script>
	<?}?>
<?}?>


<style>
.ownd-features-col a
{
	color: #555;
}

@media screen and (max-width: 1580px)
{
	.catItemsFeatures .catItemsFeatures__item
	{
		width: 50%;
	}
	
	.catItemsFeatures__item:nth-child(2) { border-right: 1px solid #ddd; }
}

@media screen and (max-width: 830px)
{
	.catItemsFeatures .catItemsFeatures__item
	{
		width: 100%;
	}
	
	.catItemsFeatures__item:nth-child(1),.catItemsFeatures__item:nth-child(3) { border-right: 1px solid #ddd; }
}


#ownd-stock
{
	border-radius: 3px;
    background-color: #f3f3f3;
    padding: 9px 15px;
    margin-top: 40px;
    width: 460px;
	max-width: 100%;
}

#ownd-stock + .catItemsFeatures.catItemsFeatures-vertical
{
	max-width: 100%;
}

#ownd-stock .top_line
{
	    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

#ownd-stock .wrap_selectpicker
{
	     display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

#ownd-stock .selectpicker_title {
    color: #373838;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    margin-right: 5px;
}

#ownd-stock .wrap_selectpicker a {
    color: #e73436;
    font-size: 14px;
    font-weight: 400;
    border-bottom: 1px #e73436 dotted;
    display: initial;
    cursor: pointer;
    line-height: normal;
    text-decoration: none;
    position: relative;
    margin-right: 30px;
    white-space: nowrap;
}

#ownd-stock .wrap_selectpicker a:before {
    content: "";
    width: 7px;
    height: 4px;
    position: absolute;
    top: 7px;
    right: -14px;
    background-image: url(/upload/images/before.png);
    background-position: center;
    background-repeat: no-repeat;
}

#ownd-stock .update_txt {
    color: #bebebe;
    font-size: 12px;
    font-weight: 400;
    line-height: 20px;
}

#ownd-stock .availability_list {
    margin: 0;
    padding: 0;
    margin-top: 9px;
    margin-bottom: 3px;
}

#ownd-stock .availability_list_item {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    position: relative;
	margin: 0;
	padding: 0;
}

#ownd-stock .availability_list_item:before {
    display: none;
}

#ownd-stock .availability_list_item_ttl {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    color: #373838;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    position: relative;
    top: 2px;
    background-color: #f3f3f3;
    padding-left: 20px;
    z-index: 2;
}

#ownd-stock .availability_list_item_ttl:before {
    content: "";
    width: 12px;
    height: 10px;
    background-image: url(/upload/images/green_check.png);
    background-position: center;
    background-repeat: no-repeat;
    -webkit-transform: translate(0,-50%);
    -ms-transform: translate(0,-50%);
    transform: translate(0,-50%);
    position: absolute;
    top: 50%;
    left: 0;
}

#ownd-stock .availability_list_item_ttl a {
    color: #e73436;
    text-decoration: underline;
    margin-left: 5px;
    margin-right: 5px;
}

#ownd-stock .availability_list_item_ttl .grey_text {
    color: #9d9d9d;
}

#ownd-stock .count {
    color: #6a9e1f;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    position: relative;
    background-color: #f3f3f3;
    top: 2px;
    z-index: 2;
}

#ownd-stock .availability_list_item:after {
    content: "";
    width: 100%;
    border-bottom: 1px #9d9d9d dotted;
    position: absolute;
    bottom: 0;
    left: 0;
}
</style>
