<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);
define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");

/** @var object $APPLICATION */
?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?php
$form_id = $_REQUEST["form_id"] ?? 1;
if (Loader::includeModule("aspro.next")) {
    global $arRegion;
    if (!$arRegion) {
        $arRegion = CNextRegionality::getCurrentRegion();
    }
    CNext::GetValidFormIDForSite($form_id);
}
$url_sizes = htmlspecialchars($_REQUEST['url']) ?: '';
?>
<?php if ($form_id === 'fast_view'): ?>
    <?php include('fast_view.php'); ?>
<?php elseif ($form_id === 'city_chooser'): ?>
    <?php include('city_chooser.php'); ?>
<?php elseif ($form_id === 'subscribe'): ?>
    <?php include('subscribe.php'); ?>
<?php elseif ($form_id === 'TABLES_SIZE' && $url_sizes): ?>
    <a href="#" class="close jqmClose"><i></i></a>
    <div class="form">
        <div class="form_head">
            <h2><?=Loc::getMessage('TABLES_SIZE_TITLE');?></h2>
        </div>
        <div class="form_body">
            <?php include('../' . $url_sizes); ?>
        </div>
    </div>
<?php elseif (isset($_REQUEST['type']) && $_REQUEST['type'] === 'auth'): ?>
    <?php include_once('auth.php'); ?>
<?php elseif ($form_id !== 'one_click_buy'): ?>
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:form",
        "popup",
        [
            "AJAX_MODE"              => "Y",
            "SEF_MODE"               => "N",
            "WEB_FORM_ID"            => $form_id,
            "START_PAGE"             => "new",
            "SHOW_LIST_PAGE"         => "N",
            "SHOW_EDIT_PAGE"         => "N",
            "SHOW_VIEW_PAGE"         => "N",
            "SUCCESS_URL"            => "",
            "SHOW_ANSWER_VALUE"      => "N",
            "SHOW_ADDITIONAL"        => "N",
            "SHOW_STATUS"            => "N",
            "EDIT_ADDITIONAL"        => "N",
            "EDIT_STATUS"            => "Y",
            "NOT_SHOW_FILTER"        => "",
            "NOT_SHOW_TABLE"         => "",
            "CHAIN_ITEM_TEXT"        => "",
            "CHAIN_ITEM_LINK"        => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS"    => "Y",
            "CACHE_GROUPS"           => "N",
            "CACHE_TYPE"             => "A",
            "CACHE_TIME"             => "3600000",
            "AJAX_OPTION_JUMP"       => "N",
            "AJAX_OPTION_STYLE"      => "Y",
            "AJAX_OPTION_HISTORY"    => "N",
            "SHOW_LICENCE"           => CNext::GetFrontParametrValue('SHOW_LICENCE'),
            "HIDDEN_CAPTCHA"         => CNext::GetFrontParametrValue('HIDDEN_CAPTCHA'),
            "VARIABLE_ALIASES"       => [
                "action" => "action"
            ]
        ]
    ); ?>
<?php endif; ?>
