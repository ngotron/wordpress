<?php
/**
 * Theme Upsell
 * 
 * @package bloginwp
 * @since 1.0.7
 */
if( !function_exists( 'bloginwp_customizer_upsells' ) ) :
    /**
     * Register blog archive section settings
     * 
     */
    function bloginwp_customizer_upsells( $wp_customize ) {
        // social icons upsells
        $wp_customize->add_setting( 'social_icons_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'social_icons_info', array(
                'label'	      => esc_html__( 'Unlimited social icons', 'bloginwp' ),
                'description' => esc_html__( 'For unlimited social icons and premium support.', 'bloginwp' ),
                'section'     => 'bloginwp_social_section',
                'settings'    => 'social_icons_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );

        // main_banner_info
        $wp_customize->add_setting( 'main_banner_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'main_banner_info', array(
                'label'	      => esc_html__( 'More control over', 'bloginwp' ),
                'description' => esc_html__( 'For unlimited custom banner items and more control over banner section.', 'bloginwp' ),
                'section'     => 'bloginwp_main_banner_section',
                'settings'    => 'main_banner_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );

        // featured_links_info
        $wp_customize->add_setting( 'featured_links_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'featured_links_info', array(
                'label'	      => esc_html__( 'More control over', 'bloginwp' ),
                'description' => esc_html__( 'For unlimited custom featured links, four column and more control over featured section.', 'bloginwp' ),
                'section'     => 'bloginwp_featured_links_section',
                'settings'    => 'featured_links_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );

        // blog_archive_info
        $wp_customize->add_setting( 'blog_archive_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'blog_archive_info', array(
                'label'	      => esc_html__( 'More layouts and controls', 'bloginwp' ),
                'description' => esc_html__( 'For more layouts masonry, three column grid and more. Related posts controls fields', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'blog_archive_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );

        // products_info
        $wp_customize->add_setting( 'products_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'products_info', array(
                'label'	      => esc_html__( 'Background styles and no limit over control', 'bloginwp' ),
                'description' => esc_html__( 'For more layouts, styles, color controls.', 'bloginwp' ),
                'section'     => 'bloginwp_products_section',
                'settings'    => 'products_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );

        // blog_single_post_info
        $wp_customize->add_setting( 'blog_single_post_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'blog_single_post_info', array(
                'label'	      => esc_html__( 'More layouts and controls', 'bloginwp' ),
                'description' => esc_html__( 'For more layouts and related posts controls fields', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'blog_single_post_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );
        
        // footer_info
        $wp_customize->add_setting( 'footer_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'footer_info', array(
                'label'	      => esc_html__( 'Colors, styles and premium support', 'bloginwp' ),
                'description' => esc_html__( 'Gradient, solid and background image fields', 'bloginwp' ),
                'section'     => 'bloginwp_footer_style_section',
                'settings'    => 'footer_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );

        // bottom_footer_info
        $wp_customize->add_setting( 'bottom_footer_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Bloginwp_WP_Info_Box_Control( $wp_customize, 'bottom_footer_info', array(
                'label'	      => esc_html__( 'Copyright Editor, Colors, styles and premium support', 'bloginwp' ),
                'description' => esc_html__( 'Gradient, solid and background image fields', 'bloginwp' ),
                'section'     => 'bloginwp_bottom_footer_content_section',
                'settings'    => 'bottom_footer_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Pro', 'bloginwp' ),
                        'url'   => esc_url( '//blazethemes.com/theme/bloginwp-pro/' )
                    )
                )
            ))
        );
    }
    add_action( 'customize_register', 'bloginwp_customizer_upsells', 10 );
endif;
