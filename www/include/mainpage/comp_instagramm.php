<?$bAjaxMode = (isset($_POST["AJAX_REQUEST_INSTAGRAM"]) && $_POST["AJAX_REQUEST_INSTAGRAM"] == "Y");
if($bAjaxMode)
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("");
	global $APPLICATION;
	\Bitrix\Main\Loader::includeModule("aspro.next");
	$bInstagrammIndex = (isset($_POST["SHOW_INSTAGRAM"]) && $_POST["SHOW_INSTAGRAM"] == 'Y');
}?>
<?global $bInstagrammIndex;?>
<?if($bInstagrammIndex):?>
	<?$APPLICATION->IncludeComponent(
	"aspro:instargam.next", 
	"clients_only", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"TITLE" => "Мы в инстаграме",
		"TOKEN" => "4956032222.afe4c81.92cad1f1519145e8bacd24cf38cf54f6",
		"COMPONENT_TEMPLATE" => "clients_only"
	),
	false
);?>
<?endif;?>
