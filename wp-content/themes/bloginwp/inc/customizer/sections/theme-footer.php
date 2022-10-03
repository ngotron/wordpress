<?php
/**
 * Footer Options Section
 * 
 */
if( !function_exists( 'bloginwp_customizer_footer_options_section' ) ) :
    /**
     * Register footer options settings
     * 
     */
    function bloginwp_customizer_footer_options_section( $wp_customize ) {
        /**
         * Content Section
         * 
         * panel - bloginwp_footer_panel
         */
        $wp_customize->add_section( 'bloginwp_main_footer_section', array(
            'title' => esc_html__( 'Main Footer', 'bloginwp' ),
            'panel' => 'bloginwp_footer_panel',
            'priority'  => 10,
        ));
        
        // section tab
        $wp_customize->add_setting( 'main_footer_section_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'   => 'general'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Tab_Control( $wp_customize, 'main_footer_section_tab', array(
                'section'     => 'bloginwp_main_footer_section'
            ))
        );

        /**
         * General Social Setting Heading
         * 
         */
        $wp_customize->add_setting( 'footer_general_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'footer_general_settings_header', array(
                'label'	      => esc_html__( 'General Setting', 'bloginwp' ),
                'section'     => 'bloginwp_main_footer_section',
                'settings'    => 'footer_general_settings_header'
            ))
        );

        /**
         * Footer Option
         * 
         */
        $wp_customize->add_setting( 'footer_option', array(
            'default'   => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'footer_option', array(
                'label'	      => esc_html__( 'Enable footer section', 'bloginwp' ),
                'section'     => 'bloginwp_main_footer_section',
                'settings'    => 'footer_option'
            ))
        );

        /**
         * Footer Widgets Redirect  Heading
         * 
         */
        $wp_customize->add_setting( 'footer_widgets_redirect_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'footer_widgets_redirect_settings_header', array(
                'label'	      => esc_html__( 'Footer Widgets', 'bloginwp' ),
                'section'     => 'bloginwp_main_footer_section',
                'settings'    => 'footer_widgets_redirect_settings_header'
            ))
        );

        /**
         * Redirect widgets link
         * 
         */
        $wp_customize->add_setting( 'footer_widgets_redirects', array(
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Redirect_Control( $wp_customize, 'footer_widgets_redirects', array(
                'label'	      => esc_html__( 'Widgets', 'bloginwp' ),
                'section'     => 'bloginwp_main_footer_section',
                'settings'    => 'footer_widgets_redirects',
                'choices'     => array(
                    'footer-column-one' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-column',
                        'label' => esc_html__( 'Manage footer widget one', 'bloginwp' )
                    ),
                    'footer-column-two' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-column-2',
                        'label' => esc_html__( 'Manage footer widget two', 'bloginwp' )
                    ),
                    'footer-column-three' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-column-3',
                        'label' => esc_html__( 'Manage footer widget three', 'bloginwp' )
                    ),
                    'footer-column-four' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-column-4',
                        'label' => esc_html__( 'Manage footer widget four', 'bloginwp' )
                    )
                )
            ))
        );

        // Footer Layouts Heading
        $wp_customize->add_setting( 'footer_layout_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'footer_layout_settings_header', array(
                'label'	      => esc_html__( 'Footer Layouts', 'bloginwp' ),
                'section'     => 'bloginwp_main_footer_section',
                'settings'    => 'footer_layout_settings_header'
            ))
        );

        // Footer Section width
        $wp_customize->add_setting( 'footer_section_width', array(
            'default' => 'full-width',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'footer_section_width', array(
            'label' => esc_html__( 'Footer Width', 'bloginwp' ),
            'type' => 'select',
            'section' => 'bloginwp_main_footer_section',
            'choices' => array(
                'full-width' => __( 'Full Width', 'bloginwp' ),
                'boxed-width' => __( 'Boxed Width', 'bloginwp' )
            ),
        ));

        /**
         * Footer Widget column
         * 
         */
        $wp_customize->add_setting( 'footer_widget_column',
            array(
            'default'           => 'column-two',
            'sanitize_callback' => 'sanitize_text_field',
            )
        );

        // Add the layout control.
        $wp_customize->add_control( new Bloginwp_WP_Radio_Image_Control(
            $wp_customize,
            'footer_widget_column',
            array(
                'section'  => 'bloginwp_main_footer_section',
                'choices'  => array(
                    'column-one' => array(
                        'label' => esc_html__( 'Column One', 'bloginwp' ),
                        'url'   => '%s/assets/images/customizer/footer-column-one.jpg'
                    ),
                    'column-two' => array(
                        'label' => esc_html__( 'Column Two', 'bloginwp' ),
                        'url'   => '%s/assets/images/customizer/footer-column-two.jpg'
                    ),
                    'column-three' => array(
                        'label' => esc_html__( 'Column Three', 'bloginwp' ),
                        'url'   => '%s/assets/images/customizer/footer-column-three.jpg'
                    ),
                    'column-four' => array(
                        'label' => esc_html__( 'Column Four', 'bloginwp' ),
                        'url'   => '%s/assets/images/customizer/footer-column-four.jpg'
                    )
                )
            )
        ));

        // footer color settings
        $wp_customize->add_setting( 'footer_color', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'footer_color', array(
                'label'     => esc_html__( 'Text Color', 'bloginwp' ),
                'section'   => 'bloginwp_main_footer_section',
                'settings'  => 'footer_color',
                'tab'   => 'design'
            ))
        );
        
        /**
         * Bottom Footer Section
         * 
         * panel - bloginwp_footer_panel
         */
        $wp_customize->add_section( 'bloginwp_bottom_footer_content_section', array(
            'title' => esc_html__( 'Bottom Footer', 'bloginwp' ),
            'panel' => 'bloginwp_footer_panel',
            'priority'  => 50,
        ));

        // Bottom footer site info
        $wp_customize->add_setting( 'bottom_footer_site_info', array(
            'default'    => esc_html__( 'Bloginwp - Elegent WordPress Theme. All Rights Reserved %year%.', 'bloginwp' ),
            'sanitize_callback' => 'wp_kses_post'
        ));
        $wp_customize->add_control( 'bottom_footer_site_info', array(
                'label'	      => esc_html__( 'Copyright Text', 'bloginwp' ),
                'type'  => 'textarea',
                'description' => esc_html__( 'Add %year% to retrieve current year.', 'bloginwp' ),
                'section'     => 'bloginwp_bottom_footer_content_section'
            )
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_footer_options_section', 10 );
endif;