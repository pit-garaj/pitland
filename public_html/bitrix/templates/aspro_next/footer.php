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
		<?
    CNext::setFooterTitle();
		CNext::showFooterBasket();
    ?>
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
						<div class="trck-cloud"><p>ХОЧЕШЬ</br>МОТОЦИКЛ?</p></div>
						<div class="trck-content">
							<a href="javascript:step1Yes();">ДА</a>
							<a href="javascript:step1No();">НЕТ</a>
						</div>
					</div>
					<div class="trck-step trck-step-2">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>ОТЛИЧНО,<br />Я ПОМОГУ!</p></div>
						<div class="trck-content">
							<a href="javascript:toStep3();" data-value="noexp">МОЙ ПЕРВЫЙ МОТОЦИКЛ</a>
							<a href="javascript:toStep3();" data-value="exp">Я ОПЫТНЫЙ РАЙДЕР</a>
						</div>
					</div>
					<div class="trck-step trck-step-3">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>КАКОГО<br />ТЫ РОСТА?</p></div>
						<div class="trck-content">
							<label class="trck-checkbox" onclick="$('#step4_value_1').show(); $('#step4_value_2').hide(); $('#step4_value_3').hide();"> 125-145 см (питбайк)
								<input type="radio" name="size" value="low">
								<span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox" onclick="$('#step4_value_1').show(); $('#step4_value_2').hide(); $('#step4_value_3').hide();"> 145-160 см (питбайк)
							  <input type="radio" name="size" value="mid">
							  <span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox" onclick="$('#step4_value_1').show(); $('#step4_value_2').hide(); $('#step4_value_3').hide();"> 160-180 см (питбайк, эндуро лайт)
							  <input type="radio" name="size" value="high">
							  <span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox" onclick="$('#step4_value_1').hide(); $('#step4_value_2').show(); $('#step4_value_3').show();"> 175-200 см (кросс, эндуро, эндуро лайт)
							  <input type="radio" name="size" value="highest">
							  <span class="trck-checkmark"></span>
							</label>
						</div>
					</div>
					<div class="trck-step trck-step-4">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>ТВОЙ БЮДЖЕТ?</p></div>
						<div class="trck-content">
							<label class="trck-checkbox" id="step4_value_1">  80 000-160 000 руб.
								<input type="checkbox" id="low_price" value="low_price">
								<span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox" id="step4_value_2" style="display:none;">  140 000-200 000 руб.
								<input type="checkbox" id="middle_price" value="middle_price">
								<span class="trck-checkmark"></span>
							</label>

							<label class="trck-checkbox" id="step4_value_3" style="display:none;">  от 200 000 руб.
								<input type="checkbox" id="high_price" value="high_price">
								<span class="trck-checkmark"></span>
							</label>

							<a href="javascript:toStep5();" data-value="step5" class="blue_button">ДАЛЬШЕ</a>
					</div>
					</div>
					<div class="trck-step trck-step-5">
						<div class="trck-girl"></div>
						<div class="trck-cloud"><p>МЫ ПОЧТИ<br />У ЦЕЛИ!</p></div>
						<div class="trck-content">
							<div class="trck-form">
								<p>ЗАПОЛНИ ФОРМУ</p>
								<input placeholder="ИМЯ" id="ownd-form-name" />
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
				$(window).on('load', function () {
          setTimeout(function () {
            showPitbikePopup();
          }, 60000);
        });
				</script>
			<?
			$APPLICATION->set_cookie( 'DONT_NEED_TO_SHOW_QUIZ_TODAY', 'Y', time() + 60*60*24 );
		}

		?>
		<div class="ts-mw-button" id="ts-mw-id">

			<div class="ts-mw-icon">
				<div class="slides"><span class="jivosite-icon"></span></div>
				<div class="slides"><span class="whatsapp-icon"></span></div>
				<div class="slides"><span class="tg-icon"></span></div>
			</div>

			<div class="ts-mw-msg" id="ts-mw-msg" style="display: block;list-style: none;width: 60px; position:fixed; height: 60px;"></div>

			<div class="ts-mw-block">
				<ul class="ts-mw-list">
					<li class="ts-mw-li"><a href="javascript:jivo_api.open()"><span class="jivosite-icon"></span>Чат онлайн</a></li>
					<li class="ts-mw-li"><a href="https://api.whatsapp.com/send?phone=79672340771" rel="nofollow" target="_blank"><span class="whatsapp-icon"></span>Whatsapp</a></li>
					<li class="ts-mw-li"><a href="http://t.me/Pitlandov" rel="nofollow" target="_blank"><span class="tg-icon"></span>Telegram</a></li>
				</ul>
			</div>
		</div>
		<div class="ts-mw-substrate"></div>

		<div class="webui-popover-new left in" id="webuiPopover">
			<div class="webui-arrow" style="top: 54.5px;"></div>
			<div class="webui-popover-inner">
				<a href="#" class="close"></a>
				<h3 class="webui-popover-title">Не можете подобрать технику или запчасть?</h3>
				<div class="webui-popover-content-new">Мы вам поможем!</div>
			</div>
		</div>
            <!-- calltouch -->
            <script type="text/javascript">
            jQuery(document).on('click', 'form#one_click_buy_form [type="submit"]', function() {
              var form = jQuery(this).closest('form');
              var ct_fio = form.find('input[name="ONE_CLICK_BUY[FIO]"]').val();
              var ct_mail = form.find('input[name="ONE_CLICK_BUY[EMAIL]"]').val();
              var ct_phone = form.find('input[name="ONE_CLICK_BUY[PHONE]"]').val();
              var ct_comment = form.find('textarea[name="ONE_CLICK_BUY[COMMENT]"]').val();
              var ct_site_id = window.ct('calltracking_params','5g9dkgum').siteId;
              var ct_sub = 'Купить в 1 клик';
              var ct_data = {
                fio: ct_fio,
                phoneNumber: ct_phone,
                email: ct_mail,
                comment: ct_comment,
                subject: ct_sub,
                requestUrl: location.href,
                sessionId: window.ct('calltracking_params','5g9dkgum').siteId
              };
              if (!!ct_fio && !!ct_phone && window.ct_snd_flag != 1){
                window.ct_snd_flag = 1; setTimeout(function(){ window.ct_snd_flag = 0; }, 20000);
                jQuery.ajax({
                  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',
                  dataType: 'json', type: 'POST', data: ct_data, async: false
                });
              }
            });

            jQuery(document).on("click", 'form:not(#one_click_buy_form) [type="submit"]', function () {
              var form = jQuery(this).closest('form');
              var fio = form.find('input[data-sid*="NAME"], [name="name"]').val();
              var phone = form.find('input[data-sid="PHONE"], [name="phone"]').val();
              var email = form.find('input[data-sid="EMAIL"]').val();
              var comment = form.find('[data-sid="QUESTION"], [data-sid="REVIEW_TEXT"], [data-sid="MESSAGE"]').val();
              var ct_site_id = window.ct('calltracking_params','5g9dkgum').siteId;

              var sub = 'Заявка с сайта ' + location.hostname;

              var ct_data = {
                fio: fio,
                phoneNumber: phone,
                email: email,
                comment: comment,
                subject: sub,
                requestUrl: location.href,
                sessionId: window.ct('calltracking_params','5g9dkgum').sessionId
              };
              var ct_valid = 0;
              form.find(':visible[required]').not('[type="checkbox"]').each(function () {
                if (jQuery(this).val() == '') { ct_valid++; }
              });
              console.log(ct_data, ct_valid);
              if (!ct_valid && !!phone && !window.ct_snd_flag) {
                window.ct_snd_flag = 1; setTimeout(function () { window.ct_snd_flag = 0; }, 20000);
                jQuery.ajax({
                  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/' + ct_site_id + '/register/',
                  dataType: 'json', type: 'POST', data: ct_data, async: false
                });
              }
            });

            jQuery(document).on("mouseup touchend", 'form[name="ORDER_FORM"] #bx-soa-orderSave a, form[name="ORDER_FORM"] a.btn-order-save', function () {
              var form = jQuery(this).closest('form');
              var fio = form.find('input[name="ORDER_PROP_1"], input[name="ORDER_PROP_12"], input[autocomplete="name"]').val();
              var phone = form.find('input[name="ORDER_PROP_3"], input[name="ORDER_PROP_14"], input[autocomplete="tel"]').val();
              var mail = form.find('input[name="ORDER_PROP_2"], input[name="ORDER_PROP_13"], input[autocomplete="email"]').val();
              var comment = form.find('#orderDescription').val();

              var ct_site_id = window.ct('calltracking_params', '5g9dkgum').siteId;
              var sub = 'Заказ из корзины';
              var ct_data = {
                fio: fio,
                phoneNumber: phone,
                comment: comment,
                email: mail,
                subject: sub,
                requestUrl: location.href,
                sessionId: window.ct('calltracking_params', '5g9dkgum').sessionId
              };
              var ct_valid = !!phone && !!fio;
              try { ct_valid = BX.Sale.OrderAjaxComponent.isValidForm(); } catch (e) { console.log(e); }
              console.log(ct_data, ct_valid);
              if (ct_valid && !window.ct_snd_flag) {
                window.ct_snd_flag = 1; setTimeout(function () { window.ct_snd_flag = 0; }, 10000);
                jQuery.ajax({
                  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/' + ct_site_id + '/register/',
                  dataType: 'json', type: 'POST', data: ct_data, async: false
                });
              }
            });

            var _ctreq_jivo = function (sub) {
              var sid = window.ct('calltracking_params', '5g9dkgum').siteId;
              var jc = jivo_api.getContactInfo(); var fio = ''; var phone = ''; var email = '';
              if (!!jc.client_name) { fio = jc.client_name; } if (!!jc.phone) { phone = jc.phone; } if (!!jc.email) { email = jc.email; }
              var ct_data = { fio: fio, phoneNumber: phone, email: email, subject: sub, requestUrl: location.href, sessionId: window.ct('calltracking_params', '5g9dkgum').sessionId };
              var request = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
              var post_data = Object.keys(ct_data).reduce(function (a, k) { if (!!ct_data[k]) { a.push(k + '=' + encodeURIComponent(ct_data[k])); } return a }, []).join('&');
              var url = 'https://api.calltouch.ru/calls-service/RestAPI/' + sid + '/requests/orders/register/';
              if (!window.ct_snd_flag) {
                window.ct_snd_flag = 1; setTimeout(function () { window.ct_snd_flag = 0; }, 10000);
                request.open("POST", url, true); request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); request.send(post_data);
              }
            }
            window.jivo_onIntroduction = function () { _ctreq_jivo('JivoSite посетитель оставил контакты'); }
            window.jivo_onCallStart = function () { _ctreq_jivo('JivoSite обратный звонок'); }
            </script>
            <!-- calltouch -->
	</body>
</html>
