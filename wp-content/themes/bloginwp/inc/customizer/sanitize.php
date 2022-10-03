<?php
/**
 * Sanitize functions
 * 
 * @package Bloginwp
 * @since 1.0.0
 * 
 */
if( !function_exists( 'bloginwp_sanitize_repeater_control' ) ) :
    /**
     * Sanitize repeater field
     * 
     * @since 1.0.0
     */
    function bloginwp_sanitize_repeater_control( $input ) {
        $input_decoded = json_decode( $input, true );
        if( !empty( $input_decoded ) ) {
            foreach( $input_decoded as $boxk => $box ) {
                foreach ( $box as $key => $value ) {
                    $input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
                }
            }
            return json_encode($input_decoded);
        }
        return $input;
    }
endif;

if( !function_exists( 'bloginwp_sanitize_toggle_control' )  ) :
    /**
     * Sanitize toggle control value
     * 
     */
    function bloginwp_sanitize_toggle_control( $value ) {
        return rest_sanitize_boolean( $value );
    }
 endif;

 if( !function_exists( 'bloginwp_sanitize_html' )  ) :
    /**
     * Sanitize toggle control value
     * 
     */
    function bloginwp_sanitize_html( $value ) {
        return wp_kses_post( $value );
    }
 endif;


 if( !function_exists( 'bloginwp_sanitize_select' )  ) :
    /**
     * Sanitize toggle control value
     * 
     */
    function bloginwp_sanitize_select( $input, $setting ) {
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

if( !function_exists( 'bloginwp_sanitize_number_range' )  ) :
    /**
     * Sanitize range slider control value
     * 
     */
    function bloginwp_sanitize_number_range($number, $setting) {
        // Ensure input is an absolute integer.
        $number = absint($number);

        // Get the input attributes associated with the setting.
        $atts = $setting->manager->get_control($setting->id)->input_attrs;

        // Get minimum number in the range.
        $min = ( isset($atts['min']) ? $atts['min'] : $number );

        // Get maximum number in the range.
        $max = ( isset($atts['max']) ? $atts['max'] : $number );

        // Get step.
        $step = ( isset($atts['step']) ? $atts['step'] : 1 );

        // If the number is within the valid range, return it; otherwise, return the default
        return ( $min <= $number && $number <= $max && is_int($number / $step) ? $number : $setting->default );
    }
endif;

if( !function_exists( 'bloginwp_sanitize_number_field' )  ) :
    /**
     * Sanitize number control value
     * 
     */
    function bloginwp_sanitize_number_field($number, $setting) {
        return abs( $number );
    }
endif;

if( !function_exists( 'bloginwp_sanitize_array' )  ) :
    // Sanitize array control value
    function bloginwp_sanitize_array( $value ) {
        return wp_unslash( $value );
    }
 endif;

 /**
 * Sanitize the hex color set within customizer controls.
 *
 * @param string $color Input from the customize controls.
 *
 * @return string
 */
function bloginwp_sanitize_hex_color( $color ) {
    if ( '' === $color ) {
        return '';
    }
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }
}