<?php
/**
 * Header Template - layout two
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( get_theme_mod( 'top_header_option', true ) ) :
?>
    <div class="top-header">
        <div class="container">
            <div class="inner_container_wrap">
                <div class="row">
                    <div class="top-header-menu">
                        <?php
                            if( get_theme_mod( 'top_header_menu_option', true ) ) :
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'top-menu',
                                        'menu_id'        => 'top-header-menu',
                                        'depth' => 1
                                    )
                                );
                            endif;
                        ?>
                    </div>
                    <div class="header__icon-group">
                            <?php 
                            if( get_theme_mod( 'header_social_option', false ) ) :
                                $social_icons_target = get_theme_mod( 'social_icons_target', '_blank' );
                                $social_icons = get_theme_mod( 'social_icons', json_encode( array(
                                        array(
                                            'icon_class'    => esc_attr( 'fab fa-linkedin-in' ),
                                            'icon_url'  => '',
                                            'item_option'   => 'show'
                                        ),
                                        array(
                                            'icon_class'    => esc_attr( 'fab fa-twitter' ),
                                            'icon_url'  => '',
                                            'item_option'   => 'show'
                                        ),
                                        array(
                                            'icon_class'    => esc_attr( 'fab fa-vimeo-v' ),
                                            'icon_url'  => '',
                                            'item_option'   => 'show'
                                        ),
                                        array(
                                            'icon_class'    => esc_attr( 'fab fa-instagram' ),
                                            'icon_url'  => '',
                                            'item_option'   => 'show'
                                        )
                                    ))
                                );
                                $social_icons_docoded = json_decode( $social_icons );
                            ?>
                            <div class="social">
                                <?php
                                    foreach( $social_icons_docoded as $social_icon ) {
                                        $icon_value = $social_icon->icon_class;
                                        $icon_link = $social_icon->icon_url;
                                        if( $social_icon->item_option  === 'show' ) echo '<a href="' .esc_url( $icon_link ). '" target="' .esc_attr( $social_icons_target ). '"><i class="' .esc_attr( $icon_value ). '"></i></a>';
                                    }
                                ?>
                            </div>
                            <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<header class="theme-default">
    <div class="container">
        <div class="header-wrapper">
            <div class="row top_header_col">
                <div class="logo_wrap">
                    <?php
                        the_custom_logo();
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="has_dot"><?php bloginfo( 'name' ); ?></a></h1>
                          <?php
                        $bloginwp_description = get_bloginfo( 'description', 'display' );
                        if ( $bloginwp_description || is_customize_preview() ) :
                            ?>
                            <p class="site-description"><?php echo wp_kses_post( $bloginwp_description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php
                        endif;
                    ?>
                </div>
                <div class="ads-banner">
                    <?php
                        $header_ads_banner_option = get_theme_mod( 'header_ads_banner_option', true );
                        $header_ads_banner_custom_image = get_theme_mod( 'header_ads_banner_custom_image' );
                        $header_ads_banner_custom_url = get_theme_mod( 'header_ads_banner_custom_url' );
                        if( $header_ads_banner_option && ! empty( $header_ads_banner_custom_image ) ) :
                        ?>
                            <a href="<?php echo esc_url( $header_ads_banner_custom_url ); ?>" target="_blank"><img src="<?php echo esc_url(wp_get_attachment_url( $header_ads_banner_custom_image )); ?>"></a>
                        <?php
                        endif;
                    ?>        
                </div><!-- .ads-banner -->
            </div>

            <div class="row menu_nav_content">
                <nav id="site-navigation">
                    <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i><span class="menu_txt"><?php esc_html_e('MENU','bloginwp') ?></button>
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                            )
                        );
                    ?>
                </nav>
                <div class="search__icon-group">
                    <?php 
                        if( get_theme_mod( 'header_search_option', false ) ) {
                            echo '<a href="#" id="search"><i class="fas fa-search"></i></a>';
                            ?>
                            <div id="search-box">
                                <div class="container">
                                    <?php echo get_search_form(); ?>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                    <?php if( get_theme_mod( 'header_sidebar_toggle_bar_option', true ) ) : ?>
                        <a class="header-sidebar-trigger sidebar-toggle-trigger" href="javascript:void(0);">
                            <div class="hamburger">
                              <span></span>
                              <span class="middle"></span>
                              <span></span>
                            </div>
                        </a>

                        <div class="header-sidebar-content">
                            <div class="header_sidebar-content-inner-wrap">
                                <div class="header-sidebar-trigger-close"><a href="javascript:void(0);"><i class="fas fa-times"></i></a></div>
                                <?php 
                                    if( is_active_sidebar('sidebar-header-toggle') ) {
                                            dynamic_sidebar('sidebar-header-toggle');
                                    } else {
                                        the_widget( 'WP_Widget_Recent_Posts' );
                                    ?>
                                        <div class="widget widget_categories">
                                            <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'bloginwp' ); ?></h2>
                                            <ul>
                                                <?php
                                                    wp_list_categories(
                                                        array(
                                                            'orderby'    => 'count',
                                                            'order'      => 'DESC',
                                                            'title_li'   => '',
                                                            'number'     => 6,
                                                        )
                                                    );
                                                ?>
                                            </ul>
                                        </div><!-- .widget -->
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
    </div>
</header>