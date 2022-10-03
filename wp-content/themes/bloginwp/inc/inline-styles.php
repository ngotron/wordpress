<?php
/**
 * Includes the inline css
 * 
 * @package Bloginwp
 * @since 1.0.0
 * 
 */

// theme color and hover color
$bloginwp_theme_color	= get_theme_mod( 'bloginwp_theme_color');
$bloginwp_theme_hover_color = get_theme_mod( 'bloginwp_theme_hover_color', '#717171' );
//page background color
$bloginwp_bk_color = get_theme_mod('background_color');
if($bloginwp_bk_color ) {
	echo "body .bmm-block-categories-collection--layout-one h5 span.section-title-inner, body .bmm-block-categories-collection--layout-one .categories-wrap .slick-arrow  { background-color: #" .esc_attr( $bloginwp_bk_color ). "; }";
}

// site logo
$bloginwp_site_logo_width = get_theme_mod( 'bloginwp_site_logo_width' );
if( $bloginwp_site_logo_width ) :
	if( $bloginwp_site_logo_width['desktop'] ) echo ".logo_wrap img.custom-logo { max-width: " .absint( $bloginwp_site_logo_width['desktop'] ). "px }\n";
	if( $bloginwp_site_logo_width['tablet'] ) echo "@media only screen and (max-width: 768px) { .logo_wrap img.custom-logo { max-width: " .absint( $bloginwp_site_logo_width['tablet'] ). "px } }\n";
	if( $bloginwp_site_logo_width['smartphone'] ) echo "@media only screen and (max-width: 320px) { .logo_wrap img.custom-logo { max-width: " .absint( $bloginwp_site_logo_width['smartphone'] ). "px } }\n";
endif; 

/* theme color **/
if($bloginwp_theme_color):
	echo ":root {
		--theme-color: ".esc_attr($bloginwp_theme_color).";
	}";
	echo ".blog-ocean__slider.layout-one .card__content-title span { color: ".esc_attr($bloginwp_theme_color) .";}";
	echo ".blog-ocean__slider.layout-one .slick-arrow.slick-next:before { background-color: ".esc_attr($bloginwp_theme_color) .";}";
endif;

echo ".widget.widget_block h2.bloginwp-widget-title span::after, h2.bloginwp-widget-title span::after { border-color: transparent transparent transparent " .esc_attr( $bloginwp_theme_color ). " }\n";
echo ".widget.widget_block h2.bloginwp-widget-title, h2.bloginwp-widget-title { border-color: " .esc_attr( $bloginwp_theme_color ). " }\n";
if($bloginwp_theme_hover_color){
	echo "body .post-card .card__content-title:hover, 
	body .post-card .card__content .more-btn:hover, 
	body .wp-block-latest-posts__list a:hover,
	.widget_bloginwp_posts_list_widget .post-card .bmm-post-title a:hover
	 { color:" .esc_attr( $bloginwp_theme_hover_color ). "!important; }\n";


	 echo "body .post-card .card__content-title, body .blog-flower__slide.layout-two .post-card .card__content-title, body .blog-food__slide.layout-three .post-card .card__content-title{ 
	 	background-image: linear-gradient(transparent calc(100% - 1px), ". esc_attr( $bloginwp_theme_hover_color ) ." 1px);
	 }\n";

	 echo "body .btn:hover, .post-footer__comment .comment-form .submit:hover {
    background-color:".esc_attr( $bloginwp_theme_hover_color ).";
    -webkit-box-shadow: 0 0 15px ".esc_attr( $bloginwp_theme_hover_color ).";
    box-shadow: 0 0 15px ".esc_attr( $bloginwp_theme_hover_color ).";
	}";
}
echo "header .header-wrapper .header__icon-group a:hover { color: " .esc_attr( $bloginwp_theme_hover_color ). "}";
echo ".bloginwp-load-more:hover { background-color:" .esc_attr( $bloginwp_theme_hover_color ). " }\n";

// footer three column section
$footer_three_column_option = get_theme_mod( 'footer_three_column_option', 'all' );
if( $footer_three_column_option != 'hide' ) :
	// footer background color
	$footer_three_column_bg_color = get_theme_mod( 'footer_three_column_background_color');
	if( isset ( $footer_three_column_bg_color['type']) && $footer_three_column_bg_color['type'] ){
		$footer_three_column_bg_color_actual = isset( $footer_three_column_bg_color[$footer_three_column_bg_color['type']] ) ? $footer_three_column_bg_color[$footer_three_column_bg_color['type']] : false;

		if($footer_three_column_bg_color_actual){
			echo "body #bloginwp-footer-three-column-section { background: " .esc_attr( $footer_three_column_bg_color_actual )."}\n";
		}
	}

	// footer font color
	$footer_three_column_color = get_theme_mod( 'footer_three_column_font_color');
	if($footer_three_column_color) {
		if ( isset($footer_three_column_color['color']) && $footer_three_column_color['color'] ){
			echo "body #bloginwp-footer-three-column-section a, body #bloginwp-footer-three-column-section h5, body #bloginwp-footer-three-column-section p {color: " .esc_attr( $footer_three_column_color['color'] ). "!important;}\n";
		}
		if (isset( $footer_three_column_color['hover']) && $footer_three_column_color['hover'] ){
			echo "body #bloginwp-footer-three-column-section a:hover {color: " .esc_attr( $footer_three_column_color['hover'] ). "!important}\n";
		}
	}
	//footer padding
	$footer_three_column_padding = get_theme_mod( 'footer_three_column_padding', array( 'desktop'   => array( 'top'=>'50px', 'right'	=> '50px', 'bottom'	=> '50px', 'left'	=> '50px' ), 'tablet'   => array( 'top'=>'20px', 'right'	=> '20px', 'bottom'	=> '20px', 'left'	=> '20px' ), 'smartphone'   => array( 'top'=>'10px', 'right'	=> '10px', 'bottom'	=> '10px', 'left'	=> '10px' ) ) );
	echo "#bloginwp-footer-three-column-section { padding: " .esc_attr( $footer_three_column_padding['desktop']['top'] ). " " .esc_attr( $footer_three_column_padding['desktop']['right'] ). " " .esc_attr( $footer_three_column_padding['desktop']['bottom'] ). " " .esc_attr( $footer_three_column_padding['desktop']['left'] ). "}\n";
	echo "@media only screen and (max-width: 768px) { #bloginwp-footer-three-column-section { padding: " .esc_attr( $footer_three_column_padding['tablet']['top'] ). " " .esc_attr( $footer_three_column_padding['tablet']['right'] ). " " .esc_attr( $footer_three_column_padding['tablet']['bottom'] ). " " .esc_attr( $footer_three_column_padding['tablet']['left'] ). " } }\n";
	echo "@media only screen and (max-width: 320px) { #bloginwp-footer-three-column-section { padding: " .esc_attr( $footer_three_column_padding['smartphone']['top'] ). " " .esc_attr( $footer_three_column_padding['smartphone']['right'] ). " " .esc_attr( $footer_three_column_padding['smartphone']['bottom'] ). " " .esc_attr( $footer_three_column_padding['smartphone']['left'] ). " } }\n";
endif;


// footer colophon section
$footer_hover_color = get_theme_mod( 'footer_hover_color', '#ffffff' );
$footer_bg_image = get_theme_mod( 'footer_bg_image' );
// footer text color
$footer_color = get_theme_mod( 'footer_color');
if(isset($footer_color['color']) && $footer_color['color']){
	echo "footer#colophon a, footer#colophon h5, footer#colophon h2, footer#colophon h4, footer#colophon p, footer#colophon div {color: " .esc_attr( $footer_color['color'] ). ";}\n";
}
if(isset($footer_color['hover']) && $footer_color['hover']){
	echo "footer#colophon a:hover { color: ".esc_attr( $footer_color['color'] ).";}";
}

// Scroll to Top
if( get_theme_mod( 'scroll_to_top_option', true ) ) :
	//scroll to top border
   $scroll_to_top_border_style = get_theme_mod( 'scroll_to_top_border');
   // padding
   $scroll_to_top_padding = get_theme_mod('scroll_to_top_padding');
   if($scroll_to_top_padding && isset($scroll_to_top_padding)){
   		echo "body #bloginwp-scroll-to-top.show { padding: ".esc_attr($scroll_to_top_padding['desktop']['top'])." ".esc_attr($scroll_to_top_padding['desktop']['right'])." ". esc_attr($scroll_to_top_padding['desktop']['bottom']) ." ". esc_attr($scroll_to_top_padding['desktop']['left']) ."}";
   		echo "@media(max-width:769px){ body #bloginwp-scroll-to-top.show { padding: ".esc_attr($scroll_to_top_padding['tablet']['top'])." ".esc_attr($scroll_to_top_padding['tablet']['right'])." ". esc_attr($scroll_to_top_padding['tablet']['bottom']) ." ". esc_attr($scroll_to_top_padding['tablet']['left']) ."} }";
   		echo "@media(max-width:542px){  body #bloginwp-scroll-to-top.show { padding: ".esc_attr($scroll_to_top_padding['smartphone']['top'])." ".esc_attr($scroll_to_top_padding['smartphone']['right'])." ". esc_attr($scroll_to_top_padding['smartphone']['bottom']) ." ". esc_attr($scroll_to_top_padding['smartphone']['left']) ."}}";
   }
   //scroll to top show hide in responsive
   $scroll_to_top_showhide = get_theme_mod('scroll_to_top_responsive_display', false);
   if($scroll_to_top_showhide == false ) {
   	echo "@media(max-width: 769px){ #bloginwp-scroll-to-top { display: none; } }";
   }

   if($scroll_to_top_border_style && isset($scroll_to_top_border_style) ){
	echo "body #bloginwp-scroll-to-top { 
		border-width: " .esc_attr( $scroll_to_top_border_style['width'] ). "px;
		border-style: " .esc_attr( $scroll_to_top_border_style['type'] ). ";
		border-radius: " .esc_attr( $scroll_to_top_border_style['radius'] ). "%;
		border-color: " .esc_attr( $scroll_to_top_border_style['color'] ). ";
	}\n";
   }
endif;

// header background settings
$header_background_styles = json_decode( get_theme_mod( 'header_background', json_encode(array(
            'type'  => 'solid',
            'solid' => null,
            'gradient'  => null,
            'image'     => array( 'media_id' => 0, 'media_url' => '' )
        ))
    )
);
if( isset($header_background_styles) && $header_background_styles ){
    $background_type = $header_background_styles->type;
    switch( $background_type ) {
        case 'image'    : echo 'body #main-header, body header.theme-default { background: url("' . esc_url( $header_background_styles->image->media_url ). '");     background-size: cover;
		    background-position: center center;
		    background-repeat: no-repeat; }';
                        break;
                default : echo "body #main-header, body header.theme-default { background: " . esc_attr( $header_background_styles->$background_type ). ";}\n";
    }
}

// top header background settings
$top_header_background_styles = json_decode( get_theme_mod( 'top_header_background', json_encode(array(
			'type'  => 'solid',
			'solid' => null,
			'gradient'  => null,
			'image'     => array( 'media_id' => 0, 'media_url' => '' )
		))
	)
);
if( isset($top_header_background_styles) && $top_header_background_styles ) {
$background_type = $top_header_background_styles->type;
switch( $background_type ) {
	case 'image'    : echo '.top-header { background: url("' . esc_url( $top_header_background_styles->image->media_url ). '"); background-size: cover; background-position: center center; background-repeat: no-repeat; }';
					break;
			default : echo ".top-header { background: " . esc_attr( $top_header_background_styles->$background_type ). ";}\n";
	}
}

 // header search toggle 
 $header_search_toggle_color_group = get_theme_mod( 'header_search_toggle_color_group');
 if ( $header_search_toggle_color_group ):
 if( isset( $header_search_toggle_color_group['color'] ) ) echo "body .search__icon-group #search { color: ". esc_attr($header_search_toggle_color_group['color']).";}\n";
 if( isset( $header_search_toggle_color_group['hover'] ) ) echo "body .search__icon-group #search:hover { color: ". esc_attr($header_search_toggle_color_group['hover']).";}\n";
endif;

 // header sidebar toggle bar
 $header_sidebar_toggle_color_group = get_theme_mod( 'header_sidebar_toggle_color_group', array( 'color'   => null, 'hover'   => null ) );
 if( isset( $header_sidebar_toggle_color_group['color'] ) && $header_sidebar_toggle_color_group['color'] ) echo "body .sidebar-toggle-trigger .hamburger span{ background: ". esc_attr($header_sidebar_toggle_color_group['color']).";}\n";
 if( isset( $header_sidebar_toggle_color_group['hover'] ) && $header_sidebar_toggle_color_group['hover'] ) echo "body .sidebar-toggle-trigger .hamburger:hover span{ background: ". esc_attr($header_sidebar_toggle_color_group['hover']).";}\n";

  // header search toggle 
 $header_social_color_group = get_theme_mod( 'header_social_color_group', array( 'color'   => null, 'hover'   => null ) );
 if( isset( $header_social_color_group['color'] ) && $header_social_color_group['color'] ) echo ".top-header .social a i { color: ". esc_attr($header_social_color_group['color']).";}\n";
 if( isset( $header_social_color_group['hover'] ) && $header_social_color_group['hover'] ) echo ".top-header .social a:hover i { color: ". esc_attr($header_social_color_group['hover']).";}\n";

// top header menu color
 $top_header_menu_color_group = get_theme_mod( 'top_header_menu_color_group', array( 'color'   => null, 'hover'   => null ) );
 if( isset( $top_header_menu_color_group['color'] ) && $top_header_menu_color_group['color'] ) echo "#top-header-menu li { color: ". esc_attr($top_header_menu_color_group['color']).";}\n";
 if( isset( $top_header_menu_color_group['hover'] ) && $top_header_menu_color_group['hover'] ) echo "#top-header-menu li:hover a { color: ". esc_attr($top_header_menu_color_group['hover']).";}\n";

 // header social icons styles
 $social_icons_padding_top = get_theme_mod( 'social_icons_padding_top', 2 );
 $social_icons_padding_right = get_theme_mod( 'social_icons_padding_right', 2 );
 $social_icons_padding_bottom = get_theme_mod( 'social_icons_padding_bottom', 2 );
 $social_icons_padding_left = get_theme_mod( 'social_icons_padding_left', 2 );

 $social_icons_color = get_theme_mod( 'social_icons_color', '#111111' );
 $social_icons_hover_color = get_theme_mod( 'social_icons_hover_color', '#101010' );

 $social_icons_bg_type = get_theme_mod('social_icons_bg_type', 'transparent');

 $social_icons_bg_color = get_theme_mod( 'social_icons_bg_color', '#f0f0f0' );
 $social_icons_hover_bg_color = get_theme_mod( 'social_icons_hover_bg_color', '#262626' );

 $social_icons_border = get_theme_mod( 'social_icons_border', 'hide' );
  if( $social_icons_border === 'show' ) :
	$social_icons_border_width = get_theme_mod( 'social_icons_border_width', '1' );
	$social_icons_border_radius = get_theme_mod( 'social_icons_border_radius', '0' ); 
	$social_icons_border_color = get_theme_mod( 'social_icons_border_color', '#000000' );
  endif;

  echo "header .social i { color: ". esc_attr($social_icons_color).";}";

  echo "header .social a:hover i { color: ". esc_attr($social_icons_hover_color).";}";

  if($social_icons_bg_type == 'solid'){
  	echo "header .social a { background-color: ". esc_attr($social_icons_bg_color).";}";

  	echo "header .social a:hover { background-color: ". esc_attr($social_icons_hover_bg_color).";}";
  }
  echo "header .social a { padding: " .esc_attr( $social_icons_padding_top ). "px " .esc_attr( $social_icons_padding_right ). "px " .esc_attr( $social_icons_padding_bottom ). "px " .esc_attr( $social_icons_padding_left ). "px; }\n";

  if( $social_icons_border === 'show' ) :
  	echo "header .social a{ border:".esc_attr( $social_icons_border_width )."px solid ". esc_attr($social_icons_border_color) ." }";
  	echo "header .social a{ border-radius: ".esc_attr( $social_icons_border_radius )."%}";
  endif;

 // header menu 
 $header_menu_font_family = get_theme_mod( 'header_menu_font_family', 'Montserrat' );
 $header_menu_font_weight = get_theme_mod( 'header_menu_font_weight', 600 );
 $header_menu_font_style = get_theme_mod( 'header_menu_font_style', 'normal' );
 $header_menu_font_size = get_theme_mod( 'header_menu_font_size', 14 );
 $header_menu_line_height = get_theme_mod( 'header_menu_line_height', 15 );

 // site title typography
 $site_title_font_family = get_theme_mod( 'site_title_font_family', 'Montserrat' );
 $site_title_font_weight = get_theme_mod( 'site_title_font_weight', 500 );
 $site_title_font_style = get_theme_mod( 'site_title_font_style', 'normal' );
 $site_title_font_size = get_theme_mod( 'site_title_font_size', 41 );
 $site_title_line_height = get_theme_mod( 'site_title_line_height', 1 );

 echo "body header .site-title a{ font-family: " .esc_attr( $site_title_font_family ). ", serif; font-weight: " .esc_attr( $site_title_font_weight ). "; font-style: " .esc_attr( $site_title_font_style ). "; font-size: " .esc_attr( $site_title_font_size ). "px; line-height: " .esc_attr( $site_title_line_height ). "}";
 echo "header .header-wrapper nav ul>li>a { font-family: " .esc_attr( $header_menu_font_family ). "; font-weight: " .esc_attr( $header_menu_font_weight ). "; font-style: " .esc_attr( $header_menu_font_style ). "; font-size: " .esc_attr( $header_menu_font_size ). "px; line-height: " .esc_attr( $header_menu_line_height ). "px}";
echo "body #site-navigation li.menu-item-has-children:after, body #site-navigation li.page_item_has_children:after { line-height: ". esc_attr( $header_menu_line_height ) ."px;}";
 $bloginwp_container_width = get_theme_mod('bloginwp_global_container_width', 1175 ); // container width
 $bloginwp_global_container_padding = get_theme_mod( 'bloginwp_global_container_padding', array( 'desktop'   => array( 'top'=>'0px', 'right'	=> '0px', 'bottom'	=> '0px', 'left'	=> '0px' ), 'tablet'   => array( 'top'=>'0px', 'right'	=> '0px', 'bottom'	=> '0px', 'left'	=> '0px' ), 'smartphone'   => array( 'top'=>'0px', 'right'	=> '0px', 'bottom'	=> '0px', 'left'	=> '0px' ) ) ); // container padding
 $bloginwp_sidebar_width = get_theme_mod('bloginwp_global_container_sidebar_width', 25); // sidebar width
 $bloginwp_primary_width = 100 - $bloginwp_sidebar_width;
 echo "@media (min-width: 1170px){ .container { max-width: " .esc_attr( $bloginwp_container_width ). "px} }\n";
 // container padding inline styles
 echo "#page { padding: " .esc_attr( $bloginwp_global_container_padding['desktop']['top'] ). " " .esc_attr( $bloginwp_global_container_padding['desktop']['right'] ). " " .esc_attr( $bloginwp_global_container_padding['desktop']['bottom'] ). " " .esc_attr( $bloginwp_global_container_padding['desktop']['left'] ). "}\n";
 echo "@media only screen and (max-width: 768px) { #page { padding: " .esc_attr( $bloginwp_global_container_padding['tablet']['top'] ). " " .esc_attr( $bloginwp_global_container_padding['tablet']['right'] ). " " .esc_attr( $bloginwp_global_container_padding['tablet']['bottom'] ). " " .esc_attr( $bloginwp_global_container_padding['tablet']['left'] ). " } }\n";
 echo "@media only screen and (max-width: 320px) { #page { padding: " .esc_attr( $bloginwp_global_container_padding['smartphone']['top'] ). " " .esc_attr( $bloginwp_global_container_padding['smartphone']['right'] ). " " .esc_attr( $bloginwp_global_container_padding['smartphone']['bottom'] ). " " .esc_attr( $bloginwp_global_container_padding['smartphone']['left'] ). " } }\n";

 // container background
 $bloginwp_global_container_background_styles = get_theme_mod( 'bloginwp_global_container_background', json_encode(array(
		'type'  => 'solid',
		'solid' => null,
		'gradient'  => null,
		'image'     => array( 'media_id' => 0, 'media_url' => '' )
	))
 );
	// if( isset($bloginwp_global_container_background_styles) && $bloginwp_global_container_background_styles ) {
	// 	$background_type = $bloginwp_global_container_background_styles->type;
	// 	switch( $background_type ) {
	// 		case 'image'    : echo '.container { background: url("' . esc_url( $bloginwp_global_container_background_styles->image->media_url ). '"); background-size: cover; background-position: center center; background-repeat: no-repeat; }';
	// 						break;
	// 				default : echo ".container { background: " . esc_attr( $bloginwp_global_container_background_styles->$background_type ). ";}\n";
	// 		}
	// }
 // sidebar width inline styles
 echo "@media (min-width: 768px){ .secondary-section { max-width: " .esc_attr( $bloginwp_sidebar_width  ). "%;
		flex: 0 0 ". esc_attr( $bloginwp_sidebar_width  ) ."%;
	} .primary-section { max-width: " .esc_attr( $bloginwp_primary_width ). "%; flex: 0 0 ". esc_attr( $bloginwp_primary_width  ) ."%;} }\n";

// header menu font color
$header_menu_font_color = get_theme_mod( 'header_menu_font_color');
if(isset($header_menu_font_color['color']) && $header_menu_font_color['color']){
	echo "header .header-wrapper nav ul>li>a, header .header-wrapper nav ul>li:after  { color : ". esc_attr( $header_menu_font_color['color'] ) ."; }";
}
if(isset($header_menu_font_color['hover']) && $header_menu_font_color['hover']){
	echo "header .header-wrapper nav ul>li>a:hover, header .header-wrapper nav ul>li> .sub-menu li>a:hover { color : ". esc_attr( $header_menu_font_color['hover'] ) ."; }";
}

// sub menu Background colors
$header_sub_menu_background_color = get_theme_mod( 'header_sub_menu_background_color');
if(isset($header_sub_menu_background_color['color']) && $header_sub_menu_background_color['color']) {
	echo "body header .header-wrapper nav ul>li > .sub-menu, body header nav.toggled  { background-color : ". esc_attr( $header_sub_menu_background_color['color'] ) ."; }";
}
if(isset($header_sub_menu_background_color['hover']) && $header_sub_menu_background_color['hover']){
	echo "header .header-wrapper nav ul>li > .sub-menu:hover, header nav.toggled:hover { background-color : ". esc_attr( $header_sub_menu_background_color['hover'] ) ."; }";
}

// active color
$header_active_menu_color = get_theme_mod('header_active_menu_font_color');

if($header_active_menu_color && isset($header_active_menu_color) ) {
	echo "header .header-wrapper nav ul>li.current-menu-item a, header .header-wrapper nav ul>li.current_page_item a,
	#site-navigation li.current-menu-item:after { color : ". esc_attr( $header_active_menu_color ) ."; }";
	echo "header .header-wrapper nav ul>li>a:after { background-color : ". esc_attr( $header_active_menu_color ) ."; }";
}

// toggle button color
$header_menu_mobile_toggle_button_color = get_theme_mod( 'header_menu_toggle_button_color', '#000000' );
$header_menu_mobile_toggle_button_background_color = get_theme_mod( 'header_menu_toggle_background_color', '#ffffff' );
echo "header #menu-toggle { color : ". esc_attr( $header_menu_mobile_toggle_button_color ) ."; background-color: ". esc_attr( $header_menu_mobile_toggle_button_background_color )."; }";
echo "body header nav.toggled, body header nav.toggled ul>li > .sub-menu.isShow, body header nav.toggled ul>li > .children.isShow  { background-color: ".esc_attr($header_menu_mobile_toggle_button_background_color)."}";
 //top border
$header_menu_border_top = get_theme_mod( 'header_menu_border_top');

 if($header_menu_border_top && isset($header_menu_border_top) ) {
	echo "body .menu_nav_content { 
		border-top-width: " .esc_attr( $header_menu_border_top['width'] ). "px;
		border-top-style: " .esc_attr( $header_menu_border_top['type'] ). ";
		border-radius: " .esc_attr( $header_menu_border_top['radius'] ). "%;
		border-top-color: " .esc_attr( $header_menu_border_top['color'] ). ";
	}\n";
}

// container bk

$container_bk = json_decode( get_theme_mod( 'bloginwp_global_container_background', json_encode(array(
            'type'  => 'solid',
            'solid' => null,
            'gradient'  => null,
            'image'     => array( 'media_id' => 0, 'media_url' => '' )
        ))
    )
);
if( isset($container_bk) && $container_bk ){
    $background_type = $container_bk->type;
    switch( $background_type ) {
        case 'image'    : echo 'body #content { background: url("' . esc_url( $container_bk->image->media_url ). '");     background-size: cover;
		    background-position: center center;
		    background-repeat: no-repeat; }';
                        break;
                default : echo "body #content{ background: " . esc_attr( $container_bk->$background_type ). ";}\n";
    }
}