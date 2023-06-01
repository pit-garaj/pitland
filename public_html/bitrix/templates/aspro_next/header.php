<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $GET */
/** @var array $MESS */
/** @var object $APPLICATION */

$isSubDomain = \Ninja\Project\Regionality\Cities::isSubDomain();
$curPage = $APPLICATION->GetCurPage(true);

if ($GET["debug"] === "y") {
    error_reporting(E_ERROR | E_PARSE);
}

IncludeTemplateLangFile(__FILE__);

global $APPLICATION, $arRegion, $arSite, $arTheme;
$arSite = CSite::GetByID(SITE_ID)->Fetch();
$htmlClass = ($_REQUEST && isset($_REQUEST['print']) ? 'print' : false);
$bIncludedModule = (Loader::includeModule("aspro.next"));?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" <?=($htmlClass ? 'class="'.$htmlClass.'"' : '')?>>
<head>
  <title><?php $APPLICATION->ShowTitle(); ?></title>
  <?php
  $APPLICATION->ShowMeta("viewport");
  $APPLICATION->ShowMeta("HandheldFriendly");
  $APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");
  $APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");
  $APPLICATION->ShowMeta("SKYPE_TOOLBAR");
  $APPLICATION->SetPageProperty('googlebot', 'noindex, nofollow');

  if ($isSubDomain) {
      Asset::getInstance()->addString('<meta name="googlebot" content="noindex, nofollow" />');
  }

  $APPLICATION->ShowHead();
  $APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject($MESS, false) . ')</script>', true);

  if ($bIncludedModule) {
      CNext::Start(SITE_ID);
  }
  ?>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-TBMXZS3');</script>
  <!-- End Google Tag Manager -->

	<?php
  Asset::getInstance()->addCss('/local/build/css/css.min.css');
  Asset::getInstance()->addJs('/local/build/js/js.min.js');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/jquery.webui-popover.css');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery-activity.min.js');
	?>
</head>
<body class="<?=($bIncludedModule ? "fill_bg_".strtolower(CNext::GetFrontParametrValue("SHOW_BG_BLOCK")) : "")?>" id="main">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBMXZS3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
	<?php if(!$bIncludedModule): ?>
		<?php $APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_ASPRO_NEXT_TITLE")); ?>
		<center><?php $APPLICATION->IncludeFile(SITE_DIR."include/error_include_module.php");?></center></body></html><?php die(); ?>
	<?php endif ?>

	<?$arTheme = $APPLICATION->IncludeComponent("aspro:theme.next", ".default", array("COMPONENT_TEMPLATE" => ".default"), false, array("HIDE_ICONS" => "Y"));?>
	<?include_once('defines.php');?>
	<?CNext::SetJSOptions();?>

	<div class="wrapper1 <?=($isIndex && $isShowIndexLeftBlock ? "with_left_block" : "");?> <?=CNext::getCurrentPageClass();?> <?=CNext::getCurrentThemeClasses();?>">
		<?CNext::get_banners_position('TOP_HEADER');?>

		<div class="header_wrap visible-lg visible-md title-v<?=$arTheme["PAGE_TITLE"]["VALUE"];?><?=($isIndex ? ' index' : '')?>">
			<header id="header">
				<?CNext::ShowPageType('header');?>
			</header>
		</div>
		<?CNext::get_banners_position('TOP_UNDERHEADER');?>

		<?if($arTheme["TOP_MENU_FIXED"]["VALUE"] == 'Y'):?>
			<div id="headerfixed">
				<?CNext::ShowPageType('header_fixed');?>
			</div>
		<?endif;?>

		<div id="mobileheader" class="visible-xs visible-sm">
			<?CNext::ShowPageType('header_mobile');?>
			<div id="mobilemenu" class="<?=($arTheme["HEADER_MOBILE_MENU_OPEN"]["VALUE"] == '1' ? 'leftside':'dropdown')?>">
				<?CNext::ShowPageType('header_mobile_menu');?>
			</div>
		</div>
		<div class="visible-xs visible-sm">
            <div class="lMobileHeaderPhone">
                <div class="lMobileHeaderPhone__item lMobileHeaderPhone__phone">
                    <div class="phone">
                        <i class="svg svg-phone"></i>
                        <a rel="nofollow" href="tel:+74953635299">+7 (495) 363 52 99</a>
                    </div>
                </div>
                <div class="lMobileHeaderPhone__item lMobileHeaderPhone__callback">
                    <span style="cursor: pointer;" class="callback-block  colored" onclick="jivo_api.open({start: 'call'});"><?=GetMessage("CALLBACK")?></span>
                </div>
            </div>
        </div>

		<?php /*filter for contacts*/
		if ($arRegion) {
			if($arRegion['LIST_STORES'] && !in_array('component', $arRegion['LIST_STORES'])) {
				if($arTheme['STORES_SOURCE']['VALUE'] != 'IBLOCK') {
            $GLOBALS['arRegionality'] = array('ID' => $arRegion['LIST_STORES']);
        }
				else {
            $GLOBALS['arRegionality'] = array('PROPERTY_STORE_ID' => $arRegion['LIST_STORES']);
        }
			}
		}
		if ($isIndex) {
			$GLOBALS['arrPopularSections'] = array('UF_POPULAR' => 1);
			$GLOBALS['arrFrontElements'] = array('PROPERTY_SHOW_ON_INDEX_PAGE_VALUE' => 'Y');
		}
    ?>
      <?php if (NINJA_SHOW_HEADER_BANNERS === true): ?>
          <?php $APPLICATION->IncludeComponent('ninja:header-banner', 'main', [], false); ?>
      <?php endif; ?>
		<div class="wraps hover_<?=$arTheme["HOVER_TYPE_IMG"]["VALUE"];?> <?$APPLICATION->ShowProperty('codePage')?>" id="content">
			<?php if (!$is404 && !$isForm && !$isIndex && NINJA_PAGE_LANDING !== true): ?>
				<?php $APPLICATION->ShowViewContent('section_bnr_content'); ?>
				<?php if ($APPLICATION->GetProperty("HIDETITLE") != 'Y'): ?>
					<!--title_content-->
					<?php CNext::ShowPageType('page_title'); ?>
					<!--end-title_content-->
				<?php endif; ?>
				<?php $APPLICATION->ShowViewContent('top_section_filter_content'); ?>
			<?php endif; ?>

			<?php if ($isIndex): ?>
				<div class="wrapper_inner front <?=($isShowIndexLeftBlock ? "" : "wide_page");?>">
			<?php elseif(!$isWidePage): ?>
				<div class="wrapper_inner <?=($isHideLeftBlock ? "wide_page" : "");?>">
			<?php endif; ?>

				<?if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
					<div class="right_block <?=(defined("ERROR_404") ? "error_page" : "");?> wide_<?=CNext::ShowPageProps("HIDE_LEFT_BLOCK");?>">
				<?endif;?>
					<div class="middle <?=($is404 ? 'error-page' : '');?>">
						<?CNext::get_banners_position('CONTENT_TOP');?>
						<?if(!$isIndex):?>
							<div class="container">
								<?//h1?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									<div class="maxwidth-theme">
								<?endif;?>
								<?if($isBlog):?>
									<div class="row">
										<div class="col-md-9 col-sm-12 col-xs-12 content-md <?=CNext::ShowPageProps("ERROR_404");?>">
								<?endif;?>
						<?endif;?>
						<?CNext::checkRestartBuffer();?>
