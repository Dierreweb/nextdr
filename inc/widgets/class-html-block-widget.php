<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
  REGISTER WIDGET THAT DISPLAYSS HTML STATIC BLOCK
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'DIERREWEB_Html_Block_Widget' ) ) {
	class DIERREWEB_Html_Block_Widget extends WPH_Widget {

		function __construct() {
			// Configure widget array
			$args = array(
				'label'       => esc_html__( 'DIERREWEB HTML Block', 'dr' ),
				'description' => esc_html__( 'Display HTML block', 'dr' ),
				'slug'        => 'dierreweb-html-block',
			 );

			// fields array
			$args['fields'] = array(
				array(
					'id'      => 'id',
					'type'    => 'dropdown',
					'heading' => 'Select block',
					'value'   => dierreweb_get_static_blocks_array()
				)
      ); // fields array

			// create widget
			$this->create_widget( $args );
		}

		// Output function
		function widget( $args, $instance )	{
			echo dierreweb_get_html_block( $instance['id'] );
		}
	} // class
}
