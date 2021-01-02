<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * POPUP SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_promo_popup', array(
  'title'    => esc_html__( 'Promo Popup', 'dr' ),
  'priority' => 70,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_popup_display', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_popup_display', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_display',
  'label'       => esc_html__( 'Enable promo popup', 'dr' ),
  'description' => esc_html__( 'Show promo popup to users when they enter the site.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_promo_popup_section_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_promo_popup_section_separator_1', array(
  'section'	=> 'dierreweb_promo_popup'
) ) );

$wp_customize->add_setting( 'dierreweb_popup_text', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_popup_text', array(
  'label'       => esc_html__( 'Popup content', 'dr' ),
  'description' => esc_html__( 'Place here content you want to see in the popup.', 'dr' ),
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_text',
  'type'        => 'textarea'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_promo_popup_section_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_promo_popup_section_separator_2', array(
  'section'	=> 'dierreweb_promo_popup'
) ) );

$wp_customize->add_setting( 'dierreweb_popup_delay', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'default'           => 2000,
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_popup_delay', array(
  'label'       => esc_html__( 'Popup delay', 'dr' ),
  'description' => esc_html__( 'Show popup after some time (in milliseconds)', 'dr' ),
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_delay',
  'type'        => 'text'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_promo_popup_section_separator_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_promo_popup_section_separator_3', array(
  'section'	=> 'dierreweb_promo_popup'
) ) );

$wp_customize->add_setting( 'dierreweb_popup_version', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'default'           => 1,
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_popup_version', array(
  'label'       => esc_html__( 'Popup version', 'dr' ),
  'description' => esc_html__( 'If you change your promo popup you can increase its version to show the popup to all visitors again.', 'dr' ),
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_version',
  'type'        => 'text'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_promo_popup_section_separator_4', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_promo_popup_section_separator_4', array(
  'section'	=> 'dierreweb_promo_popup'
) ) );

$wp_customize->add_setting( 'dierreweb_popup_pages', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'default'           => 0,
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_popup_pages', array(
  'label'       => esc_html__( 'Show after number of pages visited', 'dr' ),
  'description' => esc_html__( 'You can choose how much pages user should change before popup will be shown.', 'dr' ),
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_pages',
  'type'        => 'text'
) );

$wp_customize->add_setting( 'dierreweb_promo_popup_section_separator_5', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_promo_popup_section_separator_5', array(
  'section'	=> 'dierreweb_promo_popup'
) ) );

$wp_customize->add_setting( 'dierreweb_popup_width', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses',
  'default'           => 800,
  'transport'         => 'refresh'
) );

$wp_customize->add_control( 'dierreweb_popup_width', array(
  'label'       => esc_html__( 'Popup width', 'dr' ),
  'description' => esc_html__( 'Set width of the promo popup in pixels.', 'dr' ),
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_width',
  'type'        => 'text'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_promo_popup_section_separator_6', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_promo_popup_section_separator_6', array(
  'section'	=> 'dierreweb_promo_popup'
) ) );

$wp_customize->add_setting( 'dierreweb_popup_hide_mobile', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_promo_popup_hide_mobile', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_promo_popup',
  'settings'    => 'dierreweb_popup_hide_mobile',
  'label'       => esc_html__( 'Hide for mobile devices', 'dr' ),
  'description' => esc_html__( 'You can disable this option for mobile devices completely.', 'dr' )
) );
