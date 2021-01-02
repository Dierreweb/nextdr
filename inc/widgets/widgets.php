<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   LOAD ALL CLASSES
------------------------------------------------------------------------------------------------ */

$options = array(
  'widget-wph-class',
  'class-adoption-categories-widget',
  'class-html-block-widget',
  'class-popular-posts-widget',
  'class-recent-adoptions-widget',
  'class-recent-comments-widget',
  'class-recent-posts-widget'
);

foreach( $options as $file ) {
  $path = get_parent_theme_file_path( '/inc/widgets/' . $file . '.php' );
  if( file_exists( $path ) ) {
    require_once $path;
  }
}
