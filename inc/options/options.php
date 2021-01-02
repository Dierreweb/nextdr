<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   LOAD ALL CLASSES
------------------------------------------------------------------------------------------------ */

$options = array(
  'class-button-set',
  'class-button-switch',
	'class-radio-image',
	'class-slider'
);

foreach( $options as $file ) {
  $path = get_parent_theme_file_path( '/inc/options/' . $file . '.php' );
  if( file_exists( $path ) ) {
    require_once $path;
  }
}

if( !function_exists( 'dierreweb_cmb2_script' ) ) {
	function dierreweb_cmb2_script() {

		$theme_version = dierreweb_get_theme_info( 'Version' );

		wp_enqueue_style( 'dierreweb_cmb2-css', esc_url( DIERREWEB_THEME_DIR ) . '/inc/options/css/class-metaboxes.css', $theme_version, false );
		wp_enqueue_script( 'dierreweb_cmb2-js', esc_url( DIERREWEB_THEME_DIR ) . '/inc/options/js/class-metaboxes.js', $theme_version, false );
	}
	add_action( 'admin_enqueue_scripts', 'dierreweb_cmb2_script', 20 );
}
