<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Bloginwp
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bloginwp_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	global $post;
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[] = 'header-layout--two';
	$classes[] = 'read-more-layout--one';

	// Manage sidebar layouts
	if( is_page() ) {
		$page_sidebar_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $page_sidebar_layout ? $page_sidebar_layout : 'no-sidebar';
	} else if( is_home() ) {
		$archive_sidebar_layout = get_theme_mod( 'archive_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $archive_sidebar_layout ? $archive_sidebar_layout : 'no-sidebar';	
	}
	else if( is_single() ) {
		$post_sidebar_layout = get_theme_mod( 'post_sidebar_layout', 'no-sidebar' );
		$sidebar_layout = $post_sidebar_layout ? $post_sidebar_layout : 'no-sidebar';
	} else if ( is_archive() ) {
		$archive_sidebar_layout = get_theme_mod( 'archive_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $archive_sidebar_layout ? $archive_sidebar_layout : 'no-sidebar';
	} else if ( is_search() ) {
		$search_sidebar_layout = get_theme_mod( 'search_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $search_sidebar_layout ? $search_sidebar_layout : 'no-sidebar';
	} else if ( is_404() ) {
		$error_page_sidebar_layout = get_theme_mod( 'error_page_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $error_page_sidebar_layout ? $error_page_sidebar_layout : 'no-sidebar';
	}
	$classes[] = isset( $sidebar_layout ) ? esc_attr( $sidebar_layout ) : 'right-sidebar'; // sidebar class
	return $classes;
}
add_filter( 'body_class', 'bloginwp_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bloginwp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bloginwp_pingback_header' );

//define constant
define( 'BLOGINWP_INCLUDES_PATH', get_template_directory() . '/inc/' );

/**
 * Enqueue scripts and styles.
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
function bloginwp_scripts() {
	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
	wp_enqueue_style( 'bloginwp-fonts', wptt_get_webfont_url( bloginwp_fonts_url() ), array(), null );
	wp_enqueue_style( 'bloginwp-typo-fonts', wptt_get_webfont_url( bloginwp_typo_fonts_url() ), array(), null );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/lib/fontawesome/css/all.min.css', array(), '5.15.3', 'all' );
	wp_enqueue_style( 'bloginwp-custom-style', get_template_directory_uri() . '/assets/css/style.css', array(), BLOGINWP_VERSION, 'all' );
	wp_enqueue_style( 'bloginwp-custom-bootstrap', get_template_directory_uri() . '/assets/css/custom_bootstrap.css', array(), BLOGINWP_VERSION, 'all' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.css', array(), '1.8.0', 'all' );
	wp_enqueue_style( 'bloginwp-additional-css', get_template_directory_uri() . '/assets/css/additional.css', array(), BLOGINWP_VERSION, 'all' );
	wp_enqueue_style( 'bloginwp-additional-style-css', get_template_directory_uri() . '/assets/css/additional-styled.css', array(), BLOGINWP_VERSION, 'all' );
	wp_enqueue_style( 'bloginwp-style', get_stylesheet_uri(), array(), BLOGINWP_VERSION );
	wp_style_add_data( 'bloginwp-style', 'rtl', 'replace' );
	// enqueue inline style
	ob_start();
		include get_template_directory() . '/inc/inline-styles.php';
	$bloginwp_theme_inline_sss = ob_get_clean();
	wp_add_inline_style( 'bloginwp-style', wp_strip_all_tags($bloginwp_theme_inline_sss) );

	wp_enqueue_script('jquery-masonry');
	$sticky_sidebars_option = get_theme_mod( 'sticky_sidebars_option', false );
	if( $sticky_sidebars_option ) wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/lib/sticky/theia-sticky-sidebar.js', array(), '1.7.0', true );
	$sticky_header_option = get_theme_mod( 'sticky_header_option', false );
	$sticky_header_responsive_display = get_theme_mod( 'sticky_header_responsive_display', false );
	if ( ! $sticky_header_responsive_display && wp_is_mobile() ) {
		$sticky_header_option = false;
	}

	$relative_popup = true;
	if ( wp_is_mobile() ) $relative_popup = false;

	if( $sticky_header_option || $relative_popup ) wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/assets/lib/waypoint/jquery.waypoint.min.js', array(), '4.0.1', true );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/lib/imagesloaded/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.14', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array( 'jquery' ), '1.8.1', true );
	wp_enqueue_script( 'bloginwp-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), BLOGINWP_VERSION, true );
	wp_enqueue_script( 'bloginwp-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), BLOGINWP_VERSION, true );
	$scriptVars = array(
		'scrollToTop'	=> get_theme_mod( 'scroll_to_top_option', true ),
		'stickySidebar'	=> esc_html( $sticky_sidebars_option ),
		'stickyHeader' 	=> esc_html( $sticky_header_option ),
		'relative_post_popup' => esc_html( $relative_popup )
	);
	if( is_home() || is_archive() || is_search() ) {
		global $wp_query;
		$scriptVars['currentPage']	= ( is_search() ) ? 'search' : 'archive';
		$scriptVars['paged']	= get_query_var('paged');
		$scriptVars['_wpnonce'] = wp_create_nonce( 'bloginwp-posts-nonce' );
		$scriptVars['ajaxUrl'] 	= admin_url('admin-ajax.php');
		$scriptVars['query_vars'] = $wp_query->query_vars;
	}
	wp_localize_script( 'bloginwp-theme', 'bloginwpObject', $scriptVars );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bloginwp_scripts' );

if( !function_exists( 'bloginwp_typo_fonts_url' ) ) :
	/**
	 * Filter and Enqueue typography fonts
	 * 
	 * @package Bloginwp
	 * @since 1.0.0
	 */
	function bloginwp_typo_fonts_url() {
		$site_title_font_family = get_theme_mod( 'site_title_font_family', 'Montserrat' );
		$site_title_font_weight = get_theme_mod( 'site_title_font_weight', '500' );
		$site_title_typo = $site_title_font_family.":".$site_title_font_weight;

		$header_menu_font_family = get_theme_mod( 'header_menu_font_family', 'Montserrat' );
		$header_menu_font_weight = get_theme_mod( 'header_menu_font_weight', '400' );
		$header_menu_typo = $header_menu_font_family.":".$header_menu_font_weight;

		$get_fonts = array( $site_title_typo, $header_menu_typo );
		$font_weight_array = array();

		foreach ( $get_fonts as $fonts ) {
			$each_font = explode( ':', $fonts );
			if ( ! isset ( $font_weight_array[$each_font[0]] ) ) {
				$font_weight_array[$each_font[0]][] = $each_font[1];
			} else {
				if ( ! in_array( $each_font[1], $font_weight_array[$each_font[0]] ) ) {
					$font_weight_array[$each_font[0]][] = $each_font[1];
				}
			}
		}
		$final_font_array = array();
		foreach ( $font_weight_array as $font => $font_weight ) {
			$each_font_string = $font.':'.implode( ',', $font_weight );
			$final_font_array[] = $each_font_string;
		}

		$final_font_string = implode( '|', $final_font_array );
		$google_fonts_url = '';
		$subsets   = 'cyrillic,cyrillic-ext';
		if ( $final_font_string ) {
			$query_args = array(
				'family' => urlencode( $final_font_string ),
				'subset' => urlencode( $subsets )
			);
			$google_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
		return $google_fonts_url;
	}
endif;

/**
 * Register Google fonts.
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'bloginwp_fonts_url' ) ) :
	function bloginwp_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'cyrillic,cyrillic-ext';

		if ( 'off' !== esc_html_x( 'on', 'Public Sans: on or off', 'bloginwp' ) ) {
			$fonts[] = 'Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap';
		}
	
		if ( 'off' !== esc_html_x( 'on', 'Heebo: on or off', 'bloginwp' ) ) {
			$fonts[] = 'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap';
		}
		
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}
		return $fonts_url;
	}
	endif;

/**
 * Include files
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/hooks/frontpage-sections.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/hooks/hooks.php';
require get_template_directory() . '/inc/admin/class-theme-info.php';

if( ! function_exists( 'bloginwp_get_thumb_html_by_post_format' ) ) :
	/**
	 * Renders the html content of the current post - w.r.t current post format 
	 * 
	 * @package Bloginwp
	 * @since 1.0.0
	 * 
	 * @return html
	 */
	function bloginwp_get_thumb_html_by_post_format() {
		$format = get_post_format() ? : 'standard';
		if( $format === 'image' ) return;
		switch( $format ) :
			case 'video' :  // video post format
							if( has_block('core/video') || has_block('core/embed') ) :
								$blocksArray = parse_blocks( get_the_content() );
								foreach( $blocksArray as $singleBlock ) :
									//var_dump($singleBlock);
									if( 'core/video' === $singleBlock['blockName'] ) { echo  wp_kses_post(apply_filters( 'the_content', render_block( $singleBlock ) )); break; }
									//if( 'core/embed' === $singleBlock['blockName'] ) 
								endforeach;
							else :
								?>
									<a class="card__cover" href="<?php the_permalink(); ?>">
										<?php if( has_post_thumbnail() ) : ?>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" loading="<?php bloginwp_lazy_load_value(); ?>"/>
										<?php endif; ?>
									</a>
								<?php
							endif;
						break;
			case 'quote' :  // quote post format
							if( has_block('core/quote') ) :
								echo '<div class="post-card-quote -border">';
								echo '<div class="qoute__icon"><i class="fas fa-quote-left"></i></div>';
								$blocksArray = parse_blocks( get_the_content() );
								foreach( $blocksArray as $singleBlock ) :
									if( 'core/quote' === $singleBlock['blockName'] ) { echo wp_kses_post(apply_filters( 'the_content', render_block( $singleBlock ) )); break; }
								endforeach;
								echo '</div>';
							else :
								?>
									<a class="card__cover" href="<?php the_permalink(); ?>">
										<?php if( has_post_thumbnail() ) : ?>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" loading="<?php bloginwp_lazy_load_value(); ?>"/>
										<?php endif; ?>
									</a>
								<?php
							endif;
						break;
			case 'gallery' :  // gallery post format
							if( has_block('core/gallery') ) :
								$blocksArray = parse_blocks( get_the_content() );
								foreach( $blocksArray as $singleBlock ) :
									if( 'core/gallery' === $singleBlock['blockName'] ) { echo wp_kses_post(apply_filters( 'the_content', render_block( $singleBlock ) )); break; }
								endforeach;
							else :
								?>
									<a class="card__cover" href="<?php the_permalink(); ?>">
										<?php if( has_post_thumbnail() ) : ?>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" loading="<?php bloginwp_lazy_load_value(); ?>"/>
										<?php endif; ?>
									</a>
								<?php
							endif;
						break;
			case 'audio' :  // audio post format
						?>
							<a class="card__cover" href="<?php the_permalink(); ?>">
								<?php if( has_post_thumbnail() ) : ?>
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" loading="<?php bloginwp_lazy_load_value(); ?>"/>
                                <?php endif;
									if( has_block('core/audio') ) :
										$blocksArray = parse_blocks( get_the_content() );
										foreach( $blocksArray as $singleBlock ) :
											if( 'core/audio' === $singleBlock['blockName'] ) { echo wp_kses_post(apply_filters( 'the_content', render_block( $singleBlock ) )); break; }
										endforeach;
									endif;
								?>
							</a>
						<?php
						break;
			default : ?>
				<a class="card__cover" href="<?php the_permalink(); ?>">
					<?php if( has_post_thumbnail() ) :
						if( get_theme_mod('archive_posts_layout') == 'grid-layout-twocol'){
							the_post_thumbnail();
						} else{
							the_post_thumbnail('bloginwp_mainimg');
						}
						
					endif; ?>
				</a>
			<?php
		endswitch;
	}
endif;

if( ! function_exists( 'bloginwp_get_multicheckbox_categories_array' ) ) :
	/**
	 * Return array of categories prepended with "*" key.
	 * 
	 * @package Bloginwp
	 * @since 1.0.0
	 */
	function bloginwp_get_multicheckbox_categories_array() {
		$categories_list = get_categories();
		$cats_array = [];
		foreach( $categories_list as $cat ) :
			$cats_array[esc_html( $cat->slug )]= esc_html( $cat->name )  . ' (' .absint( $cat->count ). ')';
		endforeach;
		return $cats_array;
	}
endif;

if( ! function_exists( 'bloginwp_get_select_categories_array' ) ) :
	/**
	 * Return array of categories prepended with "" key.
	 * 
	 * @package Bloginwp
	 * @since 1.0.0
	 */
	function bloginwp_get_select_categories_array() {
		$categories_list = get_categories();
		$cats_array[''] = esc_html__( 'Select a category', 'bloginwp' );
		foreach( $categories_list as $cat ) :
			$cats_array[esc_html( $cat->slug )]= esc_html( $cat->name )  . ' (' .absint( $cat->count ). ')';
		endforeach;
		return $cats_array;
	}
endif;

if( ! function_exists( 'bloginwp_get_multicheckbox_product_categories_array' ) ) :
	/**
	 * Return array of categories prepended with "*" key.
	 * 
	 * @package Bloginwp
	 * @since 1.0.0
	 */
	function bloginwp_get_multicheckbox_product_categories_array() {
		if( ! class_exists( 'WooCommerce' ) ) return [];
		$cats_array = [];
		$categories_list = get_terms( 'product_cat' );
		foreach( $categories_list as $cat ) :
			$cats_array[esc_html( $cat->slug )]= esc_html( $cat->name )  . ' (' .absint( $cat->count ). ')';
		endforeach;
		return $cats_array;
	}
endif;

if( ! function_exists( 'bloginwp_lazy_load_value' ) ) :
	/**
	 * Echos lazy load attribute value.
	 * 
	 * @package Bloginwp
	 * @since 1.0.0
	 */
	function bloginwp_lazy_load_value() {
		$lazy_load_option = get_theme_mod( 'lazy_load_option', true );
		$attr_value = ( $lazy_load_option ) ? 'lazy' : 'eager';
		echo esc_attr( apply_filters( 'bloginwp_lazy_load_value', esc_attr( $attr_value ) ) );
	}
endif;

if( ! function_exists( 'bloginwp_post_read_time' ) ) :
    /**
     * Function contains post categories options with label and value
     * @return float
     */
    function bloginwp_post_read_time( $string ) {
    	$read_time = 0;
        if( empty( $string ) ) {
            return 0;
        } else {
            $read_time = apply_filters( 'bloginwp_content_read_time', round( str_word_count( wp_strip_all_tags( $string ) ) / 100 ), 2 );

            if($read_time == 0 ) {
            	return '1';
            }else {
            	return $read_time;
            }

        }
    }
endif;

if( ! function_exists( 'bloginwp_add_menu_description' ) ) :
	// merge menu description element to the menu 
	function bloginwp_add_menu_description( $item_output, $item, $depth, $args ) {
		if($args->theme_location != 'menu-1') return $item_output;
		
		if ( !empty( $item->description ) ) {
			$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
		}
		return $item_output;
	}
	add_filter( 'walker_nav_menu_start_el', 'bloginwp_add_menu_description', 10, 4 );
endif;

if( ! function_exists( 'bloginwp_social_share_html' ) ) :
	/**
	 * Social share icons
	 * 
	 * @package Bloginwp 
	 * @since 1.1.1
	 */
	function bloginwp_social_share_html() {
		global $post;
		if( ! $post ) return;
		if( is_single() ) {
			$social_share_option = get_theme_mod( 'single_social_share_option', true );
		} else {
			$social_share_option = get_theme_mod( 'archive_social_share_option', true );
		}
		if( ! $social_share_option ) return;
		$tsb_blogurl = rawurlencode(get_permalink($post->ID)); // blog url
		$tsb_blogtitle = rawurlencode(the_title_attribute('echo=0')); // blog title

		// social urls
		$twitter_url = '//twitter.com/intent/tweet?text='.$tsb_blogtitle.'&amp;url='.$tsb_blogurl;
		$facebook_url = '//www.facebook.com/sharer.php?u='.$tsb_blogurl;
		$linkedin_url = '//www.linkedin.com/shareArticle?mini=true&amp;title='.$tsb_blogtitle.'&amp;url='.$tsb_blogurl;

		$tsb_blogthumb_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );
		$tsb_blogthumb = isset($tsb_blogthumb_attributes[0]) ? $tsb_blogthumb_attributes[0] : '';
	?>
		<div class="bloginwp-social-share-wrap">
			<span class="social-share-prefix"><i class="fas fa-share-alt" aria-hidden="true"></i></span>
			<div class="social-share-inner-wrap">
				<?php if( get_theme_mod( 'social_share_twitter_option', true ) ) : ?>
					<a class="tsb-twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="nofollow" title="<?php echo esc_attr__('Tweet This!', 'bloginwp'); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a>
				<?php endif;

				if( get_theme_mod( 'social_share_facebook_option', true ) ) : ?>
					<a class="tsb-facebook" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="nofollow" title="<?php echo esc_attr__( 'Share on Facebook', 'bloginwp' ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
				<?php
				endif;
				
				if( get_theme_mod( 'social_share_pinterest_option', true ) && ! empty( $tsb_blogthumb ) ) :
						$pinterest_url = '//pinterest.com/pin/create/button/?url='.$tsb_blogurl.'&amp;media='.$tsb_blogthumb.'&amp;description='.$tsb_blogtitle;
				?>
						<a class="tsb-pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank" rel="nofollow" title="<?php echo esc_attr__( 'Share on Pinterest', 'bloginwp' ); ?>"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
				<?php
					endif;

				if( get_theme_mod( 'social_share_linkedin_option', true ) ) : ?>
					<a class="tsb-linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="nofollow" title="<?php echo esc_attr__( 'Share on Linkedin', 'bloginwp' ); ?>"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
				<?php endif; ?>
			</div>
		</div>
	<?php
	}
endif;

/**
 * Changing excerpt length for styled blog theme
 */
function bloginwp_excerpt_length( $length ) {
	if ( ! is_admin() ) {
		return 24;
	} else {
		return $length;
	}
}
add_filter( 'excerpt_length', 'bloginwp_excerpt_length', 999 );