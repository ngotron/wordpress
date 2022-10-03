<?php
/**
 * WP Mimalist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bloginwp
 */
if ( ! defined( 'BLOGINWP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$theme_info = wp_get_theme();
	define( 'BLOGINWP_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! function_exists( 'bloginwp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bloginwp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bloginwp, use a find and replace
		 * to change 'bloginwp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bloginwp', get_template_directory() . '/languages' );

		add_image_size( 'bloginwp-featured', 990, 668, true );
		add_image_size( 'bloginwp-grid', 300, 200, true );
		add_image_size( 'bloginwp-featured-list', 800, 500, true );
		add_image_size( 'bloginwp-category-feat', 600, 400, true);
		add_image_size( 'bloginwp-category-feature', 400, 270, true);

		add_image_size( 'bloginwp_mainimg', 900, 600, true);

		add_image_size( 'bloginwp_sliderimg', 470, 610, true);
		
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'top-menu'	=> esc_html__( 'Top Header Menu', 'bloginwp' ),
				'menu-1'	=> esc_html__( 'Primary', 'bloginwp' ),
				'footer-bottom' => esc_html__( 'Footer Menu', 'bloginwp' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'bloginwp_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Add support for post formats
		 * 
		 */
		add_theme_support( 'post-formats', array( 'standard', 'audio', 'gallery', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'bloginwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bloginwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bloginwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'bloginwp_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/woocommerce.php';
}

if( ! function_exists( 'bloginwp_set_transient' ) ) :
	/**
	 * Set transient required for theme
	 * 
	 * @package 1.3.0
	 * @since 1.0.0
	 */
	function bloginwp_set_transient() {
		set_transient( 'bloginwp_show_review_notice', 'hide', WEEK_IN_SECONDS );
	}
add_action( 'after_switch_theme', 'bloginwp_set_transient' );
endif;