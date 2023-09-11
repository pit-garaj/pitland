<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
$iVisibleItemsMenu = ($arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] ? $arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] : 10);
?>
<?if($arResult):?>
	<div class="table-menu">
		<table>
			<tr>
				<?foreach($arResult as $arItem):?>
					<?$bShowChilds = $arParams["MAX_LEVEL"] > 1;
					$bWideMenu = $arItem["PARAMS"]['FROM_IBLOCK'];?>
					<td class="menu-item unvisible <?=($arItem["CHILD"] ? "dropdown" : "")?> <?=($bWideMenu ? 'wide_menu' : '');?> <?=(isset($arItem["PARAMS"]["CLASS"]) ? $arItem["PARAMS"]["CLASS"] : "");?>  <?=($arItem["SELECTED"] ? "active" : "")?>">
						<div class="wrap">
							<a class="<?=($arItem["CHILD"] && $bShowChilds ? "dropdown-toggle" : "")?> <?=( $arItem['TEXT'] == 'Супер скидки' ? 'ownd-menu-discount' : '' )?>" href="<?=$arItem["LINK"]?>">
								<div>
									<?=$arItem["TEXT"]?>
									<div class="line-wrapper"><span class="line"></span></div>
								</div>
							</a>
							<?if($arItem["CHILD"] && $bShowChilds):?>
								<span class="tail"></span>
								<ul class="dropdown-menu">
									<?foreach($arItem["CHILD"] as $arSubItem):?>
										<?$bShowChilds = $arParams["MAX_LEVEL"] > 2;?>
										<?$bHasPicture = (isset($arSubItem['PARAMS']['PICTURE']) && $arSubItem['PARAMS']['PICTURE'] && $arTheme['SHOW_CATALOG_SECTIONS_ICONS']['VALUE'] == 'Y');?>
										<li class="<?=($arSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubItem["SELECTED"] ? "active" : "")?> <?=($bHasPicture ? "has_img" : "")?>" <?if($arItem['LINK'] == '/catalog/tekhnika/'):?>style="text-align: center;"<?endif;?>>
											<?if($arItem['LINK'] == '/catalog/tekhnika/'):?>
                                                <a href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>">
                                                <?if($bHasPicture && $bWideMenu):
                                                    $arImg = CFile::ResizeImageGet($arSubItem['PARAMS']['PICTURE'], array('width' => 150, 'height' => 150), BX_RESIZE_PROPORTIONAL_ALT, true);
                                                    if(is_array($arImg)):?>
													
														<?
														$marginTop = ( 150 - $arImg['height'] ) / 2;
														?>
													
                                                        <div class="menu_img_big ownd-menu-img-fix"><img style="margin-top: <?=$marginTop?>px" src="<?=$arImg["src"]?>" alt="<?=$arSubItem["TEXT"]?>" title="<?=$arSubItem["TEXT"]?>" /></div>
                                                    <?endif;?>
                                                <?endif;?>
                                                <span class="name"><?=$arSubItem["TEXT"]?></span><?=($arSubItem["CHILD"] && $bShowChilds ? '<span class="arrow"><i></i></span>' : '')?></a>
                                            <?else:?>
                                                <?if($bHasPicture && $bWideMenu):
                                                    $arImg = CFile::ResizeImageGet($arSubItem['PARAMS']['PICTURE'], array('width' => 60, 'height' => 60), BX_RESIZE_PROPORTIONAL_ALT);
                                                    if(is_array($arImg)):?>
                                                        <div class="menu_img"><img src="<?=$arImg["src"]?>" alt="<?=$arSubItem["TEXT"]?>" title="<?=$arSubItem["TEXT"]?>" /></div>
                                                    <?endif;?>
                                                <?endif;?>
											    <a href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>"><span class="name"><?=$arSubItem["TEXT"]?></span><?=($arSubItem["CHILD"] && $bShowChilds ? '<span class="arrow"><i></i></span>' : '')?></a>
                                            <?endif;?>
                                            <?if($arSubItem["CHILD"] && $bShowChilds):?>
												<?$iCountChilds = count($arSubItem["CHILD"]);?>
												<ul class="dropdown-menu toggle_menu">
													<?foreach($arSubItem["CHILD"] as $key => $arSubSubItem):?>
														<?$bShowChilds = $arParams["MAX_LEVEL"] > 3;?>
														<li class="<?=(++$key > $iVisibleItemsMenu ? 'collapsed' : '');?> <?=($arSubSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubSubItem["SELECTED"] ? "active" : "")?>">
															<a href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>"><span class="name"><?=$arSubSubItem["TEXT"]?></span></a>
															<?if($arSubSubItem["CHILD"] && $bShowChilds):?>
																<ul class="dropdown-menu">
																	<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																		<li class="<?=($arSubSubSubItem["SELECTED"] ? "active" : "")?>">
																			<a href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>"><span class="name"><?=$arSubSubSubItem["TEXT"]?></span></a>
																		</li>
																	<?endforeach;?>
																</ul>

															<?endif;?>
														</li>
													<?endforeach;?>
													<?if($iCountChilds > $iVisibleItemsMenu && $bWideMenu):?>
														<li><span class="colored more_items with_dropdown"><?=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS");?></span></li>
													<?endif;?>
												</ul>
											<?endif;?>
										</li>
									<?endforeach;?>
                                    <?if($arItem['LINK'] == '/catalog/tekhnika/'):?>
                                    <ul class="brends-list-menu">
                                        <li><a href="/catalog/tekhnika/filter/brand-is-bse/apply/">BSE</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-jmc/apply/">JMC</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-motoland/apply/">MOTOLAND</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-kayo/apply/">KAYO</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-ycf/apply/">YCF</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-wels/apply/">WELS</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-avantis/apply/">AVANTIS</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-apollo/apply/">APOLLO</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-gr/apply/">GR</a></li>
                                        <li><a href="/catalog/tekhnika/filter/brand-is-zuum/apply/">ZUUM</a></li>
                                    </ul>
                                    <?endif;?>
								</ul>
							<?endif;?>
						</div>
					</td>
				<?endforeach;?>

				<td class="menu-item dropdown js-dropdown nosave unvisible">
					<div class="wrap">
						<a class="dropdown-toggle more-items" href="#">
							<span><?=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS");?></span>
						</a>
						<span class="tail"></span>
						<ul class="dropdown-menu"></ul>
					</div>
				</td>

			</tr>
		</table>
	</div>
<?endif;?>