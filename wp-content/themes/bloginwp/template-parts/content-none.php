<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bloginwp
 */
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title">
			<?php
				if( is_search() ) :
					printf( esc_html( esc_html__( 'Search Results for:', 'bloginwp' ) . ' %s' ), get_search_query() );
				else :
					esc_html_e( 'Nothing Found', 'bloginwp' );
				endif;
			?>
		</h1>
	</header><!-- .page-header -->
	<div class="page-content">
		<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :
				printf(
					'<p>' . wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bloginwp' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( admin_url( 'post-new.php' ) )
				);
			elseif ( is_search() ) :
				?>
				<p>
					<?php
						echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bloginwp' );
					?>
				</p>
				<?php
					echo '<div class="error-404__content">';
						get_search_form();
					echo '</div>';
			else :
				?>
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bloginwp' ); ?></p>
				<?php
					echo '<div class="search-box-page">';
						get_search_form();
					echo '</div>';
			endif;
		?>
		<br/>
	</div><!-- .page-content -->
</section><!-- .no-results -->
