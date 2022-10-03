<?php
/**
 * Footer Three Column Panel
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( !function_exists( 'bloginwp_customizer_footer_three_column_panel' ) ) :
    /**
     * Register footer three columns section settings
     * 
     */
    function bloginwp_customizer_footer_three_column_panel( $wp_customize ) {
        /**
         * Bottom Three Column Section
         * 
         * panel - bloginwp_frontpage_sections_panel
         */
        $wp_customize->add_section( 'footer_three_column_section', array(
            'title' => esc_html__( 'Footer Three Column', 'bloginwp' ),
            'priority'  => 50
        ));
        
        // section tab
        $wp_customize->add_setting( 'footer_three_column_section_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'   => 'general'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Tab_Control( $wp_customize, 'footer_three_column_section_tab', array(
                'section'     => 'footer_three_column_section'
            ))
        );

        // section visible option
        $wp_customize->add_setting( 'footer_three_column_option', array(
            'default' => 'all',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'footer_three_column_option', array(
            'label' => esc_html__( 'Show section', 'bloginwp' ),
            'type' => 'select',
            'section' => 'footer_three_column_section',
            'choices' => array(
                'frontpage' => __( 'Show only on frontpage', 'bloginwp' ),
                'all'       => __( 'Show on frontpage and innerpages', 'bloginwp' ),
                'innerpages' => __( 'Show only on innerpages', 'bloginwp' ),
                'hide'      => __( 'Hide on all pages', 'bloginwp' )
            ),
        ));

        // section width
        $wp_customize->add_setting( 'footer_three_column_width', array(
            'default' => 'boxed-width',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'footer_three_column_width', array(
            'label' => esc_html__( 'Section Width', 'bloginwp' ),
            'type' => 'select',
            'section' => 'footer_three_column_section',
            'choices' => array(
                'full-width' => __( 'Full Width', 'bloginwp' ),
                'boxed-width' => __( 'Boxed Width', 'bloginwp' )
            )
        ));

        // Column One Heading Settings
        $wp_customize->add_setting( 'footer_column_one_header_settings', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'footer_column_one_header_settings', array(
                'label'	      => esc_html__( 'Column One Section', 'bloginwp' ),
                'section'     => 'footer_three_column_section',
                'settings'    => 'footer_column_one_header_settings'
            ))
        );

        // Column one count
        $wp_customize->add_setting( 'footer_column_one_count', array(
            'default'        => 3,
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control( 'footer_column_one_count', array(
            'label'    => esc_html__( 'Posts Count', 'bloginwp' ),
            'section'  => 'footer_three_column_section',		
            'type'     => 'number',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 3
            )
        ));

        // Category select
        $wp_customize->add_setting( 'footer_column_one_category', array(
            'default' => '',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'footer_column_one_category', array(
            'label' => esc_html__( 'Post category', 'bloginwp' ),
            'type' => 'select',
            'section' => 'footer_three_column_section',
            'choices' => bloginwp_get_select_categories_array()
        ));

        // Column Two Heading Settings
        $wp_customize->add_setting( 'footer_column_two_header_settings', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'footer_column_two_header_settings', array(
                'label'	      => esc_html__( 'Column Two Section', 'bloginwp' ),
                'section'     => 'footer_three_column_section',
                'settings'    => 'footer_column_two_header_settings'
            ))
        );

        // Column two count
        $wp_customize->add_setting( 'footer_column_two_count', array(
            'default'        => 3,
            'sanitize_callback' => 'absint',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 3
            )
        ));
        $wp_customize->add_control( 'footer_column_two_count', array(
            'label'    => esc_html__( 'Posts Count', 'bloginwp' ),
            'section'  => 'footer_three_column_section',		
            'type'     => 'number',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 3
            )
        ));

        // Category select
        $wp_customize->add_setting( 'footer_column_two_category', array(
            'default' => '',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'footer_column_two_category', array(
            'label' => esc_html__( 'Post category', 'bloginwp' ),
            'type' => 'select',
            'section' => 'footer_three_column_section',
            'choices' => bloginwp_get_select_categories_array()
        ));

        // Column Three Heading Settings
        $wp_customize->add_setting( 'footer_column_three_header_settings', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'footer_column_three_header_settings', array(
                'label'	      => esc_html__( 'Column Three Section', 'bloginwp' ),
                'section'     => 'footer_three_column_section',
                'settings'    => 'footer_column_three_header_settings'
            ))
        );

        // Column three count
        $wp_customize->add_setting( 'footer_column_three_count', array(
            'default'        => 3,
            'sanitize_callback' => 'absint',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 3
            )
        ));
        $wp_customize->add_control( 'footer_column_three_count', array(
            'label'    => esc_html__( 'Posts Count', 'bloginwp' ),
            'section'  => 'footer_three_column_section',		
            'type'     => 'number',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 3
            )
        ));

        // Category select
        $wp_customize->add_setting( 'footer_column_three_category', array(
            'default' => '',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        $wp_customize->add_control( 'footer_column_three_category', array(
            'label' => esc_html__( 'Post category', 'bloginwp' ),
            'type' => 'select',
            'section' => 'footer_three_column_section',
            'choices' => bloginwp_get_select_categories_array()
        ));
        
        // Footer Three column Padding Settings
        $wp_customize->add_setting( 'footer_three_column_padding', array( 
            'default' => array( 'desktop'   => array( 'top'=>'50px', 'right'	=> '50px', 'bottom'	=> '50px', 'left'	=> '50px' ), 'tablet'   => array( 'top'=>'50px', 'right'	=> '50px', 'bottom'	=> '50px', 'left'	=> '50px' ), 'smartphone'   => array( 'top'=>'50px', 'right'	=> '50px', 'bottom'	=> '50px', 'left'	=> '50px' ) ),
            'sanitize_callback' => 'bloginwp_sanitize_array'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Responsive_Box_Control( $wp_customize, 'footer_three_column_padding', array(
                'label'       => esc_html__( 'Padding', 'bloginwp' ),
                'section'     => 'footer_three_column_section',
                'settings'    => 'footer_three_column_padding',
                'tab'   => 'design'
            ))
        );

        // footer three column color and hover color
        $wp_customize->add_setting( 'footer_three_column_font_color', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'footer_three_column_font_color', array(
                'label'     => esc_html__( 'Color  / Hover Color', 'bloginwp' ),
                'section'   => 'footer_three_column_section',
                'settings'  => 'footer_three_column_font_color',
                'tab'   => 'design'
            ))
        );

        // footer three column background
        $wp_customize->add_setting( 'footer_three_column_background_color', array( 
            'default' => array( 'type' => 'solid', 'solid'=> null, 'gradient' => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Advanced_Color_Group_Control( $wp_customize, 'footer_three_column_background_color', array(
                'label' => esc_html__( 'Background', 'bloginwp' ),
                'section'   => 'footer_three_column_section',
                'settings'  => 'footer_three_column_background_color',
                'tab'   => 'design'
            ))
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_footer_three_column_panel', 50 );
endif;