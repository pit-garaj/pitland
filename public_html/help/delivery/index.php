<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @var object $APPLICATION */

$APPLICATION->IncludeComponent('ninja:landing', 'main', [], false);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
