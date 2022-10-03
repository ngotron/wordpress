<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Bloginwp
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function bloginwp_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'bloginwp_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function bloginwp_woocommerce_scripts() {
	wp_enqueue_style( 'bloginwp-woocommerce-style', get_template_directory_uri() . '/woocommerce/woocommerce.css', array(), BLOGINWP_VERSION, false );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'bloginwp-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'bloginwp_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function bloginwp_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'bloginwp_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function bloginwp_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'bloginwp_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'bloginwp_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function bloginwp_woocommerce_wrapper_before() {
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
	}
}
add_action( 'woocommerce_before_main_content', 'bloginwp_woocommerce_wrapper_before' );

if ( ! function_exists( 'bloginwp_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function bloginwp_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div> <!-- primary-section -->
	</div><!-- blog-with-sidebar -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'bloginwp_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'bloginwp_woocommerce_header_cart' ) ) {
			bloginwp_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'bloginwp_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function bloginwp_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		bloginwp_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'bloginwp_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'bloginwp_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function bloginwp_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'bloginwp' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'bloginwp' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'bloginwp_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function bloginwp_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php bloginwp_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);
					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

if( !function_exists( 'bloginwp_single_product_content_wrapper_open' ) ) :
	/**
	 * Single product content wapper open
	 * 
	 */
	function bloginwp_single_product_content_wrapper_open() {
		echo '<div class="shop-detail">';
			echo '<div class="row">';
	}
endif;
add_action( 'woocommerce_before_single_product_summary', 'bloginwp_single_product_content_wrapper_open', 5 );

if( !function_exists( 'bloginwp_single_product_content_wrapper_close' ) ) :
	/**
	 * Single product content wapper close
	 * 
	 */
	function bloginwp_single_product_content_wrapper_close() {
			echo '</div><!-- .shop-detail -->';
		echo '</div><!-- .row -->';
	}
endif;
add_action( 'woocommerce_after_single_product_summary', 'bloginwp_single_product_content_wrapper_close', 100 );

if( ! function_exists( 'bloginwp_single_product_image_wrap_open' ) ) :
	/**
	 * Single product image wrap open
	 * 
	 */
	function bloginwp_single_product_image_wrap_open() {
		echo '<div class="col-12 col-md-6">';
	}
endif;
add_action( 'woocommerce_before_single_product_summary', 'bloginwp_single_product_image_wrap_open', 5 );

if( ! function_exists( 'bloginwp_single_product_image_wrap_close' ) ) :
	/**
	 * Single product image wrap close
	 * 
	 */
	function bloginwp_single_product_image_wrap_close() {
		echo '</div>';
	}
endif;
add_action( 'woocommerce_before_single_product_summary', 'bloginwp_single_product_image_wrap_close', 50 );


if( ! function_exists( 'bloginwp_single_product_summary_wrap_open' ) ) :
	/**
	 * Single product summary wrap open
	 * 
	 */
	function bloginwp_single_product_summary_wrap_open() {
		echo '<div class="col-12 col-md-6">';
			echo '<div class="shop-detail__content">';
	}
endif;
add_action( 'woocommerce_before_single_product_summary', 'bloginwp_single_product_summary_wrap_open', 50 );

if( ! function_exists( 'bloginwp_single_product_summary_wrap_close' ) ) :
	/**
	 * Single product summary wrap open
	 * 
	 */
	function bloginwp_single_product_summary_wrap_close() {
			echo '</div><!-- .shop-detail__content -->';
		echo '</div>';
	}
endif;
add_action( 'woocommerce_after_single_product_summary', 'bloginwp_single_product_summary_wrap_close', 5 );


if( ! function_exists( 'bloginwp_single_product_footer_wrap_open' ) ) :
	/**
	 * Single product footer wrap open
	 * 
	 */
	function bloginwp_single_product_footer_wrap_open() {
		echo '<div class="col-12">';
	}
endif;
if( ! function_exists( 'bloginwp_single_product_footer_wrap_close' ) ) :
	/**
	 * Single product footer wrap close
	 * 
	 */
	function bloginwp_single_product_footer_wrap_close() {
		echo '</div>';
	}
endif;
add_action( 'woocommerce_after_single_product_summary', 'bloginwp_single_product_footer_wrap_open', 9 );
add_action( 'woocommerce_after_single_product_summary', 'bloginwp_single_product_footer_wrap_close', 50 );

if( ! function_exists( 'bloginwp_single_product_summary_top_meta_open' ) ) :
	/**
	 * Single product summary top meta open
	 * 
	 */
	function bloginwp_single_product_summary_top_meta_open() {
		echo '<div class="shop-detail__content__top">';
	}
endif;

if( ! function_exists( 'bloginwp_single_product_summary_top_meta_close' ) ) :
	/**
	 * Single product summary top meta close
	 * 
	 */
	function bloginwp_single_product_summary_top_meta_close() {
		echo '</div><!-- .shop-detail__content__top -->';
	}
endif;
add_action( 'woocommerce_single_product_summary', 'bloginwp_single_product_summary_top_meta_open', 4 );
add_action( 'woocommerce_single_product_summary', 'bloginwp_single_product_summary_top_meta_close', 35 );

if( ! function_exists( 'bloginwp_single_product_summary_bottom_meta_open' ) ) :
	/**
	 * Single product summary bottom meta open
	 * 
	 */
	function bloginwp_single_product_summary_bottom_meta_open() {
		echo '<div class="shop-detail__content__bottom">';
	}
endif;

if( ! function_exists( 'bloginwp_single_product_summary_bottom_meta_close' ) ) :
	/**
	 * Single product summary bottom meta close
	 * 
	 */
	function bloginwp_single_product_summary_bottom_meta_close() {
		echo '</div><!-- .shop-detail__content__bottom -->';
	}
endif;
add_action( 'woocommerce_single_product_summary', 'bloginwp_single_product_summary_bottom_meta_open', 36 );
add_action( 'woocommerce_single_product_summary', 'bloginwp_single_product_summary_bottom_meta_close', 70 );

if( ! function_exists( 'bloginwp_product_loop_content_wrap_open' ) ) :
	/**
	 * Product loop content wrap open
	 * 
	 */
	function bloginwp_product_loop_content_wrap_open() {
		echo '<div class="product__content">';
	}
endif;
if( ! function_exists( 'bloginwp_product_loop_content_wrap_close' ) ) :
	/**
	 * Product loop content wrap close
	 * 
	 */
	function bloginwp_product_loop_content_wrap_close() {
		echo '</div>';
	}
endif;
add_action( 'woocommerce_shop_loop_item_title', 'bloginwp_product_loop_content_wrap_open', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'bloginwp_product_loop_content_wrap_close', 15 );

if( ! function_exists( 'bloginwp_product_loop_content_left_wrap_open' ) ) :
	/**
	 * Product loop content left wrap open
	 * 
	 */
	function bloginwp_product_loop_content_left_wrap_open() {
		echo '<div class="product__content__left">';
	}
endif;
if( ! function_exists( 'bloginwp_product_loop_content_left_wrap_close' ) ) :
	/**
	 * Product loop content left wrap close
	 * 
	 */
	function bloginwp_product_loop_content_left_wrap_close() {
		echo '</div>';
	}
endif;
add_action( 'woocommerce_shop_loop_item_title', 'bloginwp_product_loop_content_left_wrap_open', 9 );
add_action( 'woocommerce_after_shop_loop_item_title', 'bloginwp_product_loop_content_left_wrap_close', 6 );

if( ! function_exists( 'bloginwp_product_loop_content_right_wrap_open' ) ) :
	/**
	 * Product loop content right wrap open
	 * 
	 */
	function bloginwp_product_loop_content_right_wrap_open() {
		echo '<div class="product__content__right">';
	}
endif;
if( ! function_exists( 'bloginwp_product_loop_content_right_wrap_close' ) ) :
	/**
	 * Product loop content right wrap close
	 * 
	 */
	function bloginwp_product_loop_content_right_wrap_close() {
		echo '</div>';
	}
endif;
add_action( 'woocommerce_after_shop_loop_item_title', 'bloginwp_product_loop_content_right_wrap_open', 9 );
add_action( 'woocommerce_after_shop_loop_item_title', 'bloginwp_product_loop_content_right_wrap_close', 11 );