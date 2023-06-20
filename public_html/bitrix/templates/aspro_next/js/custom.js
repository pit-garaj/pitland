/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/


$(document).ready(function() {

	$('#webuiPopover .close').click(function(e){
		e.preventDefault();
		$('#webuiPopover').removeClass('show');
		$.cookie('msg_1', 'no_more', { expires: 1, path: '/' });
	});

	$('#webuiPopover .webui-popover-inner').click(function(e){
		e.preventDefault();
		$('#ts-mw-id').toggleClass('open');
		$('.ts-mw-substrate').toggleClass('active');
		$('#webuiPopover').removeClass('show');
		$.cookie('msg_1', 'no_more', { expires: 1, path: '/' });
	});

	$('.ts-mw-icon').click(function(){
		$('#ts-mw-id').toggleClass('open');
		$('.ts-mw-substrate').toggleClass('active');
		$('#webuiPopover').removeClass('show');
	});

	$('.ts-mw-li a').click(function(){
		$('#ts-mw-id').removeClass('open');
		$('.ts-mw-substrate').removeClass('active');
		$('#webuiPopover').removeClass('show');
	});

	$('.ts-mw-substrate').click(function(){
		$('#ts-mw-id').removeClass('open');
		$('.ts-mw-substrate').removeClass('active');
		$('#webuiPopover').removeClass('show');
	});

});

$(document).ready(function() {
	var count = -1;
	function NextItem() {
		var boxes = $('.ts-mw-icon div');
		var boxLength = boxes.length - 1;
		count < boxLength ? count++ : count=0;
		boxes.removeClass('active').eq(count).addClass('active');
	}
	setInterval(NextItem, 3000);
	$('.slides').first().addClass('active');

	$('body').activity({
		'achieveTime':120,
		'testPeriod':10,
		useMultiMode: 1,
		callBack: function (e) {
			if ($.cookie('msg_1') == "no_more") {
			} else {
				$('#webuiPopover').addClass('show');
			}
		}
	});

});



$(document).ready(function() {
	$(".utPopUp").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});







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

		$( '#ownd-form-phone, [name="ORDER_PROP_3"]' ).inputmask( '+7(999)999-99-99');


		$( '.trck-step-2 .trck-content a, .trck-step-4 .trck-content a' ).click(
			function ()
			{
				$( this ).parent().find( 'a' ).removeClass( 'selected' );
				$( this ).addClass( 'selected' );
			}
		);


		$( '.ownd-credit-button, .ownd-call-jivo' ).click(
			function ()
			{
				$( '#jivo-iframe-container + jdiv > jdiv > jdiv' ).click();
			}
		);


		var hoverTimeout;
		$( '.menu-item.dropdown' ).hover(
			function ()
			{
				var _item = $( this );
				_item.addClass( 'ownd-hovered' );

				hoverTimeout = setTimeout(
					function ()
					{
						if ( _item.hasClass( 'ownd-hovered' ) )
						{
							_item.removeClass( 'ownd-hovered' );
							_item.addClass( 'hover' );
						}
					},
					300
				);
			},
			function ()
			{
				$( this ).removeClass( 'ownd-hovered' );
				$( this ).removeClass( 'hover' );
				clearTimeout( hoverTimeout );
			}
		);



		$( '#ownd-current-city > a' ).click(
			function ()
			{
				$( '#ownd-city-select' ).toggle();
				$( '#ownd-city-select-confirm' ).toggle();
			}
		);

		$( '#ownd-city-select-confirm a:last-child' ).click(
			function ()
			{
				$( '#ownd-city-select-confirm' ).hide();
				$( '#ownd-city-select' ).show();
			}
		);

		$( '#ownd-city-select-confirm a:first-child' ).click(
			function ()
			{
				$( '#ownd-city-select-confirm' ).hide();

				var city = $( '#ownd-current-city > a' ).html();

				$.post(
					'/ajax/city_cookie.php',
					{
						CITY: city
					},
				);
			}
		);


		$( 'body' ).on(
			'contextmenu',
			'img',
			function ( e )
			{
				return false;
			}
		);
	}
);


$( window ).on(
	'load',
	function ()
	{
		setTimeout(
			function ()
			{
				$.post(
					'',
					{
						AJAX: 'Y'
					},
					function ( data )
					{

					}
				);
			},
			1000
		);
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
	$( '.trck-bg' ).fadeOut( 500 );
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

	//удалить все, кроме цифр
	var phone_len = phone.replace(/[^+\d]/g, '');

	//номер телефона введен не полностью
	if (phone_len.length !== 12)
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
	var height = $( '.trck-step-3 input[type="radio"]:checked' ).val();
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
