<?php
/**
 * Header Options Section
 * 
 */
if( !function_exists( 'bloginwp_customizer_header_options_section' ) ) :
    /**
     * Register header options settings
     * 
     */
    function bloginwp_customizer_header_options_section( $wp_customize ) {
        /**
         * Top Header Section
         * 
         * panel - bloginwp_header_panel
         */
        $wp_customize->add_section( 'bloginwp_top_header_section', array(
            'title' => esc_html__( 'Top Header', 'bloginwp' ),
            'panel' => 'bloginwp_header_panel',
            'priority'  => 10,
        ));

        // section tab
        $wp_customize->add_setting( 'top_header_section_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'   => 'general'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Tab_Control( $wp_customize, 'top_header_section_tab', array(
                'section'     => 'bloginwp_top_header_section'
            ))
        );

        // top header option
        $wp_customize->add_setting( 'top_header_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'top_header_option', array(
                'label'       => esc_html__( 'Show top header section', 'bloginwp' ),
                'section'     => 'bloginwp_top_header_section',
                'settings'    => 'top_header_option'
            ))
        );

        // top header menu option
        $wp_customize->add_setting( 'top_header_menu_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'top_header_menu_option', array(
                'label'       => esc_html__( 'Show top header navigation menu item', 'bloginwp' ),
                'section'     => 'bloginwp_top_header_section',
                'settings'    => 'top_header_menu_option'
            ))
        );

        // Redirect top header menu control
        $wp_customize->add_setting( 'top_header_menu_redirects', array(
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Redirect_Control( $wp_customize, 'top_header_menu_redirects', array(
                'section'     => 'bloginwp_top_header_section',
                'settings'    => 'top_header_menu_redirects',
                'choices'     => array(
                    'footer-column-one' => array(
                        'type'  => 'section',
                        'id'    => 'menu_locations',
                        'label' => esc_html__( 'Manage menu from here', 'bloginwp' )
                    )
                )
            ))
        );

        // Header Social Icons Option
        $wp_customize->add_setting( 'header_social_option', array(
            'default'         => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'header_social_option', array(
                'label'       => esc_html__( 'Show social icons', 'bloginwp' ),
                'section'     => 'bloginwp_top_header_section',
                'settings'    => 'header_social_option'
            ))
        );

        // Redirect social icons link
        $wp_customize->add_setting( 'header_social_icons_redirects', array(
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Redirect_Control( $wp_customize, 'header_social_icons_redirects', array(
                'section'     => 'bloginwp_top_header_section',
                'settings'    => 'header_social_icons_redirects',
                'choices'     => array(
                    'footer-column-one' => array(
                        'type'  => 'section',
                        'id'    => 'bloginwp_social_section',
                        'label' => esc_html__( 'Manage social icons', 'bloginwp' )
                    )
                )
            ))
        );

        // top header menu color and hover color
        $wp_customize->add_setting( 'top_header_menu_color_group', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'top_header_menu_color_group', array(
                'label'     => esc_html__( 'Top Menu Color', 'bloginwp' ),
                'section'   => 'bloginwp_top_header_section',
                'settings'  => 'top_header_menu_color_group',
                'tab'   => 'design'
            ))
        );

        // header social icons color and hover color
        $wp_customize->add_setting( 'header_social_color_group', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'header_social_color_group', array(
                'label'     => esc_html__( 'Social Icons Color', 'bloginwp' ),
                'section'   => 'bloginwp_top_header_section',
                'settings'  => 'header_social_color_group',
                'tab'   => 'design'
            ))
        );

        // header background property
        $wp_customize->add_setting( 'top_header_background', array(
            'default'   => json_encode(array(
                'type'  => 'solid',
                'solid' => null,
                'gradient'  => null,
                'image'     => array( 'media_id' => 0, 'media_url' => '' )
            )),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Color_Image_Group_Control( $wp_customize, 'top_header_background', array(
                'label'	      => esc_html__( 'Background Setting', 'bloginwp' ),
                'section'     => 'bloginwp_top_header_section',
                'settings'    => 'top_header_background',
                'tab'   => 'design'
            ))
        );

        /**
         * Main header Section
         * 
         * panel - bloginwp_theme_panel
         */
        $wp_customize->add_section( 'bloginwp_main_header_section', array(
            'title' => esc_html__( 'Main Header', 'bloginwp' ),
            'panel' => 'bloginwp_header_panel',
            'priority'  => 20,
        ));

        // section tab
        $wp_customize->add_setting( 'main_header_section_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'   => 'general'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Tab_Control( $wp_customize, 'main_header_section_tab', array(
                'section'     => 'bloginwp_main_header_section'
            ))
        );

        // Search Option
        $wp_customize->add_setting( 'header_search_option', array(
            'default'         => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'header_search_option', array(
                'label'	      => esc_html__( 'Show search bar', 'bloginwp' ),
                'section'     => 'bloginwp_main_header_section',
                'settings'    => 'header_search_option'
            ))
        );

        // header search color and hover color
        $wp_customize->add_setting( 'header_search_toggle_color_group', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'header_search_toggle_color_group', array(
                'label'     => esc_html__( 'Search Toggle Color', 'bloginwp' ),
                'section'   => 'bloginwp_main_header_section',
                'settings'  => 'header_search_toggle_color_group',
                'tab'   => 'design'
            ))
        );

        /**
         * Header Sidebar Toggle Bar Option
         * 
         */
        $wp_customize->add_setting( 'header_sidebar_toggle_bar_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'header_sidebar_toggle_bar_option', array(
                'label'       => esc_html__( 'Show sidebar toggle bar', 'bloginwp' ),
                'section'     => 'bloginwp_main_header_section',
                'settings'    => 'header_sidebar_toggle_bar_option'
            ))
        );

        $wp_customize->add_setting( 'header_ads_banner_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'header_ads_banner_option', array(
                'label'	      => esc_html__( 'Show ads banner', 'bloginwp' ),
                'section'     => 'bloginwp_main_header_section',
                'settings'    => 'header_ads_banner_option'
            ))
        );

        // ads image field
        $wp_customize->add_setting( 'header_ads_banner_custom_image', array(
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_ads_banner_custom_image', array(
            'section' => 'bloginwp_main_header_section',
            'mime_type' => 'image',
            'label' => esc_html__( 'Ads Image', 'bloginwp' ),
            'description' => esc_html__( 'Recommended size for ad image is 900 (width) * 350 (height)', 'bloginwp' )
        )));

        // ads url field
        $wp_customize->add_setting( 'header_ads_banner_custom_url', array(
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control( 'header_ads_banner_custom_url', array(
            'type'  => 'url',
            'section'   => 'bloginwp_main_header_section',
            'label'     => esc_html__( 'Ads url', 'bloginwp' )
        ));

        // header sidebar toggle color and hover color
        $wp_customize->add_setting( 'header_sidebar_toggle_color_group', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'header_sidebar_toggle_color_group', array(
                'label'     => esc_html__( 'Offcanvas Toggle Color', 'bloginwp' ),
                'section'   => 'bloginwp_main_header_section',
                'settings'  => 'header_sidebar_toggle_color_group',
                'tab'   => 'design'
            ))
        );

        // header background property
        $wp_customize->add_setting( 'header_background', array(
            'default'   => json_encode(array(
                'type'  => 'solid',
                'solid' => null,
                'gradient'  => null,
                'image'     => array( 'media_id' => 0, 'media_url' => '' )
            )),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Color_Image_Group_Control( $wp_customize, 'header_background', array(
                'label'	      => esc_html__( 'Background Setting', 'bloginwp' ),
                'section'     => 'bloginwp_main_header_section',
                'settings'    => 'header_background',
                'tab'   => 'design'
            ))
        );

        /**
         * Menu Options Section
         * 
         * panel - bloginwp_header_panel
         */
        $wp_customize->add_section( 'bloginwp_header_menu_option_section', array(
            'title' => esc_html__( 'Menu Options', 'bloginwp' ),
            'panel' => 'bloginwp_header_panel',
            'priority'  => 30,
        ));

        /**
         * Header Menu Responsive Tab
         * 
         */
        $wp_customize->add_setting( 'header_menu_responsive_tabs_settings_header', array(
            'default'           => 'desktop',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Tab_Control( $wp_customize, 'header_menu_responsive_tabs_settings_header', array(
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'header_menu_responsive_tabs_settings_header',
                'choices'   => array(
                    array(
                        'label' => esc_html__( 'Desktop', 'bloginwp' ),
                        'controls_hide' => array(
                            'responsive_header_menu_toggle_button_colors_settings_header',
                            'header_menu_toggle_button_color',
                            'header_menu_toggle_background_color'
                        ),
                        'controls' => array(
                            'header_menu_colors_settings_header',
                            'header_menu_font_color',
                            'header_sub_menu_colors_settings_header',
                            'header_sub_menu_background_color',
                            'header_active_menu_colors_settings_header',
                            'header_active_menu_font_color',
                            'header_menu_border_settings_header',
                            'header_menu_border_top',
                            'header_menu_typo_settings_header',
                            'header_menu_typography'
                        )
                    ),
                    array(
                        'label' => esc_html__( 'Mobile', 'bloginwp' ),
                        'controls' => array(
                            'responsive_header_menu_toggle_button_colors_settings_header',
                            'header_menu_toggle_button_color',
                            'header_menu_toggle_background_color'
                        ),
                        'controls_hide' => array(
                            'header_menu_colors_settings_header',
                            'header_menu_font_color',
                            'header_sub_menu_colors_settings_header',
                            'header_sub_menu_background_color',
                            'header_active_menu_colors_settings_header',
                            'header_active_menu_font_color',
                            'header_menu_border_settings_header',
                            'header_menu_border_top',
                            'header_menu_typo_settings_header',
                            'header_menu_typography'
                        )
                    )
                )
            ))
        );

        /**
         * Responsive Header Menu Toggle Button Colors Heading
         * 
         */
        $wp_customize->add_setting( 'responsive_header_menu_toggle_button_colors_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'responsive_header_menu_toggle_button_colors_settings_header', array(
                'label'	      => esc_html__( 'Toggle Button Colors', 'bloginwp' ),
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'responsive_header_menu_toggle_button_colors_settings_header',
                'active_callback'   => function() { return false; }
            ))
        );

        // Menu toggle button background color
        $wp_customize->add_setting( 'header_menu_toggle_button_color', array(
            'default'       => '#000000',
            'sanitize_callback' => 'bloginwp_sanitize_array',
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Picker_Control( $wp_customize, 'header_menu_toggle_button_color', array(
                'label'     => esc_html__( 'Color', 'bloginwp' ),
                'section'   => 'bloginwp_header_menu_option_section',
                'settings'  => 'header_menu_toggle_button_color',
                'active_callback'   => function() { return false; }
            ))
        );

        // Menu toggle button background color
        $wp_customize->add_setting( 'header_menu_toggle_background_color', array(
            'default'       => '#ffffff',
            'sanitize_callback' => 'bloginwp_sanitize_array',
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Picker_Control( $wp_customize, 'header_menu_toggle_background_color', array(
                'label'     => esc_html__( 'Background Color', 'bloginwp' ),
                'section'   => 'bloginwp_header_menu_option_section',
                'settings'  => 'header_menu_toggle_background_color',
                'active_callback'   => function() { return false; }
            ))
        );

        /**
         * Header Menu Colors Heading
         * 
         */
        $wp_customize->add_setting( 'header_menu_colors_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'header_menu_colors_settings_header', array(
                'label'	      => esc_html__( 'Colors', 'bloginwp' ),
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'header_menu_colors_settings_header'
            ))
        );

        // header menu font color and hover color
        $wp_customize->add_setting( 'header_menu_font_color', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'header_menu_font_color', array(
                'label'     => esc_html__( 'Color / Hover Color', 'bloginwp' ),
                'section'   => 'bloginwp_header_menu_option_section',
                'settings'  => 'header_menu_font_color',
            ))
        );

        /**
         * Header Sub Menu Colors Heading
         * 
         */
        $wp_customize->add_setting( 'header_sub_menu_colors_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'header_sub_menu_colors_settings_header', array(
                'label'	      => esc_html__( 'Sub Menu Colors', 'bloginwp' ),
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'header_sub_menu_colors_settings_header'
            ))
        );


        // header menu font color and hover color
        $wp_customize->add_setting( 'header_sub_menu_background_color', array(
            'default'   => array( 'color'   => null, 'hover'   => null ),
            'sanitize_callback' => 'bloginwp_sanitize_array',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Group_Picker_Control( $wp_customize, 'header_sub_menu_background_color', array(
                'label'     => esc_html__( 'Background - Color / Hover', 'bloginwp' ),
                'section'   => 'bloginwp_header_menu_option_section',
                'settings'  => 'header_sub_menu_background_color',
            ))
        );
        
        /**
         * Header Active Menu Colors Heading
         * 
         */
        $wp_customize->add_setting( 'header_active_menu_colors_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'header_active_menu_colors_settings_header', array(
                'label'	      => esc_html__( 'Active Menu Colors', 'bloginwp' ),
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'header_active_menu_colors_settings_header'
            ))
        );
        
        // Header active menu color
        $wp_customize->add_setting( 'header_active_menu_font_color', array(
            'sanitize_callback' => 'bloginwp_sanitize_array',
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Color_Picker_Control( $wp_customize, 'header_active_menu_font_color', array(
                'label'     => esc_html__( 'Color', 'bloginwp' ),
                'section'   => 'bloginwp_header_menu_option_section',
                'settings'  => 'header_active_menu_font_color'
            ))
        );

        /**
         * Header Menu Borders Heading
         * 
         */
        $wp_customize->add_setting( 'header_menu_border_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'header_menu_border_settings_header', array(
                'label'	      => esc_html__( 'Borders', 'bloginwp' ),
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'header_menu_border_settings_header'
            ))
        );

        // header menu border top settings
        $wp_customize->add_setting( 'header_menu_border_top', array(
            'default'   => array( 'type'=> 'solid', 'color'=> '#ddd', 'width'=> 1, 'radius'=> 0 ),
            'sanitize_callback' => 'bloginwp_sanitize_array'
        ));
        $wp_customize->add_control(
            new Bloginwp_WP_Border_Box_Control( $wp_customize, 'header_menu_border_top', array(
                'label'     => esc_html__( 'Border Top', 'bloginwp' ),
                'section'   => 'bloginwp_header_menu_option_section',
                'settings'  => 'header_menu_border_top'
            ))
        );
        
        /**
         * Header Menu Typography Heading
         * 
         */
        $wp_customize->add_setting( 'header_menu_typo_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'header_menu_typo_settings_header', array(
                'label'	      => esc_html__( 'Typography ', 'bloginwp' ),
                'section'     => 'bloginwp_header_menu_option_section',
                'settings'    => 'header_menu_typo_settings_header'
            ))
        );

        // Add the `header text` typography settings.
        $wp_customize->add_setting( 'header_menu_font_family', array( 'default' => 'Montserrat',  'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_setting( 'header_menu_font_weight', array( 'default' => '600',    'sanitize_callback' => 'absint' ) );
        $wp_customize->add_setting( 'header_menu_font_style',  array( 'default' => 'normal', 'sanitize_callback' => 'sanitize_key') );
        $wp_customize->add_setting( 'header_menu_font_size',   array( 'default' => '14',     'sanitize_callback' => 'absint' ) );
        $wp_customize->add_setting( 'header_menu_line_height', array( 'default' => '15',     'sanitize_callback' => 'absint' ) );

        // Add the `menu` typography control.
        $wp_customize->add_control(
            new Bloginwp_WP_Typography_Control( $wp_customize, 'header_menu_typography',
                array(
                    'label' => __( 'Typography', 'bloginwp' ),
                    'section'     => 'bloginwp_header_menu_option_section',
                    'initial'     => true,
                    'settings'    => array(
                        'family'      => 'header_menu_font_family',
                        'weight'      => 'header_menu_font_weight',
                        'style'       => 'header_menu_font_style',
                        'size'        => 'header_menu_font_size',
                        'line_height' => 'header_menu_line_height'
                    )
                )
            )
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_header_options_section', 10 );
endif;