<?php
define('NINJA_SHOW_HEADER_BANNERS', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @var object $APPLICATION */

$APPLICATION->SetPageProperty("title", "Интернет-магазин мототехники и запчастей в Москве");
$APPLICATION->SetPageProperty("viewed_show", "Y");
$APPLICATION->SetTitle("Интернет-магазин мототехники и запчастей");

$APPLICATION->IncludeComponent('ninja:landing', 'main', [], false);
?>

<?php if ($_GET['NEW'] === 'Y'): ?>
  <script>
  $(document).ready(function () {
    showPitbikePopup();
  });
  </script>
<?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
