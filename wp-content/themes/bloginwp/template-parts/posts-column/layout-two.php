<?php
/**
 * Post Column Template Part - Layout Two
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
$columnTitle = $args['columnTitle'];
$postCategory = $args['category'];
$postCount = $args['count'];
?>
<div class="col-12 col-md-6 col-lg-4">
    <div class="footer-col -feature-post">
        <?php if( $columnTitle ) { ?>
            <div class="center-line-title"> 
                <h5><?php echo esc_html( $columnTitle ); ?></h5>
            </div>
        <?php } ?>
        <div class="feature-post-block">
            <?php
                $posts_column_post_args = array(
                    'post_type'     => 'post',
                    'posts_per_page' => esc_attr( $postCount ),
                    'post_status'   => 'publish'
                );
                if( !empty( $postCategory ) ) {
                    $posts_column_post_args['category_name'] = $postCategory;
                }
                $posts_column_post_query = new WP_Query( $posts_column_post_args );
                if( ! $posts_column_post_query->have_posts() ) {
                    esc_html_e( 'No posts found', 'bloginwp' );
                }
                $post_count = 0;
                    while( $posts_column_post_query->have_posts() ) : $posts_column_post_query->the_post();
                        $mi_post_id = get_the_ID();
                        $blockCategories = get_the_category( $mi_post_id );
                ?>
                        <div class="post-card -tiny <?php if($post_count == 0) echo esc_attr('footer_first_post'); ?>">
                            <?php
                            if( $post_count==0 ){
                                ?>
                                <div class="first_post_inner" style="back">
                                    <a class="card__cover" href="<?php the_permalink(); ?>">
                                        <?php if( has_post_thumbnail() ) : ?>
                                            <img src="<?php the_post_thumbnail_url('bloginwp-category-feature'); ?>" alt="<?php the_title_attribute(); ?>" loading="<?php bloginwp_lazy_load_value(); ?>"/>
                                        <?php endif; ?>
                                    </a>
                                    <div class="card__content">
                                        <a class="card__content-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                </div>
                                <?php
                            } else{ ?>
                                <div class="card__content">
                                    <span class="footer_count">
                                        <?php echo absint($post_count); ?>
                                    </span>
                                    <div class="three_col_outerwrap">
                                        <a class="card__content-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
            <?php
                $post_count++;
                endwhile;
            ?>
        </div>
    </div>
</div>