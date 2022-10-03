<?php
/**
 * Blog Archive Panel
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( !function_exists( 'bloginwp_customizer_blog_archive_panel' ) ) :
    /**
     * Register blog archive section settings
     * 
     */
    function bloginwp_customizer_blog_archive_panel( $wp_customize ) {
        /**
         * Blog page / archive section
         * 
         * @since 1.0.0
         */
        $wp_customize->add_section( 'bloginwp_blog_archive_section', array(
            'title' => esc_html__( 'Blog page / Archive', 'bloginwp' ),
            'priority'  => 35
        ));

        /**
         * Layout settings header
         * 
         */
        $wp_customize->add_setting( 'archive_layout_setting_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'archive_layout_setting_header', array(
                'label'       => esc_html__( 'Layout Setting', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_layout_setting_header'
            ))
        );

        /**
         * Archive Posts Layout settings
         * 
         */
        $wp_customize->add_setting( 'archive_posts_layout',
            array(
                'default'           => 'grid-layout-twocol',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        // Add the layout control.
        $wp_customize->add_control( new Bloginwp_WP_Radio_Image_Control( $wp_customize,
            'archive_posts_layout', array(
                    'label'     => esc_html__( 'Posts Layouts', 'bloginwp' ),
                    'section'   => 'bloginwp_blog_archive_section',
                    'choices'   => array(
                        'grid-layout' => array(
                            'label'   => esc_html__( 'Grid Layout', 'bloginwp' ),
                            'url'     => '%s/assets/images/customizer/grid_mode.jpg'
                        ),
                        'grid-layout-twocol' => array(
                            'label'   => esc_html__( 'Grid Layout Twocol', 'bloginwp' ),
                            'url'     => '%s/assets/images/customizer/grid-four.jpg'
                        )
                    )
                )
            )
        );

        /**
         * Archive general content settings
         * 
         */
        $wp_customize->add_setting( 'archive_general_content_setting_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'archive_general_content_setting_header', array(
                'label'       => esc_html__( 'General Content', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_general_content_setting_header'
            ))
        );

        /**
         * Archive post content type
         * 
         */
        $wp_customize->add_setting( 'archive_content_type', array(
            'default' => 'excerpt',
            'sanitize_callback' => 'bloginwp_sanitize_select'
        ));
        
        $wp_customize->add_control( 'archive_content_type', array(
            'type'      => 'select',
            'section'   => 'bloginwp_blog_archive_section',
            'label'     => __( 'Post Content to display', 'bloginwp' ),
            'choices'   => array(
                'excerpt' => esc_html__( 'Excerpt', 'bloginwp' ),
                'content' => esc_html__( 'Content', 'bloginwp' )
            ),
        ));
        
        /**
         * Archive Posted on Date Option
         * 
         */
        $wp_customize->add_setting( 'archive_post_date_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'archive_post_date_option', array(
                'label'	      => esc_html__( 'Show/Hide post date', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_post_date_option'
            ))
        );

        /**
         * Archive Comments Number Option
         * 
         */
        $wp_customize->add_setting( 'archive_post_comments_num_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'archive_post_comments_num_option', array(
                'label'	      => esc_html__( 'Show/Hide post comments number', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_post_comments_num_option'
            ))
        );


        /**
         * Archive Category Option
         * 
         */
        $wp_customize->add_setting( 'archive_post_categories_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'archive_post_categories_option', array(
                'label'	      => esc_html__( 'Show/Hide post categories', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_post_categories_option'
            ))
        );

        /**
         * Archive Read more Option
         * 
         */
        $wp_customize->add_setting( 'archive_read_more_option', array(
            'default'         => false,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'archive_read_more_option', array(
                'label'	      => esc_html__( 'Show/Hide read more', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_read_more_option'
            ))
        );

        /**
         * Add read more text
         * 
         */
        $wp_customize->add_setting( 'archive_read_more_text', array(
            'default'        => esc_html__( 'Read more', 'bloginwp' ),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 'archive_read_more_text', array(
            'label'    => esc_html__( 'Read more text', 'bloginwp' ),
            'section'  => 'bloginwp_blog_archive_section',		
            'type'     => 'text'
        ));

        /**
         * Single Related Posts settings
         * 
         */
        $wp_customize->add_setting( 'archive_related_posts_setting_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'archive_related_posts_setting_header', array(
                'label'       => esc_html__( 'Related Posts', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_related_posts_setting_header',
                'active_callback'   => function( $setting ) {
                    if ( $setting->manager->get_setting( 'archive_posts_layout' )->value() === 'grid-layout-twocol') {
                        return false;
                    }
                    return true;
                }
            ))
        );

        /**
         * Single Related Posts Section Option
         * 
         */
        $wp_customize->add_setting( 'archive_post_related_posts_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'archive_post_related_posts_option', array(
                'label'	      => esc_html__( 'Show/Hide related posts', 'bloginwp' ),
                'section'     => 'bloginwp_blog_archive_section',
                'settings'    => 'archive_post_related_posts_option',
                'active_callback'   => function( $setting ) {
                    if ( $setting->manager->get_setting( 'archive_posts_layout' )->value() === 'grid-layout-twocol' ) {
                        return false;
                    }
                    return true;
                }
            ))
        );

        /**
         * Related Posts Section Title
         * 
         */
        $wp_customize->add_setting( 'archive_post_related_posts_title', array(
            'default'   => esc_html__( 'Related Posts', 'bloginwp' ),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 'archive_post_related_posts_title', array(
            'label'    => esc_html__( 'Related posts title', 'bloginwp' ),
            'section'  => 'bloginwp_blog_archive_section',		
            'type'     => 'text',
            'active_callback'   => function( $setting ) {
                if ( $setting->manager->get_setting( 'archive_posts_layout' )->value() === 'grid-layout-twocol' ) {
                    return false;
                }
                return true;
            }
        ));
        
        /**
         * Single Relate Posts Count
         * 
         */
        $wp_customize->add_setting( 'archive_post_related_posts_count', array(
            'default'        => 2,
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control( 'archive_post_related_posts_count', array(
            'label'    => esc_html__( 'Posts Count', 'bloginwp' ),
            'section'  => 'bloginwp_blog_archive_section',		
            'type'     => 'number',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 2
            ),
            'active_callback'   => function( $setting ) {
                if ( $setting->manager->get_setting( 'archive_posts_layout' )->value() === 'grid-layout-twocol' ) {
                    return false;
                }
                return true;
            }
        ));

    }
    add_action( 'customize_register', 'bloginwp_customizer_blog_archive_panel', 10 );
endif;