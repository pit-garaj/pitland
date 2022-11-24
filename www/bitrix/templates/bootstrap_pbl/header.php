<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
CJSCore::Init(array("jquery2", "fx"));
$curPage = $APPLICATION->GetCurPage(true);
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
    <?
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/imagesloaded.pkgd.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/nprogress.js");

    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/colors.css", true);
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/nprogress.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font-awesome.min.css");
    //$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
    //$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
    Asset::getInstance()->addCss("https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext");
    Asset::getInstance()->addCss("https://fonts.googleapis.com/css?family=Oswald:300,400&amp;subset=cyrillic");
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
</head>
<body style="margin-top: 61px;">
<div id="panel" style="display: none;"><? $APPLICATION->ShowPanel(); ?></div>
<nav class="navbar navbar-default navbar-fixed-top">


    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "mega_1_09_test",
        array(
            "ROOT_MENU_TYPE" => "left",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_THEME" => "site",
            "CACHE_SELECTED_ITEMS" => "N",
            "MENU_CACHE_GET_VARS" => array(),
            "MAX_LEVEL" => "3",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N",
            "COMPONENT_TEMPLATE" => "catalog_horizontal_lvl3"
        ),
        false
    ); ?>

</nav>
<div class="row" style="display: none;">
    <div class="col-md-12 hidden-xs text-center" style="background: black;">
        <span style="vertical-align: middle;font-size: 20px;"><a
                    href="tel:+79850556788">+7 (985) 055 67 88</a></span><img style="height: 24px; padding-left: 10px;"
                                                                              src="/images/Messengers3.png">
        <a href="<?= SITE_DIR ?>"><img src="/bitrix/templates/bootstrap_pbl/images/logoheader.png"
                                       style="width: 400px;padding: 10px;"></a>
        <span style="vertical-align: middle;font-size: 20px;"><a href="tel:+74953635299">+7 (495) 363 52 99</a></span>
    </div>
</div>


<div class="row visible-xs">
    <div class="visible-xs col-xs-12">
        <div class="bx-logo">
            <a href="<?= SITE_DIR ?>"><img style="padding-top: 3px;"
                                           src="/bitrix/templates/bootstrap_pbl/images/logoheader.png"></a>
        </div>
    </div>
    <div data-toggle="collapse" data-target="#mob-input-search" id="mob-search" style="
        font-size: 28px;
        position: fixed;
        width: 40px;
        height: 40px;
        top: 5px;
        right: 5px;
        line-height: 40px;
        cursor: pointer;
        z-index: 1750;
        color: #fff;
        text-align: center;">
        <i class="fa fa-search" aria-hidden="true"></i>
    </div>


    <div class="collapse" id="mob-input-search" style="
    position: fixed;
    height: 50px;
    left: 0;
    right: 0;
    top: 50px;
    z-index: 1400;">
        <? $APPLICATION->IncludeComponent("bitrix:search.title", "mob-search", Array(
            "NUM_CATEGORIES" => "1",    // Количество категорий поиска
            "TOP_COUNT" => "5",    // Количество результатов в каждой категории
            "CHECK_DATES" => "N",    // Искать только в активных по дате документах
            "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
            "PAGE" => "",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
            "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),    // Название категории
            "CATEGORY_0" => array(    // Ограничение области поиска
                0 => "iblock_1c_catalog",
            ),
            "CATEGORY_0_iblock_catalog" => array(
                0 => "all",
            ),
            "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
            "SHOW_INPUT" => "Y",    // Показывать форму ввода поискового запроса
            "INPUT_ID" => "search-mob",    // ID строки ввода поискового запроса
            "CONTAINER_ID" => "sb-search-mob",    // ID контейнера, по ширине которого будут выводиться результаты
            "PRICE_CODE" => array(
                0 => "Основной тип цен продажи",
            ),
            "SHOW_PREVIEW" => "Y",
            "PREVIEW_WIDTH" => "75",
            "PREVIEW_HEIGHT" => "75",
            "CONVERT_CURRENCY" => "N",
            "ORDER" => "date",    // Сортировка результатов
            "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
            "PRICE_VAT_INCLUDE" => "Y",
            "PREVIEW_TRUNCATE_LEN" => "",
            "CATEGORY_0_iblock_offers" => array(
                0 => "all",
            ),
            "CATEGORY_0_iblock_1c_catalog" => array(    // Искать в информационных блоках типа "iblock_1c_catalog"
                0 => "5",
                1 => "6",
            )
        ),
            false
        ); ?>
    </div>


</div>


<div class="bx-wrapper" id="bx_eshop_wrap">
    <? if ($curPage != SITE_DIR . "index.php"): ?>
        <header class="bx-header">
            <div class="bx-header-section">
                <div class="row">
                    <div class="col-lg-12" id="navigation">
                        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => "-"
                        ),
                            false,
                            Array('HIDE_ICONS' => 'Y')
                        ); ?>
                    </div>
                </div>
                <? if (!CSite::InDir('/catalog/')): ?>
                    <h1 class="bx-title dbg_title" id="pagetitle"><?= $APPLICATION->ShowTitle(false); ?></h1>
                <? endif ?>
            </div>
        </header>
    <? endif ?>
    <div class="<? if ($curPage != SITE_DIR . "index.php"): ?>workarea<? endif ?>">
        <div class="">
            <div class="row">
                <? $needSidebar = preg_match("~^" . SITE_DIR . "(catalog|personal\/cart|personal\/order\/make)/~", $curPage); ?>
                <div class="bx-content <? if ($needSidebar || ($APPLICATION->GetCurPage(false) === '/')): ?> col-xs-12 <? else: ?> col-md-9 col-sm-8 col-lg-10<? endif; ?>">