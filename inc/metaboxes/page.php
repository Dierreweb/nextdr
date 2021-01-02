<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( !function_exists( 'dierreweb_page_metaboxes' ) ) {
	function dierreweb_page_metaboxes() {

		$box_page = new_cmb2_box( array(
			'id'           => 'page_metabox',
			'title'        => esc_html__( 'Page Settings', 'dr' ),
			'object_types' => array(
				'page',
				'post',
				'adoption'
			)
		) );

		$box_page->add_field( array(
			'name' => esc_html__( 'Disable Page title', 'dr' ),
			'desc' => esc_html__( 'You can hide page heading for this page', 'dr' ),
			'id'   => 'title',
			'type' => 'checkbox'
		) );

		$box_page->add_field( array(
			'name' => esc_html__( 'Image for page title', 'dr' ),
			'desc' => esc_html__( 'Upload an image', 'dr' ),
			'id'   => 'dierreweb_image',
			'type' => 'file'
		) );

		$box_page->add_field( array(
			'name' => esc_html__( 'Page title background color', 'dr' ),
			'desc' => esc_html__( 'Сhoose a color', 'dr' ),
			'id'   => 'dierreweb_title_bg_color',
			'type' => 'colorpicker'
		) );

		$box_page->add_field( array(
			'name' 		=> esc_html__( 'Disable footer', 'dr'),
			'desc' 		=> esc_html__( 'You can disable footer for this page', 'dr' ),
			'id'  		=> 'footer',
			'type' 		=> 'checkbox',
			'default' => false
		) );

		$box_page->add_field( array(
			'name' 		=> esc_html__( 'Disable prefooter', 'dr' ),
			'desc' 		=> esc_html__( 'You can disable prefooter for this page', 'dr' ),
			'id'  		=> 'prefooter',
			'type' 		=> 'checkbox',
			'default' => false
		) );

		$box_page->add_field(array(
			'name' 		=> esc_html__( 'Disable widgets footer', 'dr' ),
			'desc' 		=> esc_html__( 'You can disable widgets footer for this page', 'dr' ),
			'id'  		=> 'sidebar_footer',
			'type' 		=> 'checkbox',
			'default' => false
		) );

		$box_page->add_field( array(
			'name' 		=> esc_html__( 'Disable copyrights', 'dr' ),
			'desc' 		=> esc_html__( 'You can disable copyrights for this page', 'dr' ),
			'id'  		=> 'copyrights',
			'type' 		=> 'checkbox',
			'default' => false
		) );
	}
	add_action( 'cmb2_admin_init', 'dierreweb_page_metaboxes' );
}

if( !function_exists( 'dierreweb_post_metaboxes' ) ) {
	function dierreweb_post_metaboxes() {

		$box_post = new_cmb2_box( array(
			'id'           => 'post_metabox',
			'title'        => esc_html__( 'Post Settings', 'dr' ),
			'object_types' => array(
				'post'
			),
      'context'      => 'side',
      'priority'     => 'high',
      'show_names'   => true,
		) );

		$box_post->add_field( array(
      'name' => esc_html__( 'Subtitle for the post', 'dr' ),
    	'desc' => esc_html__( 'Write your subtitle for the post', 'dr' ),
    	'id'   => 'subtitle',
    	'type' => 'textarea'
		) );

	}
	add_action( 'cmb2_admin_init', 'dierreweb_post_metaboxes' );
}

if( !function_exists( 'dierreweb_adoption_metaboxes' ) ) {
	function dierreweb_adoption_metaboxes() {

		$adopt_post = new_cmb2_box( array(
			'id'           => 'adoption_metabox',
			'title'        => esc_html__( 'Adoption Settings', 'dr' ),
			'object_types' => array(
				'adoption'
			),
      'priority'     => 'high',
      'show_names'   => true,
		) );

		$adopt_post->add_field( array(
      'name' => esc_html__( 'Description', 'dr' ),
    	'desc' => esc_html__( 'Write description for the pet', 'dr' ),
    	'id'   => 'pet_desc',
    	'type' => 'textarea'
		) );

		$adopt_post->add_field( array(
      'name' => esc_html__( 'Sex', 'dr' ),
    	'desc' => esc_html__( 'Write the sex for the pet', 'dr' ),
    	'id'   => 'pet_sex',
    	'type' => 'text'
		) );

		$adopt_post->add_field( array(
      'name' => esc_html__( 'Age', 'dr' ),
    	'desc' => esc_html__( 'Write the age for the pet', 'dr' ),
    	'id'   => 'pet_age',
    	'type' => 'text'
		) );

		$adopt_post->add_field( array(
      'name' => esc_html__( 'Vaccinated', 'dr' ),
    	'desc' => esc_html__( 'Write if the pet is vaccinated', 'dr' ),
    	'id'   => 'pet_vac',
    	'type' => 'text'
		) );

		$group_field_id = $adopt_post->add_field( array(
    	'id'      => 'features_metabox',
    	'type'    => 'group',
    	'options' => array(
    		'group_title'    => esc_html__( 'Other description', 'dr' ),
    		'add_button'     => esc_html__( 'Add Another Description', 'dr' ),
    		'sortable'       => true,
    		'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'dr' )
    	)
    ) );

    $adopt_post->add_group_field( $group_field_id, array(
    	'name'        => esc_html__( 'Description', 'dr' ),
    	'description' => esc_html__( 'Write a short features for this pet', 'dr' ),
    	'id'          => 'pet_other_desc',
    	'type'        => 'textarea_small'
    ) );

	}
	add_action( 'cmb2_admin_init', 'dierreweb_adoption_metaboxes' );
}
