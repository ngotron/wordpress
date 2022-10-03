<?php
/**
 * Frontpage sections hooks
 * 
 */
if( ! function_exists( 'bloginwp_main_banner_html' ) ) :
    /**
     * Main Banner Slider
     * 
     * @since 1.0.0
     */
    function bloginwp_main_banner_html() {
        $main_banner_option = get_theme_mod( 'main_banner_option', false );
        if( ! $main_banner_option ) return;
        $main_banner_slider_display_on = get_theme_mod( 'main_banner_slider_display_on', 'front-blog' );
        if( is_home() && $main_banner_slider_display_on === 'front' ) return;
        if( is_front_page() && $main_banner_slider_display_on === 'blog' ) return;
        $layout = 'two';
        $args = new stdClass();
        $args->sliderLoop   = get_theme_mod( 'main_banner_slider_loop', true );
        $args->sliderControls   = get_theme_mod( 'main_banner_slider_arrows', true );
        $args->sliderDots   = get_theme_mod( 'main_banner_slider_dots', false );
        $args->sliderAuto   = false;
        $args->sliderFade   = false;
        $args->sliderSpeed  = get_theme_mod( 'main_banner_slider_speed', '300' );
        ?>
        <section id="bloginwp-main-banner-section" class="bloginwp-frontpage-section">
            <?php
                if( get_theme_mod( 'main_banner_slider_source', 'posts' ) === 'posts' ) :
                    $args->category = get_theme_mod( 'main_banner_slider_categories', '[]' );
                    $args->order    = get_theme_mod( 'main_banner_slider_order_by', 'date-desc' );
                    $args->count    = get_theme_mod( 'main_banner_slider_numbers', 4 );
                    $args->categoryOption   = get_theme_mod( 'main_banner_slider_categories_option', false );
                    $args->titleOption  = get_theme_mod( 'main_banner_slider_post_title_option', true );
                    $args->dateOption   = get_theme_mod( 'main_banner_slider_date_option', true );
                    $args->commentOption    = get_theme_mod( 'main_banner_slider_comments_option', true );
                    $args->no_thumb     = true;
                    // get template parts
                    get_template_part( 'template-parts/main-banner/layout', esc_html( $layout ), $args );
                else :
                    $args->items = get_theme_mod( 'main_banner_slider_custom', json_encode( array(
                            array(
                                'banner_image'  => '',
                                'banner_title'  => '',
                                'banner_url'    => '',
                                'item_option'   => 'show'
                            )
                        ))
                    );
                    $args->titleOption  = get_theme_mod( 'main_banner_slider_custom_title_option', true );
                    // get template parts
                    get_template_part( 'template-parts/main-banner/layout-custom', esc_html( $layout ), $args );
                endif;
            ?>
            </section>
    <?php
    }
endif;

if( ! function_exists( 'bloginwp_featured_links_html' ) ) :
    /**
     * Featured Categories
     * 
     * @since 1.0.0
     */
    function bloginwp_featured_links_html() {
        $featured_links_option = get_theme_mod( 'featured_links_option', false );
        if( ! $featured_links_option ) return;
        $featured_links_display_on = get_theme_mod( 'featured_links_display_on', 'front-blog' );
        if( is_home() && $featured_links_display_on === 'front' ) return;
        if( is_front_page() && $featured_links_display_on === 'blog' ) return;
        $layout = 'one';
        $args = new stdClass();
        $args->type = get_theme_mod( 'featured_links_content_type', 'categories' );
        $args->blockTitle   = get_theme_mod( 'featured_links_title' );
        $args->categories   = get_theme_mod( 'featured_links_categories', '[]' );
        $args->titleOption  = get_theme_mod( 'featured_links_title_option', true );
        $args->countOption  = get_theme_mod( 'featured_links_categories_count_option', false );
        $featured_links_carousel_column = get_theme_mod( 'featured_links_carousel_column', 'three' );
        $featured_links_carousel_controls = true;
        $featured_links_carousel_auto   = false;
    ?>
        <section id="bloginwp-featured-section" class="bloginwp-frontpage-section <?php echo esc_attr( $featured_links_carousel_column ); ?>" data-column="<?php echo esc_attr( $featured_links_carousel_column ); ?>" data-arrows="<?php echo esc_attr(json_encode( $featured_links_carousel_controls )); ?>" data-auto="<?php echo esc_attr(json_encode( $featured_links_carousel_auto )); ?>">
            <?php
                // get template parts
                get_template_part( 'template-parts/categories-collection/layout', esc_html( $layout ), $args );
            ?>
        </section>
    <?php
    }
endif;
add_action( 'bloginwp_frontpage_section_hook', 'bloginwp_main_banner_html', 10 );
add_action( 'bloginwp_frontpage_section_hook', 'bloginwp_featured_links_html', 20 );

if( ! function_exists( 'bloginwp_latest_products_sec' ) ) :
    /**
     * Latest products html
     * 
     * @since 1.0.0
     */
    function bloginwp_latest_products_sec() {
        $products_option = get_theme_mod( 'products_option', false );
        if( ! $products_option || ! is_front_page() ) return;
        $layout = 'one';
        $args = new stdClass();
        $args->blockTitle   = get_theme_mod( 'products_section_title' );
        $args->productType = get_theme_mod( 'products_content_type', 'latest' );
        $args->categories   = get_theme_mod( 'products_categories', '[]' );
        $args->count  = get_theme_mod( 'products_count', 3 );
        $args->ratingOption  = get_theme_mod( 'products_rating_option', true );
        $args->priceOption  = get_theme_mod( 'products_price_option', true );
        $args->cartOption  = get_theme_mod( 'products_cart_option', true );
    ?>
        <section id="bloginwp-products-section" class="bloginwp-frontpage-section">
            <?php
                // get template parts
                get_template_part( 'template-parts/woo-products/layout', esc_html( $layout ), $args );
            ?>
        </section>
    <?php
    }
endif;

if( ! function_exists( 'bloginwp_footer_three_column_sec' ) ) :
    /**
     * Footer three column section fnc
     * 
     */
    function bloginwp_footer_three_column_sec() {
        $footer_three_column_option = get_theme_mod( 'footer_three_column_option', 'all' );
        if( $footer_three_column_option === 'hide' ) {
            return;
        } else if( $footer_three_column_option === 'frontpage' && ! is_front_page() ) {
            return;
        } else if( $footer_three_column_option === 'innerpages' && is_front_page()  ) {
            return;
        }
        $footer_three_column_blocks = array(
                    array(
                        'columnTitle' => ( !empty( get_theme_mod( 'footer_column_one_category', '' ) ) ) ? get_theme_mod( 'footer_column_one_category', '' ) : '',
                        'category'  => get_theme_mod( 'footer_column_one_category', '' ),
                        'count'     => get_theme_mod( 'footer_column_one_count', 3 ),
                        'layout'    => 'one'
                    ),
                    array(
                        'columnTitle' => ( !empty( get_theme_mod( 'footer_column_two_category', '' ) ) ) ? get_theme_mod( 'footer_column_two_category', '' ) : '',
                        'category'  => get_theme_mod( 'footer_column_two_category', '' ),
                        'count'     => get_theme_mod( 'footer_column_two_count', 3 ),
                        'layout'    => 'two'
                    ),
                    array(
                        'columnTitle' => ( !empty( get_theme_mod( 'footer_column_three_category', '' ) ) ) ? get_theme_mod( 'footer_column_three_category', '' ) : '',
                        'category'  => get_theme_mod( 'footer_column_three_category', '' ),
                        'count'     => get_theme_mod( 'footer_column_three_count', 3 ),
                        'layout'    => 'three'
                    )
                );
        if( ! $footer_three_column_blocks ) {
            return;
        }
        $footer_three_column_width = get_theme_mod( 'footer_three_column_width', 'boxed-width' );
        $container_class = ( $footer_three_column_width === 'boxed-width' ) ? 'container' : 'container-fluid';
        echo '<section id="bloginwp-footer-three-column-section" class="bloginwp-frontpage-section">';
            echo '<div class="' .esc_html( $container_class ). '">';
                echo '<div class="row">';
                    foreach( $footer_three_column_blocks as $block ) :
                        $layout = $block['layout'];
                        get_template_part( 'template-parts/posts-column/layout', esc_html( $layout ), $block );
                    endforeach;
                echo '</div>';
            echo '</div>';
        echo '</section><!-- #bloginwp-footer-three-column-section -->';
    }
endif;

add_action( 'bloginwp_before_footer_hook', 'bloginwp_latest_products_sec', 30 );
add_action( 'bloginwp_before_footer_hook', 'bloginwp_footer_three_column_sec', 40 );