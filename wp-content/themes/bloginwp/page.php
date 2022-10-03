<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bloginwp
 */

get_header();
if( is_front_page() ) :
	/**
     * hook - bloginwp_frontpage_section_hook
     * 
     * @hooked - bloginwp_main_banner_html - 10
	 * @hooked - bloginwp_featured_links_html - 20
     * 
     */
    do_action( 'bloginwp_frontpage_section_hook' );
endif;
?>
	<div class="blog-with-sidebar">
		<div class="row">
			<div class="secondary-section col-12 col-md-5 col-lg-4 order-md-2">
	            <div class="blog-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>

			<div class="primary-section col-12 col-md-7 col-lg-8 order-md-1">
				<main id="primary" class="site-main">
					<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile; // End of the loop.
					?>
				</main><!-- #main -->
			</div>
		</div>
	</div>
<?php
get_footer();