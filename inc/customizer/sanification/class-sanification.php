<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   	FUNCTIONS CUSTOMIZER CONTROL: SANIFICATION CONTROL
------------------------------------------------------------------------------------------------ */

// Sanitize boolean for checkbox
if( !function_exists( 'dierreweb_sanitize_checkbox' ) ) {
  function dierreweb_sanitize_checkbox( $checked ) {
    return ( (isset( $checked ) && true == $checked ) ? true : false );
  }
}

// Sanitize booleans for multiple checkboxes
if( !function_exists( 'dierreweb_sanitize_multiple_checkboxes' ) ) {
  function dierreweb_sanitize_multiple_checkboxes( $values ) {
    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
  }
}

// Sanitize radio
if( !function_exists( 'dierreweb_sanitize_radio' ) ) {
  function dierreweb_sanitize_radio( $input, $setting ) {
    $input = sanitize_key( $input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
  }
}

// Sanitize select
if( !function_exists( 'dierreweb_sanitize_select' ) ) {
  function dierreweb_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
  }
}

// Sanitize image
if( !function_exists( 'dierreweb_sanitize_image' ) ) {
  function dierreweb_sanitize_image( $input, $setting ) {
    return esc_url_raw( dierreweb_validate_image( $input, $setting->default ) );
  }
}

function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }
  function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}


// Validation image
if( !function_exists( 'dierreweb_validate_image' ) ) {
  function dierreweb_validate_image( $input, $default = '' ) {
    $mimes = array(
      'jpg|jpeg|jpe' => 'image/jpeg',
      'gif'          => 'image/gif',
      'png'          => 'image/png',
      'bmp'          => 'image/bmp',
      'tif|tiff'     => 'image/tiff',
      'ico'          => 'image/x-icon'
    );

    $file = wp_check_filetype( $input, $mimes );
    return ( $file['ext'] ? $input : $default );
  }
}

// Sanitize range
// function dierreweb_sanitize_number_range( $input) {
// 	// Ensure input is an absolute integer
// 	$input = absint( $input);
// 	// Get the input attributes
// 	// associated with the setting
// 	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
// 	// Get min
// 	$min = (isset( $atts['min']) ? $atts['min'] : $input);
// 	// Get max
// 	$max = (isset( $atts['max']) ? $atts['max'] : $input);
// 	// Get Step
// 	$step = (isset( $atts['step']) ? $atts['step'] : 1);
// 	// If the input is within the valid range,
// 	// return it; otherwise, return the default
// 	return ( $min <= $input && $input <= $max && is_int( $input / $step) ? $input : $setting->default);
// }}
