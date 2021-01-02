<?php

/* ---------------------------------------------------------------------------------------------
   DEFINE CONSTANTS
------------------------------------------------------------------------------------------------ */

define( 'DIERREWEB_THEME_DIR', get_template_directory_uri() ); // Public directory
define( 'DIERREWEB_THEMEROOT', get_template_directory() ); // Private directory
define( 'DIERREWEB_STYLES', DIERREWEB_THEME_DIR . '/css' );
define( 'DIERREWEB_IMAGES', DIERREWEB_THEME_DIR . '/img' );
define( 'DIERREWEB_SCRIPTS', DIERREWEB_THEME_DIR . '/js' );
define( 'DIERREWEB_FRAMEWORK', DIERREWEB_THEME_DIR . '/inc' );

/* ---------------------------------------------------------------------------------------------
   LOAD ALL CORE CLASSES AND FILES
------------------------------------------------------------------------------------------------ */

require_once( 'blocks/actions-create-blocks.php' );
require_once( 'inc/customizer/customizer.php' );
require_once( 'inc/menu/menu.php' );
require_once( 'inc/metaboxes/metaboxes.php' );
require_once( 'inc/options/options.php' );
require_once( 'inc/shortcode/shortcode.php' );
require_once( 'inc/elements/elements.php' );
require_once( 'inc/integrations/integrations.php' );
require_once( 'inc/widgets/widgets.php' );
require_once( 'inc/functions.php' );
require_once( 'inc/helpers.php' );
require_once( 'inc/template-tags.php' );
require_once( 'inc/theme-setup.php' );

/* ---------------------------------------------------------------------------------------------
   INCLUDE CSS FILES
------------------------------------------------------------------------------------------------ */

if( !function_exists('dierreweb_styles') ) {
  function dierreweb_styles() {
    $theme_version = dierreweb_get_theme_info( 'Version' );
    $css_dependencies = array();

    wp_enqueue_style( 'dierreweb-dierreweb-grid', esc_url( DIERREWEB_STYLES ) . '/bootstrap.min.css', array(), $theme_version );
    // wp_enqueue_style('dierreweb-dierreweb-setting', DIERREWEB_STYLES . '/dierreweb-setting.css', array(), $theme_version);
    wp_enqueue_style( 'dierreweb-owl-carousel', esc_url( DIERREWEB_STYLES ) . '/owl.carousel.min.css', array(), $theme_version );
    wp_enqueue_style( 'dierreweb-magnific-popup', esc_url( DIERREWEB_STYLES ) . '/magnific-popup.min.css', array(), $theme_version );
    wp_enqueue_style( 'dierreweb-gutenberg', esc_url( DIERREWEB_STYLES ) . '/prova.css', array(), $theme_version );
    wp_enqueue_style( 'dierreweb-pets-icons', esc_url( DIERREWEB_STYLES ) . '/flaticon.css', array(), $theme_version );

    /* Remove style contact form 7 -------------- */
    wp_deregister_style( 'contact-form-7' );
		wp_dequeue_style( 'contact-form-7' );
    wp_deregister_style( 'contact-form-7-rtl' );
		wp_dequeue_style( 'contact-form-7-rtl' );

    /* Retrieve the Google Fonts URL and add it as a dependency -------------- */
    // $google_fonts_url = Dierreweb_Google_Fonts::get_google_fonts_url();
    //
		// if( $google_fonts_url ) {
    //   /* Enqueue style for Google Fonts -------------- */
		// 	wp_register_style( 'dierreweb-google-fonts', $google_fonts_url, false, $theme_version, 'all' );
		// 	$css_dependencies[] = 'dierreweb-google-fonts';
		// }

    /* Filter the list of dependencies used by the dierreweb-style CSS enqueue -------------- */
    $css_dependencies = apply_filters( 'dierreweb_css_dependencies', $css_dependencies );

    wp_enqueue_style( 'dierreweb-style', esc_url( DIERREWEB_THEME_DIR ) . '/style.css', $css_dependencies, $theme_version, 'all' );
    /* Add output of Customizer settings as inline style -------------- */
		//wp_add_inline_style( 'dierreweb-style', DierreWeb_Custom_CSS::get_customizer_css( 'front-end' ) );
  }
  add_action( 'wp_enqueue_scripts', 'dierreweb_styles', 10000 );
}

/* ---------------------------------------------------------------------------------------------
   INCLUDE JAVASCRIPT FILES
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_scripts' ) ) {
  function dierreweb_scripts() {

		$theme_version = dierreweb_get_theme_info( 'Version' );
    $js_dependencies = array( 'jquery', 'imagesloaded', 'masonry' );

    if( ( !is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply', false, array(), $theme_version );
    }

    wp_register_script( 'dierreweb-justifiedGallery', dierreweb_get_script_url( 'jquery.justifiedGallery' ), array(), $theme_version, true );

    wp_enqueue_script( 'dierreweb-compressed', dierreweb_get_script_url( 'compressed' ), array( 'jquery' ), $theme_version, true );
    wp_enqueue_script( 'dierreweb-functions', esc_url( DIERREWEB_SCRIPTS ) . '/functions.js', $js_dependencies, $theme_version, true ) ;

    $translations = array(
      'current_blog_id' => get_current_blog_id(),
      'cookies_version' => ( get_theme_mod( 'dierreweb_cookies_version' ) ) ? (int)get_theme_mod( 'cookies_version' ) : 1,
      'enable_popup' => ( get_theme_mod( 'dierreweb_popup_display' ) ) ? 'true' : 'false',
      'popup_delay' => ( get_theme_mod( 'dierreweb_popup_delay' ) ) ? (int) get_theme_mod( 'dierreweb_popup_delay' ) : 1000,

      'popup_event' => get_theme_mod( 'popup_event' ),
      'popup_scroll' => ( get_theme_mod( 'popup_scroll' ) ) ? (int) get_theme_mod( 'popup_scroll' ) : 1000,
			'popup_pages' => ( get_theme_mod( 'dierreweb_popup_pages' ) ) ? (int) get_theme_mod( 'popup_pages' ) : 0,
			'popup_hide_mobile' => ( get_theme_mod( 'dierreweb_popup_hide_mobile' ) ) ? 'true' : 'false',
      'popup_version' => ( get_theme_mod( 'dierreweb_popup_version' ) ) ? (int)get_theme_mod( 'dierreweb_popup_version' ) : 1,

      'loading' => esc_html__( 'Loading...', 'dr' ),
      'close' => esc_html__( 'Close (Esc)', 'dr' ),
      'one_page_menu_offset' => apply_filters( 'dierreweb_one_page_menu_offset', 150 ),

      'preloader_delay' => apply_filters( 'dierreweb_preloader_delay', 300 ),
      //'woo_installed' => dierreweb_woocommerce_installed(),
      // 'age_verify_expires' => apply_filters('woodmart_age_verify_expires', 30),
      // 'age_verify_expires' => apply_filters( 'woodmart_age_verify_expires', 30 ),

			'header_banner_close_btn' => get_theme_mod( 'header_close_btn' ),
			'header_banner_enabled' => get_theme_mod( 'header_banner' ),
      'lazy_loading_offset' => get_theme_mod( 'lazy_loading_offset' ),

			'loading' => esc_html__('Loading...', 'dr' ),
			'ajaxurl' => admin_url('admin-ajax.php'),
		);

    /* Add inline script from the Customizer -------------- */
    wp_add_inline_script( 'dierreweb-functions', dierreweb_settings_js(), 'after' );

    /* Localize script for JS -------------- */
		wp_localize_script( 'dierreweb-functions', 'dierreweb_settings', $translations );

  }
  add_action( 'wp_enqueue_scripts', 'dierreweb_scripts', 10000 );
}

/* ---------------------------------------------------------------------------------------------
   GET SCRPT URL
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_script_url') ) {
	function dierreweb_get_script_url( $script_name ) {
	   return esc_url( DIERREWEB_SCRIPTS . '/' . $script_name . '.min.js' );
	}
}

/* ---------------------------------------------------------------------------------------------
   INCLUDE JAVASCRIPT FILES FOR CUSTOMIZER
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_customizer_live_preview' ) ) {
  function dierreweb_customizer_live_preview() {
    $theme_version = dierreweb_get_theme_info( 'Version' );
  	wp_enqueue_script( 'dierreweb-theme-cutomizer', esc_url( DIERREWEB_SCRIPTS ) . '/theme-customizer.js', array( 'jquery' ), $theme_version, true );
  }
  add_action( 'customize_preview_init', 'dierreweb_customizer_live_preview' );
}

/*	-----------------------------------------------------------------------------------------------
	EDITOR STYLES FOR THE BLOCK EDITOR
--------------------------------------------------------------------------------------------------- */
//
// if( !function_exists( 'dierreweb_block_editor_styles' ) ) {
// 	function dierreweb_block_editor_styles() {
//     $theme_version = dierreweb_get_theme_info( 'Version' );
// 		$css_dependencies = array();
//
// 		/* Retrieve the Google Fonts URL and add it as a dependency -------------- */
// 		// $google_fonts_url = Dierreweb_Google_Fonts::get_google_fonts_url();
//     //
// 		// if( $google_fonts_url ) {
//     //   /* Register style for Google Fonts -------------- */
// 		// 	wp_register_style( 'dierreweb_google_fonts', $google_fonts_url, false, $theme_version, 'all' );
// 		// 	$css_dependencies[] = 'dierreweb_google_fonts';
// 		// }
//
// 		/* Enqueue the editor styles -------------- */
// 		wp_enqueue_style( 'dierreweb_block_editor_styles', get_theme_file_uri( 'css/dierreweb-editor-style-block-editor.css' ), $css_dependencies, $theme_version, 'all' );
// 		/* Add inline style from the Customizer -------------- */
// 		wp_add_inline_style( 'dierreweb_block_editor_styles', Dierreweb_Custom_CSS::get_customizer_css( 'block-editor' ) );
// 	}
// 	add_action( 'enqueue_block_editor_assets', 'dierreweb_block_editor_styles', 1, 1 );
// }


/* ---------------------------------------------------------------------------------------------
   EDITOR STYLES FOR THE CLASSIC EDITOR
------------------------------------------------------------------------------------------------ */

// if( !function_exists( 'dierreweb_classic_editor_styles' ) ) {
// 	function dierreweb_classic_editor_styles() {
// 		$classic_editor_styles = array( 'css/dierreweb-editor-style-classic-editor.css' );
// 		/* Retrieve the Google Fonts URL and add it as a dependency -------------- */
// 		$google_fonts_url = Dierreweb_Google_Fonts::get_google_fonts_url();
//
// 		if( $google_fonts_url ) {
// 			$classic_editor_styles[] = $google_fonts_url;
// 		}
// 		add_editor_style( $classic_editor_styles );
// 	}
// 	add_action( 'init', 'dierreweb_classic_editor_styles' );
// }


/* ---------------------------------------------------------------------------------------------
   OUTPUT OF CUSTOMIZER SETTINGS IN THE CLASSIC EDITOR
   Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
------------------------------------------------------------------------------------------------ */

// if( !function_exists( 'dierreweb_add_classic_editor_customizer_styles' ) ) {
// 	function dierreweb_add_classic_editor_customizer_styles( $mce_init ) {
// 		$styles = Dierreweb_Custom_CSS::get_customizer_css( 'classic-editor' );
// 		if( !isset( $mce_init[ 'content_style' ] ) ) {
// 			$mce_init[ 'content_style' ] = $styles . ' ';
// 		} else {
// 			$mce_init[ 'content_style' ] .= ' ' . $styles . ' ';
// 		}
// 		return $mce_init;
// 	}
// 	add_filter( 'tiny_mce_before_init', 'dierreweb_add_classic_editor_customizer_styles' );
// }

/* ---------------------------------------------------------------------------------------------
   ADD BUTTON NEXT TO WYSIWYG EDITOR
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_wysiwyg_editor' ) ) {
  function dierreweb_wysiwyg_editor( $mce_buttons ) {
    $pos = array_search( 'wp_more', $mce_buttons, true );

    if( $pos !== false ) {
      $tmp_buttons = array_slice( $mce_buttons, 0, $pos + 1 );
      $tmp_buttons[] = 'wp_page';
      $mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos + 1 ) );
    }
    return $mce_buttons;
  }
  add_filter( 'mce_buttons', 'dierreweb_wysiwyg_editor' );
}

/* ---------------------------------------------------------------------------------------------
   ESCAPE TITLE FUNCTION
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_escape_title' ) ) {
  function dierreweb_escape_title( $title ) {
    return esc_html( $title );
  }
  add_filter( 'the_title', 'dierreweb_escape_title' );
}

/* ---------------------------------------------------------------------------------------------
   TAG READ MORE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_modify_read_more_link' ) ) {
	function dierreweb_modify_read_more_link() {
		return '</p><p class="read-more-section">' . dierreweb_read_more_tag();
	}
	add_filter( 'the_content_more_link', 'dierreweb_modify_read_more_link' );
}

/* ---------------------------------------------------------------------------------------------
   READ MORE LENGTH
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_excerpt_length' ) ) {
	function dierreweb_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'dierreweb_excerpt_length', 999 ) ;
}

/* ---------------------------------------------------------------------------------------------
   READ MORE BULLETS
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_new_excerpt_more' ) ) {
	function dierreweb_new_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'dierreweb_new_excerpt_more' );
}

/* ---------------------------------------------------------------------------------------------
   READ MORE LINK
------------------------------------------------------------------------------------------------ */

if( !function_exists('dierreweb_read_more_tag' ) ) {
	function dierreweb_read_more_tag() {
		return '<a class="btn-read-more more-link" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Continue reading', 'dr' ) . '</a>';
	}
}

/* ---------------------------------------------------------------------------------------------
   EDIT TAG BUTTON
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_add_class_the_tags' ) ) {
  function dierreweb_add_class_the_tags( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a', '<a class="btn-tag"', $html );

    return $html;
  }
  add_filter( 'the_tags', 'dierreweb_add_class_the_tags' );
}

/* ---------------------------------------------------------------------------------------------
  EDIT CLASS TAG BUTTON WIDGET
------------------------------------------------------------------------------------------------ */

add_filter( 'wp_generate_tag_cloud_data', function( $tag_data ) {
  return array_map( function( $item ) {
    $item['class'] .= esc_attr( ' btn-tag' );
    return $item;
  },
  (array) $tag_data
  );
});

/* ---------------------------------------------------------------------------------------------
   EDIT FONT SIZE WIDGET TAG
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_tag_cloud' ) ) {
  function dierreweb_tag_cloud( $tag_string ) {
    return preg_replace( '/style=("|\')(.*?)("|\')/','', $tag_string );
  }
  add_filter( 'wp_generate_tag_cloud', 'dierreweb_tag_cloud', 10, 1 );
}

/* ---------------------------------------------------------------------------------------------
   EDIT WIDGET CATEGORIES
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_categories_postcount_filter' ) ) {
  function dierreweb_categories_postcount_filter( $variable ) {
    $variable = str_replace( '(', '<span class="post-count"> ', $variable );
    $variable = str_replace( ')', ' </span>', $variable );

    return $variable;
  }
  add_filter( 'wp_list_categories','dierreweb_categories_postcount_filter' );
}

/* ---------------------------------------------------------------------------------------------
   COUNT NUMBER POSTS TO RELATIVE POSTS ARCHIVE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_archives_postcount_filter' ) ) {
  function dierreweb_archives_postcount_filter( $variable ) {
    $variable = str_replace( '(', '<span class="post-count"> ', $variable );
    $variable = str_replace( ')', ' </span>', $variable );

     return $variable;
  }
  add_filter( 'get_archives_link','dierreweb_archives_postcount_filter' );
}

/* ---------------------------------------------------------------------------------------------
   REMOVE WEBSITE FIELD FROM COMMENTS
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_website_remove' ) ) {
  function dierreweb_website_remove( $fields ) {
    if( isset( $fields['url'] ) )
    unset( $fields['url'] );

    return $fields;
  }
  add_filter( 'comment_form_default_fields', 'dierreweb_website_remove' );
}

/* ---------------------------------------------------------------------------------------------
   ADD POST COMMENTS BUTTON
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_wpdocs_comment_form_defaults' ) ) {
  function dierreweb_wpdocs_comment_form_defaults( $defaults ) {
    $defaults['class_submit'] = 'btn btn-primary';

    return $defaults;
  }
  add_filter( 'comment_form_defaults', 'dierreweb_wpdocs_comment_form_defaults' );
}

/* ---------------------------------------------------------------------------------------------
   BROWSER BAR COLOR
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_browser_bar_color' ) ) {
	function dierreweb_browser_bar_color() {
		echo '<meta name="theme-color" content="' . get_theme_mod( 'dierreweb_primary_color' ) . '">';
		echo '<meta name="msapplication-navbutton-color" content="#A14CFF">';
		echo '<meta name="apple-mobile-web-app-status-bar-style" content="#A14CFF">';
		echo '<meta name="msapplication-TileColor" content="#A14CFF">';
	}
	add_filter( 'wp_head', 'dierreweb_browser_bar_color', 0) ;
}

/* ---------------------------------------------------------------------------------------------
   FUNCTION CUSTOM 404 PAGE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_custom_404_page' ) ) {
	function dierreweb_custom_404_page( $template ) {

		global $wp_query;

		$custom_404 = get_theme_mod( 'custom_404_page' );

		if($custom_404 == 'default' || empty( $custom_404 ) ) return $template;

		$wp_query->query( 'page_id=' . $custom_404 );
		$wp_query->the_post();
		$template = get_page_template();
		rewind_posts();

		return $template;
	}
	add_filter( '404_template', 'dierreweb_custom_404_page', 999 );
}

/* ---------------------------------------------------------------------------------------------
   HIDE PAGES FROM SEARCH
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_search_filter' ) ) {
  function dierreweb_search_filter( $query ) {
    if( !is_admin() && $query->is_main_query() ) {
      if( $query->is_search ) {
        $query->set( 'post_type', 'post' );
      }
    }
  }
  add_action( 'pre_get_posts', 'dierreweb_search_filter' );
}

/* ---------------------------------------------------------------------------------------------
   ADD TAGS TO SEARCH
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_custom_search_where' ) ) {
  function dierreweb_custom_search_where( $where ) {
    global $wpdb;
    if( is_search() )
    $where .= "OR (t.name LIKE '%" . get_search_query() . "%' AND {$wpdb->posts}.post_status = 'publish')";

    return $where;
  }
  add_filter( 'posts_where', 'dierreweb_custom_search_where' );
}

/* ---------------------------------------------------------------------------------------------
   CUSTOM SEARCH
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_custom_search_join' ) ) {
  function dierreweb_custom_search_join( $join )  {
    global $wpdb;
    if( is_search() )
    $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";

    return $join;
  }
  add_filter( 'posts_join', 'dierreweb_custom_search_join' );
}

/* ---------------------------------------------------------------------------------------------
   CUSTOM SEARCH
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_custom_search_groupb' ) ) {
  function dierreweb_custom_search_groupby( $groupby ) {
    global $wpdb;
    $groupby_id = "{$wpdb->posts}.ID";
    if( !is_search() || strpos( $groupby, $groupby_id ) !== false ) return $groupby;
    if( !strlen( trim( $groupby ) ) ) return $groupby_id;

    return $groupby . ", " . $groupby_id;
  }
  add_filter( 'posts_groupby', 'dierreweb_custom_search_groupby' );
}

/* ---------------------------------------------------------------------------------------------
   RESPONSIVE CONTAINER TO EMBED
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_oembed_html' ) ) {
  function dierreweb_oembed_html( $html, $url, $attr, $post_ID ) {
    $iframe = str_replace( '<iframe', '<iframe class="embed-responsive-item"', $html );
    $newHtml = '<div class="embed-responsive embed-responsive-16by9">%s</iframe></div>';
    $html = sprintf( $newHtml, $iframe );

    return $html;
  }
  add_filter( 'embed_oembed_html', 'dierreweb_oembed_html', 10, 4 );
}

/* ---------------------------------------------------------------------------------------------
   CLASS COLUMNS BACKEND PAGE AND POSTS
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'Dierreweb_Columns' ) ) {
  class Dierreweb_Columns {

    public function __construct() {
      add_filter( 'manage_posts_columns', array( $this, 'dierreweb_posts_columns' ) );
      add_filter( 'manage_pages_columns', array( $this, 'dierreweb_pages_columns' ) );
      add_action( 'manage_posts_custom_column', array( $this, 'dierreweb_manage_posts_columns' ), 10, 2 );
      add_action( 'manage_pages_custom_column', array( $this, 'dierreweb_manage_posts_columns' ), 10, 2 );
    }

    /* ---------------------------------------------------------------------------------------------
       MANAGE POSTS LIST COLUMNS
    ------------------------------------------------------------------------------------------------ */

    public function dierreweb_posts_columns( $columns ) {
      $columns = array(
        'cb'         => '<input type="checkbox"/>',
        'thumb'      => esc_html__( 'Thumbnail', 'dr' ),
        'title'      => esc_html__( 'Title', 'dr' ),
        'author'     => esc_html__( 'Author', 'dr' ),
        'categories' => esc_html__( 'Categories', 'dr' ),
        'tags'       => esc_html__( 'Tags', 'dr' ),
        'comments'   => '<span class="vers comment-grey-bubble" title="' . esc_html__( 'Comments', 'dr' ) . '"><span class="screen-reader-text">' . esc_html__( 'Comments', 'dr' ) . '</span></span>',
        'date'       => esc_html__( 'Date', 'dr' )
      );

      return $columns;
    }

    /* ---------------------------------------------------------------------------------------------
       MANAGE PAGES LIST COLUMNS
    ------------------------------------------------------------------------------------------------ */

    public function dierreweb_pages_columns( $columns ) {
      $columns = array(
        'cb'       => '<input type="checkbox"/>',
        'thumb'    => esc_html__( 'Thumbnail', 'dr' ) ,
        'title'    => esc_html__( 'Title', 'dr' ) ,
        'author'   => esc_html__( 'Author', 'dr' ),
        'comments' => '<span class="vers comment-grey-bubble" title="' . esc_html__( 'Comments', 'dr' ) . '"><span class="screen-reader-text">' . esc_html__( 'Comments', 'dr' ) . '</span></span>',
        'date'     => esc_html__( 'Date', 'dr' )
      );
      return $columns;
    }

    /* ---------------------------------------------------------------------------------------------
       EXTENDS COLUMNS TO POST AND PAGES
    ------------------------------------------------------------------------------------------------ */

    public function dierreweb_manage_posts_columns( $column, $post_id ) {
      switch( $column ) {
      case 'thumb':
        if( has_post_thumbnail( $post_id ) ) {
          the_post_thumbnail( array( 60, 60 ) );
        } else {
  				echo esc_html__( 'No Thumbnail', 'dr' );
  			}
      break;
      }
    }
  }

}

$dierreweb_columns = new Dierreweb_Columns;

/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_body_class' ) ) {
	function dierreweb_body_class( $classes ) {

		global $post;
		$post_type = isset( $post ) ? $post->post_type : false;

		// Check if we have an overlay logo
		if( get_theme_mod( 'sticky_logo' ) ) {
			$classes[] = 'has-sticky-logo';
		}

    // Theme name
		$classes[] = 'dierreweb-theme';
    // Form style
		$classes[] = 'form-style-' . get_theme_mod( 'dierreweb_forms_style', 'rounded' );
    // Form width
    $classes[] = 'form-border-width-' . get_theme_mod( 'dierreweb_forms_width', '2' );
    // Sticky notifications
		if( !get_theme_mod( 'sticky_notifications' ) ) {
			$classes[] = 'has-notifications-sticky';
		}
    // Sticky footer
		if( get_theme_mod( 'dierreweb_sticky_footer' ) ) {
			$classes[] = 'has-sticky-footer-on';
		}
    // Sticky social
		if( get_theme_mod( 'dierreweb_sticky_social_enable', false ) ) {
			$classes[] = 'has-sticky-social';
		}
		// Check whether we're in the customizer preview
		if( is_customize_preview() ) {
			$classes[] = 'customizer-preview';
		}
    // Archive blog
    if( dierreweb_is_blog_archive() ) {
			$classes[] = 'has-archive-blog';
		}
    // Adoption archive
    if( dierreweb_is_adoption_archive() ) {
			$classes[] = 'has-archive-adoption';
		}
		// Slim page template class names (class = name - file suffix)
		if( ( !is_page_template( array( 'maintenance.php' ) ) ) && is_page_template() || is_attachment() ) {
			$classes[] = 'has-no-sticky-sidebar';
		} else {
			$classes[] = 'has-sticky-sidebar';
		}
		// Check for post thumbnail
		if( is_singular() && has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		} elseif( is_singular() ) {
			$classes[] = 'missing-post-thumbnail';
		}
		// Check if posts have single pagination
		if( is_single() && ( get_next_post() || get_previous_post() ) ) {
			$classes[] = 'has-single-pagination';
		} else {
			$classes[] = 'has-no-pagination';
		}
		// Check if we're showing comments
		if( is_singular() && ( (comments_open() || get_comments_number() ) && !post_password_required() ) ) {
			$classes[] = 'showing-comments';
		} else {
			$classes[] = 'not-showing-comments';
		}
		// Slim page template class names (class = name - file suffix)
		if( is_page_template() ) {
			$classes[] = basename( get_page_template_slug(), '.php' );
		}

    return $classes;
	}
  add_filter( 'body_class', 'dierreweb_body_class' );
}


/**
 * ------------------------------------------------------------------------------------------------
 * My account navigation
 * ------------------------------------------------------------------------------------------------
 */
// if ( ! function_exists( 'dierreweb_my_account_navigation' ) ) {
// 	function dierreweb_my_account_navigation( $items ) {
// 		$user_info = get_userdata( get_current_user_id() );
// 		$user_roles = $user_info && property_exists( $user_info, 'roles' ) ? $user_info->roles : array();
//
// 		unset( $items['customer-logout'] );
//
// 		$items['customer-logout'] = esc_html__( 'Logout', 'woodmart' );
//
// 		return $items;
// 	}
//
// 	add_filter( 'woocommerce_account_menu_items', 'dierreweb_my_account_navigation', 15 );
// }

// if ( ! function_exists( 'dierreweb_my_account_navigation_endpoint_url' ) ) {
// 	function dierreweb_my_account_navigation_endpoint_url( $url, $endpoint, $value, $permalink ) {
//
// 		return $url;
// 	}
//
// 	add_filter( 'woocommerce_get_endpoint_url', 'dierreweb_my_account_navigation_endpoint_url', 15, 4 );
// }

/**
 * ------------------------------------------------------------------------------------------------
 * Register new image size two times larger than standard woocommerce one
 * ------------------------------------------------------------------------------------------------
 */

// if( ! function_exists( 'dierreweb_add_image_size' ) ) {
// 	function dierreweb_add_image_size() {
//
// 		if( ! function_exists( 'wc_get_image_size' ) ) return;
//
// 		$shop_catalog = wc_get_image_size( 'woocommerce_thumbnail' );
//
// 		$width = (int) ( $shop_catalog['width'] * 2 );
// 		$height = ( !empty( $shop_catalog['height'] ) ) ? (int) ( $shop_catalog['height'] * 2 ) : '';
//
// 		add_image_size( 'woodmart_shop_catalog_x2', $width, $height, $shop_catalog['crop'] );
// 	}
//   add_action( 'after_setup_theme', 'dierreweb_add_image_size' );
// }



/**
 * ------------------------------------------------------------------------------------------------
 * Checkout steps in page title
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'dierreweb_checkout_steps' ) ) {
	function dierreweb_checkout_steps() {

		?>
            <div class="woodmart-checkout-steps">
                <ul>
                	<li class="step-cart <?php echo (is_cart()) ? 'step-active' : 'step-inactive'; ?>">
                		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                			<span><?php esc_html_e('Shopping cart', 'dr'); ?></span>
                		</a>
                	</li>
                	<li class="step-checkout <?php echo (is_checkout() && ! is_order_received_page()) ? 'step-active' : 'step-inactive'; ?>">
                		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
                			<span><?php esc_html_e('Checkout', 'dr'); ?></span>
                		</a>
                	</li>
                	<li class="step-complete <?php echo (is_order_received_page()) ? 'step-active' : 'step-inactive'; ?>">
                		<span><?php esc_html_e('Order complete', 'dr'); ?></span>
                	</li>
                </ul>
            </div>
		<?php
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * My account sidebar
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'dierreweb_before_my_account_navigation' ) ) {
	function dierreweb_before_my_account_navigation() {
		echo '<div class="woodmart-my-account-sidebar">';
		if(!function_exists('woodmart_my_account_title')) {
			?>
				<h3 class="woocommerce-MyAccount-title entry-title">
					<?php echo get_the_title( wc_get_page_id( 'myaccount' ) ); ?>
				</h3>
			<?php
		}
	}

	add_action( 'woocommerce_account_navigation', 'dierreweb_before_my_account_navigation', 5 );
}

if( ! function_exists( 'dierreweb_product_zoom_button' ) ) {
	function dierreweb_product_zoom_button() {
		?>
			<div class="woodmart-show-product-gallery-wrap  wd-gallery-btn"><a href="#" class="woodmart-show-product-gallery"><span><?php esc_html_e('Click to enlarge', 'woodmart'); ?></span></a></div>
		<?php
	}
}
