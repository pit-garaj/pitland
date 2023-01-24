// You can also use "$(window).load(function() {"
$(function () {
  // slider_top
  $("#slider_top").responsiveSlides({
	auto: true,
	pager: true,
	nav: true,
	speed: 500,
	namespace: "callbacks",
	before: function () {
	  $('.events').append("<li>before event fired.</li>");
	},
	after: function () {
	  $('.events').append("<li>after event fired.</li>");
	}
  });

});
