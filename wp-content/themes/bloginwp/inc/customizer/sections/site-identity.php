<?php
/**
 * Site Identity Section
 * 
 */
if( !function_exists( 'bloginwp_customizer_site_identity_section' ) ) :
    /**
     * Register site identity settings
     * 
     */
    function bloginwp_customizer_site_identity_section( $wp_customize ) {
        /**
         * Site Title Section
         * 
         * panel - bloginwp_site_identity_panel
         */
        $wp_customize->add_section( 'bloginwp_site_title_section', array(
            'title' => esc_html__( 'Site Title & Tagline', 'bloginwp' ),
            'panel' => 'bloginwp_site_identity_panel',
            'priority'  => 30,
        ));
        $wp_customize->get_control( 'blogname' )->section = 'bloginwp_site_title_section';
        $wp_customize->get_control( 'display_header_text' )->section = 'bloginwp_site_title_section';
        $wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display site title', 'bloginwp' );
        $wp_customize->get_control( 'blogdescription' )->section = 'bloginwp_site_title_section';

        /**
         * Container Width Setting
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'bloginwp_site_logo_width', array(
            'default'   => array( "desktop" => null, 'tablet'   => null, 'smartphone'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Responsive_Range_Control( $wp_customize, 'bloginwp_site_logo_width', array(
                    'label'	      => esc_html__( 'Logo Width (px)', 'bloginwp' ),
                    'section'     => 'title_tagline',
                    'settings'    => 'bloginwp_site_logo_width',
                    'unit'        => 'px',
                    'input_attrs' => array(
                        'max'         => 600,
                        'min'         => 0,
                        'step'        => 1,
                        'reset' => true
                    )
                ))
        );

        /**
         * Blog Description Option
         * 
         */
        $wp_customize->add_setting( 'blogdescription_option', array(
            'default'        => true,
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_control( 'blogdescription_option', array(
            'label'    => esc_html__( 'Display site description', 'bloginwp' ),
            'section'  => 'bloginwp_site_title_section',
            'type'     => 'checkbox',
            'priority' => 50
        ));

        /**
         * Site Title Heading
         * 
         */
        $wp_customize->add_setting( 'site_title_style_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'site_title_style_header', array(
                'label'	      => esc_html__( 'Style', 'bloginwp' ),
                'section'     => 'bloginwp_site_title_section',
                'settings'    => 'site_title_style_header',
                'priority'    => 50
            ))
        );

        $wp_customize->get_control( 'header_textcolor' )->section = 'bloginwp_site_title_section';
        $wp_customize->get_control( 'header_textcolor' )->priority = 60;
        $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'bloginwp' );

        /**
         * Header Text Hover Color
         * 
         */
        $wp_customize->add_setting( 'header_hover_textcolor', array(
            'default' => '#717171',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ) );
    
        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'header_hover_textcolor', array(
                'label'      => esc_html__( 'Site Title Hover Color', 'bloginwp' ),
                'section'    => 'bloginwp_site_title_section',
                'settings'   => 'header_hover_textcolor',
                'priority'    => 70
            ))
        );

        /**
         * Site Title Typography Heading
         * 
         */
        $wp_customize->add_setting( 'site_title_typo_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'site_title_typo_settings_header', array(
                'label'	      => esc_html__( 'Typography ', 'bloginwp' ),
                'section'     => 'bloginwp_site_title_section',
                'settings'    => 'site_title_typo_settings_header',
                'priority'    => 80
            ))
        );
        
        // Add the `header text` typography settings.
        $wp_customize->add_setting( 'site_title_font_family', array( 'default' => 'Montserrat',  'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_setting( 'site_title_font_weight', array( 'default' => '600',    'sanitize_callback' => 'absint' ) );
        $wp_customize->add_setting( 'site_title_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_key') );
        $wp_customize->add_setting( 'site_title_font_size',   array( 'default' => 32,     'sanitize_callback' => 'absint' ) );
        $wp_customize->add_setting( 'site_title_line_height', array( 'default' => 1,     'sanitize_callback' => 'absint' ) );

        // Add the `<p>` typography control.
        $wp_customize->add_control(
            new Bloginwp_WP_Typography_Control( $wp_customize, 'site_title_typography',
                array(
                    'label' => __( 'Typography', 'bloginwp' ),
                    'section'     => 'bloginwp_site_title_section',
                    'initial'     => true,
                    'settings'    => array(
                        'family'      => 'site_title_font_family',
                        'weight'      => 'site_title_font_weight',
                        'style'       => 'site_title_font_style',
                        'size'        => 'site_title_font_size',
                        'line_height' => 'site_title_line_height'
                    ),
                    'priority'  => 100
                )
            )
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_site_identity_section', 10 );
endif;