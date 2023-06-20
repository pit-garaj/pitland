<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );
$APPLICATION->SetTitle( 'Подобрать питбайк' );
?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TBMXZS3');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBMXZS3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


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




<style>
* {
    margin: 0;
    padding: 0;
}

*, :after, :before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

body
{
	line-height: 24px;
}

p {
    margin: 0 0 20px;
}

.trck-bg {
	background: rgba(11,22,35,0.89);
	cursor: pointer;
	min-height: 100vh;
	width: 100%;
	top: 0;
    left: 0;
	position: fixed;
	display: none;
	z-index: 999;
	}

.trck-win {
	background: url('/bitrix/templates/aspro_next/image/win-bg.jpg') no-repeat;
	width: 810px;
	height: 514px;
	position: fixed;
	margin: auto;
	left: calc(50% - 500px);
	top: calc(50% - 250px);
	cursor: auto;
	box-shadow: 0 0 35px rgba(0,0,0,0.8);
}

.trck-cross {
	background: url('/bitrix/templates/aspro_next/image/cross.png') no-repeat;
	width: 32px;
	height: 29px;
	position: absolute;
	top: 12px;
	left: 12px;
	cursor: pointer;
}

.trck-cross:hover {
	opacity: 0.8;
}

.trck-load {
	position: absolute;
	top: 539px;
	left: 93px;
}

.trck-load span {
	display: inline-block;
	width: 35px;
	margin: 0px 12px;
	position: relative; 
	top: -33px;
	border-top: 1px solid #ffffff;
}

.trck-circle {
	background-color: #212121;
	border-radius: 100px;
	width: 66px;
	height: 66px;
	display: inline-block;
}

.trck-circle div {
	height: 66px;
	opacity: 0.3;
}

.trck-circle.win-active div {
	opacity: 1;
}

.trck-circle.trck-moto div {
	background: url('/bitrix/templates/aspro_next/image/moto.png') no-repeat 50% 50%;
}

.trck-load .win-active {
	background-color: #2981b7;
	color: #ffffff;
	box-shadow: 0 0 30px #5fc8ff;	
}

.trck-circle.trck-exp div {
	background: url('/bitrix/templates/aspro_next/image/exp.png') no-repeat 50% 50%;
}

.trck-circle.trck-he div {
	background: url('/bitrix/templates/aspro_next/image/he.png') no-repeat 50% 50%;
}

.trck-circle.trck-road div {
	background: url('/bitrix/templates/aspro_next/image/road.png') no-repeat 50% 50%;
}

.trck-circle.trck-cont div {
	background: url('/bitrix/templates/aspro_next/image/cont.png') no-repeat 50% 45%;
}

.trck-step-1 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl1.png?4') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -180px;
    left: 450px;
}

.trck-cloud {
	background: url('/bitrix/templates/aspro_next/image/cloud.png') no-repeat 50% 50%;
	height: 400px;
    width: 600px;
    position: absolute;
    top: -134px;
    left: 145px;
}

.trck-cloud p{
    position: absolute;
    top: 117px;
    left: 210px;
	color: #1865b1;
	font-size: 30px;
	font-family: OpenSans;
	font-weight: 600;
	text-shadow: 0 0 1px rgb(25,143,255,1);
	text-align: center;
	line-height: 1.43;
	letter-spacing: 1px;
}

@font-face{
    font-family: OpenSans;
    src: url(/bitrix/templates/aspro_next/fonts/OpenSans.ttf);
}

.trck-content {
	position: absolute;
    top: 249px;
    left: 319px;
}

.trck-content a {
	width: 260px;
	height: 60px;
	display: block;
	font-size: 18px;
	border: none;
	box-shadow: 0 0 2px rgb(0,0,0,0.27);
	font-family: OpenSans;
	text-align: center;
	line-height: 3;
	text-decoration: none;
}

.trck-content a:nth-child(1) {
	color: #000000;
	margin-bottom: 40px;
	background-color: #66ff00;
}

.trck-content a:nth-child(1):hover {
	background-color: #55ee00;
}

.trck-content a:nth-child(2) {
	background-color: #4fade0;
	color: #ffffff;
}

.trck-content a:nth-child(2):hover {
	background-color: #3e9cd0;
}

.trck-step-1 {
	//display: none;
}

.trck-step-2 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl2.png?4') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -170px;
    left: 527px;
}

.trck-step-2 .trck-cloud p{
    left: 196px;
    top: 117px;
}

.trck-step-2 {
	display: none;
}

.trck-step-3 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl3.png?4') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -182px;
    left: 466px;
}

.trck-step-3 .trck-cloud p{
    top: 117px;
    left: 197px;
}

.trck-step-3 .trck-content {
	position: absolute;
    top: 253px;
    left: 375px;
}

.trck-checkbox {
	display: block;
    position: relative;
    padding-left: 51px;
    margin-bottom: 24px;
    cursor: pointer;
    font-size: 18px;
	font-weight: 600;
	color: #ffffff;
	font-family: OpenSans;
}

.trck-checkbox input {
  position: absolute;
  height: 0;
  width: 0;
}

.trck-checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 26px;
  width: 26px;
  background-color: #ffffff;
  border: 5px solid #fff;
}

.trck-checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.trck-checkbox input:checked ~ .trck-checkmark:after {
  display: block;
}

.trck-checkbox .trck-checkmark:after {
  width: 26px;
  height: 26px;
  background: url('/bitrix/templates/aspro_next/image/check.png') no-repeat 50% 50%;
}

.trck-step-3 {
	display: none;
}

.trck-step-4 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl_new.png?4') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -161px;
    left: 501px;
	transform: scale(0.8);
}

.trck-step-4 .trck-cloud p{
    top: 117px;
    left: 195px;
}

.trck-step-4 {
	display: none;
}

.trck-step-5 .trck-cloud {
	background: url('/bitrix/templates/aspro_next/image/cloud2.png') no-repeat 50% 50%;
	height: 400px;
    width: 600px;
    position: absolute;
    top: -160px;
    left: 159px;
}

.trck-step-5 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl4.png?4') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -172px;
    left: 521px;
}

.trck-step-5 .trck-cloud p{
	top: 117px;
    left: 195px;
}

.trck-step-5 .trck-content {
	position: absolute;
    top: 0;
    left: 0;
	font-family: OpenSans;
}

.trck-step-5 .trck-form input {
	width: 298px;
	height: 64px;
	display: block;
	font-size: 20px;
	border: 1px solid rgba(0,0,0,0);
	box-shadow: inset 0 0 14px rgb(0,0,0,0.6);
	text-align: center;
	line-height: 3;
	margin-top: 43px;
	outline:none;
}

.trck-step-5 .trck-form input:nth-child(2) {
    margin-top: 45px;
}

.trck-step-5 .trck-form input:nth-child(3) {
    margin-top: 10px;
}

.trck-step-5 .trck-form input::placeholder {
	opacity: 0.7;
}

.trck-step-5 .trck-form a {
	color: #000000;
	background-color: #66ff00;
	margin-left: auto;
	margin-right: auto;	
	width: 298px;
	height: 64px;
	line-height: 60px;
	margin-top: 10px;
}

.trck-step-5 .trck-form a:hover {
	background-color: #55ee00;
}



.trck-step-5 .trck-form {
	position: absolute;
    top: 131px;
    left: 24px;
}

.trck-step-5 .trck-form p {
	color: #ffffff;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 0.6px;
	position: relative;
	top: 10px;
}

.trck-step-5 .trck-cont {
	position: absolute;
    top: 142px;
    left: 362px;
	width: 310px;
}

.trck-step-5 .trck-cont p{
	color: #ffffff;
	font-size: 18px;
	font-weight: 600;
	letter-spacing: 0.6px;
	margin-bottom: 18px;
}

.trck-step-5 .trck-cont .trck-cont-text{
	color: #ffffff;
	font-size: 18px;
	line-height: 1.25;
}

.trck-step-5 .trck-cont .trck-border{
	color: #ffffff;
	margin: -6px 0px 6px 0px;
	letter-spacing: 1px;
}

.trck-step-5 .trck-cont span {
	color: #ff5da0;
	font-weight: 600;
}

.trck-step-5 .trck-checkbox {
	display: block;
    position: relative;
    cursor: pointer;
    font-size: 15px;
	width: 280px;
	top: 27px;
	left: 18px;
	padding-left: 40px;
	margin-bottom: 0px;
	font-weight: 400;
	border: 1px solid rgba(0,0,0,0);
}

.trck-step-5 .trck-checkbox input[type="checkbox"]
{
	display: none;
}

.trck-step-5 .trck-checkmark {
  top: 4px;
  height: 16px;
  width: 16px;
}

.trck-step-5 .trck-checkbox .trck-checkmark:after {
  width: 12px;
  height: 12px;
  background: url('/bitrix/templates/aspro_next/image/check2.png') no-repeat 50% 50%;
  margin: -3px -3px;
}

.trck-step-5 {
	display: none;
}

.trck-step-6 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl6.png?4') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -185px;
    left: 440px;
}

.trck-step-6 .trck-cloud p{
    top: 96px;
    left: 149px;
}

.trck-step-6 .trck-content a {
    width: 364px;
}

.trck-step-6 .trck-content {
    top: 262px;
    left: 256px;
}

.trck-step-6 {
	display: none;
}

.trck-step-7 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl5.png?5') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -182px;
    left: 521px;
}

.trck-step-7 .trck-cloud p{
    top: 105px;
    left: 194px;
}

.trck-step-7 .trck-content a {
    width: 251px;
}

.trck-step-7 .trck-content {
    top: 254px;
    left: 307px;
}

.trck-step-7 {
	display: none;
}

.trck-step-8 .trck-girl {
	background: url('/bitrix/templates/aspro_next/image/girl8.png?5') no-repeat 50% 50%;
	height: 750px;
    width: 600px;
    position: absolute;
    top: -188px;
    left: 510px;
}

.trck-step-8 .trck-cloud p{
    top: 96px;
    left: 149px;
}

.trck-step-8 .trck-content a {
    width: 357px;
}

.trck-step-8 .trck-content {
    top: 297px;
    left: 254px;
}

.trck-step-8 {
	display: none;
}


@media all and (max-height: 750px)
{
	.trck-win
	{
		transform: scale(0.8);
		left: calc(50% - 470px);
	}
}

@media all and (max-width: 1024px)
{
	.trck-win
	{
		transform: scale(0.8);
		left: calc(50% - 470px);
	}
}

@media all and (max-height: 600px)
{
	.trck-win
	{
		transform: scale(0.6);
		left: calc(50% - 455px);
	}
	
	.trck-step-5 .trck-cont .trck-border
	{
		line-height: 25px;
	}
	
	.trck-content
	{
		left: 270px;
		top: 220px;
	}
	
	.trck-step-3 .trck-content
	{
		top: 215px;
	}
	
	.trck-step-7 .trck-content
	{
		top: 220px;
	}
	
	.trck-content a
	{
		width: 350px;
		height: 90px;
		line-height: 90px;
		font-size: 23px;
	}
	
	.trck-content a:nth-child(1)
	{
		margin-bottom: 60px;
	}
	
	.trck-checkbox
	{
		font-size: 27px;
		margin-bottom: 80px;
	}
	
	.trck-checkmark
	{
		top: -11px;
		left: -20px;
		height: 50px;
		width: 50px;
	}
	
	.trck-step-5 .trck-form a
	{
		height: 65px;
		line-height: 65px;
	}
}

@media all and (max-width: 820px)
{
	.trck-win
	{
		transform: scale(0.6);
		left: calc(50% - 455px);
	}
	
	.trck-step-5 .trck-cont .trck-border
	{
		line-height: 25px;
	}
	
	.trck-content
	{
		left: 270px;
		top: 220px;
	}
	
	.trck-step-3 .trck-content
	{
		top: 215px;
	}
	
	.trck-step-7 .trck-content
	{
		top: 220px;
	}
	
	.trck-content a
	{
		width: 350px;
		height: 90px;
		line-height: 90px;
		font-size: 23px;
	}
	
	.trck-content a:nth-child(1)
	{
		margin-bottom: 60px;
	}
	
	.trck-checkbox
	{
		font-size: 27px;
		margin-bottom: 80px;
	}
	
	.trck-checkmark
	{
		top: -11px;
		left: -20px;
		height: 50px;
		width: 50px;
	}
	
	.trck-step-5 .trck-form a
	{
		height: 65px;
		line-height: 65px;
	}
}

@media all and (max-height: 440px)
{
	.trck-win
	{
		transform: scale(0.5);
		left: calc(50% - 445px);
	}
	
	.trck-content
	{
		left: 180px;
		top: 200px;
	}
	
	.trck-content a
	{
		width: 450px;
		height: 115px;
		font-size: 46px;
		line-height: 105px;
	}
	
	.trck-cloud p
	{
		top: 90px;
		left: 169px;
		font-size: 46px;
		line-height: 60px;
	}
	
	.trck-step-6 .trck-content a
	{
		width: 555px;
	}
	
	.trck-step-6 .trck-content
	{
		left: 130px;
	}
	
	.trck-step-6 .trck-cloud p
	{
		top: 88px;
		left: 127px;
		font-size: 35px;
		line-height: 45px;
	}
	
	.trck-step-2 .trck-content
	{
		left: 90px;
	}
	
	.trck-step-2 .trck-content a
	{
		width: 635px;
	}
	
	.trck-step-2 .trck-cloud p
	{
		left: 156px;
		top: 90px;
	}
	
	.trck-step-3 .trck-cloud p
	{
		top: 90px;
		left: 158px;
	}
	
	.trck-checkbox
	{
		font-size: 35px;
	}
	
	.trck-step-4 .trck-cloud p 
	{
		top: 93px;
		left: 145px;
	}
	
	.trck-cross
	{
		background-size: contain;
		width: 50px;
		height: 50px;
	}
	
	.trck-step-5 .trck-cloud p 
	{
		top: 104px;
		left: 152px;
		font-size: 42px;
		line-height: 55px;
	}
	
	.trck-step-5 .trck-checkbox
	{
		left: 26px;
		top: 12px;
	}
	
	.trck-step-5 .trck-form p,
	.trck-step-5 .trck-cont p
	{
		font-size: 29px;
	}
	
	.trck-step-5 .trck-form input
	{
		height: 75px;
		font-size: 35px;
		line-height: 55px;
	}
	
	.trck-step-5 .trck-form a 
	{
		height: 75px;
		line-height: 75px;
		font-size: 26px;
	}
	
	.trck-step-7 .trck-cloud p 
	{
		top: 93px;
		left: 143px;
	}
	
	.trck-step-7 .trck-content a
	{
		width: 320px;
	}
	
	.trck-step-7 .trck-content
	{
		top: 196px;
		left: 275px;
	}
	
	.trck-step-8 .trck-content
	{
		left: 130px;
	}
	
	.trck-step-8 .trck-cloud p 
	{
		top: 88px;
		left: 110px;
		font-size: 35px;
		line-height: 45px;
	}
	
	.trck-step-8 .trck-content a 
	{
		width: 555px;
	}
}

@media all and (max-width: 620px)
{
	.trck-win
	{
		transform: scale(0.5);
		left: calc(50% - 445px);
	}
	
	.trck-content
	{
		left: 180px;
		top: 200px;
	}
	
	.trck-content a
	{
		width: 450px;
		height: 115px;
		font-size: 46px;
		line-height: 105px;
	}
	
	.trck-cloud p
	{
		top: 90px;
		left: 169px;
		font-size: 46px;
		line-height: 60px;
	}
	
	.trck-step-6 .trck-content a
	{
		width: 555px;
	}
	
	.trck-step-6 .trck-content
	{
		left: 130px;
	}
	
	.trck-step-6 .trck-cloud p
	{
		top: 88px;
		left: 127px;
		font-size: 35px;
		line-height: 45px;
	}
	
	.trck-step-2 .trck-content
	{
		left: 90px;
	}
	
	.trck-step-2 .trck-content a
	{
		width: 635px;
	}
	
	.trck-step-2 .trck-cloud p
	{
		left: 156px;
		top: 90px;
	}
	
	.trck-step-3 .trck-cloud p
	{
		top: 90px;
		left: 158px;
	}
	
	.trck-checkbox
	{
		font-size: 35px;
	}
	
	.trck-step-4 .trck-cloud p 
	{
		top: 93px;
		left: 145px;
	}
	
	.trck-cross
	{
		background-size: contain;
		width: 50px;
		height: 50px;
	}
	
	.trck-step-5 .trck-cloud p 
	{
		top: 104px;
		left: 152px;
		font-size: 42px;
		line-height: 55px;
	}
	
	.trck-step-5 .trck-checkbox
	{
		left: 26px;
		top: 12px;
	}
	
	.trck-step-5 .trck-form p,
	.trck-step-5 .trck-cont p
	{
		font-size: 29px;
	}
	
	.trck-step-5 .trck-form input
	{
		height: 75px;
		font-size: 35px;
		line-height: 55px;
	}
	
	.trck-step-5 .trck-form a 
	{
		height: 75px;
		line-height: 75px;
		font-size: 26px;
	}
	
	.trck-step-7 .trck-cloud p 
	{
		top: 93px;
		left: 143px;
	}
	
	.trck-step-7 .trck-content a
	{
		width: 320px;
	}
	
	.trck-step-7 .trck-content
	{
		top: 196px;
		left: 275px;
	}
	
	.trck-step-8 .trck-content
	{
		left: 130px;
	}
	
	.trck-step-8 .trck-cloud p 
	{
		top: 88px;
		left: 110px;
		font-size: 35px;
		line-height: 45px;
	}
	
	.trck-step-8 .trck-content a 
	{
		width: 555px;
	}
}

@media all and (max-height: 370px)
{
	.trck-win
	{
		transform: scale(0.4);
		left: calc(50% - 437px);
	}
}

@media all and (max-width: 500px)
{
	.trck-win
	{
		transform: scale(0.4);
		left: calc(50% - 437px);
	}
}

@media all and (max-height: 290px)
{
	.trck-win
	{
		transform: scale(0.3);
		left: calc(50% - 430px);
	}
}

@media all and (max-width: 400px)
{
	.trck-win
	{
		transform: scale(0.3);
		left: calc(50% - 430px);
	}
}

.ownd-timer .ownd-timer-block
{
	display: inline-block;
    width: 78px;
}

.ownd-timer .ownd-timer-block:first-child
{
	margin-right: 15px;
}

.ownd-timer .ownd-timer-block-title
{
	color: #fff;
	text-align: center;
}

.ownd-timer .ownd-timer-block-digits
{
	position: relative;
}

.ownd-timer .ownd-timer-block-digits span
{
	background-color: #eee;
    height: 45px;
    display: inline-block;
    padding: 10px 10px;
    border-radius: 18px;
    margin-right: -4px;
    color: #333;
    font-size: 32px;
}

.ownd-timer .ownd-timer-block-digits div
{
	position: absolute;
	bottom: 21px;
	left: 2px;
    height: 1px;
    width: 73px;
	background-color: rgba(0,0,0,0.3);
}
</style>


<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!--<script src="/bitrix/js/main/jquery/jquery-2.1.3.min.min.js"></script>-->
<script src="/bitrix/templates/aspro_next/js/jquery.inputmask.bundle.min.js"></script>

<script>
var timer;
var seconds = 20;

$( document ).ready(
	function ()
	{
		$( '.trck-bg' ).click(
			function (e)
			{
				if ( $( e.target ).hasClass( 'trck-bg' ) )
				{
					hidePitbikePopup();
				}
			}
		);
		
		
		$( '.trck-step-3 .trck-checkbox' ).change(
			function ()
			{
				step( 4 );
				loadStep( 4 );
			}
		);
		
		$( '#ownd-form-phone' ).inputmask( '+7 (999) 999-99-99' );
		
		
		$( '.trck-step-2 .trck-content a, .trck-step-4 .trck-content a' ).click(
			function ()
			{
				$( this ).parent().find( 'a' ).removeClass( 'selected' );
				$( this ).addClass( 'selected' );
			}
		);
	}
);


$( window ).on(
	'load',
	function ()
	{
		showPitbikePopup();
		$( '#ownd-form-phone' ).inputmask( '+7 (999) 999-99-99' );
	}
);


function showPitbikePopup()
{
	loadStep( 1 );
	step( 1 );
	$( '.trck-bg' ).fadeIn( 1000 );
}

function hidePitbikePopup()
{
	$( '.trck-bg' ).fadeOut( 4000 );
	window.location.href = '/';
}

function loadStep( loadStepIndex )
{
	$( '.trck-circle' ).removeClass( 'win-active' );
	
	if ( loadStepIndex > 0 )
	{
		for ( var i = 1; i <= loadStepIndex; i++ )
		{
			$( '.trck-circle' ).eq( i - 1 ).addClass( 'win-active' );
		}
	}
}

function step( index )
{
	$( '.trck-step' ).fadeOut( 100 );
	$( '.trck-step-' + index ).fadeIn( 500 );
}

function step1Yes()
{
	loadStep( 2 );
	step( 2 );
}

function step1No()
{
	loadStep( 0 );
	step( 6 );
}

function toStep2()
{
	$( '.trck-step-3 input[type="checkbox"]' ).prop( 'checked', false );
	
	step( 2 );
	loadStep( 2 );
}

function toStep3()
{
	step( 3 );
	loadStep( 3 );
}

function toStep5()
{
	step( 5 );
	loadStep( 5 );
	
	clearInterval( timer );
	seconds = 59;
	
	$( '.ownd-timer-minutes span' ).eq( 0 ).text( 0 );
	$( '.ownd-timer-minutes span' ).eq( 1 ).text( 0 );
	$( '.ownd-timer-seconds span' ).eq( 0 ).text( 5 );
	$( '.ownd-timer-seconds span' ).eq( 1 ).text( 9 );
	
	
	timer = setInterval(
		function ()
		{
			minusSecond();
		},
		1000
	);
}

function toStep8()
{
	step( 8 );
	loadStep( 0 );
}

function checkForm()
{
	var name = $( '#ownd-form-name' ).val();
	var phone = $( '#ownd-form-phone' ).val();
	var agree = $( '#ownd-form-agree' ).prop( 'checked' );
	
	var error = false;
	
	$( '#ownd-form-name' ).css( 'border-color', 'rgba(0,0,0,0)' );
	$( '#ownd-form-phone' ).css( 'border-color', 'rgba(0,0,0,0)' );
	$( '#ownd-form-agree' ).parent().css( 'border-color', 'rgba(0,0,0,0)' );
	
	if ( !name )
	{
		$( '#ownd-form-name' ).css( 'border-color', 'red' );
		error = true;
	}
	
	if ( !phone )
	{
		$( '#ownd-form-phone' ).css( 'border-color', 'red' );
		error = true;
	}
	
	if ( agree !== true && agree !== 'true' )
	{
		$( '#ownd-form-agree' ).parent().css( 'border-color', 'red' );
		error = true;
	}
	
	
	if ( !error )
	{
		sendData();
	}
}

function sendData()
{
	var exp = $( '.trck-step-2 .trck-content a.selected' ).data( 'value' );
	var height = $( '.trck-step-3 input[type="checkbox"]:checked' ).val();
	var road = $( '.trck-step-4 .trck-content a.selected' ).data( 'value' );
	var name = $( '#ownd-form-name' ).val();
	var phone = $( '#ownd-form-phone' ).val();
	
	$.post(
		'/ajax/pitbike_popup_result.php',
		{
			EXP: exp,
			HEIGHT: height,
			ROAD: road,
			NAME: name,
			PHONE: phone
		},
		function ( data )
		{
			window.location.href = data;
		}
	);
}

function minusSecond()
{
	seconds--;
	var stringSeconds = seconds.toString();
	
	if ( seconds < 10 )
	{
		stringSeconds = '0' + stringSeconds;
	}
	
	var tenSeconds = stringSeconds.substring( 0, 1 );
	var oneSeconds = stringSeconds.substring( 1, 2 );
	
	$( '.ownd-timer-minutes span' ).eq( 0 ).text( 0 );
	$( '.ownd-timer-minutes span' ).eq( 1 ).text( 0 );
	
	$( '.ownd-timer-seconds span' ).eq( 0 ).text( tenSeconds );
	$( '.ownd-timer-seconds span' ).eq( 1 ).text( oneSeconds );
	
	if ( seconds <= 0 )
	{
		clearInterval( timer );
		seconds = 59;
		step( 7 );
	}
}
</script>

</body>
</html>
