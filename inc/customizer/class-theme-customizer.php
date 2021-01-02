<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'Dierreweb_Customize' ) ) {
	Class Dierreweb_Customize {

		public static function dierreweb_register( $wp_customize ) {

      /* ------------------------------------------------------------------------
  		 * Theme Options Panel
  		 * ------------------------------------------------------------------------ */

    	$wp_customize->add_panel( 'dierreweb_theme_options', array(
				'priority'       => 30,
				'theme_supports' => '',
				'title'          => esc_html__( 'Theme Options', 'dr' ),
				'description'    => esc_html__( 'Options included in the Dierreweb theme.', 'dr' )
		  ) );

		  /* ------------------------------------------------------------------------
			  * Site Title & Description
			  * ------------------------------------------------------------------------ */

 			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
 			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			// Update logo image with refresh, so inline CSS output is updated as well
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';

			// Update header image with refresh, so inline CSS output is updated as well
			$wp_customize->get_setting( 'header_image' )->transport = 'postMessage';

			// Update background image with refresh, so inline CSS output is updated as well
			$wp_customize->get_setting( 'background_image' )->transport = 'postMessage';

			// Update background color with postMessage, so inline CSS output is updated as well
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => 'dierreweb_customize_partial_blogname',
			) );

 			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
 				'selector'        => '.site-description',
 				'render_callback' => 'dierreweb_customize_partial_blogdescription',
 			) );

			/* ---------------------------------------------------------------------------------------------
			   LOAD ALL CLASSES
			------------------------------------------------------------------------------------------------ */

			$options = array(
			  'blog',
			  'color',
			  'custom-js',
			  'cookie',
			  'footer',
			  'footer',
			  'forms',
			  'general',
			  'header',
			  'logo',
			  'maintenance',
			  'page-title',
			  'performance',
			  'popup',
			  'typography'
			);

			foreach( $options as $file ) {
			  $path = get_parent_theme_file_path( '/inc/customizer/' . $file . '.php' );
			  if( file_exists( $path ) ) {
			    require_once $path;
			  }
			}

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

			// $wp_customize->add_setting( 'share_fb', array(
			// 	'default'           => true,
			//   'sanitize_callback' => 'dierreweb_sanitize_checkbox',
			// 	'transport'         => 'postMessage'
			// ) );
			//
			// $wp_customize->add_control( 'share_fb', array(
			// 	'type'        => 'checkbox',
			// 	'section'     => 'dierreweb_social_section',
			// 	'settings'    => 'dierreweb_fb',
			// 	'label'       => esc_html__( 'Show FB', 'dr' ),
			// 	'description' => esc_html__( 'Displays a full chain of links to the current page.', 'dr' )
			// ) );









  }

  // // Return an array of suggested fonts
  // public static function dierreweb_suggested_fonts_data_list( $font_option ) {
  //   $suggested_fonts = Dierreweb_Google_Fonts::get_suggested_fonts( $font_option );
  //   $list = '<datalist id="dierreweb-suggested-fonts-list-' . esc_attr( $font_option ) . '">';
  //   foreach( $suggested_fonts as $font) {
  //     $list .= '<option value="' . esc_attr( $font) . '">';
  //   }
  //   $list .= '</datalist>';
	//
  //   return $list;
  // }

  // Return the sitewide color options included
  public static function dierreweb_get_color_options() {
    return apply_filters( 'dierreweb_accent_color_options', array(
      'dierreweb_primary_color' => array(
        'default'	=> '#4D5342',
        'label'		=> esc_html__( 'Primary Color', 'dr' ),
        'slug'		=> 'primary'
      ),
			'dierreweb_secondary_color' => array(
        'default'	=> '#E3D7D1',
        'label'		=> esc_html__( 'Secondary Color', 'dr' ),
        'slug'		=> 'secondary'
      ),
			'dierreweb_text_color' => array(
        'default'	=> '#A0A0A0',
        'label'		=> esc_html__( 'Text Color', 'dr' ),
        'slug'		=> 'body'
      ),
			// controllare
      'dierreweb_headings_text_color' => array(
        'default'	=> '#0D0A0B',
        'label'		=> esc_html__( 'Headings Color', 'dr' ),
        'slug'		=> 'headings'
      ),
      'dierreweb_buttons_background_color' => array(
        'default'	=> 'red',
        'label'		=> esc_html__( 'Buttons Background Color', 'dr' ),
        'slug'		=> 'buttons-background'
      ),
      'dierreweb_buttons_color' => array(
        'default'	=> '#FFFFFF',
        'label'		=> esc_html__( 'Buttons Text Color', 'dr' ),
        'slug'		=> 'buttons-text'
      ),
      'dierreweb_border_color' => array(
        'default'	=> '#E1E1E3',
        'label'		=> esc_html__( 'Border Color', 'dr' ),
        'slug'		=> 'border'
      ),
      // 'dierreweb_light_background_color' => array(
      //   'default'	=> '#F1F1F3',
      //   'label'		=> esc_html__( 'Light Background Color', 'dr' ),
      //   'slug'		=> 'light-background'
      // )
    ) );
  }

  // Initiate the customize controls js
  // public static function dierreweb_customize_controls() {
	// 	wp_enqueue_script( 'dierreweb-customize-controls-js', esc_url( DIERREWEB_FRAMEWORK ) . '/customizer/js/customize-controls.js', array( 'jquery', 'customize-controls' ), '', true );
	// }
}

  // Setup the Theme Customizer settings and controls
	add_action( 'customize_register', array( 'Dierreweb_Customize', 'dierreweb_register' ) );

	// Enqueue customize controls javascript in Theme Customizer admin screen
	//add_action( 'customize_controls_init', array( 'Dierreweb_Customize', 'dierreweb_customize_controls' ) );
}

/* ---------------------------------------------------------------------------------------------
   PARTIAL REFRESH FUNCTIONS
   --------------------------------------------------------------------------------------------- */

/* Render the site title for the selective refresh partial */
if( !function_exists( 'dierreweb_customize_partial_blogname' ) ) {
	function dierreweb_customize_partial_blogname() {
		bloginfo( 'name' );
	}
}

/* Render the site description for the selective refresh partial */
if( !function_exists( 'dierreweb_customize_partial_blogdescription' ) ) {
	function dierreweb_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}








if( !function_exists( 'dierreweb_get_post_meta_choice' ) ) {
	function dierreweb_get_post_meta_choice() {
		$post_meta_choices = array(
			'author'		 => esc_html__( 'Author', 'dr' ),
			'categories' => esc_html__( 'Categories', 'dr' ),
			'comments'	 => esc_html__( 'Comments', 'dr' ),
			'post-date'	 => esc_html__( 'Post date', 'dr' ),
			'read-time'	 => esc_html__( 'Read time', 'dr' )
		);

		return $post_meta_choices = apply_filters( 'dierreweb_post_meta_choices_in_the_customizer', $post_meta_choices );
	}
}

/* ------------------------------------------------------------------------------------------------
   GET HEADER GRID COLUMN CLASSES HEADER
--------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_header_column_classes' ) ) {
	function dierreweb_get_header_column_classes() {
		$number_of_columns = get_theme_mod( 'dierreweb_header_topbar_columns', 'centered' );
		switch( $number_of_columns ) {
			case 'centered':
				$classes = 'centered';
				break;
			case 'two-columns':
				$classes = 'two-columns';
				break;
			default:
				$classes = 'centered';
		}

		return apply_filters( 'dierreweb_header_column_classes', $classes );
	}
}

/* --------------------------------------------------------------------------------------------------------
   GET TOPABAR COLOR HEADER
----------------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_color_header_topbar' ) ) {
	function dierreweb_get_color_header_topbar() {
		$color = get_theme_mod( 'dierreweb_topbar_text_color', 'light' );
		switch( $color ) {
			case 'light':
				$classes = 'light';
				break;
			case 'dark':
				$classes = 'dark';
				break;
			default:
				$classes = 'light';
		}

		return apply_filters( 'dierreweb_color_header_topbar', $classes );
	}
}

/* ------------------------------------------------------------------------------------------------------------
   GET PAGE TITLE ALIGNMENT PAGE TITLE
--------------------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_alignment_background' ) ) {
	function dierreweb_get_alignment_background() {
		$alignment = get_theme_mod( 'page_title_align', 'center' );
		switch( $alignment ) {
			case 'center':
				$classes = 'center';
				break;
			case 'left':
				$classes = 'left';
				break;
			default:
				$classes = 'center';
		}

		return apply_filters( 'dierreweb_alignment_background', $classes );
	}
}

/* --------------------------------------------------------------------------------------------------------
   GET COLOR PAGE TITLE
----------------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_color_background' ) ) {
	function dierreweb_get_color_background() {
		$color = get_theme_mod( 'page_title_color', 'light' );
		switch( $color ) {
			case 'light':
				$classes = 'light';
				break;
			case 'dark':
				$classes = 'dark';
				break;
			default:
				$classes = 'light';
		}

		return apply_filters( 'dierreweb_color_background', $classes );
	}
}

/* --------------------------------------------------------------------------------------------------------
   GET FOOTER COLOR SCHEME
----------------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_footer_color' ) ) {
	function dierreweb_get_footer_color() {
		$color = get_theme_mod( 'dierreweb_footer_text_color', 'light' );
		switch( $color ) {
			case 'light':
				$classes = 'light';
				break;
			case 'dark':
				$classes = 'dark';
				break;
			default:
				$classes = 'light';
		}

		return apply_filters( 'dierreweb_footer_color', $classes );
	}
}

/* ------------------------------------------------------------------------------------------------
   GET GRID COLUMN CLASS FOOTER COPYRIGHTS
--------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_footer_column_class' ) ) {
	function dierreweb_get_footer_column_class() {
		$number_of_columns = get_theme_mod( 'dierreweb_footer_copyright_columns', 'centered' );
		switch( $number_of_columns ) {
			case 'centered':
				$classes = 'centered';
				break;
			case 'two-columns':
				$classes = 'two-columns';
				break;
			default:
				$classes = 'centered';
		}

		return apply_filters( 'dierreweb_footer_column_class', $classes );
	}
}

/* ------------------------------------------------------------------------------------------------
   GET POST GRID COLUMN CLASSES BLOG
--------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_post_grid_column_classes' ) ) {
	function dierreweb_get_post_grid_column_classes() {
		$number_of_columns = get_theme_mod( 'dierreweb_post_grid_columns', '2' );
		switch( $number_of_columns ) {
			case '2':
				$classes = 'columns-2';
				break;
			case '3':
				$classes = 'columns-3';
				break;
			default:
				$classes = 'columns-2';
		}

		return apply_filters( 'dierreweb_post_grid_column_classes', $classes );
	}
}

/* ------------------------------------------------------------------------------------------------
   GET FORMS STYLE CLASSES
--------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_forms_style' ) ) {
	function dierreweb_get_forms_style() {
		$forms_style = get_theme_mod( 'dierreweb_forms_style', 'rounded' );
		switch( $forms_style ) {
			case 'rounded':
				$classes = 'rounded';
				break;
			case 'semi-rounded':
				$classes = 'semi-rounded';
				break;
			case 'square':
				$classes = 'square';
				break;
			case 'underlined':
				$classes = 'underlined';
				break;
			default:
				$classes = 'round';
		}

		return apply_filters( 'dierreweb_style_forms', $classes );
	}
}

/* ------------------------------------------------------------------------------------------------
   GET FORMS WIDTH
--------------------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_forms_width' ) ) {
	function dierreweb_get_forms_width() {
		$forms_style = get_theme_mod( 'dierreweb_forms_width', '1' );
		switch( $forms_style ) {
			case '1':
				$classes = '1';
				break;
			case '2':
				$classes = '2';
				break;
			default:
				$classes = '2';
		}

		return apply_filters( 'dierreweb_width_forms', $classes );
	}
}

/* ---------------------------------------------------------------------------------------
   GET POSITION STICKY SOCIAL CLASSES
------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_sticky_social_classes' ) ) {
	function dierreweb_get_sticky_social_classes() {
		$position = get_theme_mod( 'dierreweb_sticky_social_position', 'left' );

		switch( $position ) {
			case 'left':
				$classes = 'left';
				break;
			case 'right':
				$classes = 'right';
				break;
			default:
				$classes = 'left';
		}

		return apply_filters( 'dierreweb_sticky_social_classes', $classes );
	}
}

/* -----------------------------------------------------------------------------------
   GET STICKY SOCIAL TYPE
-------------------------------------------------------------------------------------- */

if( !function_exists( 'dierreweb_get_type_sticky_social' ) ) {
	function dierreweb_get_type_sticky_social() {
		$type = get_theme_mod( 'dierreweb_sticky_social_type', 'follow' );

		switch( $type ) {
			case 'follow':
				$classes = 'follow';
				break;
			case 'share':
				$classes = 'share';
				break;
			default:
				$classes = 'follow';
		}

		return apply_filters( 'dierreweb_type_sticky_social', $classes );
	}
}
