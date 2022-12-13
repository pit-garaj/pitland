<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @var object $APPLICATION */
$APPLICATION->SetTitle("Кредит");
?>

<p>
	Вы оставляете свой номер телефона, мы перезванием и обговариваем с вами модель и стоимость товара, если вас устраивает наше предложение - с вами созванивается кредитный специалист и оформляет заявку на кредит или рассрочку. После подписания кредитного договора - можно забрать вашу покупку! Все это можно сделать он-лайн или непосредственно в нашем салоне!
</p>

<ul>
	<li>Переплата по Рассрочке 0% – 0 руб.</li>
	<li>Ставка по кредиту – от 12% годовых</li>
	<li>Первоначальный взнос по кредиту – от 0%</li>
	<li>Срок кредитования – до 84 месяцев</li>
	<li>Кредитный лимит -до 2 000 000 руб.</li>
</ul>


<p>
7 банков для подачи заявки:
</p>
<ul>
	<li>Альфа-Банк</li>
	<li>ОТП Банк</li>
	<li>Ренессанс Банк</li>
	<li>Кредит Европа Банк</li>
	<li>Почта-Банк</li>
	<li>ВТБ Банк</li>
	<li>Банк Оранжевый</li>
</ul>


<p>
	Гонять сейчас - плати потом!
</p>



<div style="width: 400px; margin: auto;">
<?php $APPLICATION->IncludeComponent(
	"bitrix:form",
	"popup",
	Array(
		"AJAX_MODE" => "Y",
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => 15,
		"START_PAGE" => "new",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"SUCCESS_URL" => "",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_STATUS" => "N",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "Y",
		"NOT_SHOW_FILTER" => "",
		"NOT_SHOW_TABLE" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SHOW_LICENCE" => CNext::GetFrontParametrValue('SHOW_LICENCE'),
		"HIDDEN_CAPTCHA" => CNext::GetFrontParametrValue('HIDDEN_CAPTCHA'),
		"VARIABLE_ALIASES" => Array(
			"action" => "action"
		)
	)
);?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
