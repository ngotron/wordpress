<?php
/**
 * Right Buttons Panel.
 *
 * @package coachpress_lite
 */
?>
<div class="panel-right">
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Upgrade To Pro', 'coachpress-lite' ); ?></h4>
		<p><?php esc_html_e( 'With the Pro version, you can change the look and feel of your website in seconds. You can change color, choose from background patterns, and change the fonts with ease. You will also get more homepage sections that you can reorder and hide as per your needs. Furthermore, the pro version comes with multiple predefined pages like contact page, gallery page, team page, service page, and pricing page.', 'coachpress-lite' ); ?></p>
		<p><?php esc_html_e( 'You will also get more frequent updates and quicker support with the Pro version.', 'coachpress-lite' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( 'https://blossomthemes.com/wordpress-themes/coachpress/' ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'coachpress-lite' ); ?>" target="_blank">
            <?php esc_html_e( 'Read More About the Pro Theme', 'coachpress-lite' ); ?>
        </a>
	</div><!-- .panel-aside Theme Support -->
	<!-- Knowledge base -->
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Visit the Knowledge Base', 'coachpress-lite' ); ?></h4>
		<p><?php esc_html_e( 'Need help with using the WordPress as quickly as possible? Visit our well-organized Knowledge Base!', 'coachpress-lite' ); ?></p>
		<p><?php esc_html_e( 'Our Knowledge Base has step-by-step video and text tutorials, from installing the WordPress to working with themes and more.', 'coachpress-lite' ); ?></p>

		<a class="button button-primary" href="<?php echo esc_url( 'https://docs.blossomthemes.com/' . COACHPRESS_LITE_THEME_TEXTDOMAIN . '/' ); ?>" title="<?php esc_attr_e( 'Visit the knowledge base', 'coachpress-lite' ); ?>" target="_blank"><?php esc_html_e( 'Visit the Knowledge Base', 'coachpress-lite' ); ?></a>
	</div><!-- .panel-aside knowledge base -->
</div><!-- .panel-right -->