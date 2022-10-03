<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bloginwp
 */

?>
<div class="post-card -theme--blue -small -horizontal">
        <?php
            if( has_post_thumbnail() ) {
                bloginwp_get_thumb_html_by_post_format();
            }
        ?>
        <div class="card__content">
        	<?php
        	$bloginwp_categories = get_the_category();
				if ( ! empty( $bloginwp_categories ) ) {
                    echo '<div class="bmm-post-cats-wrap bmm-post-meta-item">';
				    echo '<a class="card__content-category" href="' . esc_url( get_category_link( $bloginwp_categories[0]->term_id ) ) . '">' . esc_html( $bloginwp_categories[0]->name ) . '</a>';
                    echo '</div>';
				}
        	?>
            <a class="card__content-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            
            <div class="card__content-info">
                
                <div class="info__time"><i class="far fa-clock"></i>
                    <p><?php echo esc_html( get_the_date() ); ?></p>
                </div>
                <div class="info__comment">
                    <i class="far fa-comment"></i>
                    <p><?php echo absint( get_comments_number( ) ); ?></p>
                </div>
            </div>
            
            <div class="card__content-description">
                <?php the_excerpt(); ?>
            </div>
            <br/>
            <div class="card__button">
            	<a href="<?php the_permalink(); ?>">
            		<?php echo esc_html('Read More', 'bloginwp'); ?>		
            	</a>
            </div>
        </div>
    </div>
