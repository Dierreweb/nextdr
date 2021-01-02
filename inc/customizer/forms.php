<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * FORMS SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_forms_section', array(
  'title'    => esc_html__( 'Forms Style', 'dr' ),
  'priority' => 60,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_forms_style', array(
  'default'           => 'rounded',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_forms_style', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_forms_section',
  'label'   		=> esc_html__( 'Form fields style', 'dr' ),
  'description'	=> esc_html__( 'Choose your form style.', 'dr' ),
  'choices' 		=> array(
    'semi-rounded' => esc_html__( 'Circle', 'dr' ),
    'rounded'	     => esc_html__( 'Round', 'dr' ),
    'square'       => esc_html__( 'Square', 'dr' ),
    'underlined'   => esc_html__( 'Underlined', 'dr' )
  )
) );

$wp_customize->add_setting( 'dierreweb_forms_width', array(
  'default'           => '1',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_forms_width', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_forms_section',
  'label'   		=> esc_html__( 'Form border width', 'dr' ),
  'description'	=> esc_html__( 'Choose your form border width.', 'dr' ),
  'choices' 		=> array(
    '1' => esc_html__( '1', 'dr' ),
    '2'	=> esc_html__( '2', 'dr' )
  )
) );
