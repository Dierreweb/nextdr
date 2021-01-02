<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * TYPOGRAPHY SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_fonts_options', array(
  'title' 		  => esc_html__( 'Typography', 'dr' ),
  'priority' 	  => 20,
  'description' => wp_kses(__( 'Specify which fonts to use. Dierreweb supports all fonts on <a href="https://fonts.google.com" target="_blank">Google Fonts</a> and all <a href="https://www.w3schools.com/cssref/css_websafe_fonts.asp" target="_blank">web safe fonts</a>.', 'dr' ), 'default' ),
  'panel'		    => 'dierreweb_theme_options'
) );

/* Font Options ------------------ */
$dierreweb_font_options = apply_filters( 'dierreweb_font_options', array(
  'dierreweb_body_font' => array(
    'default' => '',
    'label'		=> esc_html__( 'Text Font', 'dr' ),
    'slug'		=> 'text'
  ),
  'dierreweb_headings_font' => array(
    'default'	=> 'Merriweather',
    'label'		=> esc_html__( 'Headings Font', 'dr' ),
    'slug'		=> 'headings'
  ),
	'dierreweb_menu_font' => array(
    'default'	=> '',
    'label'		=> esc_html__( 'Navigation Font', 'dr' ),
    'slug'		=> 'menu'
  ),
	'dierreweb_button_font' => array(
    'default'	=> '',
    'label'		=> esc_html__( 'Button Font', 'dr' ),
    'slug'		=> 'button'
  )
) );



// Loop over the font options and add them to the customizer
// foreach( $dierreweb_font_options as $font_option_name => $font_option ) {
//   $wp_customize->add_setting( $font_option_name, array(
//     'default' 			    => $font_option['default'],
//     'sanitize_callback' => 'wp_filter_nohtml_kses',
//     'type'				      => 'theme_mod'
//   ) );
//
//   $wp_customize->add_control( $font_option_name, array(
//     'type'			  => 'text',
//     'label' 		  => $font_option['label'],
//     'description'	=> self::dierreweb_suggested_fonts_data_list( $font_option['slug']),
//     'section' 		=> 'dierreweb_fonts_options',
//     'input_attrs' => array(
//       'autocapitalize' => 'off',
//       'autocomplete'	 => 'off',
//       'autocorrect'		 => 'off',
//       'class'				   => 'font-suggestions',
//       'list'  		     => 'dierreweb-suggested-fonts-list-' . $font_option['slug'],
//       'placeholder' 	 => esc_html__( 'Enter the font name', 'dr' ),
//       'spellcheck'		 => 'false'
//     )
//   ) );
// }

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_fonts_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_fonts_separator_1', array(
  'section'	=> 'dierreweb_fonts_options'
) ) );

/* Headings Weight --------------- */
$wp_customize->add_setting( 'dierreweb_headings_weight', array(
  'default' 			    => '700',
  'sanitize_callback' => 'dierreweb_sanitize_select'
) );

$wp_customize->add_control( 'dierreweb_headings_weight', array(
  'label' 		  => esc_html__( 'Headings Weight', 'dr' ),
  'description'	=> esc_html__( 'Note: All fonts do not support all weights.', 'dr' ),
  'section' 		=> 'dierreweb_fonts_options',
  'settings' 		=> 'dierreweb_headings_weight',
  'type' 			  => 'select',
  'choices' 		=> array(
    '100' => esc_html__( 'Thin (100)', 'dr' ),
    '200' => esc_html__( 'Ultra Light (200)', 'dr' ),
    '300' => esc_html__( 'Light (300)', 'dr' ),
    '400' => esc_html__( 'Normal (400)', 'dr' ),
    '500' => esc_html__( 'Medium (500)', 'dr' ),
    '600' => esc_html__( 'Semi Bold (600)', 'dr' ),
    '700' => esc_html__( 'Bold (700)', 'dr' ),
    '800' => esc_html__( 'Extra Bold (800)', 'dr' ),
    '900' => esc_html__( 'Black (900)', 'dr' )
  )
) );

/* Headings Text Case ------------ */
$wp_customize->add_setting( 'dierreweb_headings_letter_case', array(
  'default' 			    => 'normal',
  'sanitize_callback' => 'dierreweb_sanitize_select'
) );

$wp_customize->add_control( 'dierreweb_headings_letter_case', array(
  'label' 	 => esc_html__( 'Headings Case', 'dr' ),
  'section'  => 'dierreweb_fonts_options',
  'settings' => 'dierreweb_headings_letter_case',
  'type' 		 => 'select',
  'choices'  => array(
    'normal' 		 => esc_html__( 'Normal', 'dr' ),
    'uppercase'  => esc_html__( 'Uppercase', 'dr' ),
    'lowercase'  => esc_html__( 'Lowercase', 'dr' )
  )
) );

/* Headings Letter Spacing ------- */
$wp_customize->add_setting( 'dierreweb_headings_letterspacing', array(
  'default' 			    => 'normal',
  'sanitize_callback' => 'dierreweb_sanitize_select'
) );

$wp_customize->add_control( 'dierreweb_headings_letterspacing', array(
  'label' 	 => __( 'Headings Letterspacing', 'dr' ),
  'section'  => 'dierreweb_fonts_options',
  'settings' => 'dierreweb_headings_letterspacing',
  'type' 		 => 'select',
  'choices'  => array(
    '-0_3125'  => esc_html__( '-50%', 'dr' ),
    '-0_28125' => esc_html__( '-45%', 'dr' ),
    '-0_25' 	 => esc_html__( '-40%', 'dr' ),
    '-0_21875' => esc_html__( '-35%', 'dr' ),
    '-0_1875'  => esc_html__( '-30%', 'dr' ),
    '-0_15625' => esc_html__( '-25%', 'dr' ),
    '-0_125' 	 => esc_html__( '-20%', 'dr' ),
    '-0_09375' => esc_html__( '-15%', 'dr' ),
    '-0_0625'  => esc_html__( '-10%', 'dr' ),
    '-0_03125' => esc_html__( '-5%', 'dr' ),
    'normal' 	 => esc_html__( 'Normal', 'dr' ),
    '0_03125'  => esc_html__( '5%', 'dr' ),
    '0_0625'   => esc_html__( '10%', 'dr' ),
    '0_09375'  => esc_html__( '15%', 'dr' ),
    '0_125' 	 => esc_html__( '20%', 'dr' ),
    '0_15625'  => esc_html__( '25%', 'dr' ),
    '0_1875' 	 => esc_html__( '30%', 'dr' ),
    '0_21875'  => esc_html__( '35%', 'dr' ),
    '0_25' 		 => esc_html__( '40%', 'dr' ),
    '0_28125'  => esc_html__( '45%', 'dr' ),
    '0_3125' 	 => esc_html__( '50%', 'dr' )
  )
) );

/* Separator --------------------- */
$wp_customize->add_setting( 'dierreweb_fonts_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_fonts_separator_2', array(
  'section'	=> 'dierreweb_fonts_options'
) ) );

/* Languages --------------------- */
$wp_customize->add_setting( 'dierreweb_font_languages', array(
  'default'           => array( 'latin' ),
  'sanitize_callback' => 'dierreweb_sanitize_multiple_checkboxes'
) );

$wp_customize->add_control( new Dierreweb_Checkbox_Multiple( $wp_customize, 'dierreweb_font_languages', array(
  'section' 		   => 'dierreweb_fonts_options',
  'label'   		   => esc_html__( 'Languages', 'dr' ),
  'description'	   => esc_html__( 'Note: All fonts do not support all languages. Check Google Fonts to make sure.', 'dr' ),
  'choices' 		   => apply_filters( 'dierreweb_font_languages', array(
    'latin'			   => esc_html__( 'Latin', 'dr' ),
    'latin-ext'		 => esc_html__( 'Latin Extended', 'dr' ),
    'cyrillic'		 => esc_html__( 'Cyrillic', 'dr' ),
    'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'dr' ),
    'greek'			   => esc_html__( 'Greek', 'dr' ),
    'greek-ext'		 => esc_html__( 'Greek Extended', 'dr' ),
    'vietnamese'	 => esc_html__( 'Vietnamese', 'dr' )
  ) )
) ) );
