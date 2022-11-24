<div id="ownd-move-banner">
	<div class="ownd-move-banner-text">
		<p>Привет, дружище!</p>
		<p>Сегодня сайт может  глючить ввиду переезда</p>
		<p>Если что - звони, мы готовы принять твой заказ :)</p>
	</div>
	<div class="ownd-move-banner-bottom">
		ж-жж-жжж-жжжж-жжжжжжжжжжжжж!
	</div>
	<div class="ownd-move-banner-close">
	</div>
</div>



<style>
#ownd-move-banner
{
	width: 500px;
	height: 320px;
	background-color: #1976d2;
	position: fixed;
	top: calc(50vh - 160px);
	left: calc(50vw - 250px);
	z-index: 1000;
}

#ownd-move-banner .ownd-move-banner-text
{
	padding: 33px 54px 0;
}

#ownd-move-banner .ownd-move-banner-text p
{
	font-size: 26px;
	line-height: 31px;
	color: #ffffff;
	font-family: "Calibri";
	margin-bottom: 30px;
	text-transform: uppercase;
}

#ownd-move-banner .ownd-move-banner-text p:last-child
{
	margin-bottom: 0;
}

#ownd-move-banner .ownd-move-banner-bottom
{
	font-size: 17px;
	color: #ffd200;
	font-weight: bold;
	font-family: "Segoe Print";
	text-transform: uppercase;
	text-align: center;
	margin-top: 42px;
}

#ownd-move-banner .ownd-move-banner-close
{
	background: url(/bitrix/templates/aspro_next/image/cross.png) 50% 50% / contain no-repeat;
    width: 24px;
    height: 24px;
    position: absolute;
    top: 18px;
    right: 18px;
    cursor: pointer;
}

#ownd-move-banner .ownd-move-banner-close:hover
{
	opacity: 0.8;
}


@media screen and (max-width: 500px)
{
	#ownd-move-banner
	{
		transform: scale(0.6);
	}
}
</style>


<script>
$( document ).ready(
	function ()
	{
		$( '#ownd-move-banner .ownd-move-banner-close' ).click(
			function ()
			{
				$( '#ownd-move-banner' ).hide();
			}
		);
	}
);
</script>