<?php
/**
 * Template part for displaying posts - archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bloginwp
 */
$archive_post_comments_num_option = get_theme_mod( 'archive_post_comments_num_option', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card -center' ); ?>>
	<div class="post-inner-wrapper <?php if( !has_post_thumbnail()) echo 'no_feat_img '; ?>">
		<div class="feat_image_wrap">
			<div class="date_wrap">
				<?php bloginwp_posted_on(); ?>
			</div>
			<?php bloginwp_get_thumb_html_by_post_format(); ?>
		</div>
		<div class="card__content">
			<?php
				$archive_post_categories_option = get_theme_mod( 'archive_post_categories_option', true );
				if( $archive_post_categories_option ) :
					$post_categories = get_the_category();
					if($post_categories){
						echo '<div class="bmm-post-cats-wrap bmm-post-meta-item">';
						foreach( $post_categories as $post_cat ) :
							echo '<h5 class="card__content-category post-cat-' .esc_attr( ( $post_cat->term_id ) ). '"><a href="' .esc_url( get_category_link( $post_cat->term_id ) ). '">' .esc_html( $post_cat->name ). '</a></h5>';
						endforeach;
						echo '</div>';
					}
				endif;
			?>
			<?php
				the_title( '<a href="' . esc_url( get_permalink() ) . '" class="card__content-title" rel="bookmark">', '</a>' );

				// social share html
				if( get_theme_mod( 'archive_social_share_position', 'after_content' ) === 'before_content' ) bloginwp_social_share_html();
			?>
			
			<div class="entry-content">
				<?php  
					$archive_content_type = get_theme_mod( 'archive_content_type', 'excerpt' );
					switch( $archive_content_type ) {
						case 'content' : the_content();
									break;
						default: the_excerpt();
								break;
					}
				?>
			</div><!-- .entry-content -->
			<div class="bottom_article_info">

				<div class="read_time">
					<span><?php echo esc_html( 'Read Time: ', 'bloginwp'); ?></span>
					<?php echo absint(bloginwp_post_read_time(get_the_content())); ?>
					<span> <?php esc_html_e('Min', 'bloginwp'); ?></span>
				</div>
				
				<?php
					if( $archive_post_comments_num_option ) :
				?>
				<div class="card__content-info">
					<div class="info__comment"><i class="far fa-comment"></i>
						<p><?php echo absint(get_comments_number()); ?></p>
					</div>
				</div>
				<?php endif; ?>
				
				<!-- share more  -->
				<?php
					$social_share_class = 'social_share_hide';
					$social_share_option = get_theme_mod( 'archive_social_share_option', true );
					if($social_share_option) $social_share_class = 'social_share_display';
				?>
				<div class="share_readmore  <?php echo esc_attr($social_share_class); ?>">
					<?php
						$archive_read_more_option = get_theme_mod( 'archive_read_more_option', false );
						if( $archive_read_more_option ) :
							$archive_read_more_text = get_theme_mod( 'archive_read_more_text', esc_html__( 'Read more', 'bloginwp' ) );
							echo '<div class="card__button"><a href="' .esc_url( get_the_permalink() ). '">' .esc_html( $archive_read_more_text ). '</a></div>';
						endif;

						// social share html
						if( get_theme_mod( 'archive_social_share_position', 'after_content' ) === 'after_content' ) bloginwp_social_share_html();

					?>
				</div>
			</div>
		</div><!-- . -->
	</div>
	<?php
		/**
		 * hook - bloginwp_archive_post_footer_hook
		 * 
		 * @since 1.0.0
		 */
			do_action( 'bloginwp_archive_post_footer_hook' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
