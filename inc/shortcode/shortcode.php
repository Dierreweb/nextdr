<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   LOAD ALL CLASSES
------------------------------------------------------------------------------------------------ */

$options = array(
  'html-block',
  //'related-posts',
  'social'
);

foreach( $options as $file ) {
  $path = get_parent_theme_file_path( '/inc/shortcode/' . $file . '.php' );
  if( file_exists( $path ) ) {
    require_once $path;
  }
}
