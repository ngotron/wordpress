<?php
/**
 * Template parts - layout one "Categories Collection"
 */
$blockTitle = $args->blockTitle;
$postCategories = $args->categories;
$titleOption = $args->titleOption;
$countOption = $args->countOption;
$content_type = $args->type;
?>
<div class="bmm-categories-collection-block bmm-block bmm-block-categories-collection--layout-one">
    <div class="container">
        <?php
            if( $blockTitle ) {
                ?>
                <div class="news-block__header">
                    <div class="header__controller__title">
                        <div class="center-line-title -large -mb-0">
                            <h5><span class="section-title-inner"><?php echo esc_html( $blockTitle ); ?></span></h5>
                        </div>
                    </div>
                </div>
            <?php }
        ?>
        <div class="categories-wrap row">
            <?php
                if( $content_type === 'custom' ) :
                    $featured_links_items = get_theme_mod( 'featured_links_items', json_encode(array(
                        array(
                            'item_image'    => '',
                            'item_title'    => esc_html__( 'Featured Link', 'bloginwp' ),
                            'item_url'  => '',
                            'item_option'   => 'show'
                        )
                    )));
                    $featured_links_items = json_decode( $featured_links_items );
                    if( $featured_links_items ) :
                        foreach( $featured_links_items as $item_key => $item ) :
                            if(  $item->item_option ) {
                            ?>
                                    <div class="feature_single ">
                                        <div class="post-card category-item">
                                            <div class="category-thumb-wrap bmm-post-thumb">
                                                <a href="<?php echo esc_url( $item->item_url ); ?>" class="card__cover">
                                                    <?php if( isset( $item->item_image ) && $item->item_image ) : ?>
                                                        <img src="<?php echo esc_url( wp_get_attachment_url( $item->item_image ) ); ?>" loading="<?php bloginwp_lazy_load_value(); ?>">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="cat-meta bmm-post-title card__content">
                                                <?php
                                                    if( $item->item_title ) echo '<span class="category-name"><a href="' .esc_url( $item->item_url ). '">' .esc_html( $item->item_title ).'</a></span>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                            }
                        endforeach;
                    endif;
                else :
                    if( $postCategories != '[]' ) {
                        $postCategories = get_categories( array( 'slug' => explode( ",", $postCategories ) ) );
                    } else {
                        $postCategories = get_categories(array( 'number'    => 4 ));
                    }
                    foreach( $postCategories as $postCat ) :
                        $cat_name = $postCat->name;
                        $cat_count = $postCat->count;
                        $cat_slug = $postCat->slug;
                        $category_id = $postCat->cat_ID;
                        $block_post = new WP_Query( 
                            array( 
                                'category_name'    => esc_html( $cat_slug ),
                                'posts_per_page' => 1,
                                'meta_query' => array(
                                    array(
                                        'key' => '_thumbnail_id',
                                        'compare' => 'EXISTS'
                                    ),
                                )
                            )
                        );
                        if( $block_post->have_posts() ) :
                            while( $block_post->have_posts() ) : $block_post->the_post();
                                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'bloginwp-featured-list' );
                            endwhile;
                        endif;
                ?>      <div class="feature_single">
                            <div class="post-card category-item cat-<?php echo esc_attr( $category_id ); ?>">
                                <div class="category-thumb-wrap bmm-post-thumb">
                                    <a href="<?php echo esc_url( get_term_link( $category_id ) ); ?>" class="card__cover">
                                        <?php if( isset( $thumbnail_url ) && $thumbnail_url ) : ?>
                                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" loading="<?php bloginwp_lazy_load_value(); ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <?php
                                    if( $titleOption || $countOption ) {
                                ?>
                                <div class="cat-meta bmm-post-title card__content">
                                    <?php
                                        if( $titleOption ) {
                                            echo '<span class="category-name"><a href="' .esc_url( get_term_link( $category_id ) ). '">' .esc_html( $cat_name ).'</a></span>';
                                        }

                                        if( $countOption ) {
                                            echo '<span class="category-count"> &nbsp; ' .absint( $cat_count ). ' </span>';
                                        }
                                    ?>
                                </div>
                                <?php
                                    }
                                ?>

                            </div>
                        </div>
            <?php
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</div>