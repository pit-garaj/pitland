<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent(
	"bitrix:eshop.socnet.links", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"FACEBOOK" => "",
		"VKONTAKTE" => "https://vk.com/pitbikeland_ru",
		"TWITTER" => "",
		"GOOGLE" => "https://youtube.com/pitbikeland.ru",
		"INSTAGRAM" => "https://instagram.com/pitbikeland"
	),
	false,
	array(
		"HIDE_ICONS" => "N"
	)
);?>


<!-- По умолчанию -->
<iframe src='/include/inwidget/index.php' scrolling='no' frameborder='no' style='margin-top:20px;border:none;width:260px;height:330px;overflow:hidden;'></iframe>