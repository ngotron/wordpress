<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bloginwp
 */

get_header();
?>
	<div class="blog-with-sidebar">
		<div class="row">
			<div class="secondary-section col-12 col-md-5 col-lg-4 order-md-2">
	            <div class="blog-sidebar">
					<?php get_sidebar('page'); ?>
				</div>
			</div>

			<div class="primary-section col-12 col-md-7 col-lg-8 order-md-1">
				<main id="primary" class="site-main">
					<?php if ( have_posts() ) : ?>
						<header class="page-header">
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'bloginwp' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						</header><!-- .page-header -->

					<div class="list-layout-six">
					    <div class="news-block__content__slide container" data-slick-index="1" aria-hidden="true" tabindex="-1">
					        <div class="row">
					            <div class="col-12">

									<?php
									/* Start the Loop */
									while ( have_posts() ) :
										the_post();
										/**
										 * Run the loop for the search to output the results.
										 * If you want to overload this in a child theme then include a file
										 * called content-search.php and that will be used instead.
										 */
										get_template_part( 'template-parts/content', 'search' );

									endwhile;
									else :
										get_template_part( 'template-parts/content', 'none' );
										
									endif;
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
					/**
					* Pagination hook
					* 
					* @since 1.0.0
					*/
					do_action( 'bloginwp_pagination_link_hook' );
					?>
				</main><!-- #main -->
			</div>
		</div>
	</div>
<?php
get_footer();
