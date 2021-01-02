<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * COLORS SECTION
 * ------------------------------------------------------------------------ */

$dierreweb_accent_color_options = self::dierreweb_get_color_options();

// Loop over the color options and add them to the customizer
foreach( $dierreweb_accent_color_options as $color_option_name => $color_option ) {
 $wp_customize->add_setting( $color_option_name, array(
  'default' 			    => $color_option['default'],
  'type' 				      => 'theme_mod',
  'sanitize_callback' => 'sanitize_hex_color'
 ) );

 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color_option_name, array(
  'label' 	 => $color_option['label'],
  'section'  => 'colors',
  'settings' => $color_option_name,
  'priority' => 10
 ) ) );
}
