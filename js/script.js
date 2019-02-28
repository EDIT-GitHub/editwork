window.Parsley.setLocale("en");

//message
var uni_popup_message = function(text, type) {
  var message_div = jQuery('#uni_popup');
      message_text = message_div.text(text);

  if (type == 'success') {
    message_div.addClass('success-message');
  }
  if (type == 'warning') {
    message_div.addClass('warning-message');
  }
  if (type == 'error') {
    message_div.addClass('error-message');
  }

  if (text != '') {
    message_div.fadeIn(400).dequeue().animate({ left: 25 }, 250, function(){
      setTimeout(function(){
        message_div.animate({ left: -125 }, 250).dequeue().fadeOut(400, function(){

            setTimeout(function(){
              message_div.removeClass('success-message warning-message error-message');
            }, 1);
        });
      }, 3000);
    });
  }
};

jQuery(function ($) {

    $.fn.iLightInputNumber = function (options) {

        var inBox = '.input-number-box',
            newInput = '.input-number',
            moreVal = '.input-number-more',
            lessVal = '.input-number-less';

        this.each(function () {

            var el = $(this);
            $('<div class="' + inBox.substr(1) + '"></div>').insertAfter(el);
            var parent = el.find('+ ' + inBox);
            parent.append(el);
            var classes = el.attr('class');
            parent.append('<input class="' + newInput.substr(1) + '" type="text">');
            el.hide();
            var newEl = el.next();
            newEl.addClass(classes);
            var attrValue;

            function setInputAttr(attrName) {
                if (el.attr(attrName)) {
                    attrValue = el.attr(attrName);
                    newEl.attr(attrName, attrValue);
                }
            }

            setInputAttr('value');
            setInputAttr('placeholder');
            setInputAttr('min');
            setInputAttr('max');
            setInputAttr('step');

            parent.append('<div class=' + moreVal.substr(1) + '>+</div>');
            parent.append('<div class=' + lessVal.substr(1) + '>-</div>');

        }); //end each

        var value,
            step;

        var interval = null,
            timeout = null;

            function ToggleValue(input) {
                input.val(parseInt(input.val(), 10) + d);
                console.log(input);
            }

            $('body').on('mousedown', moreVal, function () {
                var el = $(this);
                var input = el.siblings(newInput);
                moreValFn(input);
                timeout = setTimeout(function(){
                    interval = setInterval(function(){ moreValFn(input); }, 50);
                }, 200);

            });

            $('body').on('mousedown', lessVal, function () {
                var el = $(this);
                var input = el.siblings(newInput);
                lessValFn(input);
                timeout = setTimeout(function(){
                    interval = setInterval(function(){ lessValFn(input); }, 50);
                }, 200);
            });

            $(moreVal +', '+ lessVal).on("mouseup mouseout", function() {
                clearTimeout(timeout);
                clearInterval(interval);
            });

            function moreValFn(input){
                var max = input.attr('max');
                checkInputAttr(input);
                var newValue = value + step;
                if (newValue > max) {
                    newValue = max;
                }
                changeInputsVal(input, newValue);
            }

            function lessValFn(input){
                var min = input.attr('min');
                checkInputAttr(input);
                var newValue = value - step;
                if (newValue < min) {
                    newValue = min;
                }
                changeInputsVal(input, newValue);
            }

            function changeInputsVal(input, newValue){
                input.val(newValue);
                var inputNumber = input.siblings(this);
                inputNumber.val(newValue);
            }

            function checkInputAttr(input) {
                if (input.attr('value')) {
                    value = parseFloat(input.attr('value'));
                } else if (input.attr('placeholder')) {
                    value = parseFloat(input.attr('placeholder'));
                }
                if (!( $.isNumeric(value) )) {
                    value = 0;
                }
                if (input.attr('step')) {
                    step = parseFloat(input.attr('step'));
                } else {
                    step = 1;
                }
            }

            $(newInput).change(function () {
                var input = $(this);
                var value = parseFloat(input.val());
                var min = input.attr('min');
                var max = input.attr('max');
                if (value < min) {
                    value = min;
                } else if (value > max) {
                    value = max;
                }
                if (!( $.isNumeric(value) )) {
                    value = '';
                }
                input.val(value);
                input.siblings(this).val(value);
            });

            $(newInput).keydown(function(e){
                var input = $(this);
                var k = e.keyCode;
                if( k == 38 ){
                    moreValFn(input);
                }else if( k == 40){
                    lessValFn(input);
                }
            });
    };
});

jQuery(function ($) {
    $('.quantity input[type=number], .wpcf7-number').not(".woocommerce-cart .cartPage .quantity input[type=number]").iLightInputNumber();
});

jQuery( document ).ready( function( $ ) {
    'use strict';

/* -------------------- 
	Global vars
----------------------*/
	var winWidth = $(window).width();
	var winHeight = $(window).height();
	
/* -------------------- 
	Animations for blocks
----------------------*/
	window.sr = ScrollReveal();
	if( $('.js-uni-animated').length > 0 ){
		sr.reveal( '.js-uni-animated', {
			origin: 'bottom',
			duration: 800,
			delay: 0,
			distance: '100px',
			easing: 'ease',
			scale: 1
		});	
	}
	if( $('.js-uni-animated-first').length > 0 ){
		sr.reveal( '.js-uni-animated-first', {
			origin: 'bottom',
			duration: 800,
			delay: 0,
			distance: '80px',
			easing: 'ease',
			scale: 1
		});
	}
	if( $('.js-uni-animated-second').length > 0 ){
		sr.reveal( '.js-uni-animated-second', {
			origin: 'bottom',
			duration: 800,
			delay: 200,
			distance: '80px',
			easing: 'ease',
			scale: 1
		});
	}
	if( $('.js-uni-animated-third').length > 0 ){
		sr.reveal( '.js-uni-animated-third', {
			origin: 'bottom',
			duration: 800,
			delay: 300,
			distance: '80px',
			easing: 'ease',
			scale: 1
		});	
	}

	if( $('.screenDesc').length > 0 ){
		$('.screenDesc').css({
		   	'margin-top': ((( $('.screenDesc').height() / 2 ) * -1 ) + 20 )
		});
		$(window).resize( function(e){
			$('.screenDesc').css({
			   	'margin-top': ((( $('.screenDesc').height() / 2 ) * -1 ) + 20 )
			});
		});
	}

		$(window).load(function() {
			//console.log('tudo load2');
			$(".loaderWrap").fadeOut(300,function(){
	        	$(this).remove();
	        });
		});
	

	if( $('.homeSlider').length > 0 ){
		var headerIsStickyHeight = $("#header").data("header-sticky-height");
		$('.homeSlider').css({
		   	'height': winHeight - headerIsStickyHeight
		});
		$('.homeSlider .fcell ul li').css({
		   	'height': winHeight - headerIsStickyHeight 
		});

		$(window).resize( function(e)
		{
		    var winWidth = $(window).width();
			var winHeight = $(window).height();
			var headerIsStickyHeight = $("#header").data("header-sticky-height");
			$('.homeSlider').css({
			   	'height': winHeight - headerIsStickyHeight
			});
			$('.homeSlider .fcell ul li').css({
			   	'height': winHeight - headerIsStickyHeight
			});
			
		});
	}

	if( $('.mainHomeSlider').length > 0 ){
		$('.mainHomeSlider').css({
		   	'height': winHeight
		});
		$('.mainHomeSlider ul li').css({
		   	'height': winHeight
		});

		$(window).resize( function(e)
		{
		    var winWidth = $(window).width();
			var winHeight = $(window).height();
			$('.mainHomeSlider').css({
			   	'height': winHeight
			});
			$('.mainHomeSlider ul li').css({
			   	'height': winHeight
			});
			
		});
	}

	if ($("body").hasClass("page-template-templ-home-php")) {
		$('.scroll-to-btn > a').on("click", function(e) {
			var headerIsStickyHeight = $("#header").data("header-sticky-height");
			e.preventDefault();
			var toId = $(this).attr('href').split('#')[1];
			if ($(this).closest(".mobileMenu").hasClass("mobileMenu")) {
				$(".showMobileMenu.open").removeClass("open").closest("body").removeClass('animated');
				setTimeout(function(){
					$.scrollTo("#"+toId,700, {offset: {top: -headerIsStickyHeight, left:0} }); 
				}, 600);
			} else {
				$.scrollTo("#"+toId,700, {offset: {top: -headerIsStickyHeight, left:0} }); 
			} 
	    	return false;
	    });	
	}

/* -------------------- 
	BxSliders
----------------------*/
	if( $('.homeSlider').length > 0 ){
		var homeSlide = $('.homeSlider').find(".fcell ul").bxSlider({
			mode:"fade",
			auto:true,
			speed:700,
			pause:4000
		});
        // Triggers an event - on bx slider init
		$( document.body ).trigger( 'unitheme_home_slider_init_event', [ homeSlide ] );
	}

	if( $('.mainHomeSlider').length > 0 ){
		var mainHomeSlider = $('.mainHomeSlider').find("ul").bxSlider({
			mode:"fade",
			auto:true,
			speed:700,
			pause:4000,
			onSliderLoad: function(){
				var $slider = $('.mainHomeSlider'),
					$first = $slider.find('li[data-slide="0"]'),
					$desc = $first.find('.screenDesc2'),
					height = ((( $desc.height() / 2 ) * -1 ) + 20 );
				
				$desc.css({'margin-top': height});
				$first.addClass("uni-active");
			},
			onSlideAfter: function(){
				var gcs 		= mainHomeSlider.getCurrentSlide(),
					$slider 	= $('.mainHomeSlider'),
					$notCurrent = $slider.find('li:not(li[data-slide="'+gcs+'"])'),
					$current 	= $slider.find('li[data-slide="'+gcs+'"]'),
					$desc 		= $current.find('.screenDesc2'),
					height 		= ((( $desc.height() / 2 ) * -1 ) + 20 );

		        $notCurrent.removeClass("uni-active");
		        $desc.css({'margin-top': height});
				$current.addClass("uni-active");
		    }
		});
        // Triggers an event - on bx slider init
		$( document.body ).trigger( 'unitheme_main_home_slider_init_event', [ mainHomeSlider ] );

		$(window).resize( function(e){
			var $desc = $('.mainHomeSlider li.uni-active .screenDesc2'),
				height = ((( $desc.height() / 2 ) * -1 ) + 20 );

			$desc.css({'margin-top': height});
		});
	}

/* -------------------- 
	Events bxSlider
----------------------*/
	if( $('.eventsBgSlider').length > 0 ){
		var eventsHeight = $(".events").outerHeight();
		$('.eventsBgSlider').css({
		   	'height': eventsHeight 
		});
		$('.eventsBgSlider li').css({
		   	'height': eventsHeight 
		});

		$(window).resize( function(e){
			var eventsHeight = $(".events").outerHeight();
			$('.eventsBgSlider').css({
			   	'height': eventsHeight 
			});
			$('.eventsBgSlider li').css({
			   	'height': eventsHeight 
			});
		});
	}
	if( $('.eventsBgSlider').length > 0 ){
		var eventsBgSlider = $('.eventsBgSlider').bxSlider({
			mode:"fade",
			speed:700,
			pause:4000,
			controls: false,
			pager: false
		});
		// $(".eventItem").hover(function() {
		// 		var id = $(this).data("slide-id");
		// 		eventsBgSlider.goToSlide(id);
		// 	}, function() {}
		// );
	}
	if( $('.eventTime').length > 0 ){
		$(window).load(function() {
			$('.eventTime').each( function()
			{	
				if ($(this).closest(".eventItem").hasClass('eventItemSimply')) {
					var eventStartTime = $(this).find("strong").text().split('#')[0];
					var eventEndTime = $(this).find("strong").text().split('#')[1];
					if (eventEndTime) {
						$(this).find("strong").html(eventStartTime + " <br> " + eventEndTime);	
					}
				}
			    $(this).css({
				   	'margin-top': ( ($(this).height() / 2) * -1 )
				});	
			});
		});
	}

	if( $('.productGalleryWrap').length > 0 ){
		var singleProductGallery = $('.productGalleryWrap').find("ul").bxSlider({
			mode:"fade",
			speed:300,
			pager:false,
			controls: false
		});
	}

	if( $('.galleryThumb').length > 0 ){
		var galleryThumbSlider = $('.galleryThumb').find("ul").bxSlider({
			mode: 'vertical',
			minSlides: 4,
    		maxSlides: 4,
    		moveSlides: 1,
    		slideMargin: 20,
			pager:false,
			controls:false,
			infiniteLoop:false
	    });
	};

	$(".galleryThumb a").on("click", function(e){
		e.preventDefault();
		if (!$(this).hasClass("active")) {
			var prevCurrentSlide = $(this).closest("ul").find("a.active").closest("li").data("slide");
			var currentSlide = $(this).closest("li").data("slide");
			
			$("a.galleryThumbItem.active").removeClass("active");
			$(this).addClass("active");

			if (prevCurrentSlide < currentSlide ) {
				singleProductGallery.goToSlide($(this).closest("li").data("slide"));
				galleryThumbSlider.goToNextSlide();	
			} else if (prevCurrentSlide > currentSlide) {
				singleProductGallery.goToSlide($(this).closest("li").data("slide"));
				galleryThumbSlider.goToPrevSlide();	
			}
		}
	});

/* -------------------- 
	Second screen
----------------------*/
	// if( $('.secondScreen h3').length > 0 ){
	// 	$('.secondScreen h3').css({
	// 	   	'margin-top': ((( $('.secondScreen h3').height() / 2 ) * -1 ) )
	// 	});

	// 	$(window).resize( function(e)
	// 		{
	// 		$('.secondScreen h3').css({
	// 		   	'margin-top': ((( $('.secondScreen h3').height() / 2 ) * -1 ) )
	// 		});
	// 	});
	// }

	var benefitSize = $(".benefitItem").size();
	if (benefitSize <= 8) {
		$(".benefitItem:eq(3)").after("<br>");
	} else if (benefitSize > 8 && benefitSize <= 12 ) {
		$(".benefitItem:eq(3)").after("<br>");
		$(".benefitItem:eq(7)").after("<br>");
	}

/* -------------------- 
	Home shop
----------------------*/
	if( $('.productDesc').length > 0 ){
		$('.productDesc').each( function()
		{
		    $(this).css({
			   	'margin-top': ((( $(this).height() / 2 ) * -1 ) )
			});
		});

	}

/* -------------------- 
	Main menu sticky
----------------------*/
	var sticky_navigation_offset_top = 0;
	var sticky_navigation = function(){
		var scroll_top = $(window).scrollTop();
		if (scroll_top > sticky_navigation_offset_top) { 
			$('#header .headerWrap').addClass("isSticky");
		} else {
			$('#header .headerWrap').removeClass("isSticky"); 
		}
	};
	sticky_navigation();

	$(window).on('scroll', function() {
		 sticky_navigation();
	});

/* -------------------- 
	Dotdotdot
----------------------*/
    var uniDot = function(wrap) {
		var $wrap = $(''+wrap);

		$wrap.dotdotdot({
			wrap: 'letter'	
		});
		$(window).resize( function(e){
			var content = $wrap.triggerHandler("originalContent.dot");
			$wrap.append( content );
			$wrap.trigger("update.dot");
		});
	}
	uniDot('.postItem h3 a');
	uniDot('.postItem p');
	uniDot('.benefitItem p');
	uniDot('.productDesc h3');
	uniDot('.postItemV2 h3 a');
	uniDot('.postItemV2 p');
    
/* -------------------- 
	Mini cart
----------------------*/
    $(".showMiniCart").on("click", function(){
		$(this).closest(".contentWrap").addClass("miniCartOn");
	});
	$(".closeCartPopup").on("click", function(){
		$(this).closest(".contentWrap").removeClass("miniCartOn");
	});

	$(window).load(function() {
		var miniCartHeight = $(".miniCartItemWrap").outerHeight();
		var contentShopHeight = $(".contentWrap").outerHeight();
		if (contentShopHeight < miniCartHeight + 73) {
			$(".contentWrap").css("height", miniCartHeight + 73);
		}
	});

/* --------------------
	Show mobile menu
----------------------*/
	$('.showMobileMenu').on('click', function(e){
		e.preventDefault();
		$(this).toggleClass('open').closest('body').toggleClass('animated');
	});

	var h = 0; // the height of the highest element (after the function runs)
	var h_elem;  // the highest element (after the function runs)
	$(".pricingPlanItemDescWrap").each(function () {
	    if ($(this).outerHeight() > h) {
	        h_elem = $(this);
	        h = $(this).outerHeight();
	    }    
	});
	$(".pricingPlanItemDescWrap").css({
		"min-height" : h,
		"max-height" : h
	});

	$(".cartPage .woocommerce td.product-name dl.variation").each(function(){
		var dlContainer = $(this).closest(".cartProduct").find("h4");
		$(this).appendTo(dlContainer);
	});	

	$(".miniCartItem dd, .page-template-templ-wishlist .variation dd").each(function(){
		$("<br>").insertAfter($(this));
	});	

	$(".page-template-templ-wishlist .uni-wishlist-variation-details dl.variation").each(function(){
		var dlContainer = $(this).closest(".uni-wishlist-item-details").find("h4.uni-wishlist-item-title");
		$(this).appendTo(dlContainer);
	});	

	$(".page-template-templ-wishlist .uni-wishlist-item-availability span").each(function(){
		var dlContainer = $(this).closest(".uni-wishlist-item-details").find("h4.uni-wishlist-item-title");
		$(this).appendTo(dlContainer);
	});	
	
	if (winWidth > 767) {
		$('div[data-type="parallax"]').each(function(){
	        var $bgobj = $(this); // assigning the object
	        var bgobjTop = $(this).offset().top;
	    
	        $(window).scroll(function() {
	        	//console.log($(window).scrollTop() + winHeight)
	        	//console.log(bgobjTop)

				if ( ($(window).scrollTop() + winHeight) > bgobjTop )        	
				{

					var yPos = -(($(window).scrollTop() - $bgobj.offset().top) / $bgobj.data('speed')); 
	            
		            // Put together our final background position
		            var coords = '50% '+ yPos + 'px';

		            // Move the background
		            $bgobj.css({ backgroundPosition: coords });	
				}
	        }); 
	    });  
    }

    $(window).resize( function(e)
		{
		    var winWidth = $(window).width();
			var winHeight = $(window).height();

			if (winWidth > 767) {
				$('div[data-type="parallax"]').each(function(){
			        var $bgobj = $(this); // assigning the object
			        var bgobjTop = $(this).offset().top;
			    
			        $(window).scroll(function() {
						if ( ($(window).scrollTop() + winHeight) > bgobjTop )        	
						{

							var yPos = -(($(window).scrollTop() - $bgobj.offset().top) / $bgobj.data('speed')); 
			            
				            // Put together our final background position
				            var coords = '50% '+ yPos + 'px';

				            // Move the background
				            $bgobj.css({ backgroundPosition: coords });	
						}
			        }); 
			    });
		    }
	});
		
	$(window).load(function() {

		/* Main menu */
		var menu = $(".mainMenu");
		var	mainMenuHeight = menu.height();
		var	mainMenuWidth = menu.width();
		var headOuterHeight = $("#header").outerHeight();
		var	logoWidth = $(".logo").outerWidth();
		var	bookATourWidth = $(".bookATour").outerWidth();
			
			$(".pageHeaderImg").css("padding-top", headOuterHeight);

			/*Menu padding bottom */
			if ($(".headerWrap").hasClass("isSticky")) {
				var headerIsStickyHeight = $("#header").data("header-sticky-height");
				menu.children("ul").children("li").children("ul").css("padding-top", ( ( (headerIsStickyHeight / 2) - 23 ) + 13 ));
			} else {
				menu.children("ul").children("li").children("ul").css("padding-top", ( ( (headOuterHeight / 2) - 23 ) + 13 ));
			}
			$(window).on('scroll', function() {
				if ($(".headerWrap").hasClass("isSticky")) {
					var headerIsStickyHeight = $("#header").data("header-sticky-height");
					menu.children("ul").children("li").children("ul").css("padding-top", ( ( (headerIsStickyHeight / 2) - 23 ) + 13 ));
				} else {
					menu.children("ul").children("li").children("ul").css("padding-top", ( ( (headOuterHeight / 2) - 23 ) + 13 ));
				}
			});

			/* Menu show/hide */
			if ((mainMenuWidth + logoWidth + bookATourWidth + 40) >= winWidth) {
				$("body").addClass("showMobileMenuWrap");
			} else {
				$("body").removeClass("showMobileMenuWrap");
			}
			$(window).resize( function(e)
			{
				var winWidth = $(window).width();

			    if ((mainMenuWidth + logoWidth + bookATourWidth + 40) >= winWidth) {
					$("body").addClass("showMobileMenuWrap");
				} else {
					$("body").removeClass("showMobileMenuWrap");
				}
			});

		/* Footer menu */	
		var winWidth2 = $(window).width();
		var footermenuMiddleElement = (Math.ceil(( $(".footerMenu ul li").length ) / 2) ) - 1;
		var footerLogoWidth = $(".footerLogo a img").width();
		var footerLogoHeight = $(".footerLogo a img").height();
		$(".footerMenu ul li:eq("+ footermenuMiddleElement +")").addClass("logoNext").css("margin-right", footerLogoWidth + 52 + 23 );
		

		if (winWidth2 > 1023) {
		var footermenu = $(".footerMenu");
		var footermenuCountElement = $(".footerMenu ul li").length;
		var footermenuMiddleElement = (Math.ceil(( $(".footerMenu ul li").length ) / 2) ) - 1;
		var	footerMenuWidth = footermenu.width();
			
			var footermenuElementWidthValue1 = 0;
			var i = 0;
			for (i = 0; i < footermenuMiddleElement + 1; i++) {
				var footermenuElementWidthValue1 = footermenuElementWidthValue1 + $(".footerMenu ul li:eq("+ i +")").width();
			}

			var footermenuElementWidthValue2 = 0;
			var j = 0;
			for (j = footermenuMiddleElement+1; j < footermenuCountElement + 1; j++) {
				var footermenuElementWidthValue2 = footermenuElementWidthValue2 + $(".footerMenu ul li:eq("+ j +")").width();
			}

			if (footermenuElementWidthValue1 > footermenuElementWidthValue2) {
				var value10 = footermenuElementWidthValue1 - footermenuElementWidthValue2;
				
				if ((footermenuCountElement % 2) == 0 ) {
					footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) - (value10 / 2) ) );
				} else {
					footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) - (value10 / 2) - 25 ) );
				}
				

			} else if (footermenuElementWidthValue1 < footermenuElementWidthValue2) {
				var value11 = footermenuElementWidthValue2 - footermenuElementWidthValue1;

				if ((footermenuCountElement % 2) == 0 ) {
					footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) + (value11 / 2) ) );
				} else {
					footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) + (value11 / 2) - 25 ) );
				}
			}
			// if (footerLogoHeight > 76) {
			// 	footermenu.css("bottom", 134 - ((footerLogoHeight - 76) / 2) );
			// } else if (footerLogoHeight < 76) {
			// 	footermenu.css("bottom", 134 + ((76 - footerLogoHeight) / 2) );
			// }
		}

		$(window).resize( function(e){
			var winWidth3 = $(window).width();

			if (winWidth3 > 1023) {
			var footermenu = $(".footerMenu");
			var footermenuCountElement = $(".footerMenu ul li").length;
			var footermenuMiddleElement = (Math.ceil(( $(".footerMenu ul li").length ) / 2) ) - 1;
			var	footerMenuWidth = footermenu.width();
				
				var footermenuElementWidthValue1 = 0;
				var i = 0;
				for (i = 0; i < footermenuMiddleElement + 1; i++) {
					var footermenuElementWidthValue1 = footermenuElementWidthValue1 + $(".footerMenu ul li:eq("+ i +")").width();
				}

				var footermenuElementWidthValue2 = 0;
				var j = 0;
				for (j = footermenuMiddleElement+1; j < footermenuCountElement + 1; j++) {
					var footermenuElementWidthValue2 = footermenuElementWidthValue2 + $(".footerMenu ul li:eq("+ j +")").width();
				}

				if (footermenuElementWidthValue1 > footermenuElementWidthValue2) {
					var value10 = footermenuElementWidthValue1 - footermenuElementWidthValue2;
					
					if ((footermenuCountElement % 2) == 0 ) {
						footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) - (value10 / 2) ) );
					} else {
						footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) - (value10 / 2) - 25 ) );
					}
					

				} else if (footermenuElementWidthValue1 < footermenuElementWidthValue2) {
					var value11 = footermenuElementWidthValue2 - footermenuElementWidthValue1;

					if ((footermenuCountElement % 2) == 0 ) {
						footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) + (value11 / 2) ) );
					} else {
						footermenu.css("margin-left", ( (((footerMenuWidth) / 2 ) * - 1) + (value11 / 2) - 25 ) );
					}
				}
				// if (footerLogoHeight > 76) {
				// 	footermenu.css("bottom", 134 - ((footerLogoHeight - 76) / 2) );
				// } else if (footerLogoHeight < 76) {
				// 	footermenu.css("bottom", 134 + ((76 - footerLogoHeight) / 2) );
				// } else {
				// 	footermenu.css("bottom", 134 );
				// }
			} // else {
			// 	var footermenu = $(".footerMenu");
			// 	footermenu.css("bottom", "auto");
			// }
			    
		});

		/* Page header img */
		if( $('.pageHeaderImg').length > 0 ){
			$("body").addClass("pageHeaderImgWrap");
		}

		if($('.pageHeaderImg h1').length){
			var headOuterHeight = $(".headerWrap").outerHeight();
			$('.pageHeaderImg h1').css({
			   	'margin-top': ((( $('.pageHeaderImg h1').height() / 2 ) * -1 ) + (headOuterHeight / 2))
			});

			$(window).resize( function(e)
			{
			    var headOuterHeight = $(".headerWrap").outerHeight();
			    $('.pageHeaderImg h1').css({
				   	'margin-top': ((( $('.pageHeaderImg h1').height() / 2 ) * -1 ) + (headOuterHeight / 2))
				});
			});
		}

		/* Contact page */
		if( $('.page-template-templ-contact-php').length > 0 ){
			$("body").addClass("pageHeaderImgWrap");
			var headOuterHeight = $(".headerWrap").outerHeight();
			var headOuterStickyHeight = $("#header").data("header-sticky-height");
			var mapSectionHeight = $("#js-uni-templ-contact-wrap").height();
			$("#js-uni-templ-contact-wrap").css("padding-top", headOuterStickyHeight);
			$("#js-uni-templ-contact-wrap, #js-uni-templ-contact-wrap .uni-location-map, #js-uni-templ-contact-wrap .uni-location-map .uni-map-canvas").css("height", headOuterHeight - headOuterStickyHeight + mapSectionHeight);
			$(".contactInfo").css({
				"height": headOuterHeight - headOuterStickyHeight + mapSectionHeight,
				"top": headOuterStickyHeight
			});
			
		}

		$("body").addClass("page-loaded");

    });

    $("body").on("click", ".uni_input_submit", function (e) {
        var submit_button = $(this),
            this_form = submit_button.closest("form");
        this_form.submit();
    });

    $("body").on("submit", ".uni_form", function (e) {

        var submit_button = $(this),
            this_form = submit_button.closest("form"),
            action = this_form.attr('action');
            //console.log(submit_button);
        var form_valid = this_form.parsley({excluded: '[disabled]'}).validate();

            if ( form_valid ) {
                var dataToSend = this_form.serialize();

			    $.ajax({
				    type: 'post',
	        	    url: action,
	        	    data: dataToSend + '&cheaters_always_disable_js=' + 'true_bro',
	        	    dataType: 'json',
	        	    beforeSend: function(){
	        	        this_form.block({
	        	            message: null,
                            overlayCSS: { background: '#fff', opacity: 0.6 }
                        });
	        	    },
	        	    success: function(response) {
	        		    if ( response.status == "success" ) {

                            // Triggers an event - success
			                $( document.body ).trigger( 'uni_coworking_theme_form_submit_success', [ this_form.serializeArray(), response ] );

                            this_form.unblock();
                            uni_popup_message(response.message, "success");

	        		    } else if ( response.status == "error" ) {

                            // Triggers an event - error
			                $( document.body ).trigger( 'uni_coworking_theme_form_submit_error', [ this_form.serializeArray(), response ] );

                            this_form.unblock();
                            uni_popup_message(response.message, "error");
	        		    }
	        	    },
	        	    error:function(response){
	        	        this_form.unblock();
	        	        uni_popup_message(uni_coworking_theme_var.error_msg, "warning");
	        	    }
	            });
            }
            return false;
    });

/* --------------------
	Remodal
----------------------*/
    $('[data-remodal-id=bookingForm], [data-remodal-id=joinForm], [data-remodal-id=eventRegistrationPopup]').remodal();
    var uniPriceRemodal = $('[data-remodal-id=priceForm]').remodal();

    $("body").on("click", ".js-price-form-link", function (e) {
        e.preventDefault();

        var price_id = $(this).data("priceid"),
            price_title = $(this).data("pricetitle");

        $("#js-price-title").empty().text(price_title);
        $("input[name=uni_price_id]").val(price_id);
        uniPriceRemodal.open();
    });

    //
    //Cookies.remove('uni_is_retina');
    var uni_is_retina = Cookies.get('uni_is_retina');
    if ( typeof uni_is_retina === 'undefined' ) {
        Cookies.set('uni_is_retina', uniIsRetina(), { expires: 7 });
        window.location.reload();
    }

    function uniIsRetina(){
        return ((window.matchMedia && (window.matchMedia('only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx), only screen and (min-resolution: 75.6dpcm)').matches || window.matchMedia('only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (min--moz-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2)').matches)) || (window.devicePixelRatio && window.devicePixelRatio >= 2)) && /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
    }

});