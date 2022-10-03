<?php
/**
 * About Theme Panel
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( !function_exists( 'bloginwp_customizer_about_theme_panel' ) ) :
    /**
     * Register blog archive section settings
     * 
     */
    function bloginwp_customizer_about_theme_panel( $wp_customize ) {
        /**
         * About theme section
         * 
         * @since 1.0.0
         */
        $wp_customize->add_section( 'bloginwp_about_section', array(
            'title' => esc_html__( 'About Theme', 'bloginwp' ),
            'priority'  => 1
        ));
        
        // theme documentation info box
        $wp_customize->add_setting( 'site_documentation_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'site_documentation_info', array(
                'label'	      => esc_html__( 'Theme Documentation', 'bloginwp' ),
                'description' => esc_html__( 'We have well prepared documentation which includes overall instructions and recommendations that are required in this theme.', 'bloginwp' ),
                'section'     => 'bloginwp_about_section',
                'settings'    => 'site_documentation_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Documentation', 'bloginwp' ),
                        'url'   => esc_url( '//doc.blazethemes.com/bloginwp' )
                    )
                )
            ))
        );

        // theme support form info box
        $wp_customize->add_setting( 'site_support_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'site_support_info', array(
                'label'	      => esc_html__( 'Theme Support', 'bloginwp' ),
                'description' => esc_html__( 'We provide 24/7 support regarding any theme issue. Our support team will help you to solve any kind of issue. Feel free to contact us.', 'bloginwp' ),
                'section'     => 'bloginwp_about_section',
                'settings'    => 'site_support_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'Support Form', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/support' )
                    )
                )
            ))
        );

        // theme review info box
        $wp_customize->add_setting( 'theme_review_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'theme_review_info', array(
                'label'	      => esc_html__( 'Theme Review', 'bloginwp' ),
                'description' => esc_html__( 'We hope you are enjoying using bloginwp. We look forward to hear from you which will definetely help us to improve in future.', 'bloginwp' ),
                'section'     => 'bloginwp_about_section',
                'settings'    => 'theme_review_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'Leave a review', 'bloginwp' ),
                        'url'   => esc_url( '//wordpress.org/support/theme/bloginwp/reviews/?filter=5' )
                    )
                )
            ))
        );

        // theme upgrade info box
        $wp_customize->add_setting( 'theme_upgrade_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'theme_upgrade_info', array(
                'label'	      => esc_html__( 'Premium upgrade', 'bloginwp' ),
                'description' => esc_html__( 'Looking for more control over the theme? With more features, layouts and more freedom over the theme we have released the premium version of bloginwp.', 'bloginwp' ),
                'section'     => 'bloginwp_about_section',
                'settings'    => 'theme_upgrade_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View premium', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_about_theme_panel', 10 );
endif;