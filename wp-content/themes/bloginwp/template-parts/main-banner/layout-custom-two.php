<?php
/**
 * Slider Template Part - Layout Two
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
$items = json_decode( $args->items );
$titleOption = $args->titleOption;
$sliderLoop = ( !$args->sliderLoop ) ? 0 : 1;
$sliderControls = ( !$args->sliderControls ) ? 0 : 1;
$sliderDots = ( !$args->sliderDots ) ? 0 : 1;
$sliderAuto = ( !$args->sliderAuto ) ? 0 : 1;
$sliderFade = ( !$args->sliderFade ) ? 0 : 1;
$sliderSpeed = $args->sliderSpeed;
$sliderAttr = 'data-loop=' .esc_attr( $sliderLoop ). ' data-controls=' .esc_attr( $sliderControls ). ' data-dots=' .esc_attr( $sliderDots ). ' data-auto=' .esc_attr( $sliderAuto ). ' data-fade=' .esc_attr( $sliderFade ). ' data-speed=' .absint( $sliderSpeed );
?>
<div class="blog-flower">
    <div class="blog-flower__slide__wrapper">
        <div class="blog-flower__slide layout-two" <?php echo esc_attr( $sliderAttr ); ?>>
            <?php
                foreach( $items as $item ) :
                    if( $item->item_option == 'show' ) :
                    ?>
                        <div class="blog-flower__slide__item">
                            <div class="post-card -box-text -center -theme--violet">
                                <a class="card__cover" href="<?php the_permalink(); ?>">
                                    <?php
                                        if( $item->banner_image ) :
                                            echo wp_get_attachment_image( $item->banner_image, 'bloginwp_sliderimg' );
                                        endif;
                                    ?>
                                </a>
                                <div class="card__content">
                                    <?php
                                        if( $titleOption ) {
                                    ?>
                                            <a class="card__content-title" href="<?php echo esc_url( $item->banner_url ); ?>"><?php echo esc_html( $item->banner_title ); ?></a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    endif;
                endforeach;
            ?>
        </div>
    </div>
</div>