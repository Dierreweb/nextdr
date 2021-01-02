<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * PAGE TITLE SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_page_title', array(
  'title' 	 => esc_html__( 'Page Title', 'dierreweb' ),
  'priority' => 40,
  'panel'		 => 'dierreweb_theme_options'
) );

/* Title --------------------- */
$wp_customize->add_setting( 'dierreweb_page_title_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Title( $wp_customize, 'dierreweb_page_title_1', array(
  'label'	  => esc_html__( 'Page Title', 'dierreweb' ),
  'section'	=> 'dierreweb_page_title'
) ) );

/* Page Title Disable --------------------- */
$wp_customize->add_setting( 'page_title_disable', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'page_title_disable', array(
  'label'    => esc_html__( 'Page title', 'dierreweb' ),
  'section'  => 'dierreweb_page_title',
  'settings' => 'page_title_disable',
  'type'     => 'checkbox'
) ) );

/* Page Title Size --------------------- */
$wp_customize->add_setting( 'page_title_size', array(
  'default'           => 'center',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'page_title_size', array(
  'label'   		=> esc_html__( 'Page title design', 'dierreweb' ),
  'description'	=> esc_html__( 'Select page title section design or disable it completely on all pages.', 'dierreweb' ),
  'section' 		=> 'dierreweb_page_title',
  'settings'    => 'page_title_size',
  'choices' 		=> array(
    'center' => esc_html__( 'Centered', 'dierreweb' ),
    'left'	 => esc_html__( 'Left', 'dierreweb' )
  ),
  'type'			  => 'select'
) );

/* Page Title Fixed Background Image --------------------- */
$wp_customize->add_setting( 'fixed_background_image', array(
  'default'			      => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'fixed_background_image', array(
  'label' 	 => esc_html__( 'Fixed background image', 'dierreweb' ),
  'section'  => 'dierreweb_page_title',
  'settings' => 'fixed_background_image',
  'type'     => 'checkbox'
) ) );

/* Separator --------------------- */
$wp_customize->add_setting( 'dierreweb_page_title_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_page_title_separator_1', array(
  'section'	=> 'dierreweb_page_title'
) ) );

/* Page Title Design --------------------- */
$wp_customize->add_setting( 'page_title_align', array(
  'default'           => 'center',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'page_title_align', array(
  'label'   		=> esc_html__( 'Page title design', 'dierreweb' ),
  'description'	=> esc_html__( 'Select page title section design or disable it completely on all pages.', 'dierreweb' ),
  'section' 		=> 'dierreweb_page_title',
  'settings'    => 'page_title_align',
  'choices' 		=> array(
    'center' => esc_html__( 'Centered', 'dierreweb' ),
    'left'	 => esc_html__( 'Left', 'dierreweb' )
  ),
  'type'			  => 'select'
) );

/* Title --------------------- */
$wp_customize->add_setting( 'dierreweb_page_title_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Title( $wp_customize, 'dierreweb_page_title_2', array(
  'label'	  => esc_html__( 'Page title color ad background', 'dierreweb' ),
  'section'	=> 'dierreweb_page_title'
) ) );

/* Page Title Color --------------------- */
$wp_customize->add_setting( 'page_title_color', array(
  'default'           => 'light',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'page_title_color', array(
  'label'   		=> esc_html__( 'Text color for page title', 'dierreweb' ),
  'description'	=> esc_html__( 'You can set different colors depending on it\'s background. May be light or dark.', 'dierreweb' ),
  'section' 		=> 'dierreweb_page_title',
  'settings'    => 'page_title_color',
  'choices' 		=> array(
    'light' => esc_html__( 'Light', 'dierreweb' ),
    'dark'	=> esc_html__( 'Dark', 'dierreweb' )
  ),
  'type'			  => 'select'
) );

/* Separator --------------------- */
$wp_customize->add_setting( 'dierreweb_page_title_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_page_title_separator_2', array(
  'section'	=> 'dierreweb_page_title'
) ) );

// Background Image
$wp_customize->add_setting( 'dierreweb_background_image', array(
  'sanitize_callback' => 'dierreweb_validate_image'
) );

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'dierreweb_background_image', array(
  'label'			  => esc_html__( 'Pages title background', 'dierreweb' ),
  'description'	=> esc_html__( 'The selected image will be used when a post is missing a featured image. A default fallback image included in the theme will be used if no image is set.', 'dierreweb' ),
  'mime_type'		=> 'image',
  'section' 		=> 'dierreweb_page_title'
) ) );

/* Title --------------------- */
$wp_customize->add_setting( 'dierreweb_page_title_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Title( $wp_customize, 'dierreweb_page_title_3', array(
  'label'	  => esc_html__( 'Breadcrumbs Options', 'dierreweb' ),
  'section'	=> 'dierreweb_page_title'
) ) );

/* General Breadcrumbs --------------------- */
$wp_customize->add_setting( 'breadcrumbs', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'breadcrumbs', array(
  'label'    => esc_html__( 'Show breadcrumbs', 'dierreweb' ),
  'section'  => 'dierreweb_page_title',
  'settings' => 'breadcrumbs',
  'type'     => 'checkbox'
) ) );

/* Yoast Breadcrumbs for Shop --------------------- */
$wp_customize->add_setting( 'yoast_woocommerce_breadcrumb', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'yoast_woocommerce_breadcrumb', array(
  'label'    => esc_html__( 'Yoast breadcrumbs for shop', 'dierreweb' ),
  'section'  => 'dierreweb_page_title',
  'settings' => 'yoast_woocommerce_breadcrumb',
  'type'     => 'checkbox'
) ) );

/* Yoast Breadcrumbs for Page --------------------- */
$wp_customize->add_setting( 'yoast_dierreweb_breadcrumb', array(
  'default'           => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( new Dierreweb_Checkbox( $wp_customize, 'yoast_dierreweb_breadcrumb', array(
  'label'    => esc_html__( 'Yoast breadcrumbs for page', 'dierreweb' ),
  'section'  => 'dierreweb_page_title',
  'settings' => 'yoast_dierreweb_breadcrumb',
  'type'     => 'checkbox'
) ) );
