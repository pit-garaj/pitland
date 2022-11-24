<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->addExternalJS("/bitrix/templates/bootstrap_pbl/js/classie.js");
$this->addExternalJS("/bitrix/templates/bootstrap_pbl/js/uisearch.js");


$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
<div id="<?echo $CONTAINER_ID?>" class="sb-search">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
			<input id="<?echo $INPUT_ID?>" type="text" name="q" placeholder="Что будем искать?" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" autocomplete="off" class="sb-search-input"/>
        	<input class="sb-search-submit" type="submit" value="">
			<span class="sb-icon-search"><i class="fa fa-search fa-1x" aria-hidden="true"></i></span>
	</form>
</div>

<?endif?>
<script>
	new UISearch( document.getElementById( 'sb-search' ) );
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': 'search',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>

