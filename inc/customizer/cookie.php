<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * COOKIES SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_cookies', array(
  'title'    => esc_html__( 'Cookies', 'dr' ),
  'priority' => 80,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_cookies_info', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_cookies_info', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_cookies',
  'settings'    => 'dierreweb_cookies_info',
  'label'       => esc_html__( 'Show cookies info', 'dr' ),
  'description' => esc_html__( 'Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_cookies_section_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_cookies_section_separator_1', array(
  'section'	=> 'dierreweb_cookies'
) ) );

$wp_customize->add_setting( 'dierreweb_cookies_text', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'default'           => esc_html__( 'Utilizziamo i cookie per migliorare la tua esperienza sul nostro sito Web. Navigando su questo sito Web, accetti il ​​nostro utilizzo dei cookie.', 'dr' ),
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_cookies_text', array(
  'label'       => esc_html__( 'Cookie text', 'dr' ),
  'description' => esc_html__( 'Place here some information about cookies usage that will be shown in the popup.', 'dr' ),
  'section'     => 'dierreweb_cookies',
  'settings'    => 'dierreweb_cookies_text',
  'type'        => 'textarea'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_cookies_section_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_cookies_section_separator_2', array(
  'section'	=> 'dierreweb_cookies'
) ) );

$wp_customize->add_setting( 'dierreweb_cookies_policy_page', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_cookies_policy_page', array(
  'label'       => esc_html__( 'Page with details', 'dr' ),
  'description' => esc_html__( 'Choose page that will contain detailed information about your Privacy Policy', 'dr' ),
  'section'     => 'dierreweb_cookies',
  'settings'    => 'dierreweb_cookies_policy_page',
  'type'        => 'dropdown-pages'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_cookies_section_separator_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_cookies_section_separator_3', array(
  'section'	=> 'dierreweb_cookies'
) ) );

$wp_customize->add_setting( 'dierreweb_cookies_version', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'default'           => 1,
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_cookies_version', array(
  'label'       => esc_html__( 'Cookies version', 'dr' ),
  'description' => esc_html__( 'If you change your cookie policy information you can increase their version to show the popup to all visitors again.', 'dr' ),
  'section'     => 'dierreweb_cookies',
  'settings'    => 'dierreweb_cookies_version',
  'type'        => 'text'
) );
