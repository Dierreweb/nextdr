/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	/* ------------------------------------------------------------------------
	 * Site identity section
	 * ------------------------------------------------------------------------ */

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html ( newval );
		} );
	} );

	// Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	/* ------------------------------------------------------------------------
	 * Body background color section
	 * ------------------------------------------------------------------------ */

	// Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css( 'background-color', newval );
      $( '.bottom-shape' ).css( 'color', newval );
		});
	});

	/* ------------------------------------------------------------------------
	 * Body background image section
	 * ------------------------------------------------------------------------ */

	// Update site background image in real time...
	wp.customize( 'background_image', function( value ) {
		value.bind( function( newval ) {
			$( 'body.custom-background' ).css( 'background-image', newval );
		});
	});

	/* ------------------------------------------------------------------------
	 * Header image section
	 * ------------------------------------------------------------------------ */

	// Update site background image in real time...
	wp.customize( 'header_image', function( value ) {
		value.bind( function( newval ) {
			$( '.header' ).css( 'background-image', 'url( ' + newval + ' )' );
		});
	});

	/* ------------------------------------------------------------------------
	 * General section
	 * ------------------------------------------------------------------------ */

   // Remove comments on page
   wp.customize( 'comments_on_page', function( value ) {
 		value.bind( function( newval ) {
 			$( '.comments' ).toggle( this.newval );
 		});
 	 });

  // Sticky notification.
	wp.customize( 'sticky_notifications', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).toggleClass( 'has-notifications-sticky' );
		});
	});

	// // Update site logo width in real time...
	// wp.customize( 'dierreweb_logo_width', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( '.main-logo img' ).css( 'max-width', newval );
	// 	});
	// });
	//
	// // Update site sticky logo width in real time...
	// wp.customize( 'dierreweb_sticky_logo_width', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( '.sticky-logo img' ).css( 'max-width', newval );
	// 	});
	// });

	// // Update site background image in real time...
	// wp.customize( 'background_image', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( 'body' ).css( 'background-image', 'url( ' + newval + ' )' );
	// 	});
	// });
	//
	// // Update site header image in real time...
	// wp.customize( 'header_image', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( '.header' ).css( 'background-image', 'url( ' + newval + ' )' );
	// 	});
	// });


  /* ------------------------------------------------------------------------
   * Header section
   * ------------------------------------------------------------------------ */

  // Remove topbar
  wp.customize( 'dierreweb_header_topbar', function( value ) {
    value.bind( function( newval ) {
      $( '.topbar-header' ).toggle( this.newval );
    });
  });

  // Header topbar color scheme
	wp.customize( 'dierreweb_topbar_text_color', function( value ) {
		value.bind( function( newval ) {
			if( 'light' === newval ) {
				$( '.topbar-header' ).addClass( 'color-scheme-light' ).removeClass( 'color-scheme-dark' );
			} else {
				$( '.topbar-header' ).removeClass( 'color-scheme-light' ).addClass( 'copyrights-two-dark' );
			}
		});
	});

  // Header topbar layouts.
	wp.customize( 'dierreweb_header_topbar_columns', function( value ) {
		value.bind( function( newval ) {
			if( 'centered' === newval ) {
				$( '.topbar-header' ).addClass( 'topbar-centered' ).removeClass( 'topbar-two-columns' );
			} else {
				$( '.topbar-header' ).removeClass( 'topbar-centered' ).addClass( 'topbar-two-columns' );
			}
		});
	});

  // Update site topbar header text in real time...
  wp.customize( 'dierreweb_header_topbar_text', function( value ) {
    value.bind( function( newval ) {
      $( '.topbar-header .col-left' ).html( newval );
    });
  });

  // Update site topbar header text in real time...
  wp.customize( 'dierreweb_header_topbar_text2', function( value ) {
    value.bind( function( newval ) {
      $( '.topbar-header .col-right' ).html( newval );
    });
  });

	/* ------------------------------------------------------------------------
	 * Page title section
	 * ------------------------------------------------------------------------ */

   // Remove comments on page
   wp.customize( 'page_title_disable', function( value ) {
 		value.bind( function( newval ) {
 			$( '.class' ).toggle( this.newval );
 		});
 	 });

	// Cover header layouts.
 	wp.customize( 'page_title_align', function( value ) {
 		value.bind( function( newval ) {
 			if( 'center' === newval ) {
 				$( '.class' ).addClass( 'text-center' ).removeClass( 'text-left' );
 			} else {
 				$( '.class' ).removeClass( 'text-center' ).addClass( 'text-left' );
 			}
 		});
 	});

	// Header title colors
 	wp.customize( 'dierreweb_page_title_color', function( value ) {
 		value.bind( function( newval ) {
 			if( 'light' === newval ) {
 				$( '.class' ).addClass( 'color-scheme-light' ).removeClass( 'color-scheme-dark' );
 			} else {
 				$( '.class' ).removeClass( 'color-scheme-light' ).addClass( 'color-scheme-dark' );
 			}
 		});
 	});

  // Title size
	wp.customize( 'title_size', function( value ) {
 		value.bind( function( newval ) {
 			if( 'light' === newval ) {
 				$( '.class' ).addClass( 'class' ).removeClass( 'class' );
 			} else {
 				$( '.class' ).removeClass( 'class' ).addClass( 'class' );
 			}
 		});
 	});

	// Fixed background image
	wp.customize( 'fixed_background_image', function( value ) {
		value.bind( function( newval ) {
			$( '.class' ).toggleClass( 'cover-fixed' );
		});
	});

  // Remove breadcrumbs.
	wp.customize( 'breadcrumbs', function( value ) {
		value.bind( function( newval ) {
			$( '.breadcrumb' ).toggle( this.newval );
		});
	});

	// Add Yoast breadcrumbs for show
	wp.customize( 'yoast_woocommerce_breadcrumb', function( value ) {
		value.bind( function( newval ) {
			$( '.class' ).toggle( this.newval );
		});
	});

  // Add Yoast breadcrumbs for page
	wp.customize( 'yoast_dierreweb_breadcrumb', function( value ) {
		value.bind( function( newval ) {
			$( '.class' ).toggle( this.newval );
		});
	});

  /* ------------------------------------------------------------------------
	 * Footer section
	 * ------------------------------------------------------------------------ */

	// Remove footer
	wp.customize( 'dierreweb_disable_footer', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-container' ).toggle( this.newval );
		});
	});

	// Remove scroll button
	wp.customize( 'dierreweb_disable_scroll_to_top', function( value ) {
		value.bind( function( newval ) {
			$( '#button-top' ).toggle( this.newval );
		});
	});

	// Sticky footer.
	wp.customize( 'dierreweb_sticky_footer', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).toggleClass( 'has-sticky-footer-on' );
		});
	});

	// Footer color scheme
	wp.customize( 'dierreweb_footer_text_color', function( value ) {
		value.bind( function( newval ) {
			if( 'light' === newval ) {
				$( '.footer-container' ).addClass( 'color-scheme-light' ).removeClass( 'color-scheme-dark' );
			} else {
				$( '.footer-container' ).removeClass( 'color-scheme-light' ).addClass( 'copyrights-two-dark' );
			}
		});
	});

	// Footer background color...
	wp.customize( 'dierreweb_footer_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-container' ).css( 'background-color', newval );
		});
	})

	// Footer background image
	wp.customize( 'dierreweb_footer_background_image', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-container' ).css( 'background-image', 'url( ' + newval + ' )' );
		});
	});

	// Remove footer copyrights
	wp.customize( 'dierreweb_footer_copyright', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-copyrights' ).toggle( this.newval );
		});
	});

	// Footer copyrights layouts.
	wp.customize( 'dierreweb_footer_copyright_columns', function( value ) {
		value.bind( function( newval ) {
			if( 'centered' === newval ) {
				$( '.footer-copyrights' ).addClass( 'copyrights-centered' ).removeClass( 'copyrights-two-columns' );
			} else {
				$( '.footer-copyrights' ).removeClass( 'copyrights-centered' ).addClass( 'copyrights-two-columns' );
			}
		});
	});

	// Update site footer text in real time...
	wp.customize( 'dierreweb_footer_copyright_text', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-copyrights .col-left' ).html( newval );
		});
	});

	// Update site footer text in real time...
	wp.customize( 'dierreweb_footer_copyright_text2', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-copyrights .col-right' ).html( newval );
		});
	});

  // Update site prefooter text in real time...
	wp.customize( 'dierreweb_prefooter_area', function( value ) {
		value.bind( function( newval ) {
			$( '.prefooter .container' ).html( newval );
		});
	});

	/* ------------------------------------------------------------------------
	 * Blog section
	 * ------------------------------------------------------------------------ */

	// Blog layouts.
	wp.customize( 'dierreweb_post_grid_columns', function( value ) {
		value.bind( function( newval ) {
			if( '2' === newval ) {
				$( '.posts' ).addClass( 'columns-2' ).removeClass( 'columns-3' );
			} else {
				$( '.posts' ).removeClass( 'columns-2' ).addClass( 'columns-3' );
			}
		});
	});

	// Remove excerpts
	wp.customize( 'dierreweb_display_excerpts', function( value ) {
		value.bind( function( newval ) {
			$( '.post-content' ).toggle( this.newval );
		});
	});

	// Remove button read more
	wp.customize( 'dierreweb_display_read_more', function( value ) {
		value.bind( function( newval ) {
			$( '.read-more-section' ).toggle( this.newval );
		});
	});

	/* ------------------------------------------------------------------------
	 * Cookies section
	 * ------------------------------------------------------------------------ */

	// Cookies popup
	wp.customize( 'dierreweb_cookies_info', function( value ) {
		value.bind( function( newval ) {
			$( '.cookies-popup' ).toggle( this.newval );
		});
	});

	// Update cookies text in real time...
	wp.customize( 'dierreweb_cookies_text', function( value ) {
		value.bind( function( newval ) {
			$( '.cookies-info-text' ).html( newval );
		});
	});

	// Update site link color in real time...
	// wp.customize( 'link_textcolor', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( 'a' ).css( 'color', newval );
	// 	} );
	// } );

} )( jQuery );
