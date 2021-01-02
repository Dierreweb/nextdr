<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if(!function_exists( 'dierreweb_slide_metaboxes' ) ) {
	function dierreweb_slide_metaboxes() {

		$slide = new_cmb2_box(array(
			'id'           => 'slide_page_metabox',
			'title'        => esc_html__( 'Slide Setting (custom metabox from theme)', 'dr' ),
			'object_types' => array(
				'dierreweb_slide'
			)
		) );

		// $box_slide->add_section(
		// 	array(
		// 		'id'       => 'general',
		// 		'name'     => esc_html__( 'General', 'woodmart' ),
		// 		'priority' => 10,
		// 		'icon'     => WOODMART_ASSETS . '/assets/images/dashboard-icons/settings.svg',
		// 	)
		// );

		$slide->add_field( array(
			'name' => esc_html__( 'Slide title', 'dr' ),
			'id'   => 'slide_title',
			'type' => 'text'
		) );

		$slide->add_field( array(
			'name' => esc_html__( 'Slide text', 'dr' ),
			'id'   => 'slide_text',
			'type' => 'textarea'
		) );

		$slide->add_field( array(
			'name' => esc_html__( 'Slide button text', 'dr' ),
			'id'   => 'button_text',
			'type' => 'text'
		) );

		$slide->add_field( array(
			'name' => esc_html__( 'Slide button url', 'dr' ),
			'id'   => 'button_url',
			'type' => 'text_url'
		) );

		$slide->add_field( array(
			'id'      => 'vertical_align',
			'name'    => esc_html__( 'Vertical content align', 'dr' ),
			'type'    => 'radio_image',
			'default' => 'center',
			'options' => array(
				'start'  => esc_html__( 'Top', 'dr' ),
				'center' => esc_html__( 'Middle', 'dr' ),
				'end'    => esc_html__( 'Bottom', 'dr' )
			),
			'images'  => array(
				'start'  => DIERREWEB_FRAMEWORK . '/metaboxes/images/top.jpg',
				'center' => DIERREWEB_FRAMEWORK . '/metaboxes/images/middle.jpg',
				'end'    => DIERREWEB_FRAMEWORK . '/metaboxes/images/bottom.jpg'
			)
		) );

		$slide->add_field( array(
			'id'      => 'horizontal_align',
			'name'    => esc_html__( 'Horizontal content align', 'dr' ),
			'type'    => 'radio_image',
			'default' => 'center',
			'options' => array(
				'start'  => esc_html__( 'Left', 'dr' ),
				'center' => esc_html__( 'Center', 'dr' ),
				'end'    => esc_html__( 'Right', 'dr' )
			),
			'images'  => array(
				'start'  => DIERREWEB_FRAMEWORK . '/metaboxes/images/left.jpg',
				'center' => DIERREWEB_FRAMEWORK . '/metaboxes/images/center.jpg',
				'end'    => DIERREWEB_FRAMEWORK . '/metaboxes/images/right.jpg'
			)
		) );
	}

	add_action( 'cmb2_admin_init', 'dierreweb_slide_metaboxes' );
}

// Slider
if( !function_exists( 'dierreweb_slider_metaboxes' ) ) {
	function dierreweb_slider_metaboxes() {

		$slider = new_cmb2_box( array(
			'id'           => 'slider_page_metabox',
			'title'        => esc_html__( 'Slide Setting', 'dr' ),
			'object_types' => array(
				'term'
			),
			'taxonomies'   => array(
				'dierreweb_slider'
			)
		) );

		$slider->add_field( array(
			'name' => esc_html__( 'Background color', 'dr' ),
			'id'   => 'slider_bg_color',
			'type' => 'colorpicker',
			'desc' => 'ciao'
		) );

		$slider->add_field( array(
			'id'   => 'slider_overlay',
			'type' => 'checkbox',
			'name' => esc_html__( 'Background overlay', 'dr' ),
			'desc' => 'ciao'
		) );

		$slider->add_field( array(
			'id'   => 'slider_burns',
			'type' => 'checkbox',
			'name' => esc_html__( 'Background burns', 'dr' ),
			'desc' => 'ciao'
		) );

		$slider->add_field( array(
			'name'        => esc_html__( 'Slider Height', 'dr' ),
      'id'          => 'slider_height',
      'desc'        => esc_html__( 'Set your value in vh.', 'dr' ),
      'type'        => 'slider',
      'min'         => '0',
      'step'        => '5',
      'max'         => '100',
      'default'     => '70',
      'value_label' => esc_html__( 'Value:', 'dr' )
		) );

		$slider->add_field( array(
			'id'      => 'arrows_style',
			'name'    => esc_html__( 'Arrow style', 'dr' ),
			'type'    => 'radio_image',
			'default' => 'style1',
			'options' => array(
				'style1' => esc_html__( 'Style 1', 'dr' ),
				'style2' => esc_html__( 'Style 2', 'dr' ),
				'style3' => esc_html__( 'Style 3', 'dr' ),
				'style4' => esc_html__( 'Disable', 'dr' )
			),
			'images'  => array(
				'style1' => DIERREWEB_FRAMEWORK . '/metaboxes/images/arrow-style-1.jpg',
				'style2' => DIERREWEB_FRAMEWORK . '/metaboxes/images/arrow-style-2.jpg',
				'style3' => DIERREWEB_FRAMEWORK . '/metaboxes/images/arrow-style-3.jpg',
				'style4' => DIERREWEB_FRAMEWORK . '/metaboxes/images/arrow-style-disable.jpg'
			)
		) );

		$slider->add_field( array(
			'id'      => 'pagination_style',
			'name'    => esc_html__( 'Pagination style', 'dr' ),
			'type'    => 'radio_image',
			'default' => true,
			'options' => array(
				'true'  => esc_html__( 'Style 1', 'dr' ),
				'false' => esc_html__( 'Style 2', 'dr' ),
			),
			'images'  => array(
				'true' => DIERREWEB_FRAMEWORK . '/metaboxes/images/pagination-style-1.jpg',
				// 'true' => DIERREWEB_FRAMEWORK . '/metaboxes/images/pagination-style-2.jpg',
				'false' => DIERREWEB_FRAMEWORK . '/metaboxes/images/pagination-style-disable.jpg'
			)
		) );

		$slider->add_field( array(
			'id'      => 'color_scheme',
			'name'    => esc_html__( 'Navigation color scheme', 'dr' ),
			'type'    => 'radio_image',
			'default' => 'light',
			'options' => array(
				'light' => esc_html__( 'Light', 'dr' ),
				'dark'  => esc_html__( 'Dark', 'dr' )
			),
			'images'  => array(
				'light' => DIERREWEB_FRAMEWORK . '/metaboxes/images/pagination-color-dark.jpg',
				'dark'  => DIERREWEB_FRAMEWORK . '/metaboxes/images/pagination-color-light.jpg'
			)
		) );

		$slider->add_field( array(
			'id'   => 'slider_autoplay',
			'type' => 'checkbox',
			'name' => esc_html__( 'Enable autoplay', 'dr' ),
			'desc' => esc_html__( 'Rotate slider images automatically.', 'dr' )
		) );

		$slider->add_field( array(
			'id'   => 'slider_scroll',
			'type' => 'checkbox',
			'name' => esc_html__( 'Init carousel on scroll', 'dr' ),
			'desc' => esc_html__( 'This option allows you to init carousel script only when visitor scroll the page to the slider. Useful for performance optimization.', 'dr' )
		) );

		$slider->add_field( array(
			'name'    => esc_html__( 'Slide change animation', 'dr' ),
			'id'      => 'animation_button',
			'type'    => 'button_set',
			'default' => 'on',
			'options' => array(
				'on'  => esc_html__( 'Slide', 'dr' ),
				'off' => esc_html__( 'Fade', 'dr' ),
			)
		) );
	}

	add_action( 'cmb2_admin_init', 'dierreweb_slider_metaboxes' );
}
