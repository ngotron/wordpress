/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// logo width
	wp.customize( 'bloginwp_site_logo_width', function( value ) {
		value.bind( function( to ) {
			if( $("#bloginwp-header-logo-width-css").length > 0 ) {
				$("#bloginwp-header-logo-width-css").html( '.logo_wrap img.custom-logo { max-width :' + to.desktop + 'px } @media only screen and (max-width: 768px) { .logo_wrap img.custom-logo { max-width:' + to.tablet + 'px } } @media only screen and (max-width: 320px) { .logo_wrap img.custom-logo { max-width:' + to.smartphone + 'px } }' )
			} else {
				$("head").append( '<style id="bloginwp-header-logo-width-css">.logo_wrap img.custom-logo { max-width :' + to.desktop + 'px } @media only screen and (max-width: 768px) { .logo_wrap img.custom-logo { max-width:' + to.tablet + 'px } } @media only screen and (max-width: 320px) { .logo_wrap img.custom-logo { max-width:' + to.smartphone + 'px } }</style>' )
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	});

	// blog description
	wp.customize( 'blogdescription_option', function( value ) {
		value.bind(function(to) {
			if( to ) {
				$( '.site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		})
	});
	
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	});

	// header hover text color
	wp.customize( 'header_hover_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a:hover' ).css( {
				color: to,
			});
		} );
	});

	// header search icon color
	wp.customize( 'header_search_toggle_color_group', function( value ) {
		value.bind( function( to ) {
			if(to.color) {
				$( "body header .header-wrapper .search__icon-group #search" ).css({
					color: to.color
				})
			} else {
				$( "body header .header-wrapper .search__icon-group #search" ).css({
					color: 'initial'
				})
			}
			if(to.hover) {
				$( "body header .header-wrapper .search__icon-group #search" ).mouseover(function() {
					$(this).css({
						color: to.hover
					})
				})
				$( "body header .header-wrapper .search__icon-group #search" ).mouseout(function() {
					var _this = $(this);
					if(to.color) {
						_this.css({
							color: to.color
						})
					} else {
						_this.css({
							color: 'initial'
						})
					}
				})
			} else {
				$("body header .header-wrapper .search__icon-group #search").unbind(); 
			}
		} );
	});

	// header toggle icon color
	wp.customize( 'header_sidebar_toggle_color_group', function( value ) {
		value.bind( function( to ) {
			if(to.color) {
				$( ".sidebar-toggle-trigger .hamburger span" ).each(function() {
					$(this).css({
						background: to.color
					})
				})
			} else {
				$( ".sidebar-toggle-trigger .hamburger span" ).each(function() {
					$(this).removeAttr('style')
				})
			}
			if( to.hover ) {
				$( ".sidebar-toggle-trigger" ).mouseover(function() {
					var _this = $(this)
					_this.find(".hamburger span").css({
						background: to.hover
					})
				})
				$( ".sidebar-toggle-trigger" ).mouseout(function() {
					var _this = $(this)
					if(to.color) {
						_this.find(".hamburger span").css({
							background: to.color
						})
					} else {
						_this.find(".hamburger span").removeAttr('style')
					}
				})
			} else {
				$(".sidebar-toggle-trigger").unbind(); 
			}
		} );
	});

	// header social icon color
	wp.customize( 'header_social_color_group', function( value ) {
		value.bind( function( to ) {
			if(to.color) {
				$( ".top-header .social a i" ).css({
					color: to.color
				})
			} else {
				$( ".top-header .social a i" ).css({
					color: 'initial'
				})
			}
			if(to.hover) {
				$( ".top-header .social a i" ).mouseover(function() {
					$(this).css({
						color: to.hover
					})
				})
				$( ".top-header .social a i" ).mouseout(function() {
					var _this = $(this);
					if(to.color) {
						_this.css({
							color: to.color
						})
					} else {
						_this.css({
							color: 'initial'
						})
					}
				})
			} else {
				$(".top-header .social a i").unbind(); 
			}
		} );
	});

	// top header menu color
	wp.customize( 'top_header_menu_color_group', function( value ) {
		value.bind( function( to ) {
			if(to.color) {
				$( "#top-header-menu li a" ).css({
					color: to.color
				})
			} else {
				$( "#top-header-menu li a" ).css({
					color: 'initial'
				})
			}
			if(to.hover) {
				$( "#top-header-menu li" ).mouseover(function() {
					$(this).find( "a" ).css({
						color: to.hover
					})
				})
				$( "#top-header-menu li" ).mouseout(function() {
					var _this = $(this).find("a");
					if(to.color) {
						_this.css({
							color: to.color
						})
					} else {
						_this.css({
							color: 'initial'
						})
					}
				})
			} else {
				$("#top-header-menu li").unbind(); 
			}
		} );
	});
	
	// header Menu Font Color
	wp.customize( 'header_menu_font_color', function( value ) {
		value.bind( function( to ) {
			if(to.color) {
				$( "header .header-wrapper nav ul>li>a" ).css({
					color: to.color
				})
			} else {
				$( "header .header-wrapper nav ul>li>a" ).css({
					color: 'initial'
				})
			}
			if(to.hover) {
				$( "header .header-wrapper nav ul>li>a" ).mouseover(function() {
					$(this).css({
						color: to.hover
					})
				})
				$( "header .header-wrapper nav ul>li>a" ).mouseout(function() {
					var _this = $(this);
					if(to.color) {
						_this.css({
							color: to.color
						})
					} else {
						_this.css({
							color: 'initial'
						})
					}
				})
			} else {
				$("header .header-wrapper nav ul>li>a").unbind(); 
			}
		} );
	});

	// header Bakground color
	wp.customize( 'header_menu_background_color', function( value ) {
		value.bind( function( to ) {
			if( to != 'null' ) {
				$( 'header .header-wrapper .menu_nav_content' ).css( {
					'background-color': to,
				});
			} else {
				$( 'header .header-wrapper .menu_nav_content' ).removeAttr('style')
			}
		} );
	});

	// header Menu Submenu Font Color
	wp.customize( 'header_sub_menu_font_color', function( value ) {
		value.bind( function( to ) {
			if(to.color) {
				$( "header .header-wrapper nav ul>li .sub-menu li a" ).css({
					color: to.color
				})
			} else {
				$( "header .header-wrapper nav ul>li .sub-menu li a" ).css({
					color: 'initial'
				})
			}
			if(to.hover) {
				$( "header .header-wrapper nav ul>li .sub-menu li a" ).mouseover(function() {
					$(this).css({
						color: to.hover
					})
				})
				$( "header .header-wrapper nav ul>li .sub-menu li a" ).mouseout(function() {
					var _this = $(this);
					if(to.color) {
						_this.css({
							color: to.color
						})
					} else {
						_this.css({
							color: 'initial'
						})
					}
				})
			} else {
				$("header .header-wrapper nav ul>li .sub-menu li a").unbind(); 
			}
		} );
	});

	// header_background
	wp.customize( 'header_background', function( value ) {
		value.bind( function( to ) {
			var parsedTo = JSON.parse(to)
			if( parsedTo.type == 'image' ) {
				if( parsedTo[parsedTo.type].media_url ) {
					$( 'body #main-header, body header.theme-default' ).css({ 'background-image':'url( ' + parsedTo[parsedTo.type].media_url + ' )', 'background-position': parsedTo.position, 'background-repeat': parsedTo.repeat,'background-attachment': parsedTo.attachment,'background-size': parsedTo.size })
				} else {
					$( 'body #main-header, body header.theme-default' ).removeAttr( 'style' )
				}
			} else {
				if( parsedTo[parsedTo.type] ) {
					$( 'body #main-header, body header.theme-default' ).css( 'background', parsedTo[parsedTo.type] )
				} else {
					$( 'body #main-header, body header.theme-default' ).removeAttr( 'style' )
				}
			}
		});
	});

	// top_header_background
	wp.customize( 'top_header_background', function( value ) {
		value.bind( function( to ) {
			var parsedTo = JSON.parse(to)
			if( parsedTo.type == 'image' ) {
				if( parsedTo[parsedTo.type].media_url ) {
					$( '.top-header' ).css({ 'background-image':'url( ' + parsedTo[parsedTo.type].media_url + ' )', 'background-position': parsedTo.position, 'background-repeat': parsedTo.repeat,'background-attachment': parsedTo.attachment,'background-size': parsedTo.size })
				} else {
					$( '.top-header' ).removeAttr( 'style' )
				}
			} else {
				if( parsedTo[parsedTo.type] ) {
					$( '.top-header' ).css( 'background', parsedTo[parsedTo.type] )
				} else {
					$( '.top-header' ).removeAttr( 'style' )
				}
			}
		});
	});

	// footer_three_column_background_color
	wp.customize( 'footer_three_column_background_color', function( value ) {
		value.bind( function( to ) {
			if( to[to.type] ) {
				$( '#bloginwp-footer-three-column-section' ).css( 'background', to[to.type] )
			} else {
				$( '#bloginwp-footer-three-column-section' ).removeAttr( 'style' )
			}
		});
	});

	// bottom footer background color
	wp.customize( 'bottom_footer_bg_color', function( value ) {
		value.bind( function( to ) {
			if( to[to.type] ) {
				$( '#bottom-footer, #bottom-footer .copyright' ).css( 'background', to[to.type] )
			} else {
				$( '#bottom-footer, #bottom-footer .copyright' ).removeAttr( 'style' )
			}
		});
	});
}( jQuery ) );
