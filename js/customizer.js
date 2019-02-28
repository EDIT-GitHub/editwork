jQuery( document ).ready( function( $ ) {
    'use strict';

    wp.customize( 'coworking_options[uni_home_static_screen_title]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-static-screen-title' ).html(to);
		} );
	} );
    wp.customize( 'coworking_options[uni_home_static_screen_text]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-static-screen-text' ).html(to);
		} );
	} );
    wp.customize( 'coworking_options[uni_home_static_screen_more_link_text]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-static-screen-link' ).text(to);
		} );
	} );

    wp.customize( 'coworking_options[uni_home_about_one_title]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-about-one-title' ).html(to);
		} );
	} );
    wp.customize( 'coworking_options[uni_home_about_one_text]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-about-one-text' ).html(to);
		} );
	} );
    wp.customize( 'coworking_options[uni_home_about_one_more_link_text]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-about-one-link' ).text(to);
		} );
	} );

    wp.customize( 'coworking_options[uni_home_about_two_title]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-about-two-title' ).html(to);
		} );
	} );
    wp.customize( 'coworking_options[uni_home_about_two_text]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-about-two-text' ).html(to);
		} );
	} );
    wp.customize( 'coworking_options[uni_home_about_two_more_link_text]', function( value ) {
		value.bind( function( to ) {
		    $( '.js-about-two-link' ).text(to);
		} );
	} );

    wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
		if ( placement.partial.id === 'coworking_options[uni_custom_logo_footer]' ) {

			$(".footerLogo a img").on('load', function(){
		    	/* Footer menu */	
				var winWidth2 = $(window).width();
				var footermenuMiddleElement = (Math.ceil(( $(".footerMenu ul li").length ) / 2) ) - 1;
				var footerLogoWidth = $(".footerLogo a img").width();
				var footerLogoHeight = $(".footerLogo a img").height();
				$(".footerMenu ul li:eq("+ footermenuMiddleElement +")").addClass("logoNext").css("margin-right", footerLogoWidth + 52 + 23 );
				
				console.log(footerLogoWidth +""+ footerLogoHeight);

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
					if (footerLogoHeight > 76) {
						footermenu.css("bottom", 134 - ((footerLogoHeight - 76) / 2) );
					} else if (footerLogoHeight < 76) {
						footermenu.css("bottom", 134 + ((76 - footerLogoHeight) / 2) );
					}
				}
			});
		    
		}
	} );

});