<?php
/**
 * Grid Template Part - Layout One
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
$blockTitle = $args->blockTitle;
$productType = $args->productType;
$blockCategories = json_decode( $args->categories );
$postCount = $args->count;
$ratingOption = $args->ratingOption;
$priceOption = $args->priceOption;
$cartOption = $args->cartOption;
$woo_classes = '';
if( ! $cartOption ) $woo_classes .= ' hide-cart';
if( ! $priceOption ) $woo_classes .= ' hide-price';
if( ! $ratingOption ) $woo_classes .= ' hide-rating';
?>
<div class="woo-products-layout-one container">
    <?php 
        if( !empty( $blockTitle ) ) {
            ?>
            <div class="header__controller__title">
                <div class="center-line-title -large -mb-0">
                    <h5><?php echo esc_html( $blockTitle ); ?></h5>
                </div>
            </div>

            <?php
        }

        $products_args = array(
            'post_type' => 'product',
            'posts_per_page' => esc_attr( $postCount ),
        );
        if( 'featured' == $productType ) {
            $products_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                )
            );
        } else {
            if( $blockCategories ) {
                $products_args['product_cat'] = implode( ",", $blockCategories );
            }
        }
        $products_query = new WP_Query( $products_args );
        if ( $products_query->have_posts() ) :
            echo '<div class="shop__products__content">';
                echo '<div class="row woo-products-wrapper ' .esc_attr( $woo_classes ). '">';
                    while ( $products_query->have_posts() ) : $products_query->the_post();
                        ?>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        </div>
                        <?php
                    endwhile;
                echo '</div><!-- .woo-products-wrapper -->';
            echo '</div>';
        endif;
    ?>
</div>