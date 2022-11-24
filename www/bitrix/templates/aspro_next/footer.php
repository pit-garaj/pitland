						<?CNext::checkRestartBuffer();?>
						<?IncludeTemplateLangFile(__FILE__);?>
							<?if(!$isIndex):?>
								<?if($isBlog):?>
									</div> <?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
									<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
										<div class="sidearea">
											<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
											<?CNext::get_banners_position('SIDE', 'Y');?>
											<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "sidebar", "AREA_FILE_RECURSIVE" => "Y"), false);?>
										</div>
									</div>
								</div><?endif;?>
								<?if($isHideLeftBlock):?>
									</div> <?// .maxwidth-theme?>
								<?endif;?>
								</div> <?// .container?>
							<?else:?>
								<?CNext::ShowPageType('indexblocks');?>
							<?endif;?>
							<?CNext::get_banners_position('CONTENT_BOTTOM');?>
						</div> <?// .middle?>
					<?//if(!$isHideLeftBlock && !$isBlog):?>
					<?if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
						</div> <?// .right_block?>				
						<?if($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" && !defined("ERROR_404")):?>
							<div class="left_block">
								<?CNext::ShowPageType('left_block');?>
							</div>
						<?endif;?>
					<?endif;?>
				<?if($isIndex):?>
					</div>
				<?elseif(!$isWidePage):?>
					</div> <?// .wrapper_inner?>				
				<?endif;?>
			</div> <?// #content?>
			<?CNext::get_banners_position('FOOTER');?>
		</div><?// .wrapper?>
		<footer id="footer">
			<?if($APPLICATION->GetProperty("viewed_show") == "Y" || $is404):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					"basket", 
					array(
						"COMPONENT_TEMPLATE" => "basket",
						"PATH" => SITE_DIR."include/footer/comp_viewed.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "standard.php",
						"PRICE_CODE" => array(
							0 => "BASE",
						),
						"STORES" => array(
							0 => "",
							1 => "",
						),
						"BIG_DATA_RCM_TYPE" => "bestsell"
					),
					false
				);?>					
			<?endif;?>
			<?CNext::ShowPageType('footer');?>




		</footer>
		<div class="bx_areas">
			<?CNext::ShowPageType('bottom_counter');?>


		</div>
		<?CNext::ShowPageType('search_title_component');?>
		<?CNext::setFooterTitle();
		CNext::showFooterBasket();?>
		
		
		
		
		<div class="trck-bg" >
			<div class="trck-win">
				<div class="trck-cross" onClick="javascript:hidePitbikePopup();"></div>
				<div class="trck-load">
					<div class="trck-circle trck-moto win-active">
						<div></div>
					</div>
						<span></span>
					<div class="trck-circle trck-exp">
						<div></div>
					</div>
						<span></span>
					<div class="trck-circle trck-he">
						<div></div>
					</div>
						<span></span>
					<div class="trck-circle trck-road">
						<div></div>
					</div>
						<span></span>
					<div class="trck-circle trck-cont">
						<div></div>
					</div>
				</div>
				<div class="trck-steps">
					<div class="trck-step trck-step-1">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>ХОЧЕШЬ</br>ПИТБАЙК?</p></div>
						<div class="trck-content">
							<a href="javascript:step1Yes();">ДА</a>
							<a href="javascript:step1No();">НЕТ</a>
						</div>
					</div>
					<div class="trck-step trck-step-2">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>ОТЛИЧНО,<br />Я ПОМОГУ!</p></div>
						<div class="trck-content">
							<a href="javascript:toStep3();" data-value="noexp">МОЙ ПЕРВЫЙ ПИТБАЙК!</a>
							<a href="javascript:toStep3();" data-value="exp">Я ОПЫТНЫЙ РАЙДЕР</a>
						</div>
					</div>
					<div class="trck-step trck-step-3">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>КАКОГО<br />ТЫ РОСТА?</p></div>
						<div class="trck-content">
							<label class="trck-checkbox"> 90-140
								<input type="checkbox" value="low">
								<span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox"> 140-170
							  <input type="checkbox" value="mid">
							  <span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox"> ОТ 170
							  <input type="checkbox" value="high">
							  <span class="trck-checkmark"></span>
							</label>
						</div>
					</div>
					<div class="trck-step trck-step-4">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>ГДЕ БУДЕШЬ<br />КАТАТЬ?</p></div>
						<div class="trck-content">
							<a href="javascript:toStep5();" data-value="offroad">НА ДАЧЕ</a>
							<a href="javascript:toStep5();" data-value="road">КРОСС ТРАССА</a>
						</div>
					</div>
					<div class="trck-step trck-step-5">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>МЫ ПОЧТИ<br />У ЦЕЛИ!</p></div>
						<div class="trck-content">
							<div class="trck-form">
								<p>ЗАПОЛНИ ФОРМУ</p>
								<input placeholder="ТВОЕ ИМЯ" id="ownd-form-name" />
								<input placeholder="ТЕЛЕФОН" id="ownd-form-phone" />
								<a href="javascript:checkForm();">ЗАВЕРШИТЬ ПОДБОР</a>
								<label class="trck-checkbox">Согласен на обработку своих персональных данных
									<input type="checkbox" id="ownd-form-agree" checked>
									<span class="trck-checkmark"></span>
								</label>
							</div>
							<div class="trck-cont">
							<p>И ПОЛУЧИ:</p>
								<div class="trck-cont-text"><span>– подбор</span> байка</div>
								<div class="trck-border">---------------------</div>
								<div class="trck-cont-text"><span>– клубную</span> карту со скидками и доступом на нашу трассу</div>
								<div class="trck-border">------------------------------------</div>
								<div class="trck-cont-text"><span>– бесплатный</span> урок езды на пите от нашего инструктора</div>
								<div class="trck-border">------------------------------------</div>
								<div class="trck-cont-text"><span>– бесплатную</span> доставку твоего байка по всей стране*</div>
								<div class="trck-border">------------------------------------</div>
								<div class="ownd-timer">
									<div class="ownd-timer-block">
										<div class="ownd-timer-block-title">минуты</div>
										<div class="ownd-timer-block-digits ownd-timer-minutes">
											<span>0</span>
											<span>0</span>
											<div></div>
										</div>
									</div>
									<div class="ownd-timer-block">
										<div class="ownd-timer-block-title">секунды</div>
										<div class="ownd-timer-block-digits ownd-timer-seconds">
											<span>2</span>
											<span>0</span>
											<div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="trck-step trck-step-6">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>КАК ЖАЛЬ, Я БУДУ</br>ЖДАТЬ, ЕСЛИ</br>ПЕРЕДУМАЕШЬ</p></div>
						<div class="trck-content">
							<a href="javascript:toStep2();">ЛАДНО, Я РЕШИЛСЯ!</a>
						</div>
					</div>
					<div class="trck-step trck-step-7">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>А ТЫ ТОЧНО</br>ПИТБАЙКЕР?</p></div>
						<div class="trck-content">
							<a href="javascript:toStep5();">ДА</a>
							<a href="javascript:toStep8();">НЕ УВЕРЕН</a>
						</div>
					</div>
					<div class="trck-step trck-step-8">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>КАК ЖАЛЬ, Я БУДУ</br>ЖДАТЬ, ЕСЛИ</br>ПЕРЕДУМАЕШЬ</p></div>
						<div class="trck-content">
							<a href="javascript:toStep5();">ЛАДНО, Я РЕШИЛСЯ</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<?
		$dontNeedToShowQuiz = $APPLICATION->get_cookie( 'DONT_NEED_TO_SHOW_QUIZ' );
		$dontNeedToShowQuizToday = $APPLICATION->get_cookie( 'DONT_NEED_TO_SHOW_QUIZ_TODAY' );
		
		if ( $_GET['quiz'] == 'yes' || ( $dontNeedToShowQuiz != 'Y' && $dontNeedToShowQuizToday != 'Y' && strpos( $APPLICATION->GetCurDir(), '/catalog/tekhnika/pitbayki/' ) !== false ) )
		{
			?>
				<script>
				$( window ).on(
					'load',
					function ()
					{
						setTimeout(
							function ()
							{
								showPitbikePopup();
							},
							60000
						);	
					}
				);
				</script>
			<?
			$APPLICATION->set_cookie( 'DONT_NEED_TO_SHOW_QUIZ_TODAY', 'Y', time() + 60*60*24 );
		}
		
		
		

		/*$dontShowMoveBanner = $APPLICATION->get_cookie( 'DONT_SHOW_MOVE_BANNER' );
		
		if ( $dontShowMoveBanner != 'Y' )
		{
			include( $_SERVER['DOCUMENT_ROOT'] . '/include/move_banner.php' );
			$APPLICATION->set_cookie( 'DONT_SHOW_MOVE_BANNER', 'Y', time() + 60*60*24 );
		}*/
		?>
		
		
		<?/*
		<script type="text/javascript" src="https://xsi.beeline.ru/com.broadsoft.xsi-actions/test/v2.0/user/userid/calls/callmenow/mpbx/mpbx-cmn-frame.js?user=MPBX_g_205902_ivr_209116%40ip.beeline.ru&theme=2&color=4"></script>
		*/?>

	</body>
</html>