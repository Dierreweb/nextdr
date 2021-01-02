<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * PERFORMANCE SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_perfomance_section', array(
  'title'    => esc_html__( 'Perfomance', 'dr' ),
  'priority' => 110,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_preloader', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_preloader', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_perfomance_section',
  'settings'    => 'dierreweb_preloader',
  'label'       => esc_html__( 'Preloader', 'dr' ),
  'description' => esc_html__( 'Enable preloader animation while loading your website content. Useful when you move all the CSS to the footer.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_perfomance_section_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_perfomance_section_separator_1', array(
  'section'	=> 'dierreweb_perfomance_section'
) ) );

$wp_customize->add_setting( 'dierreweb_ciao_image', array(
  'transport'         => 'postMessage',
  'sanitize_callback' => 'dierreweb_validate_image'
) );

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'dierreweb_ciao_image', array(
  'label'       => esc_html__( 'Animated image', 'dr' ),
  'description' => esc_html__( 'You can set your preloader background image.', 'dr' ),
  'mime_type'	  => 'image',
  'section' 	  => 'dierreweb_perfomance_section',
  'settings' 		=> 'dierreweb_ciao_image'
) ) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_perfomance_section_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_perfomance_section_separator_2', array(
  'section'	=> 'dierreweb_perfomance_section'
) ) );

$wp_customize->add_setting( 'dierreweb_ciao', array(
  'transport'         => 'postMessage',
  'default' 			    => 'transparent',
  'type' 				      => 'theme_mod',
  'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dierreweb_ciao', array(
  'label' 		  => esc_html__( 'Background for loader screen', 'dr' ),
  'description'	=> esc_html__( 'You can set your preloader background color.', 'dr' ),
  'section' 		=> 'dierreweb_perfomance_section',
  'settings' 		=> 'dierreweb_ciao'
) ) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_perfomance_section_separator_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_perfomance_section_separator_3', array(
  'section'	=> 'dierreweb_perfomance_section'
) ) );
