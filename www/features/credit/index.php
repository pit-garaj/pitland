<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @var object $APPLICATION */
$APPLICATION->SetTitle("Кредит");
?>
<p>
  Вы оставляете свой номер телефона, мы перезванием и обговариваем с вами модель и стоимость товара,
  если вас устраивает наше предложение - с вами созванивается кредитный специалист и оформляет
  заявку на кредит или рассрочку. После подписания кредитного договора - можно забрать вашу покупку!
  Все это можно сделать он-лайн или непосредственно в нашем салоне!
</p>
<p>Условия по <u>рассрочке</u>:</p>
<ul>
  <li>Первоначальный взнос - 50%, оставшуюся сумму выплачиваете равными долями на 6 месяцев без
    переплат.
  </li>
  <li>Переплата по Рассрочке 0% – 0 руб.</li>
</ul>

<p>Условия по <u>кредиту</u>:</p>
<ul>
  <li>Ставка по кредиту – от 17% годовых.</li>
  <li>Первоначальный взнос по кредиту – от 0%.</li>
  <li>Срок кредитования – до 36 месяцев.</li>
  <li>Кредитный лимит - до 2 000 000 руб.</li>
</ul>

<p>4 банка для подачи заявки:</p>
<ul>
  <li>ОТП Банк</li>
  <li>Ренессанс Банк</li>
  <li>Кредит Европа Банк</li>
  <li>Почта-Банк</li>
</ul>

<p>Гонять сейчас - плати потом!</p>

<div style="width: 400px; margin: auto;">
    <?php $APPLICATION->IncludeComponent(
        "bitrix:form",
        "popup",
        array(
            "AJAX_MODE"              => "Y",
            "AJAX_OPTION_HISTORY"    => "N",
            "AJAX_OPTION_JUMP"       => "N",
            "AJAX_OPTION_STYLE"      => "Y",
            "CACHE_GROUPS"           => "N",
            "CACHE_TIME"             => "3600000",
            "CACHE_TYPE"             => "A",
            "CHAIN_ITEM_LINK"        => "",
            "CHAIN_ITEM_TEXT"        => "",
            "EDIT_ADDITIONAL"        => "N",
            "EDIT_STATUS"            => "Y",
            "HIDDEN_CAPTCHA"         => CNext::GetFrontParametrValue('HIDDEN_CAPTCHA'),
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "NOT_SHOW_FILTER"        => "",
            "NOT_SHOW_TABLE"         => "",
            "SEF_MODE"               => "N",
            "SHOW_ADDITIONAL"        => "N",
            "SHOW_ANSWER_VALUE"      => "N",
            "SHOW_EDIT_PAGE"         => "N",
            "SHOW_LICENCE"           => CNext::GetFrontParametrValue('SHOW_LICENCE'),
            "SHOW_LIST_PAGE"         => "N",
            "SHOW_STATUS"            => "N",
            "SHOW_VIEW_PAGE"         => "N",
            "START_PAGE"             => "new",
            "SUCCESS_URL"            => "",
            "USE_EXTENDED_ERRORS"    => "Y",
            "VARIABLE_ALIASES"       => array("action" => "action"),
            "WEB_FORM_ID"            => 15
        )
    ); ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
