<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
					</div>
					<?if (!$needSidebar && ($curPage != SITE_DIR."index.php")):?>
					<div class="sidebar col-md-3 col-sm-4 col-lg-2">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "sect",
								"AREA_FILE_SUFFIX" => "sidebar",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_MODE" => "html",
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div><!--// sidebar -->
					<?endif?>
				</div><!--//row-->
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "bottom",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'N')
				);?>
			</div><!--//container bx-content-seection-->
		</div><!--//workarea-->

<?/*
		<footer class="bx-footer">
			<div class="bx-footer-line">
				<div class="bx-footer-section container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/socnet_footer.php",
							"AREA_FILE_RECURSIVE" => "N",
							"EDIT_MODE" => "html",
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);?>
				</div>
			</div>
			<div class="bx-footer-section container bx-center-section">
				<div class="col-sm-5 col-md-3 col-md-push-6">
					<h4 class="bx-block-title"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/about_title.php"), false);?></h4>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
							"ROOT_MENU_TYPE" => "bottom",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_TYPE" => "A",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
						),
						false
					);?>
				</div>
				<div class="col-sm-5 col-md-3">
					<h4 class="bx-block-title"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/catalog_title.php"), false);?></h4>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
							"ROOT_MENU_TYPE" => "left",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"CACHE_SELECTED_ITEMS" => "N",
							"MAX_LEVEL" => "1",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);?>
				</div>
				<div class="col-sm-5 col-md-3 col-md-push-3">
					<div style="padding: 20px;background:#eaeaeb">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/sender.php",
								"AREA_FILE_RECURSIVE" => "N",
								"EDIT_MODE" => "html",
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div>
					<div id="bx-composite-banner" style="padding-top: 20px"></div>
				</div>
				<div class="col-sm-5 col-md-3 col-md-pull-9">
					<div class="bx-inclogofooter">
						<div class="bx-inclogofooter-block">
							<a class="bx-inclogofooter-logo" href="<?=SITE_DIR?>">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo_mobile.php"), false);?>
							</a>
						</div>
						<div class="bx-inclogofooter-block">
							<div class="bx-inclogofooter-tel"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></div>
							<div class="bx-inclogofooter-worktime"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?></div>
						</div>
						<div>
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/personal.php"), false);?>
						</div>
					</div>
				</div>
			</div>

		</footer>
*/?>
<footer>

      
<!--contacts starts-->
<section class="contacts" id="section_8">
    <!--container ends-->
    <div class="dt-sc-margin20"></div>

    
    <div class="parallax full-width-contact" style="background-position: 50% 78px;">
        <!--container starts-->
        <div class="container">
            <!--column one-half starts-->
            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
				<a href="/"><img src="<?=SITE_TEMPLATE_PATH."/images/footerlogo.png"?>" alt="Главная" style="width: 50%;"></a>
            </div>
            <!--column one-half ends-->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <!--contact-info box starts-->
                <div class="dt-sc-contact-info text-center">
                  <h3 style="padding-left: 25.72px">КОНТАКТЫ</h3>
                  <p><i style="padding-right: 10px;" class="fa fa-phone"></i><a href="tel:+74953635299">+7 (495) 363 52 99</a></p>
				  <p><i style="padding-left: 68.41px;padding-right: 10px;" class="fa fa-phone"></i><a href="tel:+79850556788">+7 (985) 055 67 88</a><img style="height: 30px; padding-left: 10px; display: inline-block; vertical-align: bottom;" src="/images/Messengers3.png"></p>
                  <p><i style="padding-right: 10px;" class="fa fa-envelope"></i><a href="mailto:info@pitbikeland.ru">info@pitbikeland.ru</a></p>

        	</div>
        <!--contact-info box ends-->
      </div>
      <!--column one-half starts-->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <!--contact-info box starts-->
        <div class="dt-sc-contact-info text-center">
          <h3 style="padding-left:0px;">ПОДПИШИСЬ!</h3>

          <ul class="dt-sc-social-icons" style="list-style: none;display: inline-flex;">
            
            <li>
              <a href="https://www.vk.com/pitbikeland_ru" target="_blank">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-inverse fa-stack-2x" aria-hidden="true"></i>
				  <i class="fa fa-vk fa-stack-1x"></i>
				</span>
                </a>
              </li>



            
            <li>
               <a href="https://www.youtube.com/channel/UCM-bKfBFe5PJgTh94lCoijw" target="_blank">
				<span class="fa-stack fa-lg">    
				  <i class="fa fa-circle fa-inverse fa-stack-2x" aria-hidden="true"></i>
				  <i class="fa fa-youtube fa-stack-1x "></i>
				</span>
                </a>
            </li>
            

            
            
            <li>
               <a href="https://www.instagram.com/pitbikeland" target="_blank">
				<span class="fa-stack fa-lg">    
				  <i class="fa fa-circle fa-inverse fa-stack-2x" aria-hidden="true"></i>
				  <i class="fa fa-instagram fa-stack-1x"></i>
				</span>
                </a>
            </li>
            


          </ul>
          
        </div>
        <!--contact-info box ends-->
      </div>
      <!--column one-half ends-->
    </div>
    <!--container ends-->
  </div>
  
  <!--full-width-section ends-->
</section>
<!--contacts ends-->

	<!--<img style="display:none" id="img" src="https://js.cx/clipart/yozhik.jpg?speed=1">-->
      <div class="copyright">
        <!--container starts-->
        <div class="">
          	<div class="col-sm-11" style="font-size: 11px;"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?></div>
			<div class="col-sm-1 bx-up"><a href="javascript:void(0)" data-role="eshopUpButton" id="up_to_top"><i class="fa fa-caret-up"></i></a></div>

        </div>
        <!--container ends-->
      </div>
    </footer>

		<div class="col-xs-12 hidden-lg hidden-md hidden-sm visible-xs">
			<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
					"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
					"PATH_TO_PERSONAL" => SITE_DIR."personal/",
					"SHOW_PERSONAL_LINK" => "N",
					"SHOW_NUM_PRODUCTS" => "Y",
					"SHOW_TOTAL_PRICE" => "Y",
					"SHOW_PRODUCTS" => "N",
					"POSITION_FIXED" =>"Y",
					"POSITION_HORIZONTAL" => "center",
					"POSITION_VERTICAL" => "bottom",
					"SHOW_AUTHOR" => "Y",
					"PATH_TO_REGISTER" => SITE_DIR."login/",
					"PATH_TO_PROFILE" => SITE_DIR."personal/"
				),
				false,
				array()
			);?>
		</div>
	</div> <!-- //bx-wrapper -->







<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45730335 = new Ya.Metrika({
                    id:45730335,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    ecommerce:"dataLayer"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45730335" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-105248945-1', 'auto');
  ga('send', 'pageview');

</script>



<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'P1dWHVmDLz';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->



<script>

NProgress.configure({ parent: '#tyt' });
NProgress.start();
window.onload = function() {
	NProgress.done();
	$('.main_menu').addClass('finesh');

};
$('.bar, .spinner, .main_menu').affix({offset: {top: $('#top').height() + $('#bx-panel').height()} });
	BX.ready(function(){


		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});

if ((location.pathname != '/') && (location.pathname != '/index.php')) {
    (new BX.easing({
        duration: 1000,
        start: {scroll: 0},
        finish: {scroll: $('#tyt').offset().top},
        transition: BX.easing.makeEaseOut(BX.easing.transitions.quart),
        step: function (state) {
            window.scrollTo(0, state.scroll);
        },
        complete: function () {
        }
    })).animate();
}

if ((location.pathname != '/') && (screen.width < 600)) {
    $('#top').hide();
}

</script>
</body>
</html>