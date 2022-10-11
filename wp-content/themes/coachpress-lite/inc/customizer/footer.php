<?php
/**
 * Footer Setting
 *
 * @package CoachPress_Lite
 */

function coachpress_lite_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'coachpress-lite' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => __( 'Footer Copyright Text', 'coachpress-lite' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.site-info .copyright',
        'render_callback' => 'coachpress_lite_get_footer_copyright',
    ) );
        
    $wp_customize->add_setting( 'footer_above_bg',
        array(
            'default'           => '',
            'sanitize_callback' => 'coachpress_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'footer_above_bg',
            array(
                'label'         => esc_html__( 'Above Footer Background', 'coachpress-lite' ),
                'description'   => esc_html__( 'Choose the background image of the footer.', 'coachpress-lite' ),
                'section'       => 'footer_settings',
                'type'          => 'image',
            )
        )
    );
}
add_action( 'customize_register', 'coachpress_lite_customize_register_footer' );