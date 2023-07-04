<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<?php
/** @var object $APPLICATION */

global $USER, $isShowSale, $isShowCatalogSections, $isShowCatalogElements, $isShowMiddleAdvBottomBanner, $isShowBlog;
?>

<?php
/*$APPLICATION->IncludeComponent(
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
);*/ ?>

<?php
/**
 * Популярные категории
 */
?>
<div class="grey_block">
    <div class="maxwidth-theme">
        <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
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


<?php
/**
 * Акция
 * Распродажа
 */
?>
<div class="grey_block mBlockDlm">
    <div class="maxwidth-theme">
        <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
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
		
		<br /><br />
		
		<?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR . "include/mainpage/discount.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        ); ?>
    </div>
</div>

<?php
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
                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-delivery.png" alt="" /></div>
                <div class="maIcon__desc"><b>Доставка</b> по всей стране</div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
              <div class="mAdvantages__icon maIcon">
                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-service.png" alt="" /></div>
                <div class="maIcon__desc">Профессиональный <b>мотосервис</b></div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
              <div class="mAdvantages__icon maIcon">
                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-credit.png" alt="" /></div>
                <div class="maIcon__desc">Индивидуальные <b>кредитные программы</b></div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
              <div class="mAdvantages__icon maIcon">
                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-awards.png" alt="" /></div>
                <div class="maIcon__desc">Премия <b>«Лучший Мотосалон»</b> Avantis, JMC, BSE</div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
              <div class="mAdvantages__icon maIcon">
                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-likes.png" alt="" /></div>
                <div class="maIcon__desc"><b>Более 1000</b> довольных покупателей</div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
              <div class="mAdvantages__icon maIcon">
                <div class="maIcon__image"><img src="/local/build/img/advantages/ico-service.jpg" alt="" /></div>
                <div class="maIcon__desc"><b>Премиальная</b> сборка</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
/**
 * Мы в инстаграме
 */
?>
<?php /* $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/mainpage/comp_instagramm.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
    ),
    false
); */?>


<?php
/**
 * Акции
 */
?>
<div class="maxwidth-theme mBlockDlm">
    <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
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


<?php
/**
 * Новости
 */
?>
<div class="maxwidth-theme mBlockDlm">
    <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
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


<?php
/**
 * Youtube
 */
?>
<div class="mBlockDlm youtube_video">
    <?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR . "include/mainpage/comp_youtube.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    ); ?>
</div>


<?php
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
                        <p><a href="/company/">Подробнее</a></p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12 mAboutIndex__team-block">
                    <div class="mAboutIndex__team-block">
                        <img src="/local/build/img/about/team.jpg" class="img-responsive" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
/**
 * Запись на сервис
 */
?>
<?php $APPLICATION->IncludeComponent('ninja:feed_back', 'main', [], false); ?>


<?php
/**
 * Карта
 */
?>
<?php
$APPLICATION->IncludeComponent('ninja:contacts-detail', 'map', [], false);
?>
