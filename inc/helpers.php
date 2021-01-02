<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   HEADER MAINTENANCE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_needs_header' ) ) {
	function dierreweb_needs_header() {
		return ( !dierreweb_maintenance_page() );
	}
}

/* ---------------------------------------------------------------------------------------------
   FOOTER MAINTENANCE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_needs_footer' ) ) {
	function dierreweb_needs_footer() {
		return ( !dierreweb_maintenance_page() );
	}
}

/* ---------------------------------------------------------------------------------------------
   ALL BLOG ARCHIVE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_is_blog_archive' ) ) {
	function dierreweb_is_blog_archive() {
		return ( is_home() || is_search() || is_tag() || is_category() || is_date() || is_author() );
 	}
}

/* ---------------------------------------------------------------------------------------------
   ALL PORTFOLIO ARCHIVE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_is_adoption_archive' ) ) {
	function dierreweb_is_adoption_archive() {
		return ( is_post_type_archive( 'adoption' ) || is_tax( 'adopted' ) );
	}
}

/* ---------------------------------------------------------------------------------------------
   ALL SHOP ARCHIVE
------------------------------------------------------------------------------------------------ */

// if( !function_exists( 'dierreweb_is_shop_archive' ) ) {
// 	function dierreweb_is_shop_archive() {
// 		return ( dierreweb_woocommerce_installed() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || dierreweb_is_product_attribute_archieve() ) );
// 	}
// }

/* ---------------------------------------------------------------------------------------------
   IS SHOP ON FRONT PAGE
------------------------------------------------------------------------------------------------ */

if ( !function_exists( 'dierreweb_is_shop_on_front' ) ) {
	function dierreweb_is_shop_on_front() {
		return function_exists( 'wc_get_page_id' ) && 'page' === get_option( 'show_on_front' ) && wc_get_page_id( 'shop' ) == get_option( 'page_on_front' );
	}
}

/* ---------------------------------------------------------------------------------------------
   GET PAGE ID BY IT'S TEMPLATE NAME
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_tpl2id' ) ) {
	function dierreweb_tpl2id( $tpl = '' ) {
		$pages = get_pages( array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $tpl
		) );
		foreach( $pages as $page ){
			return $page->ID;
		}
	}
}

/* ---------------------------------------------------------------------------------------------
   THEME INFO
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_theme_info' ) ) {
	function dierreweb_get_theme_info( $parameter ) {
		$theme_info = wp_get_theme();
		if( is_child_theme() ){
			$theme_info = wp_get_theme( $theme_info->parent()->template );
		}

		return $theme_info->get( $parameter );
	}
}

/* ---------------------------------------------------------------------------------------------
   ALLOWED HTML
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_allowed_html' ) ) {
  function dierreweb_get_allowed_html() {
	   return apply_filters( 'dierreweb_allowed_html', array(
			'br'     => array(),
			'i'      => array(),
			'b'      => array(),
			'u'      => array(),
			'em'     => array(),
			'del'    => array(),
			'a'      => array(
				'href'  => true,
				'class' => true,
				'title' => true,
				'rel'   => true,
			),
			'strong' => array(),
			'span'   => array(
				'style' => true,
				'class' => true,
			)
		) );
	}
}

/* ---------------------------------------------------------------------------------------------
   GET SVG
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_the_theme_svg' ) ) {
	function dierreweb_the_theme_svg( $svg_name, $color = '' ) {
		echo dierreweb_get_theme_svg( $svg_name, $color );
	}
}

/* ---------------------------------------------------------------------------------------------
   SVG
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_theme_svg' ) ) {
	function dierreweb_get_theme_svg( $svg_name, $color = '' ) {
		$svg = wp_kses(
			Dierreweb_SVG_Icons::get_svg( $svg_name, $color ), array(
				'svg'     => array(
					'class'       => true,
					'xmlns'       => true,
					'width'       => true,
					'height'      => true,
					'viewbox'     => true,
					'aria-hidden' => true,
					'role'        => true,
					'focusable'   => true
				),
				'path'    => array(
					'fill'      => true,
					'fill-rule' => true,
					'd'         => true,
					'transform' => true
				),
				'polygon' => array(
					'fill'      => true,
					'fill-rule' => true,
					'points'    => true,
					'transform' => true,
					'focusable' => true
				)
			) );

		if( !$svg ) {
			return false;
		}

		return $svg;
	}
}

/* ---------------------------------------------------------------------------------------------
   GET PROTOCOL (http or https)
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_http' ) ) {
	function woodmart_http() {
		if( !is_ssl() ) {
			return 'http';
		} else {
			return 'https';
		}
	}
}

/* ---------------------------------------------------------------------------------------------
   REMOVE HTTPS
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'woodmart_remove_https' ) ) {
	function woodmart_remove_https( $link ) {
		return preg_replace( '#^https?:#', '', $link );
	}
}
