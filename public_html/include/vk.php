<div class="bx-incbanners">
	<div id="vk_widget">
		<div id="vk_groups"></div>
	</div>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
	<script>
        function VK_Widget_Init(){
            document.getElementById('vk_groups').innerHTML = "";
            var vk_width = document.getElementById('vk_widget').clientWidth;
            VK.Widgets.Group("vk_groups", {mode: 3, width: 'auto', height: "241"}, 139854830);
        };
        window.addEventListener('load', VK_Widget_Init, false);
        window.addEventListener('resize', VK_Widget_Init, false);
	</script>
</div>
