<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   GET LOGO
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_the_custom_logo' ) ) {
	function dierreweb_the_custom_logo( $logo_theme_mod = 'custom_logo' ) {
		echo esc_html( dierreweb_get_custom_logo( $logo_theme_mod ) );
	}
}

/* ---------------------------------------------------------------------------------------------
   LOGO
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_custom_logo' ) ) {

	function dierreweb_get_custom_logo( $logo_theme_mod = 'custom_logo' ) {

		// Main logo
		$logo = DIERREWEB_IMAGES . '/logo.png';
		$logo_id = get_theme_mod( $logo_theme_mod );
		if( !$logo_id ) return;
		$logo_main = wp_get_attachment_image_src( $logo_id, 'full' );

		// For clarity
		$logo_url = esc_url( $logo_main[0] );
		$logo_width = get_theme_mod( 'dierreweb_logo_width' );

		// Sticky logo
		$sticky_logo_id = get_theme_mod( 'dierreweb_sticky_logo' );
		$sticky_logo = wp_get_attachment_image_url( $sticky_logo_id, 'full' );

		// For clarity
		$sticky_logo_url = esc_url( $sticky_logo );
		$logo_sticky_width = get_theme_mod( 'dierreweb_sticky_logo_width' );

		if( isset( $logo_url ) && $logo_url != '' ) {
			$logo = $logo_url;
		}

		$has_logo_width = isset( $logo_width ) ? (int) $logo_width : 50;
		$has_sticky_logo = ( isset( $sticky_logo_url ) && !empty( $sticky_logo_url ) );
		$has_logo_sticky_width = isset( $logo_sticky_width ) ? (int) $logo_sticky_width : 50;

		// Record output
		ob_start();

		?>

		<div class="site-logo">
			<div class="logo-wrap<?php if( $has_sticky_logo )  echo esc_attr( ' switch-logo-enable' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo main-logo" rel="home">
					<img src="<?php echo esc_url( $logo ); ?>" style="max-width: <?php echo esc_attr( $has_logo_width ); ?>px" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			<?php if( $has_sticky_logo ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo sticky-logo" rel="home">
					<img src="<?php echo esc_url( $sticky_logo_url ) ; ?>" style="max-width: <?php echo esc_attr( $has_logo_sticky_width ); ?>px" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			<?php endif; ?>
			</div>
		</div>

		<?php

		// Return output
		// $output = ob_get_contents();
		// ob_end_clean();
		//
		// return $output;

		$output = ob_get_contents();


	}

}

/* ---------------------------------------------------------------------------------------------
   BREADCRUMBS
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_breadcrumbs' ) ) {
	function dierreweb_breadcrumbs() {

		$text['home'] = esc_html__( 'Home', 'dr' );
		$text['category'] = esc_html__( 'Archive by Category "%s"', 'dr' );
		$text['search'] = esc_html__( 'Search Results for "%s"', 'dr' );
		$text['tag'] = esc_html__( 'Posts Tagged "%s"', 'dr' );
		$text['author'] = esc_html__( 'Articles Posted by %s', 'dr' );
		$text['404'] = esc_html__( 'Error 404', 'dr' );

		$show_current_post  = 0;
		$show_current = 1;
		$show_on_home = 0;
		$show_home_link = 1;
		$show_title = 1;
		$delimiter = ' / ';
		$before = '<span class="current">';
		$after = '</span>';

		global $post;

		$home_link = home_url( '/' );
		$link_before = '<span typeof="v:Breadcrumb">';
		$link_after = '</span>';
		$link_attr = ' rel="v:url" property="v:title"';
		$link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
		$parent_id = $parent_id_2 = ( !empty( $post ) && is_a( $post, 'WP_Post' ) ) ? $post->post_parent : 0;
		$frontpage_id = get_option( 'page_on_front' );
		$projects_id = dierreweb_tpl2id( 'adoption.php' );

		if( is_home() || is_front_page() ) {
			if( $show_on_home == 1 ) echo '<div class="breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
		} else {
			echo '<div class="breadcrumb">';
			if( $show_home_link == 1 ) {
				echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
				if( $frontpage_id == 0 || $parent_id != $frontpage_id ) echo esc_html( $delimiter );
			}
			if( is_category() ) {
				$this_cat = get_category( get_query_var( 'cat' ), false );
				if( $this_cat->parent != 0 ) {
					$cats = get_category_parents( $this_cat->parent, TRUE, $delimiter );
					if( $show_current == 0 ) $cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
					if( $show_title == 0 ) $cats = preg_replace( '/ title="(.*?)"/', '', $cats );
					echo wp_kses_post( $cats );
				}

				if( $show_current == 1 ) echo wp_kses_post( $before ) . sprintf( $text['category'], single_cat_title( '', false ) ) . wp_kses_post( $after );

			} elseif ( is_tax( 'adopted' ) ) {
				printf( $link, get_the_permalink( $projects_id ), get_the_title( $projects_id ) );

			} elseif( is_search() ) {
				echo wp_kses_post( $before ) . sprintf( $text['search'], get_search_query() ) . wp_kses_post( $after );

			} elseif( is_day() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
				echo wp_kses_post( $before ) . get_the_time( 'd' ) . wp_kses_post( $after );

			} elseif( is_month() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo wp_kses_post( $before ) . get_the_time( 'F' ) . wp_kses_post( $after );

			} elseif( is_year() ) {
				echo wp_kses_post( $before ) . get_the_time( 'Y' ) . wp_kses_post( $after );

			} elseif( is_single() && !is_attachment() ) {
				if( get_post_type() == 'adoption' ) {
					printf( $link, get_the_permalink( $projects_id ), get_the_title( $projects_id ) );
					if( $show_current == 1 ) {
						echo esc_html( $delimiter ) . $before . get_the_title() . $after;
					}
				} elseif( get_post_type() != 'post' ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug = $post_type->rewrite;
					printf( $link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name );
					if( $show_current == 1 ) echo esc_html( $delimiter ) . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					$cats = get_category_parents( $cat, TRUE, $delimiter );
					if( $show_current == 0 ) $cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
					if( $show_title == 0 ) $cats = preg_replace( '/ title="(.*?)"/', '', $cats );
					echo wp_kses_post( $cats );
					if( $show_current_post == 1 ) echo wp_kses_post( $before ) . get_the_title() . wp_kses_post( $after );
				}

			} elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				if( is_object( $post_type ) ) {
					echo wp_kses_post( $before ) . $post_type->labels->singular_name . wp_kses_post( $after );
				}

			} elseif( is_attachment() ) {
				$parent = get_post( $parent_id );
				$cat = get_the_category( $parent->ID );
				$cat = $cat[0];
				if( $cat ) {
					$cats = get_category_parents( $cat, TRUE, $delimiter );
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats ) ;
					$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
					if( $show_title == 0 ) $cats = preg_replace( '/ title="(.*?)"/', '', $cats );
					echo wp_kses_post( $cats );
				}
				printf( $link, get_permalink( $parent ), $parent->post_title );
				if( $show_current == 1 ) echo esc_html( $delimiter ) . $before . get_the_title() . $after;

			} elseif( is_page() && !$parent_id ) {
				if( $show_current == 1 ) echo wp_kses_post( $before ) . get_the_title() . wp_kses_post( $after );

			} elseif( is_page() && $parent_id ) {
				if( $parent_id != $frontpage_id ) {
					$breadcrumbs = array();
					while( $parent_id ) {
						$page = get_page( $parent_id );
						if( $parent_id != $frontpage_id ) {
							$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse( $breadcrumbs );
					for( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
						echo wp_kses_post( $breadcrumbs[$i] );
						if( $i != count( $breadcrumbs ) -1 ) echo esc_html( $delimiter );
					}
				}
				if( $show_current == 1 ) {
					if( $show_home_link == 1 || ( $parent_id_2 != 0 && $parent_id_2 != $frontpage_id ) ) echo esc_html( $delimiter );
					echo wp_kses_post( $before ) . get_the_title() . wp_kses_post( $after );
				}
			} elseif( is_tag() ) {
				echo wp_kses_post( $before ) . sprintf( $text['tag'], single_tag_title( '', false ) ) . wp_kses_post( $after );

			} elseif( is_author() ) {
		 		global $author;
				$userdata = get_userdata( $author );
				echo wp_kses_post( $before ) . sprintf( $text['author'], $userdata->display_name ) . wp_kses_post( $after );

			} elseif( is_404() ) {
				echo wp_kses_post( $before ) . $text['404'] . wp_kses_post( $after );

			} elseif( has_post_format() && !is_singular() ) {
				echo get_post_format_string( get_post_format() );
			}

			if( get_query_var( 'paged' ) ) {
				if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo esc_html__( 'Page', 'dr' ) . ' ' . get_query_var( 'paged' );
				if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</div><!-- .breadcrumbs -->';

		}
	}
}

/* ---------------------------------------------------------------------------------------------
   YOAST BREADCRUMBS
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_current_breadcrumbs' ) ) {
	function dierreweb_current_breadcrumbs( $type ) {

		$function = ( $type == 'shop' ) ? 'woocommerce_breadcrumb' : 'dierreweb_breadcrumbs';

		if( get_theme_mod( 'yoast_' . $type . '_breadcrumbs', false ) && function_exists( 'yoast_breadcrumb' ) ) {
			echo '<div class="yoast-breadcrumb">';
				echo yoast_breadcrumb();
			echo '</div>';
		} else {
			$function();
		}
	}
}

/* ---------------------------------------------------------------------------------------------
   GET THE ID
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_the_ID' ) ) {
	function dierreweb_get_the_ID ($args = array() ) {
		global $post;

		$page_id = 0;
		$page_for_posts = get_option( 'page_for_posts' );
		$page_for_shop = get_option( 'woocommerce_shop_page_id' );
		$page_for_projects = dierreweb_tpl2id( 'adoption.php' );
		$custom_404_id = get_theme_mod( 'custom_404_page' );

		if( isset( $post->ID ) ) $page_id = $post->ID;

		if( isset( $post->ID ) && ( is_singular( 'page' ) || is_singular( 'post' ) ) ) {
			$page_id = $post->ID;
		} elseif( is_home() || is_singular( 'post' ) || is_search() || is_tag() || is_category() || is_date() || is_author() ) {
			$page_id = $page_for_posts;
		} elseif( is_archive( 'adoption' ) && get_post_type() == 'adoption' ) {
			$page_id = $page_for_projects;
		}

		// if( woodmart_woocommerce_installed() && function_exists( 'is_shop' )  ) {
		// 	if( isset( $args['singulars'] ) && in_array( 'product', $args['singulars']) && is_singular( "product" ) ) {
		// 		// keep post id
		// 	} else if( is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || woodmart_is_product_attribute_archieve() ) {
		// 		$page_id = $page_for_shop;
		// 	}
		// }

		if( is_404() && ( $custom_404_id != 'default' || !empty( $custom_404_id ) ) ) $page_id = $custom_404_id;

		return $page_id;
	}
}

/* ---------------------------------------------------------------------------------------------
   CUSTOM PAGINATION
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_paging_nav' ) ) {
	function dierreweb_paging_nav() {
		$enable_pagination = apply_filters( 'dierreweb_enable_pagination', true );
		if( $enable_pagination ) {
			query_pagination();
			return;
		}
		?>
			<ul>
				<?php if( get_previous_posts_link() ) : ?>
					<li class="next">
						<?php previous_posts_link( esc_html__( 'Newer Posts &rarr;', 'dr' ) ); ?>
					</li>
				<?php endif ?>

				<?php if( get_next_posts_link() ) : ?>
					<li class="previous">
						<?php next_posts_link( esc_html__( '&larr; Older Posts', 'dr' ) ); ?>
					</li>
				<?php endif ?>
			</ul>
		<?php
	}
}

/* ---------------------------------------------------------------------------------------------
   NEXT AND PREV PAGINATION
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'query_pagination' ) ) {
	function query_pagination( $pages = '', $range = 2 ) {
		$showitems = ( $range * 2 ) + 1;

		global $paged;

		if( empty($paged ) ) $paged = 1;
		if( $pages == '' ) {

			global $wp_query;

			$pages = $wp_query->max_num_pages;
			if( !$pages ) {
		  	$pages = 1;
		  }
		}

   	if( 1 != $pages ) {
    	echo "<div class='pagination text-center'>";
      if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
      if( $paged > 1 && $showitems < $pages ) echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";

      for( $i=1; $i <= $pages; $i++ ) {
     		if( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
	   			if( $paged == $i ) {
		 				echo "<span class='page-numbers current'>" . $i . "</span>";
		 			} else {
						echo "<a href='" . get_pagenum_link( $i ) . "'class='page-numbers'>" . $i . "</a>";
		 			}
        }
      }

	    if( $paged < $pages && $showitems < $pages ) echo "<a href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
	    if( $paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages ) echo "<a href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>";
	    echo "</div>\n";
	  }
	}
}

/* ---------------------------------------------------------------------------------------------
   POST NAVIGATION
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_posts_navigation' ) ) {
	function dierreweb_posts_navigation() {
		?>
		<div class="single-navigation">
			<?php
		    $next_post = get_next_post();
		    $prev_post = get_previous_post();
		    $archive_url = false;

		    if( get_post_type() == 'post' ) {
					$archive_page = get_option( 'page_for_posts' );
					$archive_url = $archive_page;
		    } elseif ( get_post_type() == 'adoption' ) {
					$archive_page = dierreweb_tpl2id( 'adoption.php' );
					$archive_url = $archive_page;
				}
	    ?>
			<div class="posts-nav-btn prev-btn">

				<?php if( !empty( $next_post ) ) : ?>

					<div class="posts-nav-inner">
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<span class="btn-label">

								<?php esc_html_e( 'Newer', 'dr' ); ?>

							</span>
							<span class="post-title">

								<?php echo get_the_title( $next_post->ID ); ?>

							</span>
						</a>
					</div>

				<?php endif ?>

			</div>

			<?php if( $archive_url && 'page' == get_option( 'show_on_front' ) ) : ?>

        <div class="back-to-archive">
        	<a href="<?php echo esc_url( get_permalink( $archive_url ) ); ?>" >
        		<span class="dierreweb-tooltip">

							<?php esc_html_e( 'Back to list', 'dr' ); ?>

						</span>
        	</a>
        </div>

			<?php endif ?>

			<div class="posts-nav-btn next-btn">

        <?php if( !empty( $prev_post ) ) : ?>

          <div class="posts-nav-inner">
          	<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
              <span class="btn-label">

								<?php esc_html_e( 'Older', 'dr' ); ?>

							</span>
             	<span class="post-title">

								<?php echo get_the_title( $prev_post->ID ); ?>

							</span>
            </a>
          </div>

        <?php endif ?>

      </div>
		</div>

		<?php
	}
}

/* ---------------------------------------------------------------------------------------------
   FUNCTION TO GET HTML BLOCK CONTENT
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_html_block' ) ) {
	function dierreweb_get_html_block( $id ) {
		$post = get_post( $id );
		if( !$post || $post->post_type != 'cms_block' ) return;
		$content = do_shortcode( $post->post_content );

		return $content;
	}

}

if( !function_exists( 'dierreweb_get_static_blocks_array' ) ) {
	function dierreweb_get_static_blocks_array( $new = false ) {
		$args = array(
			'posts_per_page' => 500,
			'post_type' 		 => 'cms_block'
		);
		$blocks_posts = get_posts( $args );
		$array = array();
		foreach ( $blocks_posts as $post ) :
			setup_postdata( $post );
			if ( $new ) {
				$array[$post->ID] = array(
					'name' => $post->post_title,
					'value' => $post->ID,
				);
			} else {
				$array[$post->post_title] = $post->ID;
			}
		endforeach;
		wp_reset_postdata();
		return $array;
	}
}

/* ---------------------------------------------------------------------------------------------
   GET PAGE FROM TEMPLATE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_pages_ids_from_template' ) ) {
	function dierreweb_pages_ids_from_template( $name ) {
		$pages = get_pages( array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => $name . '.php'
		) );

		$return = array();
		foreach( $pages as $page ) {
			$return[] = $page->ID;
		}

		return $return;
	}
}

/* ---------------------------------------------------------------------------------------------
   MAINTENANCE PAGE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_maintenance_page' ) ) {
	function dierreweb_maintenance_page() {
		$pages_ids = dierreweb_pages_ids_from_template( 'maintenance' );
		if( !empty( $pages_ids ) && is_page( $pages_ids ) ) {
			return true;
		}
		return false;
	}
}

/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER JS
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_settings_js' ) ) {
	function dierreweb_settings_js() {
	  $custom_js = get_option( 'global_js' );
	  $js_ready = get_option( 'ready_js' );

		ob_start();

		if( !empty( $custom_js ) || !empty( $js_ready ) ) :

			if( !empty( $custom_js ) ) :
				echo $custom_js . "\n";
			endif;

			if( !empty( $js_ready ) ) : ?>
				jQuery(document).ready(function() {
					<?php echo $js_ready; ?>
				});
			<?php endif;

		endif;

		return ob_get_clean();
	}
}

/* ---------------------------------------------------------------------------------------------
   IT COULD BE USEFUL IF YOU USING NGIX INSTEAD OF APACHE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'getallheaders' ) ) {
	function getallheaders() {
		$headers = array();
		foreach( $_SERVER as $name => $value ) {
			if( substr( $name, 0, 5 ) == 'HTTP_' ) {
				$headers[ str_replace( ' ', '-', ucwords( strtolower( str_replace('_', ' ', substr( $name, 5 ) ) ) ) ) ] = $value;
			}
		}
		return $headers;
  }
}

























if ( ! function_exists( 'chaplin_get_post_meta' ) ) :
	function chaplin_get_post_meta( $post_id, $location = 'single-top' ) {

		/**
		 * Filter for modifying the post types supporting post meta output.
		 *
		 * If you wish to enable a post type to display post meta, add it here.
		 *
		 * @param array	$post_types		Post types with post meta support.
		 */

		$post_types = apply_filters( 'chaplin_allowed_post_types_for_meta_output', array( 'post', 'jetpack-portfolio' ) );

		if ( ! in_array( get_post_type( $post_id ), $post_types ) ) return;

		// Setup arrays with CSS classes for the post meta wrapper and list elements.
		$post_meta_wrapper_classes = array( 'post-meta-wrapper' );
		$post_meta_classes = array( 'post-meta' );

		// Get the post meta settings for the location passes as a parameter.
		switch ( $location ) {

			// In the single post header
			case 'single-top' :
				$post_meta = get_theme_mod( 'chaplin_post_meta_single_top' );
				$post_meta_wrapper_classes[] = 'post-meta-single';
				$post_meta_wrapper_classes[] = 'post-meta-single-top';

				// Empty = use a fallback
				if ( ! $post_meta ) {
					$post_meta = array(
						'post-date',
						'categories',
					);
				}
				break;

			// Below the single post content
			case 'single-bottom' :
				$post_meta = get_theme_mod( 'chaplin_post_meta_single_bottom' );
				$post_meta_wrapper_classes[] = 'post-meta-single';
				$post_meta_wrapper_classes[] = 'post-meta-single-bottom';

				// Empty = use a fallback
				if ( ! $post_meta ) {
					$post_meta = array(
						'tags',
					);
				}
				break;

			// In post previews
			case 'archive' :
				$post_meta = get_theme_mod( 'chaplin_post_meta_archive' );
				$post_meta_wrapper_classes[] = 'post-meta-archive';

				// Empty = use a fallback
				if ( ! $post_meta ) {
					$post_meta = array(
						'post-date',
					);
				}
				break;

		}

		// If we have post meta at this point, sort it.
		if ( $post_meta && ! in_array( 'empty', $post_meta ) ) {

			/**
			 * Filter for the order of the post meta.
			 *
			 * Allows child themes to modify the order of the post meta.
			 * Note: Any post meta items added via the chaplin_post_meta_items filter will not be affected by this sorting.
			 *
			 * @param array $post_meta_order 	Order of the post meta items.
			 */

			$post_meta_order = apply_filters( 'chaplin_post_meta_order', array( 'post-date', 'author', 'categories', 'jetpack-portfolio-type', 'tags', 'jetpack-portfolio-tag', 'comments', 'sticky', 'edit-link' ) );

			// Store any custom post meta items in a separate array, so we can append them after sorting.
			$post_meta_custom = array_diff( $post_meta, $post_meta_order );

			// Loop over the intended order, and sort $post_meta_reordered accordingly.
			$post_meta_reordered = array();
			foreach ( $post_meta_order as $i => $post_meta_name ) {
				$original_i = array_search( $post_meta_name, $post_meta );
				if ( $original_i === false ) continue;
				$post_meta_reordered[$i] = $post_meta[$original_i];
			}

			// Reassign the reordered post meta with custom post meta items appended, and update the indexes.
			$post_meta = array_values( array_merge( $post_meta_reordered, $post_meta_custom ) );

		}

		/**
		 * Filter for the post meta.
		 *
		 * Allows child themes to add, remove and modify which post meta items to include.
		 *
		 * @param array 	$post_meta 	Post meta items to include in the post meta.
		 * @param string 	$location 	Post meta location being output.
		 */

		$post_meta = apply_filters( 'chaplin_post_meta_items', $post_meta, $location );

		// If the post meta setting has the value 'empty', it's explicitly empty and the default post meta shouldn't be output.
		if ( ! $post_meta || ( $post_meta && in_array( 'empty', $post_meta ) ) ) return;

		// Make sure the right color is used for the post meta.
		if ( chaplin_is_cover_template( $post_id ) && $location == 'single-top' ) {
			$post_meta_classes[] = 'color-inherit';
		} else {
			$post_meta_classes[] = 'color-accent';
		}

		/**
		 * Filter for the post meta CSS classes.
		 *
		 * Allows child themes to filter the classes on the post meta wrapper element and list element.
		 *
		 * @param array 	$classes 	CSS classes of the element.
		 * @param string	$location 	Post meta location being output.
		 * @param array		$post_meta 	Post meta items included in the location.
		 */

		$post_meta_wrapper_classes = apply_filters( 'chaplin_post_meta_wrapper_classes', $post_meta_wrapper_classes, $location, $post_meta );
		$post_meta_classes = apply_filters( 'chaplin_post_meta_classes', $post_meta_classes, $location, $post_meta );

		// Convert the class arrays to strings for output.
		$post_meta_wrapper_classes_str = implode( ' ', $post_meta_wrapper_classes );
		$post_meta_classes_str = implode( ' ', $post_meta_classes );

		// Enable the $has_meta variable to be modified in actions.
		global $has_meta;

		// Default it to false, to make sure we don't output an empty container.
		$has_meta = false;

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		// Record output.
		ob_start();
		?>

		<div class="<?php echo esc_attr( $post_meta_wrapper_classes_str ); ?>">
			<ul class="<?php echo esc_attr( $post_meta_classes_str ); ?>">

				<?php

				/**
				 * Action run before output of post meta items.
				 *
				 * If you add any output to this action, make sure you include $has_meta as a global variable
				 * and set it to true.
				 *
				 * @param array		$post_meta 	Post meta items included in the location.
				 * @param array 	$post_id 	ID of the post.
				 * @param string	$location 	Post meta location being output.
				 */

				do_action( 'chaplin_start_of_post_meta_list', $post_meta, $post_id, $location );

				foreach ( $post_meta as $post_meta_item ) :

					switch ( $post_meta_item ) {

						// Post date
						case 'post-date' :
							$has_meta = true;
							?>
							<li class="post-date">
								<a class="meta-wrapper" href="<?php the_permalink(); ?>">
									<span class="meta-icon">
										<span class="screen-reader-text"><?php esc_html_e( 'Post date', 'chaplin' ); ?></span>
										<?php chaplin_the_theme_svg( 'calendar' ); ?>
									</span>
									<span class="meta-text">
										<?php the_time( get_option( 'date_format' ) ); ?>
									</span>
								</a>
							</li>
							<?php
							break;

						// Author
						case 'author' :
							$has_meta = true;
							?>
							<li class="post-author meta-wrapper">
								<span class="meta-icon">
									<span class="screen-reader-text"><?php esc_html_e( 'Post author', 'chaplin' ); ?></span>
									<?php chaplin_the_theme_svg( 'user' ); ?>
								</span>
								<span class="meta-text">
									<?php
									// Translators: %s = the author name
									printf( esc_html_x( 'By %s', '%s = author name', 'chaplin' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>' ); ?>
								</span>
							</li>
							<?php
							break;

						// Categories
						case 'categories' :
							if ( ! has_category() ) break;
							$has_meta = true;
							?>
							<li class="post-categories meta-wrapper">
								<span class="meta-icon">
									<span class="screen-reader-text"><?php esc_html_e( 'Post categories', 'chaplin' ); ?></span>
									<?php chaplin_the_theme_svg( 'folder' ); ?>
								</span>
								<span class="meta-text">
									<?php esc_html_e( 'In', 'chaplin' ); ?> <?php the_category( ', ' ); ?>
								</span>
							</li>
							<?php
							break;

						// Jetpack Portfolio Type
						case 'jetpack-portfolio-type' :
							if ( ! has_term( '', 'jetpack-portfolio-type', $post_id ) ) break;
							$has_meta = true;
							?>
							<li class="post-jetpack-portfolio-type meta-wrapper">
								<span class="meta-icon">
									<span class="screen-reader-text"><?php esc_html_e( 'Portfolio types', 'chaplin' ); ?></span>
									<?php chaplin_the_theme_svg( 'folder' ); ?>
								</span>
								<span class="meta-text">
									<?php the_terms( $post_id, 'jetpack-portfolio-type', __( 'In', 'chaplin' ) . ' ', ', ' ); ?>
								</span>
							</li>
							<?php
							break;

						// Tags
						case 'tags' :
							if ( ! has_tag( '', $post_id ) ) break;
							$has_meta = true;
							?>
							<li class="post-tags meta-wrapper">
								<span class="meta-icon">
									<span class="screen-reader-text"><?php esc_html_e( 'Tags', 'chaplin' ); ?></span>
									<?php chaplin_the_theme_svg( 'tag' ); ?>
								</span>
								<span class="meta-text">
									<?php the_tags( '', ', ', '' ); ?>
								</span>
							</li>
							<?php
							break;

						// Jetpack Portfolio Tags
						case 'jetpack-portfolio-tag' :
							if ( ! has_term( '', 'jetpack-portfolio-tag', $post_id ) ) break;
							$has_meta = true;
							?>
							<li class="post-jetpack-portfolio-tag meta-wrapper">
								<span class="meta-icon">
									<span class="screen-reader-text"><?php esc_html_e( 'Portfolio tags', 'chaplin' ); ?></span>
									<?php chaplin_the_theme_svg( 'tag' ); ?>
								</span>
								<span class="meta-text">
									<?php the_terms( $post_id, 'jetpack-portfolio-tag', '', ', ' ); ?>
								</span>
							</li>
							<?php
							break;

						// Comments
						case 'comments' :
							if ( post_password_required() || ! comments_open() || ! get_comments_number() ) break;
							$has_meta = true;
							?>
							<li class="post-comment-link meta-wrapper">
								<span class="meta-icon">
									<?php chaplin_the_theme_svg( 'comment' ); ?>
								</span>
								<span class="meta-text">
									<?php comments_popup_link(); ?>
								</span>
							</li>
							<?php
							break;

						// Sticky
						case 'sticky' :
							if ( ! is_sticky() ) break;
							$has_meta = true;
							?>
							<li class="post-sticky meta-wrapper">
								<span class="meta-icon">
									<?php chaplin_the_theme_svg( 'bookmark' ); ?>
								</span>
								<span class="meta-text">
									<?php esc_html_e( 'Sticky post', 'chaplin' ); ?>
								</span>
							</li>
							<?php
							break;

						// Edit link
						case 'edit-link' :
							if ( ! current_user_can( 'edit_post', $post_id ) ) break;
							$has_meta = true;
							?>
							<li class="post-edit">

								<a href="<?php echo esc_url( get_edit_post_link() ); ?>" class="meta-wrapper">
									<span class="meta-icon">
										<?php chaplin_the_theme_svg( 'edit' ); ?>
									</span>
									<span class="meta-text">
										<?php esc_html_e( 'Edit', 'chaplin' ); ?>
									</span>
								</a>

							</li>
							<?php
							break;

						default :

							/**
							 * Action for handling of custom post meta items.
							 *
							 * This action gets called if the post meta looped over doesn't match any of the types supported
							 * out of the box in Chaplin. If you've added a custom post meta type in a child theme, you can
							 * output it here by hooking into chaplin_post_meta_[your-post-meta-key].
							 *
							 *	Note: If you add any output to this action, make sure you include $has_meta as a global
							 *	variable and set it to true.
							 *
							 * @param array 	$post_id 	ID of the post.
							 * @param string	$location 	Post meta location being output.
							 */

							do_action( 'chaplin_post_meta_' . $post_meta_item, $post_id, $location );
					}

				endforeach;

				/**
				 * Action run after output of post meta items.
				 *
				 * If you add any output to this action, make sure you include $has_meta as a global variable
				 * and set it to true.
				 *
				 * @param array		$post_meta 	Post meta items included in the location.
				 * @param array 	$post_id 	ID of the post.
				 * @param string	$location 	Post meta location being output.
				 */

				do_action( 'chaplin_end_of_post_meta_list', $post_meta, $post_id, $location );

				?>

			</ul>
		</div>

		<?php

		wp_reset_postdata();

		// Get the recorded output.
		$meta_output = ob_get_clean();

		// If there is post meta, return it.
		return ( $has_meta && $meta_output ) ? $meta_output : '';

	}
endif;






/**
 * ------------------------------------------------------------------------------------------------
 * Display meta information for a specific post
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'woodmart_post_meta' ) ) {
	function woodmart_post_meta( $atts = array() ) {
		extract(
			shortcode_atts(
				array(
					'author'       => 1,
					'author_ava'   => 0,
					'date'         => 1,
					'cats'         => 0,
					'tags'         => 0,
					'labels'       => 0,
					'short_labels' => false,
					'edit'         => 1,
					'comments'     => 1,
					'limit_cats'   => 0,
				),
				$atts
			)
		);
		?>
			<ul class="entry-meta-list">
				<?php if ( get_post_type() === 'post' ) : ?>

					<?php // Is sticky ?>
					<li class="modified-date"><time class="updated" datetime="<?php echo get_the_modified_date( 'c' ); ?>"><?php echo get_the_modified_date(); ?></time></li>
					<?php if ( is_sticky() ) : ?>
						<li class="meta-featured-post"><?php esc_html_e( 'Featured', 'woodmart' ); ?></li>
					<?php endif; ?>

					<?php // Author ?>
					<?php if ( $author == 1 ) : ?>
						<li class="meta-author">
							<?php if ( $labels == 1 && ! $short_labels ) : ?>
								<?php esc_html_e( 'Posted by', 'woodmart' ); ?>
							<?php elseif ( $labels == 1 && $short_labels ) : ?>
								<?php esc_html_e( 'By', 'woodmart' ); ?>
							<?php endif; ?>
							<?php if ( $author_ava == 1 ) : ?>
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', 'author-avatar' ); ?>
							<?php endif; ?>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<span class="vcard author author_name">
									<span class="fn"><?php echo get_the_author(); ?></span>
								</span>
							</a>
						</li>
					<?php endif ?>
					<?php // Date ?>
					<?php if ( $date == 1 ) : ?>
						<li class="meta-date">
							<?php echo esc_html__( 'On', 'woodmart' ) . ' ' . get_the_date(); ?>
						</li>
					<?php endif ?>
					<?php // Categories ?>
					<?php if ( get_the_category_list( ', ' ) && $cats == 1 ) : ?>
						<li class="meta-categories"><?php echo get_the_category_list( ', ' ); ?></li>
					<?php endif; ?>
					<?php // Tags ?>
					<?php if ( get_the_tag_list( '', ', ' ) && $tags == 1 ) : ?>
						<li class="meta-tags"><?php echo get_the_tag_list( '', ', ' ); ?></li>
					<?php endif; ?>
					<?php // Comments ?>
					<?php if ( $comments && comments_open() ) : ?>
						<li><span class="meta-reply">
							<?php
								$comment_link_template = '<span class="replies-count">%s</span> <span class="replies-count-label">%s</span>';
							?>
							<?php
							comments_popup_link(
								sprintf( $comment_link_template, '0', esc_html__( 'comments', 'woodmart' ) ),
								sprintf( $comment_link_template, '1', esc_html__( 'comment', 'woodmart' ) ),
								sprintf( $comment_link_template, '%', esc_html__( 'comments', 'woodmart' ) )
							);
							?>
						</span></li>
					<?php endif; ?>
					<?php // Edit link ?>
					<?php if ( is_user_logged_in() && $edit == 1 ) : ?>
						<!--li><?php edit_post_link( esc_html__( 'Edit', 'woodmart' ), '<span class="edit-link">', '</span>' ); ?></li-->
					<?php endif; ?>
				<?php endif; ?>
			</ul>
		<?php
	}
}
