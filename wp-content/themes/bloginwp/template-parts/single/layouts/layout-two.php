<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bloginwp
 */
$singlePost_categories = get_the_category( get_the_ID() );
$singlePost_tags = get_the_tags( get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-card -center post-title single_layout_two">
		<div class="card__content">
			<div class="bmm-post-cats-wrap">
				<?php
				$single_post_categories_option = get_theme_mod( 'single_post_categories_option', true );
				if( $single_post_categories_option ) :
					foreach( $singlePost_categories as $singlePost_category ) :
						?>
							<h5 class="card__content-category"><a href="<?php echo esc_url( get_term_link( $singlePost_category->term_id ) ); ?>"><?php echo esc_html( $singlePost_category->name ); ?></a></h5>
					<?php
						endforeach;
				endif;
				?>
			</div>
			<?php the_title( '<h1 class="card__content-title">', '</h1>' ); ?>
		</div><!-- .card__content -->
	</div>
	<div class="post-card -center <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
		<?php bloginwp_posted_on(); ?>
		<?php bloginwp_post_thumbnail(); ?>
	</div>
	<div class="post-standard__content">
		<?php
			// social share html
			if( get_theme_mod( 'single_social_share_position', 'after_content' ) === 'before_content' ) bloginwp_social_share_html();

			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bloginwp' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			// social share html
			if( get_theme_mod( 'single_social_share_position', 'after_content' ) === 'after_content' ) bloginwp_social_share_html();
		?>
			<div class="post-footer">
		<?php
				$single_post_tags_option = get_theme_mod( 'single_post_tags_option', true );
				if( $single_post_tags_option ) :
			?>
					<div class="post-footer__tags center">
						<div class="tags-group">
							<?php
								if( $singlePost_tags ) :
									foreach( $singlePost_tags as $singlePost_tag ) : ?>
										<a href="<?php echo esc_url( get_term_link( $singlePost_tag->term_id ) ); ?>" class="tag-btn"><?php echo esc_html( $singlePost_tag->name ); ?></a>
							<?php
									endforeach;
								endif;
							?>
						</div>
					</div>
			<?php
				endif;

				/**
				 * hook - bloginwp_single_after_content
				 * 
				 */
				if( is_single() ) :
					do_action( 'bloginwp_single_after_content' );
				endif;
		?>
			</div>
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloginwp' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->