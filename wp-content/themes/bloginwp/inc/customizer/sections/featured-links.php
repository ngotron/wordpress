<?php
/**
 * Featured Links Panel
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( !function_exists( 'bloginwp_customizer_featured_links_panel' ) ) :
    /**
     * Register featured links section settings
     * 
     */
    function bloginwp_customizer_featured_links_panel( $wp_customize ) {
        /**
         * Featured Links section
         * 
         * @since 1.0.0
         */
        $wp_customize->add_section( 'bloginwp_featured_links_section', array(
            'title' => esc_html__( 'Featured Links', 'bloginwp' ),
            'priority'  => 30
        ));

        /**
         * Featured Links layout setting heading
         */
        $wp_customize->add_setting( 'featured_links_layout_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'featured_links_layout_settings_header', array(
                'label'	      => esc_html__( 'Layouts Setting', 'bloginwp' ),
                'section'     => 'bloginwp_featured_links_section',
                'settings'    => 'featured_links_layout_settings_header'
            ))
        );

        /**
         * Featured Links option
         */
        $wp_customize->add_setting( 'featured_links_option', array(
            'default'   => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'featured_links_option', array(
                'label'	      => esc_html__( 'Show featured links', 'bloginwp' ),
                'section'     => 'bloginwp_featured_links_section',
                'settings'    => 'featured_links_option'
            ))
        );

        /**
         * Featured Links display on
         * 
         */
        $wp_customize->add_setting( 'featured_links_display_on', array(
            'default' => 'front-blog',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'featured_links_display_on', array(
            'type'      => 'select',
            'section'   => 'bloginwp_featured_links_section',
            'label'     => esc_html__( 'Show On', 'bloginwp' ),
            'choices'   => array(
                'front' => esc_html__( 'Frontpage', 'bloginwp' ),
                'blog'  => esc_html__( 'Posts page', 'bloginwp' ),
                'front-blog'    => esc_html__( 'Frontpage and posts page', 'bloginwp' )
            )
        ));

        /**
         * Featured Links content setting heading
         * 
         */
        $wp_customize->add_setting( 'featured_links_content_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'featured_links_content_settings_header', array(
                'label'	      => esc_html__( 'Content Setting', 'bloginwp' ),
                'section'     => 'bloginwp_featured_links_section',
                'settings'    => 'featured_links_content_settings_header'
            ))
        );

        /**
         * Section title
         * 
         */
        $wp_customize->add_setting( 'featured_links_title', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 'featured_links_title', array(
            'label'    => esc_html__( 'Section Title', 'bloginwp' ),
            'section'  => 'bloginwp_featured_links_section',		
            'type'     => 'text'
        ));

        /**
         * Featured Links content type
         * 
         */
        $wp_customize->add_setting( 'featured_links_content_type', array(
            'default' => 'categories',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'featured_links_content_type', array(
            'type'      => 'select',
            'section'   => 'bloginwp_featured_links_section',
            'label'     => esc_html__( 'Content Type', 'bloginwp' ),
            'choices'   => array(
                'categories'=> esc_html__( 'Post Categories', 'bloginwp' ),
                'custom'    => esc_html__( 'Custom Links', 'bloginwp' )
            ),
        ));

        /**
         * Featured Links categories
         * 
         */
        $wp_customize->add_setting( 'featured_links_categories', array(
            'default' => '[]',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Multicheckbox_Control( $wp_customize, 'featured_links_categories', array(
                'label'     => esc_html__( 'Posts Categories', 'bloginwp' ),
                'section'   => 'bloginwp_featured_links_section',
                'settings'  => 'featured_links_categories',
                'choices'   => bloginwp_get_multicheckbox_categories_array(),
                'active_callback'   => function( $setting ) {
                    if ( $setting->manager->get_setting( 'featured_links_content_type' )->value() === 'categories' ) {
                        return true;
                    }
                    return false;
                }
            ))
        );

        /**
         * Featured Links Items
         * 
         */
        $wp_customize->add_setting( 'featured_links_items', array(
            'default'   => json_encode(array(
                array(
                    'item_image'    => '',
                    'item_title'    => esc_html__( 'Featured Link', 'bloginwp' ),
                    'item_url'  => '',
                    'item_option'   => 'show'
                )
            )),
            'sanitize_callback' => 'bloginwp_sanitize_repeater_control'
        ));

        $wp_customize->add_control(
            new Bloginwp_WP_Custom_Repeater( $wp_customize, 'featured_links_items', array(
                'label'         => esc_html__( 'Featured links', 'bloginwp' ),
                'description'   => esc_html__( 'Hold item and drag vertically to re-order the icons', 'bloginwp' ),
                'section'       => 'bloginwp_featured_links_section',
                'settings'      => 'featured_links_items',
                'row_label'     => esc_html__( 'Featured Item', 'bloginwp' ),
                'add_new_label' => esc_html__( 'Add new item', 'bloginwp' ),
                'fields'        => array(
                    'item_image'   => array(
                        'type'          => 'image',
                        'label'         => esc_html__( 'Image', 'bloginwp' ),
                        'description'   => esc_html__( 'Choose from the library or upload an image.', 'bloginwp' ),
                        'default'       => esc_attr( 'fab fa-instagram' )

                    ),
                    'item_title'  => array(
                        'type'      => 'text',
                        'label'     => esc_html__( 'Title', 'bloginwp' ),
                        'default'   => ''
                    ),
                    'item_url'  => array(
                        'type'      => 'url',
                        'label'     => esc_html__( 'URL for featured item', 'bloginwp' ),
                        'default'   => ''
                    ),
                    'item_option'             => 'show'
                ),
                'active_callback'   => function( $setting ) {
                    if ( $setting->manager->get_setting( 'featured_links_content_type' )->value() === 'custom' ) {
                        return true;
                    }
                    return false;
                }
            ))
        );

        /**
         * Featured Links title option
         * 
         */
        $wp_customize->add_setting( 'featured_links_title_option', array(
            'default'   => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'featured_links_title_option', array(
                'label' => esc_html__( 'Show links title', 'bloginwp' ),
                'section'   => 'bloginwp_featured_links_section',
                'settings'  => 'featured_links_title_option',
                'type'      => 'simple-toggle-button'
            ))
        );

        /**
         * Categories count option
         * 
         */
        $wp_customize->add_setting( 'featured_links_categories_count_option', array(
            'default'   => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'featured_links_categories_count_option', array(
                'label' => esc_html__( 'Show categories count', 'bloginwp' ),
                'section'   => 'bloginwp_featured_links_section',
                'settings'  => 'featured_links_categories_count_option',
                'type'      => 'simple-toggle-button',
                'active_callback'   => function( $setting ) {
                    if ( $setting->manager->get_setting( 'featured_links_content_type' )->value() === 'categories' ) {
                        return true;
                    }
                    return false;
                }
            ))
        );

        /**
         * Featured Links carousel setting heading
         */
        $wp_customize->add_setting( 'featured_links_carousel_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'featured_links_carousel_settings_header', array(
                'label'	      => esc_html__( 'Carousel Setting', 'bloginwp' ),
                'section'     => 'bloginwp_featured_links_section',
                'settings'    => 'featured_links_carousel_settings_header'
            ))
        );

        /**
         * Featured Links column option
         */
        $wp_customize->add_setting( 'featured_links_carousel_column', array(
            'default'   => 'three',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control(
            new Bloginwp_WP_Tab_Group_Control( $wp_customize, 'featured_links_carousel_column', array(
                'label'     => esc_html__( 'Column control', 'bloginwp' ),
                'section'   => 'bloginwp_featured_links_section',
                'settings'  => 'featured_links_carousel_column',
                'choices'   => array(
                    'two'   => array(
                        'label' => esc_html__( 'Two', 'bloginwp' )
                    ),
                    'three' => array(
                        'label' => esc_html__( 'Three', 'bloginwp' )
                    )
                )
            ))
        );

    }
    add_action( 'customize_register', 'bloginwp_customizer_featured_links_panel', 10 );
endif;