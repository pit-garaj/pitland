<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @var object $APPLICATION */
$APPLICATION->SetTitle("Контакты");
$APPLICATION->IncludeComponent('ninja:contacts-detail', 'detail', [], false);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
