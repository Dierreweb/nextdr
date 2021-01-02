<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * HEADER SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_header', array(
  'title'    => esc_html__( 'Header', 'dr' ),
  'priority' => 30,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_header_topbar', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_header_topbar', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_header',
  'settings'    => 'dierreweb_header_topbar',
  'label'       => esc_html__( 'Topbar', 'dr' ),
  'description' => esc_html__( 'Click to disable topbar section with your copyrights under the footer.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_header_section_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_header_section_separator_1', array(
  'section'	=> 'dierreweb_header'
) ) );

$wp_customize->add_setting( 'dierreweb_topbar_text_color', array(
  'default'           => 'light',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_topbar_text_color', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_header',
  'label'   		=> esc_html__( 'Topbar text color', 'dr' ),
  'description'	=> esc_html__( 'Choose your topbar color scheme.', 'dr' ),
  'choices' 		=> array(
    'light'	=> esc_html__( 'Light', 'dr' ),
    'dark'	=> esc_html__( 'Dark', 'dr' )
  )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_header_section_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_header_section_separator_2', array(
  'section'	=> 'dierreweb_header'
) ) );

$wp_customize->add_setting( 'dierreweb_header_topbar_columns', array(
  'default'           => 'centered',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_header_topbar_columns', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_header',
  'label'   		=> esc_html__( 'Topbar layout', 'dr' ),
  'description'	=> esc_html__( 'Set different topbar section layout.', 'dr' ),
  'choices' 		=> array(
    'centered'	  => esc_html__( 'Centered', 'dr' ),
    'two-columns'	=> esc_html__( 'Two columns', 'dr' )
  )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_header_section_separator_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_header_section_separator_3', array(
  'section'	=> 'dierreweb_header'
) ) );

$wp_customize->add_setting( 'dierreweb_header_topbar_text', array(
  'transport'         => 'postMessage',
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( 'dierreweb_header_topbar_text', array(
  'label'       => esc_html__( 'Copyrights text', 'dr' ),
  'description' => esc_html__( 'Place here text you want to see in the copyrights area. You can use shortocodes. Ex.: [social_buttons]', 'dr' ),
  'section'     => 'dierreweb_header',
  'settings'    => 'dierreweb_header_topbar_text',
  'type'        => 'textarea'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_header_section_separator_4', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_header_section_separator_4', array(
  'section'	=> 'dierreweb_header'
) ) );

$wp_customize->add_setting( 'dierreweb_header_topbar_text2', array(
  'transport'         => 'postMessage',
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( 'dierreweb_header_topbar_text2', array(
  'label'       => esc_html__( 'Text next to copyrights', 'dr' ),
  'description' => esc_html__( 'You can use shortocodes. Ex.: [social_buttons]', 'dr' ),
  'section'     => 'dierreweb_header',
  'settings'    => 'dierreweb_header_topbar_text2',
  'type'        => 'textarea'
) );
