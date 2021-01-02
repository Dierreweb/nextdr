<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

$options = array(
  'control/control',
  'sanification/sanification',
  'class-theme-customizer'
);

foreach( $options as $file ) {
  $path = get_parent_theme_file_path( '/inc/customizer/' . $file . '.php' );
  if( file_exists( $path ) ) {
    require_once $path;
  }
}
