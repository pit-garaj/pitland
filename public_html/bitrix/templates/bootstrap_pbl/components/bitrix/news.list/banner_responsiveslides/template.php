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
$this->addExternalJS("/bitrix/templates/bootstrap_pbl/js/responsiveslides.min.js");
?>

<div id="top" class="callbacks_container">
	<ul class="rslides callbacks callbacks1" id="slider_top">
<?foreach($arResult["ITEMS"] as $i=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<li <?if ($i > 0):?> style="display:none" <?endif;?> id="callbacks1_s<?=$i?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="banner-bg" style="background: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>) no-repeat 0px 0px;background-size:cover;background-position: bottom;">
				<div class="container-fluid info_big">
					<div class="banner-info">
						<h2><?=$arItem["NAME"]?></h2>
						<p>
						<?=$arItem["PREVIEW_TEXT"]?>
						</p>
						<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">Подробно</a>
					</div>
				</div>
			</div>
		</li>
<?endforeach;?>
	</ul>
</div>
<script>
$(function () {
	$('.slider_top > li').each(function() {
	  $( this ).show();
	});
})
</script>