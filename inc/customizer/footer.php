<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * FOOTER SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_footer_section', array(
  'title'    => esc_html__( 'Footer', 'dr' ),
  'priority' => 50,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_disable_footer', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_disable_footer', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'dierreweb_disable_footer',
  'label'       => esc_html__( 'Footer', 'dr' ),
  'description' => esc_html__( 'Enable/disable footer on your website.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_1', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_1', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_disable_scroll_to_top', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_disable_scroll_to_top', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'dierreweb_disable_scroll_to_top',
  'label'       => esc_html__( 'Scroll to top button', 'dr' ),
  'description' => esc_html__( 'This button moves you to the top of the page when you click it.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_2', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_2', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_sticky_footer', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'

) );

$wp_customize->add_control( 'dierreweb_sticky_footer', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'dierreweb_sticky_footer',
  'label'       => esc_html__( 'Sticky footer', 'dr' ),
  'description' => esc_html__( 'The footer will be displayed behind the content of the page and will be visible when user scrolls to the bottom on the page.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_3', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_3', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_footer_text_color', array(
  'default'           => 'light',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_footer_text_color', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_footer_section',
  'label'   		=> esc_html__( 'Footer text color', 'dr' ),
  'description'	=> esc_html__( 'Choose your footer color scheme.', 'dr' ),
  'choices' 		=> array(
    'light'	=> esc_html__( 'Light', 'dr' ),
    'dark'	=> esc_html__( 'Dark', 'dr' )
  )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_4', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_4', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_footer_background_color', array(
  'transport'         => 'postMessage',
  'default' 			    => get_theme_mod( 'dierreweb_accent_color', '#007C89' ),
  'type' 				      => 'theme_mod',
  'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dierreweb_footer_background_color', array(
  'label' 		  => esc_html__( 'Footer background', 'dr' ),
  'description'	=> esc_html__( 'You can set your footer section background color.', 'dr' ),
  'section' 		=> 'dierreweb_footer_section',
  'settings' 		=> 'dierreweb_footer_background_color'
) ) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_5', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_5', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_footer_background_image', array(
  'transport'         => 'postMessage',
  'sanitize_callback' => 'dierreweb_validate_image'
) );

$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'dierreweb_footer_background_image', array(
  'label'       => esc_html__( 'Footer background', 'dr' ),
  'description' => esc_html__( 'You can set your footer section background image.', 'dr' ),
  'mime_type'	  => 'image',
  'section' 	  => 'dierreweb_footer_section'
) ) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_6', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_6', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'footer_widget', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'footer_widget', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'footer_widget',
  'label'       => esc_html__( 'Footer widget', 'dr' ),
  'description' => esc_html__( 'Click to disable section with your copyrights under the footer.', 'dr' )
) );

$wp_customize->add_setting( 'dierreweb_footer_copyright', array(
  'default'           => false,
  'sanitize_callback' => 'dierreweb_sanitize_checkbox',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_footer_copyright', array(
  'type'        => 'checkbox',
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'dierreweb_footer_copyright',
  'label'       => esc_html__( 'Copyrights', 'dr' ),
  'description' => esc_html__( 'Click to disable section with your copyrights under the footer.', 'dr' )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_7', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_7', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_footer_copyright_columns', array(
  'default'           => 'centered',
  'sanitize_callback' => 'dierreweb_sanitize_select',
  'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'dierreweb_footer_copyright_columns', array(
  'type'			  => 'select',
  'section' 		=> 'dierreweb_footer_section',
  'label'   		=> esc_html__( 'Copyrights layout', 'dr' ),
  'description'	=> esc_html__( 'Set different copyrights section layout.', 'dr' ),
  'choices' 		=> array(
    'centered'	  => esc_html__( 'Centered', 'dr' ),
    'two-columns'	=> esc_html__( 'Two columns', 'dr' )
  )
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_8', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_8', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_footer_copyright_text', array(
  'transport'         => 'postMessage',
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( 'dierreweb_footer_copyright_text', array(
  'label'       => esc_html__( 'Copyrights text', 'dr' ),
  'description' => esc_html__( 'Place here text you want to see in the copyrights area. You can use shortocodes. Ex.: [social_buttons]', 'dr' ),
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'dierreweb_footer_copyright_text',
  'type'        => 'textarea'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_9', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_9', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

$wp_customize->add_setting( 'dierreweb_footer_copyright_text2', array(
  'transport'         => 'postMessage',
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( 'dierreweb_footer_copyright_text2', array(
  'label'       => esc_html__( 'Text next to copyrights', 'dr' ),
  'description' => esc_html__( 'You can use shortocodes. Ex.: [social_buttons]', 'dr' ),
  'section'     => 'dierreweb_footer_section',
  'settings'    => 'dierreweb_footer_copyright_text2',
  'type'        => 'textarea'
) );

/* Separator --------------------- */

$wp_customize->add_setting( 'dierreweb_footer_section_separator_10', array(
  'sanitize_callback' => 'wp_filter_nohtml_kses'
) );

$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_footer_section_separator_10', array(
  'section'	=> 'dierreweb_footer_section'
) ) );

// $wp_customize->add_setting( 'dierreweb_prefooter_area', array(
//   'transport'         => 'refresh',
//   'default'=>'default text',
//   'sanitize_callback' => 'wp_filter_nohtml_kses'
// ) );
//
// $wp_customize->add_control( new Dierreweb_Text_Area( $wp_customize, 'dierreweb_bo', array(
//   'label'	  => esc_html__( 'BOOO', 'dr' ),
//
//   'section'     => 'dierreweb_footer_section',
//   'settings'    => 'dierreweb_prefooter_area',
//   // 'type'        => 'textarea'
// ) ) );

// $wp_customize->add_setting( 'dierreweb_prefooter_area', array(
// 	'transport'         => 'postMessage',
// 	'sanitize_callback' => 'wp_filter_nohtml_kses'
// ) );
//
// $wp_customize->add_control( 'dierreweb_prefooter_area', array(
// 	'label'       => esc_html__( 'HTML before footer', 'dr' ),
// 	'description' => esc_html__( 'This is the text before footer field, again good for additional info. You can place here any shortcode, for ex.: [html_block id=""]', 'dr' ),
// 	'section'     => 'dierreweb_footer_section',
// 	'settings'    => 'dierreweb_prefooter_area',
// 	'type'        => 'textarea'
// ) );
