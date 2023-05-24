<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc;

/** @var array $arParams */
/** @var object $APPLICATION */
?>


<?if(!empty($arResult['PROPERTIES']['VIDEO']['VALUE'])) {?>
	<div class="video-container">
		<iframe width="100%" height="315" src="<?=$arResult['PROPERTIES']['VIDEO']['VALUE']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>

<?}?>
<div class="bottom_nav" style="padding-top: 0">
	<a href="<?=$arParams['YOUTUBE_CHANEL_LINK']?>" class="btn btn-default basket read_more" target="_blank">
		<?=$arParams['TITLE_BLOCK_ALL']?>
	</a>
</div>

<div class="introtext_wrapper">
	<div class="introtext">
		<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
			<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
		<?else:?>
			<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
		<?endif;?>
	</div>
</div>


<?// form question?>
<?if($bShowFormQuestion && $isHideLeftBlock):?>
	</div>
	<div class="col-md-3 hidden-xs hidden-sm">
		<div class="fixed_block_fix"></div>
			<div class="ask_a_question_wrapper">
				<?=$sFormQuestion;?>
			</div>
		</div>
	</div>
<?endif;?>
