<?php
/**
 * Single Post Panel
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( !function_exists( 'bloginwp_customizer_single_post_panel' ) ) :
    /**
     * Register single post section settings
     * 
     */
    function bloginwp_customizer_single_post_panel( $wp_customize ) {
        /**
         * Single Post section
         * 
         * @since 1.0.0
         */
        $wp_customize->add_section( 'bloginwp_blog_single_post_section', array(
            'title' => esc_html__( 'Single post', 'bloginwp' ),
            'priority'  => 50
        ));

        /**
         * Single general content settings
         * 
         */
        $wp_customize->add_setting( 'single_general_content_setting_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'single_general_content_setting_header', array(
                'label'       => esc_html__( 'General Content', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_general_content_setting_header'
            ))
        );

        /**
         * Single Posted on Date Option
         * 
         */
        $wp_customize->add_setting( 'single_post_date_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'single_post_date_option', array(
                'label'	      => esc_html__( 'Show/Hide post date', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_post_date_option'
            ))
        );
        
        /**
         * Single Category Option
         * 
         */
        $wp_customize->add_setting( 'single_post_categories_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'single_post_categories_option', array(
                'label'	      => esc_html__( 'Show/Hide post categories', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_post_categories_option'
            ))
        );

        /**
         * Single Comments Number Option
         * 
         */
        $wp_customize->add_setting( 'single_post_comments_num_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'single_post_comments_num_option', array(
                'label'	      => esc_html__( 'Show/Hide post comments number', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_post_comments_num_option'
            ))
        );

        /**
         * Single Tag Option
         * 
         */
        $wp_customize->add_setting( 'single_post_tags_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Checkbox_Control( $wp_customize, 'single_post_tags_option', array(
                'label'	      => esc_html__( 'Show/Hide post tags', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_post_tags_option'
            ))
        );

        /**
         * Single Author Box settings
         * 
         */
        $wp_customize->add_setting( 'single_author_box_setting_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'single_author_box_setting_header', array(
                'label'       => esc_html__( 'Author Box', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_author_box_setting_header'
            ))
        );

        /**
         * Single Author Box Option
         * 
         */
        $wp_customize->add_setting( 'single_post_author_box_option', array(
            'default'         => true,
            'sanitize_callback' => 'bloginwp_sanitize_toggle_control',
        ));
    
        $wp_customize->add_control( 
            new Bloginwp_WP_Toggle_Control( $wp_customize, 'single_post_author_box_option', array(
                'label'	      => esc_html__( 'Show/Hide author box', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_post_author_box_option'
            ))
        );

        /**
         * Single Related Posts settings
         * 
         */
        $wp_customize->add_setting( 'single_related_posts_setting_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 
            new Bloginwp_WP_Section_Heading_Control( $wp_customize, 'single_related_posts_setting_header', array(
                'label'       => esc_html__( 'Related Posts', 'bloginwp' ),
                'section'     => 'bloginwp_blog_single_post_section',
                'settings'    => 'single_related_posts_setting_header'
            ))
        );

        /**
         * Related Posts Section Title
         * 
         */
        $wp_customize->add_setting( 'single_post_related_posts_title', array(
            'default'   => esc_html__( 'Related Posts', 'bloginwp' ),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 'single_post_related_posts_title', array(
            'label'    => esc_html__( 'Related posts title', 'bloginwp' ),
            'section'  => 'bloginwp_blog_single_post_section',		
            'type'     => 'text'
        ));
        
        /**
         * Single Related Posts Count
         * 
         */
        $wp_customize->add_setting( 'single_post_related_posts_count', array(
            'default'        => 3,
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control( 'single_post_related_posts_count', array(
            'label'    => esc_html__( 'Posts Count -', 'bloginwp' ),
            'section'  => 'bloginwp_blog_single_post_section',		
            'type'     => 'number',
            'input_attrs'   => array(
                'min'   => 1,
                'step'  => 1,
                'max'   => 3
            )
        ));

    }
    add_action( 'customize_register', 'bloginwp_customizer_single_post_panel', 10 );
endif;