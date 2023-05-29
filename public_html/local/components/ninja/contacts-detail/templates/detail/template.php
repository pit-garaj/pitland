<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
/** @var object $APPLICATION */
?>

<?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => $arResult['path'] . "/templates/shared/map.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        'CITY' => $arResult['city'],
        'SHOPS_MAP' => $arResult['shopsMap'],
    ),
    false
); ?>

<?php if ($arResult['city']): ?>
  <div class="row1">
    <div class="contacts maxwidth-theme top-cart">
      <div class="cols-md-12" itemprop="description">
        <div class="contacts-shops">
            <?php foreach ($arResult['shops'] as $item): ?>
              <h2>Как добраться до «<?=$item['name']?>»</h2>
                <?php if ($item['route']): ?>
                <ul class="how-get-list unstyled clearfix" style="list-style: none;">
                    <?php foreach ($item['route'] as $route): ?>
                      <li class="col-xs-6 col-sm-4 how-get-list__item"><?=$route?></li>
                    <?php endforeach ?>
                </ul>
                <?php endif ?>

                <?php if ($item['detailPicture']['src']): ?>
                <div style="text-align: center; margin-top: 30px;">
                  <img alt="<?=$item['name']?>" src="<?=$item['detailPicture']['src']?>" style="display: block;width: auto;height: auto;max-width: 100%;margin: 0 auto;" title="<?=$item['name']?>" />
                    <?php if ($item['address']): ?>
                      <span style="font-size: 20px; text-align: Center; display: block; margin-top: 10px;"><?=$item['address']?></span>
                    <?php endif ?>
                    <?php if ($item['detailText']): ?><?=$item['detailText']?><?php endif ?>
                </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>

    <?php
    global $arTheme;

    Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("contacts-form-block");
    $APPLICATION->IncludeComponent("bitrix:form.result.new", "inline", Array(
        "WEB_FORM_ID" => "3",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "USE_EXTENDED_ERRORS" => "Y",
        "SEF_MODE" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600000",
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "?send=ok",
        "SHOW_LICENCE" => $arTheme["SHOW_LICENCE"]["VALUE"],
        "HIDDEN_CAPTCHA" => CNext::GetFrontParametrValue('HIDDEN_CAPTCHA'),
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "VARIABLE_ALIASES" => Array(
            "WEB_FORM_ID" => "WEB_FORM_ID",
            "RESULT_ID" => "RESULT_ID"
        )
    ));
    Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("contacts-form-block", "");
    ?>
<?php endif ?>

