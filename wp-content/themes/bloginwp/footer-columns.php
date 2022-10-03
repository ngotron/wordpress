<?php
/**
 * Footer section
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
$footer_widget_column = get_theme_mod( 'footer_widget_column', 'column-two' );


    $bloginwp_footer_class = '';
    switch ( $footer_widget_column ) {
        case 'column-one':
            $bloginwp_footer_class = 'col-lg-12';
            break;
        case 'column-two':
            $bloginwp_footer_class = 'col-md-6';
            break;
        case 'column-three':
            $bloginwp_footer_class = 'col-md-4';
            break;
        case 'column-four':
            $bloginwp_footer_class = 'col-md-3';
            break;
    }

?>
<div class="footer-widget <?php echo esc_attr($bloginwp_footer_class); ?>">
    <?php is_active_sidebar( 'footer-column' ) ? dynamic_sidebar( 'footer-column' ) : ''; ?>
</div>
<?php
    if( $footer_widget_column !== 'column-one' ) {
    ?>
        <div class="footer-widget <?php echo esc_attr($bloginwp_footer_class); ?>">
            <?php
                is_active_sidebar( 'footer-column-2' ) ? dynamic_sidebar( 'footer-column-2' ) : '';
            ?>
        </div>
<?php
    }

    if( $footer_widget_column === 'column-four' || $footer_widget_column === 'column-three' ) {
    ?>
        <div class="footer-widget <?php echo esc_attr($bloginwp_footer_class); ?>">
            <?php
                is_active_sidebar( 'footer-column-3' ) ? dynamic_sidebar( 'footer-column-3' ) : '';
            ?>
        </div>
<?php
    }

    if( $footer_widget_column === 'column-four' ) {
        ?>
            <div class="footer-widget <?php echo esc_attr($bloginwp_footer_class); ?>">
                <?php
                    is_active_sidebar( 'footer-column-4' ) ? dynamic_sidebar( 'footer-column-4' ) : '';
                ?>
            </div>
    <?php
        }