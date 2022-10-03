<?php
/**
 * Slider Template Part - Layout Two
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
$postCategory = json_decode( $args->category );
$postCount = $args->count;
$no_thumb = $args->no_thumb;
$categoryOption = $args->categoryOption;
$titleOption = $args->titleOption;
$dateOption = $args->dateOption;
$commentOption = $args->commentOption;
$sliderLoop = ( !$args->sliderLoop ) ? 0 : 1;
$sliderControls = ( !$args->sliderControls ) ? 0 : 1;
$sliderDots = ( !$args->sliderDots ) ? 0 : 1;
$sliderAuto = ( !$args->sliderAuto ) ? 0 : 1;
$sliderFade = ( !$args->sliderFade ) ? 0 : 1;
$sliderSpeed = $args->sliderSpeed;
$orderArray = explode( '-', $args->order );
$sliderAttr = 'data-loop=' .esc_attr( $sliderLoop ). ' data-controls=' .esc_attr( $sliderControls ). ' data-dots=' .esc_attr( $sliderDots ). ' data-auto=' .esc_attr( $sliderAuto ). ' data-fade=' .esc_attr( $sliderFade ). ' data-speed=' .absint( $sliderSpeed );
?>
<div class="blog-flower">
    <div class="blog-flower__slide__wrapper">
        <div class="blog-flower__slide layout-two" <?php echo esc_attr( $sliderAttr ); ?>>
            <?php
                $banner_args = array(
                    'order' => esc_html( $orderArray[1] ),
                    'orderby'   => esc_html( $orderArray[0] ),
                    'category_name' => implode( ',', $postCategory ),
                    'posts_per_page'    => esc_html( $postCount )
                );
                if( $no_thumb ) $banner_args['meta_query'] = array(array('key' => '_thumbnail_id','compare' => 'EXISTS'));
                $banner_slider_posts = new WP_Query( $banner_args );
                if( $banner_slider_posts->have_posts() ) :
                    while( $banner_slider_posts->have_posts() ) : $banner_slider_posts->the_post();
                    $blockCategories = get_the_category();
                ?>
                        <div class="blog-flower__slide__item">
                            <div class="post-card -box-text -center -theme--violet">
                                <a class="card__cover" href="<?php the_permalink(); ?>">
                                    <?php if( has_post_thumbnail() ) : 
                                        the_post_thumbnail('bloginwp_sliderimg');
                                        endif; 
                                    ?>
                                </a>
                                <div class="card__content">
                                    <?php
                                        if( $categoryOption ) {
                                            ?>
                                            <div class="bmm-post-cats-wrap">
                                                <?php 
                                                foreach( $blockCategories as $category ) :
                                                    ?>
                                                    <h5 class="card__content-category post-cat-<?php echo esc_attr( ( $category->term_id ) ); ?>"><a href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></h5>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </div>
                                            <?php
                                            }
                                        if( $titleOption ) {
                                    ?>
                                            <a class="card__content-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php } 

                                    if( $dateOption || $commentOption ) {
                                        ?>
                                        <div class="card__content-info">
                                            <?php if( $dateOption ) { ?>
                                                    <div class="info__time"><i class="far fa-clock"></i>
                                                        <p><?php echo get_the_date(); ?></p>
                                                    </div>
                                            <?php }
                                            if( $commentOption ) {
                                            ?>
                                                <div class="info__comment"><i class="far fa-comment"></i>
                                                    <p><?php echo absint(get_comments_number()); ?></p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php 
                                    } ?>
                                </div>
                            </div>
                        </div>
            <?php
                    endwhile;
                endif;
            ?>
        </div>
    </div>
</div>