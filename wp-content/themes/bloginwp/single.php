<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bloginwp
 */

get_header();
?>
	<div class="blog-with-sidebar">
		<div class="row">
			<div class="secondary-section col-12 col-md-5 col-lg-4 order-md-2">
	            <div class="blog-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>

			<div class="primary-section col-12 col-md-7 col-lg-8 order-md-1">
				<main id="primary" class="site-main <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
				<?php
					while ( have_posts() ) :
						the_post();
						/**
						 * Load template parts
						 * 
						 */
						get_template_part( 'template-parts/single/layouts/layout', 'two' );

						$prev_post = get_previous_post();
						$prev_post_thumb = $prev_post ? get_the_post_thumbnail_url( $prev_post->ID, 'medium' ) : '';
						$prev_post_thumb_class = $prev_post_thumb ? 'has-thumb' : 'no-thumb';
						$next_post = get_next_post();
						$next_post_thumb = $next_post ? get_the_post_thumbnail_url( $next_post->ID, 'medium' ) : '';
						$next_post_thumb_class = $next_post_thumb ? 'has-thumb' : 'no-thumb';
						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle"><i class="fas fa-angle-double-left"></i>' . esc_html__( 'Previous', 'bloginwp' ) . '</span><span class="nav-thumb"><div class="nav_thumb_wrap ' .esc_attr( $prev_post_thumb_class ). '"><img src="' .esc_url( $prev_post_thumb ). '"></div><span class="nav-title">%title</span></span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'bloginwp' ) . '<i class="fas fa-angle-double-right"></i></span><span class="nav-thumb"><span class="nav-title">%title</span><div class="nav_thumb_wrap ' .esc_attr( $next_post_thumb_class ). '"><img src="' .esc_url( $next_post_thumb ). '"></div></span>',
							)
						);
						
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							echo '<div class="post-footer__comment">';
								comments_template();
							echo '</div>';
						endif;

						/**
						 * hook - bloginwp_single_post_footer_hook
						 * 
						 * @since 1.0.0
						 * 
						 */
						do_action( 'bloginwp_single_post_footer_hook' );
					endwhile; // End of the loop.
				?>
				</main><!-- #main -->
			</div>
		</div>
	</div>


<?php
get_footer();
