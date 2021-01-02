<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   HTML BLOCK SHORTCODE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_html_block_shortcode' ) ) {
	function dierreweb_html_block_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'id' => 0
		), $atts ) );

		return dierreweb_get_html_block( $id );
	}
}
