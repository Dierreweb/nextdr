<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

$options = array(
  'control/class-customize-control-checkbox',
  'control/class-customize-control-checkbox-multiple',
  'control/class-customize-control-range',
  'control/class-customize-control-separator',
  'control/class-customize-control-textarea',
  'control/class-customize-control-title'
);

foreach( $options as $file ) {
  $path = get_parent_theme_file_path( '/inc/customizer/' . $file . '.php' );
  if( file_exists( $path ) ) {
    require_once $path;
  }
}

if( !function_exists( 'dierreweb_control_enqueue' ) ) {
	function dierreweb_control_enqueuet() {

		$theme_version = dierreweb_get_theme_info( 'Version' );

		wp_enqueue_style( 'dierreweb-customizer-controls', DIERREWEB_FRAMEWORK . '/customizer/css/customizer.css', $theme_version, false );
    wp_enqueue_script( 'dierreweb-customizer-controls', DIERREWEB_FRAMEWORK . '/customizer/js/customize-controls.js', array( 'jquery' ), $theme_version, true );
	}
	add_action( 'customize_controls_init', 'dierreweb_control_enqueue', 20 );
}
