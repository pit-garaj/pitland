<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? global $USER, $isShowSale, $isShowCatalogSections, $isShowCatalogElements, $isShowMiddleAdvBottomBanner, $isShowBlog; ?>

<? if ( /* $USER->IsAdmin() && */ $_GET['show'] === 'demo'): ?>

<? $APPLICATION->IncludeComponent(
    "aspro:com.banners.next",
    "top_one_banner_slick",
    array(
        "IBLOCK_TYPE" => "aspro_next_adv",
        "IBLOCK_ID" => "9",
        "TYPE_BANNERS_IBLOCK_ID" => "7",
        "SET_BANNER_TYPE_FROM_THEME" => "N",
        "NEWS_COUNT" => "10",
        "NEWS_COUNT2" => "4",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        "FIELD_CODE" => ['CODE'],
        "PROPERTY_CODE" => array(
            0 => "TEXT_POSITION",
            1 => "TARGETS",
            2 => "TEXTCOLOR",
            3 => "URL_STRING",
            4 => "BUTTON1TEXT",
            5 => "BUTTON1LINK",
            6 => "BUTTON2TEXT",
            7 => "BUTTON2LINK",
            8 => "",
        ),
        "CHECK_DATES" => "Y",
        "CACHE_GROUPS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "SITE_THEME" => $SITE_THEME,
        "BANNER_TYPE_THEME" => "TOP",
        "BANNER_TYPE_THEME_CHILD" => "TOP_SMALL_BANNER",
    ),
    false
); ?>

<?
/**
 * Популярные категории
 */
?>
<div class="grey_block">
    <div class="maxwidth-theme">
        <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR . "include/mainpage/comp_catalog_sections.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        ); ?>
    </div>
</div>


<?
/**
 * Акция
 */
?>
<div class="grey_block mBlockDlm">
    <div class="maxwidth-theme">
        <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR . "include/mainpage/comp_catalog_hit.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        ); ?>
    </div>
</div>


<?
/**
 * Наши преимущества
 */
?>
<div class="mAdvantages">
    <div class="maxwidth-theme">
        <div class="sections_wrapper">
            <div class="top_block">
                <h3 class="title_block">Наши преимущества</h3>
                <div class="mAdvantages__list">
                    <div class="row flexbox">
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="mAdvantages__icon maIcon">
                                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-trassa.png" /></div>
                                <div class="maIcon__desc"><b>Своя трасса</b> для тест драйва</div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="mAdvantages__icon maIcon">
                                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-delivery.png" /></div>
                                <div class="maIcon__desc"><b>Бесплатная доставка</b> по всей стране</div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="mAdvantages__icon maIcon">
                                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-service.png" /></div>
                                <div class="maIcon__desc">Профессиональный <b>мотосервис</b></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="mAdvantages__icon maIcon">
                                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-credit.png" /></div>
                                <div class="maIcon__desc">Индивидуальные <b>кредитные программы</b></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="mAdvantages__icon maIcon">
                                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-awards.png" /></div>
                                <div class="maIcon__desc">Премия <b>«Лучший Мотосалон»</b> Avantis, JMC, BSE</div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="mAdvantages__icon maIcon">
                                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-likes.png" /></div>
                                <div class="maIcon__desc"><b>Более 1000</b> довольных покупателей</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?
/**
 * Мы в инстаграме
 */
?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/mainpage/comp_instagramm.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
    ),
    false
); ?>


<?
/**
 * Акции
 */
?>
<div class="maxwidth-theme mBlockDlm">
    <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_news_akc.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>


<?
/**
 * Новости
 */
?>
<div class="maxwidth-theme mBlockDlm">
    <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_news.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>


<?
/**
 * Youtube
 */
?>
<div class="mBlockDlm">
	<? $APPLICATION->IncludeComponent("bitrix:news.list", "youtube", [
	    "IBLOCK_TYPE" => "aspro_next_content",
	    "IBLOCK_ID" => "29",
	    "NEWS_COUNT" => "4",
	    "SORT_BY1" => "ACTIVE_FROM",
	    "SORT_ORDER1" => "DESC",
	    "SORT_BY2" => "SORT",
	    "SORT_ORDER2" => "ASC",
	    "FIELD_CODE" => [
	        0 => "ID",
	        1 => "NAME",
	        2 => "PREVIEW_PICTURE",
	    ],
	    "PROPERTY_CODE" => [
	        0 => "VIDEO",
	        1 => "",
	    ],
	    "CHECK_DATES" => "Y",
	    "DETAIL_URL" => "",
	    "AJAX_MODE" => "N",
	    "AJAX_OPTION_JUMP" => "N",
	    "AJAX_OPTION_STYLE" => "Y",
	    "AJAX_OPTION_HISTORY" => "N",
	    "CACHE_TYPE" => "A",
	    "CACHE_TIME" => "36000000",
	    "CACHE_FILTER" => "Y",
	    "CACHE_GROUPS" => "N",
	    "PREVIEW_TRUNCATE_LEN" => "140",
	    "ACTIVE_DATE_FORMAT" => "j F Y",
	    "SET_TITLE" => "N",
	    "SET_STATUS_404" => "N",
	    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	    "ADD_SECTIONS_CHAIN" => "N",
	    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
	    "PARENT_SECTION" => "",
	    "PARENT_SECTION_CODE" => "",
	    "INCLUDE_SUBSECTIONS" => "Y",
	    "PAGER_TEMPLATE" => "",
	    "DISPLAY_TOP_PAGER" => "N",
	    "DISPLAY_BOTTOM_PAGER" => "N",
	    "PAGER_TITLE" => "",
	    "PAGER_SHOW_ALWAYS" => "N",
	    "PAGER_DESC_NUMBERING" => "N",
	    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	    "PAGER_SHOW_ALL" => "N",
	    "AJAX_OPTION_ADDITIONAL" => "",
	    "COMPONENT_TEMPLATE" => "front_akc",
	    "SET_BROWSER_TITLE" => "N",
	    "SET_META_KEYWORDS" => "N",
	    "SET_META_DESCRIPTION" => "N",
	    "FILTER_NAME" => "",
	    "TITLE_BLOCK" => "Наш Youtube-канал",
	    "SET_LAST_MODIFIED" => "N",
	    "ALL_URL" => "sale/",
	    "PAGER_BASE_LINK_ENABLE" => "N",
	    "SHOW_404" => "N",
	    "MESSAGE_404" => "",
	    "TITLE_BLOCK_ALL" => "Больше видео",
	    "YOUTUBE_CHANEL_LINK" => "https://www.youtube.com/channel/UCM-bKfBFe5PJgTh94lCoijw/videos",
	    "ICON_CLASS" => "mTitleBlock__youtube",
	    "DISPLAY_DATE" => "Y"
	], false, ["ACTIVE_COMPONENT" => "Y"]); ?>
</div>


<?
/**
 * О нас
 */
?>
<div class="mAboutIndex">
    <div class="maxwidth-theme">
        <div class="sections_wrapper">
            <div class="row flexbox">
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div class="mAboutIndex__text">
                        <h3 class="title_block">О нас</h3>
                        <p>Ты можешь положиться на наше экспертное мнение, ведь для нас работа – это любимое дело. Создавая PITLAND, мы сделали самую крутую и удобную сеть магазинов питбайков в России. Место, где не просто есть все для питбайкера, но и куда нам самим было приятно приходить каждый день. На работу нашей мечты, в идеальный магазин питбайков.</p>
                        <p>Нам приятно осознавать, что в стенах нашего шоу рума, среди грубого дерева, хулиганских скетчей на стенах, яркой и четкой экипировки, запчастей и питбайков рождается интерес к нашей теме у начинающих спортсменов. Для тех же, кто давно в теме, наших старых друзей – это атмосферное место, куда они приходят как в любимый бар или гараж. Что-то купить и пообщаться, решить свои проблемы с техникой, узнать новости и «позалипать» на новый экип или видео на мониторах.<br /></p>
                        <p><a href="">Подробнее</a></p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12 mAboutIndex__team-block">
                    <div class="mAboutIndex__team-img"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?
/**
 * Запись на сервис
 */
?>
<? $APPLICATION->IncludeComponent('ninja:feed_back', 'main', [], false); ?>


<?
/**
 * Карта
 */
?>
<? include_once('contacts/page_contacts_index.php'); ?>


<? else: ?>

<? $APPLICATION->IncludeComponent(
    "aspro:com.banners.next",
    "top_one_banner",
    array(
        "IBLOCK_TYPE" => "aspro_next_adv",
        "IBLOCK_ID" => "9",
        "TYPE_BANNERS_IBLOCK_ID" => "7",
        "SET_BANNER_TYPE_FROM_THEME" => "N",
        "NEWS_COUNT" => "10",
        "NEWS_COUNT2" => "4",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        "PROPERTY_CODE" => array(
            0 => "TEXT_POSITION",
            1 => "TARGETS",
            2 => "TEXTCOLOR",
            3 => "URL_STRING",
            4 => "BUTTON1TEXT",
            5 => "BUTTON1LINK",
            6 => "BUTTON2TEXT",
            7 => "BUTTON2LINK",
            8 => "",
        ),
        "CHECK_DATES" => "Y",
        "CACHE_GROUPS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "SITE_THEME" => $SITE_THEME,
        "BANNER_TYPE_THEME" => "TOP",
        "BANNER_TYPE_THEME_CHILD" => "TOP_SMALL_BANNER",
    ),
    false
); ?>


<? /*
<div class="grey_block small-padding">
    <div class="maxwidth-theme">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_adv_middle.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );?>

    </div>
    <hr>
</div>
*/ ?>


<div class="grey_block">
    <div class="maxwidth-theme">
        <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR . "include/mainpage/comp_catalog_hit.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        ); ?>
    </div>
</div>


<div class="maxwidth-theme">
    <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_news_akc.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>

<div class="grey_block">
    <div class="maxwidth-theme">
        <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR . "include/mainpage/comp_catalog_sections.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        ); ?>
    </div>
</div>

<? if ($isShowBlog): ?>
    <div class="maxwidth-theme">
        <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR . "include/mainpage/comp_blog.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        ); ?>
    </div>
<? endif; ?>


<div class="maxwidth-theme">
    <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_instagramm.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>


<? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/mainpage/comp_bottom_banners.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
    ),
    false
); ?>

<div class="maxwidth-theme">

    <? global $arRegion, $isShowCompany; ?>
    <div class="company_bottom_block">
        <div class="row wrap_md">
            <div class="col-md-3 col-sm-3 hidden-xs img">
                <? $APPLICATION->IncludeFile(SITE_DIR . "include/mainpage/company/front_img.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("FRONT_IMG"))); ?>
            </div>
            <div class="col-md-9 col-sm-9 big">
                <? if ($arRegion): ?>
                    <?= $arRegion['DETAIL_TEXT']; ?>
                <? else: ?>
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "front", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/mainpage/company/front_info.php", "EDIT_TEMPLATE" => "")); ?>
                <? endif; ?>
            </div>
        </div>
    </div>


    <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_brands.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>

<div class="maxwidth-theme">
    <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_news.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>
<? endif; ?>