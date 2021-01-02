<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   CUSTOM CSS CLASS
   Handle custom CSS output
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'Dierreweb_Custom_CSS' ) ) {
	Class Dierreweb_Custom_CSS {

		/*	-----------------------------------------------------------------------------------------------
			GENERATE CSS
		--------------------------------------------------------------------------------------------------- */

		public static function generate_css( $selector, $style, $value, $prefix = '', $suffix = '', $echo = false ) {

			$return = '';
			if( !$value) {
				return;
			}

			$return = sprintf( '%s { %s: %s; }', $selector, $style, $prefix . $value . $suffix );
			if( $echo ) {
				echo $return;
			}

			return $return;
		}


		/*	-----------------------------------------------------------------------------------------------
			HEX TO RGB
			Convert hex colors to RGB colors
		--------------------------------------------------------------------------------------------------- */

		public static function hex_to_rgb( $hex_color ) {

			$values = str_replace( '#', '', $hex_color );
			$rgb_color = array();
			switch( strlen( $values ) ) {
				case 3 :
					list( $r, $g, $b ) = sscanf( $values, "%1s%1s%1s" );
					return [hexdec( "$r$r" ), hexdec( "$g$g" ), hexdec( "$b$b" )];
				case 6 :
					return array_map( 'hexdec', sscanf( $values, "%2s%2s%2s" ) );
				default :
					return false;
			}
		}


		/*	-----------------------------------------------------------------------------------------------
			HEX TO P3
			Convert hex colors to the P3 color gamut
		--------------------------------------------------------------------------------------------------- */

		public static function hex_to_p3( $hex_color ) {

			$rgb_color = self::hex_to_rgb( $hex_color );

			return array(
				'red'	  => round( $rgb_color[0] / 255, 3 ),
				'green'	=> round( $rgb_color[1] / 255, 3 ),
				'blue'	=> round( $rgb_color[2] / 255, 3 )
			);
		}

		/*	-----------------------------------------------------------------------------------------------
			FORMAT P3
			Format P3 colors
		--------------------------------------------------------------------------------------------------- */

		public static function format_p3( $p3_colors ) {
			return 'color(display-p3 ' . $p3_colors['red'] . ' ' . $p3_colors['green'] . ' ' . $p3_colors['blue'] . ' / 1)';
		}

		/*	-----------------------------------------------------------------------------------------------
			MINIFY CSS
			Helper function for reducing the size of the line styles output by Dierreweb.
			Based on a original script by @webgefrickel: https://gist.github.com/webgefrickel/3339063
		--------------------------------------------------------------------------------------------------- */

		public static function minify_css( $css ) {

			$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

			// Backup values within single or double quotes
			preg_match_all( '/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER );

			for( $i = 0; $i < count($hit[1]); $i++ ) {
				$css = str_replace( $hit[1][$i], '##########' . $i . '##########', $css );
			}

			// Remove traoling semicolon of selector's last property
			$css = preg_replace( '/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css );

			// Remove any whitespace between semicolon and property-name
			$css = preg_replace( '/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css );

			// Remove any whitespace surrounding property-colon
			$css = preg_replace( '/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css );

			// Remove any whitespace surrounding selector-comma
			$css = preg_replace( '/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css );

			// Remove any whitespace surrounding opening parenthesis
			$css = preg_replace( '/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css );

			// Remove any whitespace between numbers and units
			$css = preg_replace( '/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css );

			// Shorten zero-values
			$css = preg_replace( '/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css );

			// Constrain multiple whitespaces
			$css = preg_replace( '/\p{Zs}+/ims',' ', $css );

			// Remove newlines
			$css = str_replace( array( "\r\n", "\r", "\n" ), '', $css );

			// Restore backed up values within single or double quotes
			for( $i = 0; $i < count($hit[1]); $i++ ) {
				$css = str_replace( '##########' . $i . '##########', $hit[1][$i], $css );
			}

			return $css;
		}

		/*	-----------------------------------------------------------------------------------------------
			GET CSS FOR CUSTOMIZER OPTIONS
			Build CSS reflecting colors, fonts and other options set in the Customizer settings, and return them for output

			@param		$type string	Whether to return CSS for 'front-end', 'block-editor', or 'classic-editor'
		--------------------------------------------------------------------------------------------------- */

		public static function get_customizer_css( $type = 'front-end' ) {

			$css = '';

			/* Font Options ------------------ */

			$text_font = esc_attr( get_theme_mod( 'dierreweb_text_font', Dierreweb_Google_Fonts::$default_text_font ) );
			$headings_font = esc_attr( get_theme_mod( 'dierreweb_headings_font', Dierreweb_Google_Fonts::$default_headings_font ) );
			$menu_font = esc_attr( get_theme_mod( 'dierreweb_menu_font', Dierreweb_Google_Fonts::$default_menu_font ) );
			$button_font = esc_attr( get_theme_mod( 'dierreweb_button_font', Dierreweb_Google_Fonts::$default_button_font ) );

			$headings_weight = esc_attr( get_theme_mod( 'dierreweb_headings_weight' ) );
			$headings_case = esc_attr( get_theme_mod( 'dierreweb_headings_letter_case' ) );
			$headings_spacing =	get_theme_mod( 'dierreweb_headings_letterspacing' ) ? str_replace( '_', '.', esc_attr( get_theme_mod( 'dierreweb_headings_letterspacing' ) ) ) : ''; // Replace underscores with dots

			// Combine the chosen fonts with the appropriate fallback font stack
			if( $text_font ) {
				$text_font_stack = Dierreweb_Google_Fonts::get_font_fallbacks( $text_font, 'text' );
				$text_font = $text_font . ', '. $text_font_stack;
			}

			if( $headings_font ) {
				$headings_font_stack = Dierreweb_Google_Fonts::get_font_fallbacks( $headings_font, 'headings' );
				$headings_font = $headings_font . ', ' . $headings_font_stack;
			}

			if( $menu_font ) {
				$menu_font_stack = Dierreweb_Google_Fonts::get_font_fallbacks( $menu_font, 'menu' );
				$menu_font = $menu_font . ', '. $menu_font_stack;
			}

			if( $button_font ) {
				$button_font_stack = Dierreweb_Google_Fonts::get_font_fallbacks( $button_font, 'button' );
				$button_font = $button_font . ', '. $button_font_stack;
			}

			/* Color Options ----------------- */
			$primary = get_theme_mod( 'dierreweb_primary_color' );
			$secondary = get_theme_mod( 'dierreweb_secondary_color' );
			$background = get_theme_mod( 'background_color' ) ? '#' . get_theme_mod( 'background_color' ) : false;
			$body = get_theme_mod( 'dierreweb_text_color') ;
			$headings = get_theme_mod('dierreweb_headings_text_color');

			$buttons_background = get_theme_mod( 'dierreweb_buttons_background_color' );
			$buttons_text = get_theme_mod( 'dierreweb_buttons_text_color' );

			$border = get_theme_mod( 'dierreweb_border_color' );
			$light_background = get_theme_mod( 'dierreweb_light_background_color' );

			// The default buttons background color is conditional.
			// If an accent color is set, the default is the accent color.
			// If an accent color is not set, the default is the default primary color.
			$default_primary = '#4D5342';
			$buttons_background_default = ($primary && $primary !== $default_primary) ? $primary : $default_primary;

			/* Properties -------------------- */
			// Make the list of CSS properties filterable
			$properties = apply_filters('dierreweb_css_properties', array(
				'background' => array(
					'default'	=> '#ffffff',
					'value'		=> $background,
					'type'		=> 'color'
				),
				'primary'	=> array(
					'default'	=> '#4D5342',
					'value'	  => $primary,
					'type'		=> 'color'
				),
				'secondary'	=> array(
					'default'	=> '#E3D7D1',
					'value'		=> $secondary,
					'type'		=> 'color'
				),
				'body' => array(
					'default'	=> '#A0A0A0',
					'value'		=> $body,
					'type'		=> 'color'
				),
				'headings' => array(
					'default'	=> '#0D0A0B',
					'value'	  => $headings,
					'type'		=> 'color'
				),
				'buttons_background' => array(
					'default'	=> $buttons_background_default,
					'value'		=> $buttons_background,
					'type'		=> 'color'
				),
				'buttons_text' => array(
					'default'	=> $background,
					'value'		=> $buttons_text,
					'type'		=> 'color'
				),
				'border' => array(
					'default'	=> '#e1e1e3',
					'value'		=> $border,
					'type'		=> 'color'
				),

				'light_background' => array(
					'default'	=> '#f1f1f3',
					'value'		=> $light_background,
					'type'		=> 'color'
				),



				'text_font'	=> array(
					'default'	=> '',
					'value'		=> $text_font,
					'type'		=> 'font',
				),
				'headings_font'	=> array(
					'default'	=> '',
					'value'		=> $headings_font,
					'type'		=> 'font'
				),
				'menu_font'	=> array(
					'default'	=> '',
					'value'		=> $menu_font,
					'type'		=> 'font',
				),
				'button_font'	=> array(
					'default'	=> '',
					'value'		=> $button_font,
					'type'		=> 'font'
				),
				'headings_weight'	=> array(
					'default'	=> '700',
					'value'	  => $headings_weight,
					'type'	  => 'font'
				),
				'headings_case'	=> array(
					'default'	=> 'normal',
					'value'		=> $headings_case,
					'type'		=> 'font'
				),
				'headings_spacing' => array(
					'default'	=> 'normal',
					'value'		=> $headings_spacing,
					'suffix'	=> 'em',
					'type'		=> 'font'
				)
			));

			/* P3 Colors --------------------- */
			// Filter for whether to output P3 colors
			$output_p3 = apply_filters( 'dierreweb_custom_css_output_p3_colors', true );

			// Default value
			$p3_value = '';

			// P3 media query opening and closing
			$p3_open =	'@supports (color: color(display-p3 0 0 0 / 1)) {';
			$p3_close = '}';

			/* CSS Variables ----------------- */
			// Filter for whether to output CSS variables
			$output_css_variables = apply_filters( 'dierreweb_custom_css_output_variables', true );

			if($output_css_variables) {

				$css_variables_string = '';

				foreach( $properties as $name => $data ) {

					// Skip if we're missing a value, or if it's the same as the default
					if( !$data['value'] || $data['value'] == $data['default'] ) continue;

					$variable_name = '--' . str_replace( '_', '-', $name );

					if( $data['type'] == 'color' ) {
						$variable_name .= '-color';
					}

					$variable_value = isset( $data['prefix'] ) ? $data['prefix'] : '';
					$variable_value .= $data['value'];
					$variable_value .= isset( $data['suffix'] ) ? $data['suffix'] : '';

					$css_variables_string .= $variable_name . ': ' . $variable_value . ';';

				}

				// Only output the wrapping scope if we have variables to output
				if( $css_variables_string ) {
					$css .= ':root {' . $css_variables_string . '}';
				}
			}

			/* CSS Elements ------------------ */
			$css_elements = self::get_css_elements_array($type);

			/* Loop over the CSS elements ---- */
			foreach($css_elements as $key => $definitions) {

				$property = $properties[$key];

				// Only proceeed if the value is set and not the default one
				if(!$property['value'] || ($property['default'] && $property['default'] == $property['value'])) {
					continue;
				}

				// Get the P3 color, if they're enabled and we're outputting a color property
				if($output_p3 && isset($property['type']) && $property['type'] == 'color') {
					$p3_value = self::format_p3(self::hex_to_p3($property['value']));
				}

				// Add the specified prefix and/or suffix to the value
				$value = $property['value'];
				$value = isset($property['prefix']) && $property['prefix'] ? $property['prefix'] . $value : $value;
				$value = isset($property['suffix']) && $property['suffix'] ? $value . $property['suffix'] : $value;

				foreach($definitions as $elements_property => $elements) {

					// No elements, no output
					if(empty($elements)) {
						continue;
					}

					// Convert to array, to support multiple sets of elements for each property. This gets
					// us around edgecases where browsers will break if it hits an urecognized selector.
					// For example, vendor specific ::placeholder selectors need to be styled separately,
					// or the browser will skip the entire CSS rule.
					if(!is_array($elements)) $elements = array($elements);

					foreach($elements as $elements_set) {
						// Generate CSS for the elements
						$css .= self::generate_css($elements_set, $elements_property, $value);

						// Generate P3 color CSS, if available and enabled
						if($output_p3 && isset($property['type']) && $property['type'] == 'color' && $p3_value) {
							$css .= $p3_open . self::generate_css($elements_set, $elements_property, $p3_value) . $p3_close;
						}
					}

				}
			}

			/* Minify the results ------------ */
			$css = self::minify_css($css);

			/* Return the results ------------ */
			return $css;

		}

		/*	-----------------------------------------------------------------------------------------------
			GET THE CSS ELEMENTS
			Stores an array of all elements to apply custom CSS to.

			@param		$type string	Whether to return elements for 'front-end', 'block-editor', or 'classic-editor'
		--------------------------------------------------------------------------------------------------- */

		public static function get_css_elements_array($type = 'front-end') {

			/* Helper Variables -------------- */
			// Type specific helper variables
			switch($type) {
				case 'front-end':
					$headings_targets = apply_filters('dierreweb_headings_targets_front_end', 'h1, h2, h3, h4, h5, h6,
					.h1, .h2, .h3, .h4, .h5, .h6, .entry-title, .widget-title, .post-title');
					$menu_targets = apply_filters('dierreweb_menu_targets_front_end', '.header .header-inner .navigation li a');

					$buttons_targets = apply_filters('dierreweb_buttons_targets_front_end', 'button, .button,
					:root .wp-block-button__link, :root .wp-block-file a.wp-block-file__button,
					input[type=\'button\'], input[type=\'reset\'], input[type=\'submit\']');
					break;

				case 'block-editor':
					$headings_targets = apply_filters('dierreweb_headings_targets_block_editor',
					':root .wp-block h1, :root .wp-block h2, :root .wp-block h3, :root .wp-block h4,
					:root .wp-block h5, :root .wp-block h6, .editor-post-title__block .editor-post-title__input,
					.editor-post-title__block .editor-post-title__input:focus');

					$buttons_targets = apply_filters('dierreweb_buttons_targets_block_editor', '.editor-styles-wrapper
					.wp-block-button__link, .editor-styles-wrapper :root .wp-block-file a.wp-block-file__button');

					break;
				case 'classic-editor':
					$headings_targets = apply_filters('dierreweb_headings_targets_classic_editor', 'body#tinymce.wp-editor h1, body#tinymce.wp-editor h2, body#tinymce.wp-editor h3, body#tinymce.wp-editor h4, body#tinymce.wp-editor h5, body#tinymce.wp-editor h6');
					$buttons_targets = apply_filters('dierreweb_buttons_targets_classic_editor', 'body#tinymce.wp-editor button, body#tinymce.wp-editor .button, body#tinymce.wp-editor .faux-button, body#tinymce.wp-editor input[type=\'button\'], body#tinymce.wp-editor input[type=\'reset\'], body#tinymce.wp-editor input[type=\'submit\']');
					break;

			}

/* Build the array --------------- */
$elements = array(
	'front-end'	=> array(
		// Colors
		'background' => array(
			'background-color' => 'body, :root body.custom-background, :root .has-background-background-color',
			'border-color'	   => '',
			'border-top-color' => '',
			'color'					   => '.posts .post .post-inner .bottom-shape,
														 :root .has-background-color, ' . $buttons_targets,
		),
		'primary'	=> array(
			'background-color' => '.btn-primary, .btn-tag:hover::after, .scrollToTop, .background-primary, .header .progress-container .progress-bar,
														.posts .post .post-inner .post-body .post-categories:before, .related-posts .item-content .post-categories:before,
														.entry-header .post-categories:before, #wp-calendar > tbody > tr > #today, .post-count,
													  .post-page-numbers.current, .page-numbers.current, .icons-design-simple .dierreweb-social-icon:hover,
														:root .has-primary-background-color, :root .has-buttons-background-background-color',

			'border-color' => 'blockquote, input[type=\'email\']:focus, input[type=\'date\']:focus, input[type=\'search\']:focus,
												input[type=\'number\']:focus, input[type=\'text\']:focus, input[type=\'tel\']:focus,
												input[type=\'url\']:focus, input[type=\'password\']:focus, textarea:focus, select:focus, input:focus:-webkit-autofill,
												.btn-tag:hover, .border-color-primary, .hr, .header .header-inner .navigation .menu-item-has-children > .dropdown, .widget-title, .related-title,
												.wp-block-pullquote:not(.is-style-solid-color),
												.wp-block-quote.has-text-align-right,
												.wp-block-quote[style*="text-align:right"],
												.wp-block-quote[style*="text-align: right"]',

			'color' => 'q:before, q:after, .read-more-section a, .read-more-section a:after, .first-letter, .color-primary,
									.header .header-inner .navigation li a:hover, .header .header-inner .navigation .active, .error404 .entry-title,
									.posts .post .post-inner .post-body .post-categories, .related-posts .item-content .post-categories, .entry-header .post-categories,
									.posts .post .post-inner .post-body .post-categories > a, .related-posts .item-content .post-categories > a, .entry-header .post-categories > a,
									.posts .post:hover .post-inner .post-body .post-title a, .single-navigation .next-btn a:hover:after, .single-navigation .posts-nav-btn .posts-nav-inner a:hover,

									.comments .comments-area .comment-list .comment .comment-body .reply .comment-reply-link, .comments .comments-area .comment-respond .comment-reply-title #cancel-comment-reply-link:hover:after,

									.recent-posts-list li:hover .recent-posts-info .recent-post-title a, .popular-posts-list li:hover .popular-posts-info .popular-post-title a,
									.recent-comments-list li:hover .recent-comments-info .recent-comments-title a, .wp-calendar-nav a,
									.color-scheme-light .main-footer .recent-posts-list li:hover .recent-posts-info .recent-post-title a,
									.color-scheme-light .main-footer .popular-posts-list li:hover .popular-posts-info .popular-post-title a,
									.color-scheme-light .main-footer .recent-comments-list li:hover .recent-comments-info .recent-comments-title a,
									.post-page-numbers:hover, .page-numbers:hover,

									:root .has-primary-color, :root .has-buttons-background-color, .wp-block-button.is-style-outline, .wp-block-button__link.is-style-outline,
									.wp-block-latest-comments .wp-block-latest-comments__comment:hover article .wp-block-latest-comments__comment-meta,
									.wp-block-latest-comments .wp-block-latest-comments__comment:hover article .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-author,
									.wp-block-latest-comments .wp-block-latest-comments__comment:hover article .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-link,
									.wp-block-latest-posts li:hover > a,
									.entry-content > ul > li:before,
									.entry-content > div > ul > li:before,
									.entry-content > div > div > ul > li:before,
									.entry-content p > * > a:hover,
									.entry-content p > a:hover,
									.entry-content > a:hover',

			'text-decoration-color' => '.posts .post:hover .post-inner .post-body .post-title a, .recent-posts-list li:hover .recent-posts-info .recent-post-title a,
																	 .popular-posts-list li:hover .popular-posts-info .popular-post-title a,
																	 .recent-comments-list li:hover .recent-comments-info .recent-comments-title a,
																	 .wp-block-latest-comments .wp-block-latest-comments__comment:hover article .wp-block-latest-comments__comment-meta,
																	 .wp-block-latest-comments .wp-block-latest-comments__comment:hover article .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-author,
																	 .wp-block-latest-comments .wp-block-latest-comments__comment:hover article .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-link,
																	 .wp-block-latest-posts li:hover > a',
			'fill' => ''
		),
		'secondary' => array(
			'background-color' => '.background-secondary, :root .has-secondary-background-color',
			'border-color'		 => '.border-color-secondary,',
			'color'				     => '.color-secondary, :root .has-secondary-color',
			'fill'					   => ''
		),
		'body' => array(
			'background-color' => ':root .has-body-background-color',
			'color'				     => array(
															'body, a, .subtitle, .single-navigation .posts-nav-inner .btn-label, div.wpcf7 .ajax-loader:before,
												      .wp-block-latest-comments.has-dates .wp-block-latest-comments__comment article .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-date,
	 											      .wp-block-latest-comments.has-excerpts .wp-block-latest-comments__comment article .wp-block-latest-comments__comment-excerpt p,
															:root .has-body-color',
															'::-webkit-input-placeholder',
															':-moz-placeholder',
															'::-moz-placeholder',
															':-ms-input-placeholder',
															'::-ms-input-placeholder',
															'::placeholder',
															),
		  '-webkit-text-fill-color' => 'input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus,
																	  textarea:-webkit-autofill, textarea:-webkit-autofill:hover, textarea:-webkit-autofill:focus,
																		select:-webkit-autofill, select:-webkit-autofill:hover, select:-webkit-autofill:focus',
			'border-color' => '',
		  'fill' => ''
		),

		'headings' => array(
			'color'	 => $headings_targets
		),

		'buttons_background' => array(
			'background-color' => $buttons_targets . ', :root .has-buttons-background-background-color, .btn-primary, .scrollToTop',
			'color'					   => ':root .has-buttons-background-color, .wp-block-button.is-style-outline, .wp-block-button__link.is-style-outline'
		),
		'buttons_text' => array(
			'background-color' => ':root .has-buttons-text-background-color',
			'color'					   => $buttons_targets . ', :root .has-buttons-text-color'
		),
		'border' => array(
			'background-color' => '.bg-border, .bg-border-hover:hover, :root .has-border-background-color',

			'border-color'		 => '.border-color-border, .border-color-border-hover:hover, pre, th, td, input,
														fieldset, .main-menu li, button.sub-menu-toggle, .wp-block-latest-posts.is-grid li, .wp-block-calendar,
														.footer-menu li, .comment .comment, .post-navigation, .related-posts, .select2-container .select2-selection--single',

			'color'					   => '.color-border, .color-border-hover:hover, :root .has-border-color, hr',
			'fill'					   => '.fill-children-border, .fill-children-border *'
		),


		'light_background' => array(
			'background-color' => '.bg-light-background, .bg-light-background-hover:hover, :root .has-light-background-background-color, code, kbd, samp, table.is-style-stripes tr:nth-child(odd)',
			'border-color'		 => '.border-color-light-background, .border-color-light-background-hover:hover',
			'color'					   => '.color-light-background, .color-light-background-hover:hover, :root .has-light-background-color, .main-menu-alt ul',
			'fill'					   => '.fill-children-light-background, .fill-children-light-background *'
		),


		// Typography
		'text_font'	=> array(
			'font-family'	=> 'body'
		),
		'headings_font'	=> array(
			'font-family'	=> $headings_targets
		),
		'menu_font'	=> array(
			'font-family'	=> $menu_targets
		),
		'button_font'	=> array(
			'font-family'	=> $buttons_targets
		),
		'headings_weight'	=> array(
			'font-weight'	=> $headings_targets
		),
		'headings_case'	=> array(
			'text-transform' => $headings_targets
		),
		'headings_spacing' => array(
			'letter-spacing' => $headings_targets
		)
	),

				'block-editor' => array(
					// Typography
					'text_font'	=> array(
						'font-family'	=> '.editor-styles-wrapper > *, .editor-post-title__block .editor-post-title__input'
					),
					'headings_font'	=> array(
						'font-family'	=> $headings_targets
					),
					'headings_weight'	=> array(
						'font-weight'	=> $headings_targets
					),
					'headings_case'	=> array(
						'text-transform' => $headings_targets
					),
					'headings_spacing' => array(
						'letter-spacing' => $headings_targets
					),
					// Colors
					'background' => array(
						'background-color' => ':root .has-background-background-color, .editor-styles-wrapper, .editor-styles-wrapper > .editor-writing-flow,
																	.editor-styles-wrapper > .editor-writing-flow > div',
						'color'					   => ':root .has-background-color, ' . $buttons_targets
					),
					'body' => array(
						'background-color' => ':root .has-body-color-background-color',
						'color'					   => ':root .has-body-color-color, .editor-styles-wrapper > *'
					),
					'headings' => array(
						'color'	=> $headings_targets
					),

					// 'secondary'	=> array(
					// 	'background-color' => ':root .has-secondary-background-color',
					// 	'color'					   => ':root .has-secondary-color, .editor-styles-wrapper .wp-block-latest-comments time, .editor-styles-wrapper .wp-block-latest-posts time, .block-editor-default-block-appender textarea.block-editor-default-block-appender__content, .editor-post-title__block .editor-post-title__input::placeholder, .block-editor-default-block-appender textarea.block-editor-default-block-appender__content .editor-post-title__input::placeholder, .components-modal__frame input::placeholder, .components-modal__frame textarea::placeholder, .components-popover input::placeholder, .components-popover textarea::placeholder, .edit-post-header input::placeholder, .edit-post-header textarea::placeholder, .edit-post-sidebar input::placeholder, .edit-post-sidebar textarea::placeholder, .edit-post-text-editor input::placeholder, .edit-post-text-editor textarea::placeholder, .edit-post-visual-editor input::placeholder, .edit-post-visual-editor textarea::placeholder, .editor-post-publish-panel input::placeholder, .editor-post-publish-panel textarea::placeholder'
					// ),

					'primary' => array(
						'background-color' => ':root .has-primary-background-color, ' . $buttons_targets,
						'border-color'		 => '.editor-styles-wrapper blockquote, .editor-styles-wrapper .wp-block-quote',
						'color'					   => ':root .has-primary-color, .editor-styles-wrapper .editor-block-list__layout a, .editor-styles-wrapper .block-editor-block-list__layout a,
																	.editor-styles-wrapper .wp-block-file .wp-block-file__textlink, .wp-block-button.is-style-outline, .wp-block-button__link.is-style-outline'
					),
					'buttons_background' => array(
						'background-color' => $buttons_targets,
						'color'					   => '.wp-block-button.is-style-outline, .wp-block-button__link.is-style-outline'
					),
					'buttons_text' => array(
						'color'	=> $buttons_targets
					),
					'border' => array(
						'background-color' => ':root .has-border-background-color, .editor-styles-wrapper caption',
						'border-color'		 => '.editor-styles-wrapper hr, .editor-styles-wrapper pre, .editor-styles-wrapper th, .editor-styles-wrapper td, .editor-styles-wrapper fieldset, .editor-styles-wrapper .wp-block-latest-posts.is-grid li, .editor-styles-wrapper table.wp-block-table',
						'color'					   => ':root .has-border-color, .editor-styles-wrapper hr.wp-block-separator'
					),
					'light_background' => array(
						'background-color'	=> ':root .has-light-background-background-color, code, kbd, samp, table.is-style-stripes tbody tr:nth-child(odd), .wp-block-table.is-style-stripes tbody tr:nth-child(odd), .wp-block-shortcode',
						'color'					    => ':root .has-light-background-color'
					),
				),

				'classic-editor' => array(
					// Typography
					'text_font'	=> array(
						'font-family'	=> 'body#tinymce.wp-editor'
					),
					'headings_font'	=> array(
						'font-family'	=> $headings_targets
					),
					'headings_weight'	=> array(
						'font-weight'	=> $headings_targets
					),
					'headings_case'	=> array(
						'text-transform' => $headings_targets
					),
					'headings_spacing' => array(
						'letter-spacing' => $headings_targets
					),
					// Colors
					'background' => array(
						'background-color' => 'body#tinymce.wp-editor',
						'color'					   => $buttons_targets
					),
					'primary'	=> array(
						'color'	=> 'body#tinymce.wp-editor'
					),
					'headings' => array(
						'color'	=> $headings_targets
					),

					// 'accent' => array(
					// 	'background-color' => $buttons_targets,
					// 	'border-color'		 => 'body#tinymce.wp-editor blockquote, body#tinymce.wp-editor .wp-block-quote',
					// 	'color'					   => 'body#tinymce.wp-editor a'
					// ),

					'buttons_background' => array(
						'background-color' => $buttons_targets
					),
					'buttons_text' => array(
						'color'	=> $buttons_targets
					),
					'border' => array(
						'background-color' => 'body#tinymce.wp-editor caption',
						'border-color'		 => 'body#tinymce.wp-editor hr, body#tinymce.wp-editor pre, body#tinymce.wp-editor th, body#tinymce.wp-editor td, body#tinymce.wp-editor input, body#tinymce.wp-editor textarea, body#tinymce.wp-editor select, body#tinymce.wp-editor fieldset'
					),
					'light_background' => array(
						'background-color' => 'body#tinymce.wp-editor code, body#tinymce.wp-editor kbd, body#tinymce.wp-editor samp, body#tinymce.wp-editor table tbody > tr:nth-child(odd)'
					),
				),
			);

			/**
			 * Filter the array of elements and return the array
			 *
			 * @param array Array of elements
			 * @param string The type of elements selected (front-end, block-editor or classic-editor)
			 */

			return apply_filters( 'dierreweb_get_css_elements_array', $elements[$type], $type );

		}
	}
}
