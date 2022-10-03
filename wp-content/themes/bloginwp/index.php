<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bloginwp
 */

get_header();

	/**
     * hook - bloginwp_frontpage_section_hook
     * 
     * @hooked - bloginwp_main_banner_html - 10
	 * @hooked - bloginwp_featured_links_html - 20
     * 
     */
	if( ! is_paged() ) do_action( 'bloginwp_frontpage_section_hook' );
	
	if ( is_home() && ! is_front_page() ) :
?>
		<div class="category__header">
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
		</div>
		<?php
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
				<main id="primary" class="site-main archive-block <?php echo esc_attr( get_theme_mod('archive_posts_layout','grid-layout-twocol') ); ?>">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'archive' );
						endwhile;
					else :
						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</main><!-- #main -->
				<?php
					/**
					* Pagination hook
					* 
					* @since 1.0.0
					*/
					do_action( 'bloginwp_pagination_link_hook' );
				?>
			</div>
		</div>
	</div>
<?php
get_footer();