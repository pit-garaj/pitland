<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Интернет-магазин мототехники и запчастей в Москве");
$APPLICATION->SetPageProperty("viewed_show", "Y");
$APPLICATION->SetTitle("Интернет-магазин мототехники и запчастей");
?>



<?
if ( $_GET['NEW'] == 'Y' )
{
	?>
		<script>
		$( document ).ready(
			function ()
			{
				showPitbikePopup();
			}
		);
		</script>
	<?
}
?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>