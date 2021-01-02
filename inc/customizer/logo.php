<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* Logo ------------------ */

//$wp_customize->add_setting( 'dierreweb_logo_width' )->transport = 'postMessage';

$wp_customize->add_setting( 'dierreweb_logo_width', array(
  // 'transport'         => 'postMessage',
  'default'           => 50,
  'sanitize_callback' => ''
) );

$wp_customize->add_control( new WP_Customize_Range( $wp_customize,'dierreweb_logo_width', array(
  'type'        => 'range-value',
  'section'     => 'title_tagline',
  'priority'    => 8,
  'label'       => esc_html__( 'Size logo', 'dr' ),
  'description' => esc_html__( 'Logo width', 'dr' ),

    'min'  => 10,
    'max'  => 500,
    'step' => 1,

) ) );

/* Sticky Logo ------------------ */

$wp_customize->add_setting( 'dierreweb_sticky_logo', array(
  'transport'         => 'refresh',
  'sanitize_callback' => 'dierreweb_validate_image'
) );

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'dierreweb_sticky_logo', array(
  'label'     => esc_html__( 'Sticky Logo', 'dr' ),
  'priority'	=> 8,
  'mime_type'	=> 'image',
  'section' 	=> 'title_tagline'
) ) );

//$wp_customize->add_setting( 'dierreweb_sticky_logo_width' )->transport = 'postMessage';

$wp_customize->add_setting( 'dierreweb_sticky_logo_width', array(
  'default'           => 50,
  'sanitize_callback' => 'dierreweb_sanitize_number_range'
) );

$wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'dierreweb_sticky_logo_width', array(
  'type'        => 'range',
  'section'     => 'title_tagline',
  'priority'	  => 9,
  'label'       => esc_html__( 'Size sticky logo', 'dr' ),
  'description' => esc_html__( 'Sticky logo width', 'dr' ),
  'min'  => 10,
  'max'  => 500,
  'step' => 1
) ) );
