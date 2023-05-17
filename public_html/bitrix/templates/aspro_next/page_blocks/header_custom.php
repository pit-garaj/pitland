<?php

use Ninja\Helper\SeoBot;
use Ninja\Project\Regionality\Cities;
use Ninja\Project\Regionality\Regionality;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var object $APPLICATION */

global $arTheme, $arRegion;

/**
 * Регионы
 */
$arRegions = Regionality::getRegions();

/**
 *
 */
$bPhone = $arRegion ? (bool)$arRegion['PHONES'] : (bool)((int)$arTheme['HEADER_PHONES']);

/**
 * Определяет поискового бота по user agent
 */
$isBot = SeoBot::check();

/**
 *
 */
$city = Cities::getCityByHost();

/**
 *
 */
// $cityConfirmed = Regionality::getCityNameFromCookie(Regionality::COOKIE_CITY_CONFIRMED_CODE);
?>
<div class="top-block top-block-v1">
  <div class="maxwidth-theme">
    <div class="row">
      <?php /* ?>
      <div id="ownd-current-city">
        <a href="javascript:void(0)"><?=$city?></a>
        <div id="ownd-city-select">
            <?php $APPLICATION->IncludeComponent("bitrix:sale.location.selector.search", "city", Array(
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CODE" => "",
                "FILTER_BY_SITE" => "N",
                "ID" => "",
                "INITIALIZE_BY_GLOBAL_EVENT" => "",
                "INPUT_NAME" => "LOCATION",
                "JS_CALLBACK" => "",
                "JS_CONTROL_GLOBAL_ID" => "",
                "PROVIDE_LINK_BY" => "id",
                "SHOW_DEFAULT_LOCATIONS" => "N",
                "SUPPRESS_ERRORS" => "N"
            ));?>
        </div>

          <?php if (!$cityConfirmed):?>
            <div id="ownd-city-select-confirm">
              Ваш город - <?=$city?>
              <div>
                <a href="javascript:void(0)">Да</a>
                <a href="javascript:void(0)">Нет</a>
              </div>
            </div>
          <?php endif ?>
      </div>
      <? */ ?>

      <div class="col-md-6">
          <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
              "COMPONENT_TEMPLATE" => ".default",
              "PATH" => SITE_DIR."include/menu/menu.topest.php",
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "",
              "AREA_FILE_RECURSIVE" => "Y",
              "EDIT_TEMPLATE" => "include_area.php"
          ), false);?>
      </div>

      <div class="top-block-item pull-right show-fixed top-ctrl">
        <div class="personal_wrap">
          <div class="personal top login twosmallfont">
              <?=CNext::ShowCabinetLink(true, true);?>
          </div>
        </div>
      </div>

        <?php if ($arTheme['ORDER_BASKET_VIEW']['VALUE'] === 'NORMAL'): ?>
          <div class="top-block-item pull-right">
            <div class="phone-block">
                <?php if($bPhone): ?>
                  <div class="inline-block">
                    <div class="phone with_dropdown">
                      <i class="svg svg-phone"></i>
                      <a rel="nofollow" href="tel:+74953635299">+7 (495) 363 52 99</a>
                      <div class="dropdown">
                        <div class="wrap">
                          <div class="more_phone"><a rel="nofollow" href="tel:+79689984612"><i class="fa fa-whatsapp"></i> +7 (968) 998 46 12</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="inline-block">
                    <div class="phone">
                      <i class="svg svg-phone"></i>
                      <a rel="nofollow" href="tel:+78006005790">8 (800) 600 57 90</a>
                    </div>

                  </div>
                <?php endif ?>
                <?php if($arTheme['SHOW_CALLBACK']['VALUE'] === 'Y'): ?>
                  <div class="inline-block">
                    <!--<span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback"><?=GetMessage("CALLBACK")?></span>-->
                    <span style="cursor: pointer;" class="callback-block  colored ownd-call-jivo"><?=GetMessage("CALLBACK")?></span>
                  </div>
                <?php endif ?>
            </div>
          </div>
        <?php endif ?>
    </div>
  </div>
</div>
<div class="header-v3 header-wrapper">
  <div class="logo_and_menu-row">
    <div class="logo-row" style="background:#d4d4d4">
      <div class="maxwidth-theme" style="background:#d4d4d4">
        <div class="row">
          <div class="logo-block col-md-2 col-sm-3">
            <div class="logo">
                <?=CNext::ShowLogo()?>
            </div>
          </div>
            <?php if($arRegions): ?>
              <div class="inline-block pull-left">
                <div class="top-description">
                    <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => SITE_DIR."include/top_page/regionality.list.php",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "include_area.php"
                    ), false);?>
                </div>
              </div>
            <?php endif ?>
          <div class="pull-left search_wrap wide_search">
            <div class="search-block inner-table-block">
                <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/top_page/search.title.catalog.php",
                    "EDIT_TEMPLATE" => "include_area.php"
                )); ?>
            </div>
          </div>
            <?php if($arTheme['ORDER_BASKET_VIEW']['VALUE'] !== 'NORMAL'): ?>
              <div class="pull-right block-link">
                <div class="phone-block with_btn">
                    <?php if($bPhone): ?>
                      <div class="inner-table-block">
                          <?php CNext::ShowHeaderPhones(); ?>
                        <div class="schedule">
                            <?php $APPLICATION->IncludeFile(SITE_DIR."include/header-schedule.php", array(), array("MODE" => "html","NAME" => GetMessage('HEADER_SCHEDULE'),"TEMPLATE" => "include_area.php")); ?>
                        </div>
                      </div>
                    <?php endif ?>
                    <?php if($arTheme['SHOW_CALLBACK']['VALUE'] === 'Y'): ?>
                      <div class="inner-table-block">
                        <span class="callback-block animate-load twosmallfont colored  white btn-default btn" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback"><?=GetMessage("CALLBACK")?></span>
                      </div>
                    <?php endif ?>
                </div>
              </div>
            <?php endif ?>
          <div class="pull-right block-link">
              <?=CNext::ShowBasketWithCompareLink('with_price', 'big', true, 'wrap_icon inner-table-block baskets big-padding')?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="menu-row middle-block bg<?=strtolower($arTheme["MENU_COLOR"]["VALUE"]);?>">
    <div class="maxwidth-theme">
      <div class="row">
        <div class="col-md-12">
          <div class="menu-only">
            <nav class="mega-menu sliced">
                <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => SITE_DIR."include/menu/menu.top_catalog_wide.php",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "include_area.php"
                ), false, array("HIDE_ICONS" => "Y"));?>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="line-row visible-xs"></div>
</div>
