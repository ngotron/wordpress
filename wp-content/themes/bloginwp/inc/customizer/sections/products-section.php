<?php
/**
 * Products Panel
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( !function_exists( 'bloginwp_customizer_products_panel' ) ) :
    /**
     * Register products section settings
     * 
     */
    function bloginwp_customizer_products_panel( $wp_customize ) {
        /**
         * Products section
         * 
         * @since 1.0.0
         */
        $wp_customize->add_section( 'bloginwp_products_section', array(
            'title' => esc_html__( 'Latest Products', 'bloginwp' ),
            'priority'  => 35
        ));

        /**
         * Products layout setting heading
         */
        $wp_customize->add_setting( 'products_layout_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'products_layout_settings_header', array(
                'label'	      => esc_html__( 'Layouts Setting', 'bloginwp' ),
                'section'     => 'bloginwp_products_section',
                'settings'    => 'products_layout_settings_header'
            ))
        );

        /**
         * Products option
         */
        $wp_customize->add_setting( 'products_option', array(
            'default'   => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'products_option', array(
                'label'	      => esc_html__( 'Show products section', 'bloginwp' ),
                'section'     => 'bloginwp_products_section',
                'settings'    => 'products_option'
            ))
        );

        // theme documentation info box
        $wp_customize->add_setting( 'site_woocommerce_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'site_woocommerce_info', array(
                'label'	      => esc_html__( 'Plugin Required', 'bloginwp' ),
                'description' => esc_html__( 'You require Woocommerce plugin to display this section. After installing and activating woocommerce add products and start cusmtomizing the below options.', 'bloginwp' ),
                'section'     => 'bloginwp_products_section',
                'settings'    => 'site_woocommerce_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Woocommerce', 'bloginwp' ),
                        'url'   => esc_url( '//wordpress.org/plugins/woocommerce/' )
                    )
                )
            ))
        );

        /**
         * Products content setting heading
         * 
         */
        $wp_customize->add_setting( 'products_content_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'products_content_settings_header', array(
                'label'	      => esc_html__( 'Content Setting', 'bloginwp' ),
                'section'     => 'bloginwp_products_section',
                'settings'    => 'products_content_settings_header'
            ))
        );

        /**
         * Section title
         * 
         */
        $wp_customize->add_setting( 'products_section_title', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 'products_section_title', array(
            'label'    => esc_html__( 'Section title', 'bloginwp' ),
            'section'  => 'bloginwp_products_section',		
            'type'     => 'text'
        ));

        /**
         * Featured Links content type
         * 
         */
        $wp_customize->add_setting( 'products_content_type', array(
            'default' => 'latest',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'products_content_type', array(
            'type'      => 'select',
            'section'   => 'bloginwp_products_section',
            'label'     => esc_html__( 'Product Type', 'bloginwp' ),
            'choices'   => array(
                'latest'    => esc_html__( 'Latest', 'bloginwp' ),
                'featured'  => esc_html__( 'Featured', 'bloginwp' )
            ),
        ));

        /**
         * Products categories
         * 
         */
        $wp_customize->add_setting( 'products_categories', array(
            'default' => '[]',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Multicheckbox_Control( $wp_customize, 'products_categories', array(
                'label'     => esc_html__( 'Products Categories', 'bloginwp' ),
                'section'   => 'bloginwp_products_section',
                'settings'  => 'products_categories',
                'choices'   => bloginwp_get_multicheckbox_product_categories_array()
            ))
        );

        /**
         * Products Count
         * 
         */
        $wp_customize->add_setting( 'products_count', array(
            'default' => 3,
            'sanitize_callback' => 'absint'
        ));
        
        $wp_customize->add_control( 
            new Bloginwp_WP_Range_Control( $wp_customize, 'products_count', array(
                'label'	      => esc_html__( 'Number of products to display', 'bloginwp' ),
                'section'     => 'bloginwp_products_section',
                'settings'    => 'products_count',
                'input_attrs' => array(
                    'min'   => 1,
                    'max'   => 3,
                    'step'  => 1,
                    'reset' => true
                )
            ))
        );

        /**
         * Products rating option
         * 
         */
        $wp_customize->add_setting( 'products_rating_option', array(
            'default'   => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'products_rating_option', array(
                'label' => esc_html__( 'Show ratings', 'bloginwp' ),
                'section'   => 'bloginwp_products_section',
                'settings'  => 'products_rating_option'
            ))
        );

        /**
         * Products price option
         * 
         */
        $wp_customize->add_setting( 'products_price_option', array(
            'default'   => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'products_price_option', array(
                'label' => esc_html__( 'Show price', 'bloginwp' ),
                'section'   => 'bloginwp_products_section',
                'settings'  => 'products_price_option'
            ))
        );

        /**
         * Products add to cart option
         * 
         */
        $wp_customize->add_setting( 'products_cart_option', array(
            'default'   => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control'
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'products_cart_option', array(
                'label' => esc_html__( 'Show add to cart', 'bloginwp' ),
                'section'   => 'bloginwp_products_section',
                'settings'  => 'products_cart_option'
            ))
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_products_panel', 10 );
endif;