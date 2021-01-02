<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * ADDITIONAL JS SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'custom_js', array(
  'title'       => esc_html__( 'Additional JS', 'dr' ),
  'priority'    => 200
) );

// Global JS
$wp_customize->add_setting( 'global_js', array(
  'type'              => 'option',
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'global_js', array(
  'settings'  => 'global_js',
  'section'   => 'custom_js',
  'label'     => esc_html__( 'Global Custom JS', 'dr' ),
  'code_type' => 'javascript'
) ) );

// JS on document ready
$wp_customize->add_setting( 'ready_js', array(
  'type'              => 'option',
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'ready_js', array(
  'settings'    => 'ready_js',
  'section'     => 'custom_js',
  'label'       => esc_html__('On document ready',  'dr'),
  'description' => esc_html__( 'Will be executed on $(document).ready().', 'dr' ),
  'code_type'   => 'javascript'
) ) );
