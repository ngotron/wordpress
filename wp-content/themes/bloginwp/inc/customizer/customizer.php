<?php
/**
 * Bloginwp Theme Customizer
 *
 * @package Bloginwp
 * @since 1.0.0
 */
function bloginwp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_section( 'header_image' )->priority		= 10;
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->panel = 'bloginwp_site_identity_panel';
	$wp_customize->get_section( 'title_tagline' )->title = esc_html__( 'Logo & Site Icon', 'bloginwp' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'bloginwp_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'bloginwp_customize_partial_blogdescription',
			)
		);
	}
	require get_template_directory() . '/inc/customizer/custom-controls/repeater/repeater.php';
	require get_template_directory() . '/inc/customizer/roots.php';
	require get_template_directory() . '/inc/customizer/custom-controls/radio-image/radio-image.php';
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading/section-heading.php';
	require get_template_directory() . '/inc/customizer/custom-controls/typography/typography.php';
	require get_template_directory() . '/inc/customizer/custom-controls/redirect-control/redirect-control.php';
	require get_template_directory() . '/inc/customizer/custom-controls/tab-control/tab-control.php';

	// register control type
	$wp_customize->register_control_type( 'Bloginwp_WP_Radio_Image_Control' );
	$wp_customize->register_control_type( 'Bloginwp_WP_Typography_Control' );

	/**
	 * Register "Site Identity Options" panel
	 * 
	 */
	$wp_customize->add_panel( 'bloginwp_site_identity_panel', array(
		'title' => esc_html__( 'Site Identity', 'bloginwp' ),
		'priority' => 5
	));

	/**
	 * Register "Gloabl Options" panel
	 * 
	 */
	$wp_customize->add_panel( 'bloginwp_global_options_panel', array(
		'title' => esc_html__( 'Global Options', 'bloginwp' ),
		'priority' => 10
	));

	/**
	 * Register "Theme Header" panel
	 * 
	 */
	$wp_customize->add_panel( 'bloginwp_header_panel', array(
		'title' => esc_html__( 'Theme Header', 'bloginwp' ),
		'priority' => 20
	));

	/**
	 * Register "Frontpage Sections" panel
	 * 
	 */
	$wp_customize->add_panel( 'bloginwp_frontpage_sections_panel', array(
		'title' => esc_html__( 'Frontpage Sections', 'bloginwp' ),
		'priority' => 30
	));

	/**
	 * Register "Innerpages Section" panel
	 * 
	 */
	$wp_customize->add_panel( 'bloginwp_innerpages_settings_panel', array(
		'title' => esc_html__( 'Innerpages', 'bloginwp' ),
		'priority' => 40
	));

	/**
	 * Register "Theme Footer" panel
	 * 
	 */
	$wp_customize->add_panel( 'bloginwp_footer_panel', array(
		'title' => esc_html__( 'Theme Footer', 'bloginwp' ),
		'priority' => 80
	));

	/**
	 * Theme Color
	 * 
	 */
	$wp_customize->add_setting( 'bloginwp_theme_color', array(
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'bloginwp_theme_color', array(
			'label'      => esc_html__( 'Theme Color', 'bloginwp' ),
			'section'    => 'colors',
			'settings'   => 'bloginwp_theme_color'
		))
	);

	/**
	 * Theme Hover Color
	 * 
	 */
	$wp_customize->add_setting( 'bloginwp_theme_hover_color', array(
		'default' => '#717171',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'bloginwp_theme_hover_color', array(
			'label'      => esc_html__( 'Theme Hover Color', 'bloginwp' ),
			'section'    => 'colors',
			'settings'   => 'bloginwp_theme_hover_color'
		))
	);

}
add_action( 'customize_register', 'bloginwp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bloginwp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bloginwp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bloginwp_customize_preview_js() {
	wp_enqueue_script( 'bloginwp-customizer', get_template_directory_uri() . '/inc/customizer/assets/customizer-preview.js', array( 'customize-preview' ), BLOGINWP_VERSION, true );
}
add_action( 'customize_preview_init', 'bloginwp_customize_preview_js' );

/**
 * Binds JS handlers to extend Theme Customizer (section inside section).
 */
function bloginwp_customize_controls_scripts() {
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/lib/fontawesome/css/all.min.css', array(), '5.15.3', 'all' );
    wp_enqueue_style( 'select-2', get_template_directory_uri() . '/assets/lib/select2/css/select2.min.css', array(), '4.1.0', 'all' );
    wp_enqueue_style( 'bloginwp-customizer-control', get_template_directory_uri() . '/inc/customizer/assets/customizer-controls.css', array(), BLOGINWP_VERSION, 'all' );
    wp_enqueue_script( 'select-2', get_template_directory_uri() . '/assets/lib/select2/js/select2.min.js', array(), '4.1.0', true );
    wp_enqueue_script( 'bloginwp-customizer-control-build', get_template_directory_uri() . '/inc/customizer/assets/customizer-controls.min.js', array( 'react', 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n', 'wp-polyfill', 'wp-components' ), BLOGINWP_VERSION, true );
    wp_set_script_translations( 'bloginwp-customizer-control-build', 'bloginwp' );
}
add_action( 'customize_controls_enqueue_scripts', 'bloginwp_customize_controls_scripts' );

// include files
require get_template_directory() . '/inc/customizer/sanitize.php';
require get_template_directory() . '/inc/customizer/sections/about-theme.php';
require get_template_directory() . '/inc/customizer/sections/site-identity.php';
require get_template_directory() . '/inc/customizer/sections/global-options.php';
require get_template_directory() . '/inc/customizer/sections/theme-header.php';
require get_template_directory() . '/inc/customizer/sections/main-banner.php';
require get_template_directory() . '/inc/customizer/sections/featured-links.php';
require get_template_directory() . '/inc/customizer/sections/blog-archive.php';
require get_template_directory() . '/inc/customizer/sections/single-post.php';
require get_template_directory() . '/inc/customizer/sections/three-column.php';
require get_template_directory() . '/inc/customizer/sections/products-section.php';
require get_template_directory() . '/inc/customizer/sections/theme-footer.php';
require get_template_directory() . '/inc/customizer/sections/sidebar-layouts.php';
require get_template_directory() . '/inc/admin/customizer-upsell.php';

if ( ! function_exists( 'bloginwp_get_google_font_weight_html' ) ) :
    /**
     * get Google font weights html
     *
     * @since 1.0.0
     */
    function bloginwp_get_google_font_weight_html() {
		$google_fonts_file = get_template_directory() . '/assets/lib/googleFonts.json';
		$google_fonts = array();
		if ( file_exists( $google_fonts_file ) ) {
            $google_fonts   = json_decode( file_get_contents( $google_fonts_file ), true );
		}
		$font_family = isset( $_REQUEST['font_family'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['font_family'] ) ) : esc_html( 'Montserrat' );
		$font_weights = $google_fonts[$font_family]['variants']['normal'];

        foreach ( $font_weights as $weight_key => $weight ) {
            echo '<option value="'.esc_attr( $weight_key ).'">'. esc_html( $weight_key ).'</option>';
    
		}
        wp_die();
    }
endif;
add_action( "wp_ajax_bloginwp_get_google_font_weight_html", "bloginwp_get_google_font_weight_html" );