<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * BLOG SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_blog_section', array(
  'priority' => 70,
  'title'    => esc_html__( 'Blog', 'dr' ),
  'panel'    => 'dierreweb_theme_options'
) );

 $wp_customize->add_setting( 'dierreweb_post_pagination_type', array(
  'capability' 		    => 'edit_theme_options',
  'default'           => 'button',
  'sanitize_callback' => 'dierreweb_sanitize_select'
) );

$wp_customize->add_control( 'dierreweb_post_pagination_type', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_blog_section',
  'label'   		=> esc_html__( 'Pagination Type', 'chaplin' ),
  'description'	=> esc_html__( 'Determines how the pagination on archive pages should be displayed.', 'dr' ),
  'choices' 		=> array(
    'button' => esc_html__( 'Load more on button click', 'dr' ),
    'scroll' => esc_html__( 'Load more on scroll', 'dr' ),
    'links'	 => esc_html__( 'Previous and next page links', 'dr' )
  ),
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_blog_section_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_blog_section_separator_1', array(
  'section'	=> 'dierreweb_blog_section'
) ) );

$wp_customize->add_setting( 'dierreweb_post_grid_columns', array(
  'default'           => '2',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_post_grid_columns', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_blog_section',
  'label'   		=> esc_html__( 'Number of Columns', 'dr' ),
  'description'	=> esc_html__( 'The maximum number of columns to use in the post grid.', 'dr' ),
  'choices' 		=> array(
    '2'	=> esc_html__( 'Two', 'dr' ),
    '3' => esc_html__( 'Three', 'dr' )
  )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_blog_section_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_blog_section_separator_2', array(
  'section'	=> 'dierreweb_blog_section'
) ) );

$wp_customize->add_setting( 'dierreweb_display_excerpts', array(
  'default'			      => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_display_excerpts', array(
  'type' 		    => 'checkbox',
  'section'     => 'dierreweb_blog_section',
  'label' 	    => esc_html__( 'Hide Excerpts', 'dr' ),
  'description'	=> esc_html__( 'Enable/disable to display excerpts in post previews.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_blog_section_separator_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_blog_section_separator_3', array(
  'section'	=> 'dierreweb_blog_section'
) ) );

$wp_customize->add_setting( 'dierreweb_display_read_more', array(
  'default'			      => true,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_display_read_more', array(
  'type' 		    => 'checkbox',
  'section'     => 'dierreweb_blog_section',
  'label' 	    => esc_html__( 'Show Read More Button', 'dr' ),
  'description'	=> esc_html__( 'Enable/disable to display read more in post previews.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_blog_section_separator_4', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_blog_section_separator_4', array(
  'section'	=> 'dierreweb_blog_section'
) ) );

$post_meta_choice = dierreweb_get_post_meta_choice();

$wp_customize->add_setting( 'dierreweb_post_archive_meta', array(
  'default' => array(
    'post-date',
    'author',
    'comments',
    'read-time',
    'categories'
  ),
  'sanitize_callback' => 'dierreweb_sanitize_multiple_checkboxes'
) );

$wp_customize->add_control( new Dierreweb_Checkbox_Multiple( $wp_customize, 'dierreweb_post_archive_meta', array(
  'section' 		=> 'dierreweb_blog_section',
  'label'   		=> esc_html__( 'Archive Post Meta', 'dr' ),
  'description'	=> esc_html__( 'Select post meta to display on archive pages.', 'dr' ),
  'choices' 		=> $post_meta_choice
) ) );
