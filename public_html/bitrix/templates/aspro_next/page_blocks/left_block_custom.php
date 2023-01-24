<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? global $arTheme, $APPLICATION; ?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/left_block/menu.left_menu.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "include_area.php"
    ),
    false
); ?>

<? $APPLICATION->ShowViewContent('left_menu'); ?>
<? $APPLICATION->ShowViewContent('under_sidebar_content'); ?>

<? CNext::get_banners_position('SIDE', 'Y'); ?>

<? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/left_block/comp_subscribe.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "include_area.php"
    ),
    false
); ?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/left_block/comp_news.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "include_area.php"
    ),
    false
); ?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR . "include/left_block/comp_news_articles.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "include_area.php"
    ),
    false
); ?>
<!--
<div class="block text-center">
    <a href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/463292/reviews"><img
                src="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2507/*https://grade.market.yandex.ru/?id=463292&action=image&size=3"
                border="0" width="200" height="125"
                alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете"/></a>
</div>
-->