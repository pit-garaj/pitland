<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arTheme */
/** @var object $APPLICATION */
?>
<div class="footer_inner <?=($arTheme["SHOW_BG_BLOCK"]["VALUE"] === "Y" ? "fill" : "no_fill")?> footer-light ext_view">
	<div class="bottom_wrapper">
		<div class="wrapper_inner">
			<div class="row bottom-middle">
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<?php $APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
								"ROOT_MENU_TYPE" => "bottom_company",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "3600000",
								"MENU_CACHE_USE_GROUPS" => "N",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y"
								),
								false
							);?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php $APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
								"ROOT_MENU_TYPE" => "bottom_info",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "3600000",
								"MENU_CACHE_USE_GROUPS" => "N",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y"
								),
								false
							);?>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php $APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
								"ROOT_MENU_TYPE" => "bottom_help",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "3600000",
								"MENU_CACHE_USE_GROUPS" => "N",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y"
								),
								false
							);?>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-sm-6">
							<?php $APPLICATION->IncludeComponent("bitrix:main.include", ".default",
								array(
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => SITE_DIR."include/left_block/comp_subscribe.php",
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_TEMPLATE" => "standard.php"
								),
								false
							);?>
							<div class="social-block rounded_block">
								<?php $APPLICATION->IncludeComponent(
									"aspro:social.info.next",
									".default",
									array(
										"CACHE_TYPE" => "A",
										"CACHE_TIME" => "3600000",
										"CACHE_GROUPS" => "N",
										"COMPONENT_TEMPLATE" => ".default",
										"SOCIAL_TITLE" => GetMessage("SOCIAL_TITLE")
									),
									false
								);?>
							</div>
						</div>
            <div class="col-lg-6 col-md-12 col-sm-4 col-sm-offset-2">
                <?php $APPLICATION->IncludeComponent('ninja:layout-contacts', 'footer', [], false); ?>
            </div>
					</div>
				</div>
			</div>
			<div class="bottom-under">
				<div class="row">
					<div class="col-md-12 outer-wrapper">
						<div class="inner-wrapper row">
							<div class="copy-block">
								<div class="copy">
									<?php $APPLICATION->IncludeFile(SITE_DIR."include/footer/copy/copyright.php", Array(), Array(
											"MODE" => "php",
											"NAME" => "Copyright",
											"TEMPLATE" => "include_area.php",
										)
									);?>
								</div>
								<div class="print-block"><?=CNext::ShowPrintLink();?></div>
								<div id="bx-composite-banner"></div>
							</div>
							<div class="pull-right pay_system_icons">
								<span class="">
									<?php $APPLICATION->IncludeFile(SITE_DIR."include/footer/copy/pay_system_icons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE"), "TEMPLATE" => "include_area.php",));?>
								</span>
                <iframe src="https://yandex.ru/sprav/widget/rating-badge/179404829137" width="150" height="50" frameborder="0"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
