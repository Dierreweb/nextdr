<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
  * GENERAL SECTION
  * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_general', array(
  'title'    => esc_html__( 'General', 'dr' ),
  'priority' => 10,
  'panel'		 => 'dierreweb_theme_options'
) );

/* Title --------------------- */
$wp_customize->add_setting( 'dierreweb_general_title', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Title( $wp_customize, 'dierreweb_general_title', array(
  'label'	  => esc_html__( 'General', 'dr' ),
  'section'	=> 'dierreweb_general'
) ) );

/* comments page --------------------- */
$wp_customize->add_setting( 'comments_on_page', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'comments_on_page', array(
  'label'    => esc_html__( 'Show comments on page', 'dr' ),
  'section'  => 'dierreweb_general',
  'settings' => 'comments_on_page',
  'type'     => 'checkbox'
) ) );

/* Separator --------------------- */
$wp_customize->add_setting( 'dierreweb_general_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_general_separator_1', array(
  'section'	=> 'dierreweb_general'
) ) );

/* Custom 404 page --------------------- */
$wp_customize->add_setting( 'custom_404_page', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'custom_404_page', array(
  'label'       => esc_html__( 'Custom 404 page', 'dr' ),
  'description' => esc_html__( 'You can make your custom 404 page.', 'dr' ),
  'section'     => 'dierreweb_general',
  'settings'    => 'custom_404_page',
  'type'        => 'dropdown-pages'
) );

/* Separator --------------------- */
$wp_customize->add_setting( 'dierreweb_general_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_general_separator_2', array(
  'section'	=> 'dierreweb_general'
) ) );

/* Sticky notifications --------------------- */
$wp_customize->add_setting( 'sticky_notifications', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'sticky_notifications', array(
  'label'    => esc_html__( 'Sticky notifications', 'dr' ),
  'section'  => 'dierreweb_general',
  'settings' => 'sticky_notifications',
  'type'     => 'checkbox'
) ) );
