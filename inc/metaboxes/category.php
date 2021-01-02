<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( !function_exists( 'dierreweb_category_metaboxes' ) ) {
	function dierreweb_category_metaboxes() {

		$category_page = new_cmb2_box( array(
			'id'           => 'category_metabox',
			'object_types' => 'term',
			'taxonomies'   => array(
				'category'
			)
		) );

		$category_page->add_field( array(
			'name' => esc_html__( 'Image for page category', 'dr' ),
			'desc' => esc_html__( 'Upload an image', 'dr' ),
			'id'   => '_image',
			'type' => 'file'
		) );

	}
	add_action('cmb2_admin_init', 'dierreweb_category_metaboxes');
}
