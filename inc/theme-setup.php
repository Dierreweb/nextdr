<?php

if( ! defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   CONTENT WIDTH
------------------------------------------------------------------------------------------------ */
if( ! isset( $content_width ) ) $content_width = 1400;

/* ---------------------------------------------------------------------------------------------
   SET UP THEME DEFAULT AND REGISTER VARIOUS SUPPORTED FEATURES
------------------------------------------------------------------------------------------------ */
if( !function_exists( 'dierreweb_theme_setup' ) ) {
  function dierreweb_theme_setup() {

    /* ---------------------------------------------------------------------------------------------
       SUPPORTS FOR POST FORMAT
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'post-formats', array( 'aside', 'video', 'audio', 'quote', 'image', 'gallery', 'link' ) );

    /* ---------------------------------------------------------------------------------------------
       CUSTOM LOGO
    ------------------------------------------------------------------------------------------------ */
		add_theme_support( 'custom-logo' );

    /* ---------------------------------------------------------------------------------------------
       CUSTOM HEADER
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'custom-header' );

    /* ---------------------------------------------------------------------------------------------
       CUSTOM BACKGROUND COLOR
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'custom-background', array( 'default-color' => 'FFFFFF' ) );

    /* ---------------------------------------------------------------------------------------------
       SUPPORT TITLE
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'title-tag' );

    /* ---------------------------------------------------------------------------------------------
       ADD SUPPORT FOR RESPONSIVE EMBEDS
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'responsive-embeds' );

    /* ---------------------------------------------------------------------------------------------
       AUTOMATIC FEED
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'automatic-feed-links' );

    /* ---------------------------------------------------------------------------------------------
       POSTS THUMBNAIL
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'post-thumbnails' );

    /* ---------------------------------------------------------------------------------------------
       HTML5 SEMANTIC MARKUP
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'script', 'style' ) );

    /* ---------------------------------------------------------------------------------------------
       SELECTIVE REFRESH FOR WIDGETS
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'customize-selective-refresh-widgets' );

    /* ---------------------------------------------------------------------------------------------
       LOAD DEFAULT BLOCK STYLES
    ------------------------------------------------------------------------------------------------ */
    add_theme_support( 'wp-block-styles' );

    /* ---------------------------------------------------------------------------------------------
       ALIGNWIDE AND ALIGN FULL CLASSES IN THE BLOCK EDITOR
    ------------------------------------------------------------------------------------------------ */
		add_theme_support( 'align-wide' );
    add_theme_support( 'experimental-custom-spacing' );
    add_theme_support( 'experimental-link-color' );
    add_theme_support( 'custom-units', 'px', 'rem', 'em', 'vw', 'vh' );
    add_theme_support( 'custom-line-height' );

    /* ---------------------------------------------------------------------------------------------
       CUSTOM SIZE IMAGE
    ------------------------------------------------------------------------------------------------ */
    add_image_size( 'dierreweb_big', 1400, 800, true );
    add_image_size( 'dierreweb_quad', 800, 800, true ); // 1080, 9999
    add_image_size( 'dierreweb_single', 1200, 900, true) ;

    /* ---------------------------------------------------------------------------------------------
       LOAD THEME LANGUAGES
    ------------------------------------------------------------------------------------------------ */
    load_theme_textdomain( 'dr', DIERREWEB_THEMEROOT . '/languages' );

    /* ---------------------------------------------------------------------------------------------
       SET NAME MENU
    ------------------------------------------------------------------------------------------------ */
    $locations = array(
      'header'      => esc_html__( 'Header', 'dr' ),
      'mobile_menu' => esc_html__( 'Mobile Menu', 'dr' )
		);

    register_nav_menus( $locations );
  }
  add_action( 'after_setup_theme', 'dierreweb_theme_setup' );
}

/* ---------------------------------------------------------------------------------------------
   SET UP WIDGETS
------------------------------------------------------------------------------------------------ */
if( !function_exists( 'dierreweb_sidebars' ) ) {
  function dierreweb_sidebars() {
    register_sidebar( array(
      'name'          => esc_html__( 'Main Widget Area', 'dr' ),
      'id'            => 'primary',
      'description'   => esc_html__( 'Default Widget Area for posts and pages', 'dr' ),
      'before_widget' => '<div id="%1$s" class="sidebar-widget widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>'
      )
    );

    register_sidebar( array(
      'name'          => esc_html__( 'Area after the mobile menu', 'dr' ),
      'id'            => 'widget-mobile',
      'description'   => esc_html__( 'Place your widgets that will be displayed after the mobile menu links', 'dr' ),
      'before_widget' => '<div id="%1$s" class="sidebar-widget widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>'
      )
    );

    if( !get_theme_mod( 'footer_widget' ) ) {
      register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar 1', 'dr' ),
        'id'            => 'footer-sidebar-1',
        'description'   => esc_html__( 'Appears in the footer area.', 'dr' ),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        )
      );

      register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar 2', 'dr' ),
        'id'            => 'footer-sidebar-2',
        'description'   => esc_html__( 'Appears in the footer area.', 'dr' ),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        )
      );

      register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar 3', 'dr' ),
        'id'            => 'footer-sidebar-3',
        'description'   => esc_html__( 'Appears in the footer area.', 'dr' ),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        )
      );

      register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar 4', 'dr' ),
        'id'            => 'footer-sidebar-4',
        'description'   => esc_html__( 'Appears in the footer area.', 'dr' ),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        )
      );
    }
  }
  add_action( 'widgets_init', 'dierreweb_sidebars' );
}

/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR SETTINGS
   Add custom colors and font sizes to the block editor
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_block_editor_settings' ) ) {
	function dierreweb_block_editor_settings() {
		/* Block Editor Palette -------------- */
		$editor_color_palette = array();
		/* Get the color options -------------- */
		$dierreweb_accent_color_options = Dierreweb_Customize::dierreweb_get_color_options();

		/* Loop over them and construct an array for the editor-color-palette -------------- */
		if( $dierreweb_accent_color_options ) {
			foreach( $dierreweb_accent_color_options as $color_option_name => $color_option ) {
				$editor_color_palette[] = array(
					'name'  => $color_option['label'],
					'slug'  => $color_option['slug'],
					'color' => get_theme_mod( $color_option_name, $color_option['default'] )
				);
			}
		}

		/* Add the background option -------------- */
		$background_color = get_theme_mod( 'background_color' );

		if( !$background_color ) {
			$background_color_arr = get_theme_support( 'custom-background' );
			$background_color = $background_color_arr[0]['default-color'];
		}

		$editor_color_palette[] = array(
			'name'  => esc_html__( 'Background Color', 'dr' ),
			'slug'  => 'background',
			'color' => '#' . $background_color,
		);

		/* If we have accent colors, add them to the block editor palette -------------- */
		if( $editor_color_palette ) {
			add_theme_support( 'editor-color-palette', $editor_color_palette );
		}

		/* Block Editor Font Sizes ----------- */
		add_theme_support( 'editor-font-sizes',
			array(
				array(
					'name'      => _x( 'Small', 'Name of the small font size in Gutenberg', 'dr' ),
					'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'dr' ),
					'size'      => 16,
					'slug'      => 'small'
				),
				array(
					'name'      => _x( 'Regular', 'Name of the regular font size in Gutenberg', 'dr' ),
					'shortName' => _x( 'M', 'Short name of the regular font size in the Gutenberg editor.', 'dr' ),
					'size'      => 19,
					'slug'      => 'normal'
				),
				array(
					'name'      => _x( 'Large', 'Name of the large font size in Gutenberg', 'dr' ),
					'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'dr' ),
					'size'      => 24,
					'slug'      => 'large'
				),
				array(
					'name'      => _x( 'Larger', 'Name of the larger font size in Gutenberg', 'dr' ),
					'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'dr' ),
					'size'      => 32,
					'slug'      => 'larger'
				)
			)
		);
	}
	add_action( 'after_setup_theme', 'dierreweb_block_editor_settings' );
}


/* ---------------------------------------------------------------------------------------------
   REGISTER PLUGINS NECESSARY FOR THE THEME
------------------------------------------------------------------------------------------------ */
if( !function_exists( 'dierreweb_register_required_plugins' ) ) {
  function dierreweb_register_required_plugins() {
    $plugins = array(
      // array(
      //   'name'     => 'Dierreweb Core',
      //   'slug'     => 'dierreweb-core',
      //   'source'   => DIERREWEB_PLUGIN . '/dierreweb-core.zip',
      //   'required' => true
      // ),
      array(
        'name'     => 'CMB2',
        'slug'     => 'cmb2',
        'required' => true
      ),
      array(
        'name'     => 'Contact Form 7',
        'slug'     => 'contact-form-7',
        'required' => true
      ),
      array(
        'name'     => 'Custom Blocks',
        'slug'     => 'genesis-custom-blocks',
        'required' => true
      ),
      array(
        'name'     => 'Woocommerce',
        'slug'     => 'woocommerce',
        'required' => false
      ),
      array(
        'name'     => 'WordPress SEO',
        'slug'     => 'wordpress-seo',
        'required' => false
      ),
      array(
        'name'     => 'MailChimp for WordPress',
        'slug'     => 'mailchimp-for-wp',
        'required' => false
      ),
      array(
        'name'      => 'Safe SVG',
        'slug'      => 'safe-svg',
        'required'  => false
      )
    );

    $config = array(
      'id'           => 'tgmpa',
      'default_path' => '',
      'menu'         => 'tgmpa-install-plugins',
      'parent_slug'  => 'themes.php',
      'capability'   => 'edit_theme_options',
      'has_notices'  => true,
      'dismissable'  => true,
      'dismiss_msg'  => '',
      'is_automatic' => false,
      'message'      => '',
      'strings'      => array(
        'page_title'                  => esc_html__( 'Install Required Plugins', 'dr' ),
        'menu_title'                  => esc_html__( 'Install Plugins', 'dr' ),
        'installing'                  => esc_html__( 'Installing Plugin: %s', 'dr' ),
        'updating'                    => esc_html__( 'Updating Plugin: %s', 'dr' ),
        'oops'                        => esc_html__( 'Something went wrong with the plugin API.', 'dr' ),
        'notice_can_install_required' => _n_noop(
          'This theme requires the following plugin: %1$s.',
          'This theme requires the following plugins: %1$s.',
          'dr'
        ),
        'notice_can_install_recommended' => _n_noop(
          'This theme recommends the following plugin: %1$s.',
          'This theme recommends the following plugins: %1$s.',
          'dr'
        ),
        'notice_ask_to_update' => _n_noop(
          'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
          'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
          'dr'
        ),
        'notice_ask_to_update_maybe' => _n_noop(
          'There is an update available for: %1$s.',
          'There are updates available for the following plugins: %1$s.',
          'dr'
        ),
        'notice_can_activate_required' => _n_noop(
          'The following required plugin is currently inactive: %1$s.',
          'The following required plugins are currently inactive: %1$s.',
          'dr'
        ),
        'notice_can_activate_recommended' => _n_noop(
          'The following recommended plugin is currently inactive: %1$s.',
          'The following recommended plugins are currently inactive: %1$s.',
          'dr'
        ),
        'install_link' => _n_noop(
          'Begin installing plugin',
          'Begin installing plugins',
          'dr'
        ),
        'update_link' => _n_noop(
          'Begin updating plugin',
          'Begin updating plugins',
          'dr'
        ),
        'activate_link' => _n_noop(
          'Begin activating plugin',
          'Begin activating plugins',
          'dr'
        ),
        'plugin_activated'               => esc_html__( 'Plugin activated successfully.', 'dr' ),
        'activated_successfully'         => esc_html__( 'The following plugin was activated successfully:', 'dr' ),
        'plugin_already_active'          => esc_html__( 'No action taken. Plugin %1$s was already active.', 'dr' ),
        'plugin_needs_higher_version'    => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'dr' ),
        'complete'                       => esc_html__( 'All plugins installed and activated successfully. %1$s', 'dr' ),
        'dismiss'                        => esc_html__( 'Dismiss this notice', 'dr' ),
        'notice_cannot_install_activate' => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'dr' ),
        'contact_admin'                  => esc_html__( 'Please contact the administrator of this site for help.', 'dr' ),
        'nag_type'                       => 'notice-warning' // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
      )
    );
    tgmpa( $plugins, $config );
  }
  add_action( 'tgmpa_register', 'dierreweb_register_required_plugins' );
}
