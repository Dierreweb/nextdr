<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   BACKGROUND PAGES
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_title_heading' ) ) {

	function dierreweb_title_heading() {

		global $wp_query, $post;

		//$page_id = 0;
    $page_for_posts = get_option('page_for_posts');
		$breadcrumbs = get_theme_mod('breadcrumbs', true);
		$cover_align = dierreweb_get_alignment_background();
		$cover_fixed = get_theme_mod('fixed_background_image', false);
		$cover_color_scheme = dierreweb_get_color_background();

		$cover_classes = '';
		if($cover_fixed) $cover_classes .= 'cover-fixed ';
		$cover_classes .= 'text-' . $cover_align;
		$cover_classes .= ' color-scheme-' . $cover_color_scheme;

		// if($page_id != 0) {
			//$thumb = the_post_thumbnail_url($post->ID, 'dierreweb_big');

			//$disable_site_background_image = get_theme_mod('dierreweb_disable_background_image');

			$site_background_image_id = get_theme_mod('dierreweb_background_image');
			$site_background_image_url = wp_get_attachment_image_url($site_background_image_id, 'dierreweb_big');
			$background = null;
			// if($thumb != '') {
			// 	$background .= 'background-image: url(' . $thumb . ')';
			// } elseif($site_background_image_url != '') {
			// 	$background .= 'background-image: url(' . $site_background_image_url . ')';
			// }
		// }

    // Heading for pages
    if(is_singular('page') && (!is_404()) && (!is_page_template(array('template-full-width-cover.php', 'template-homepage.php', 'template-cover.php'))) && (!$page_for_posts || !is_page($page_for_posts))) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
			  <div class="container content-layout-wrapper">
					<div class="entry-header">
						<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>

						<?php

			        $title = the_title('<h1 class="entry-title">', '</h1>');

			        if(!empty($title)) {

			          $title;

			        }

			       ?>

					<!-- ROW -->
			    <div class="row">

      <?php
      return;
    endif;

		if(is_page_template('template-homepage.php') || is_404()) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
			  <div class="container">
					<!-- ROW -->
			    <div class="row">
      <?php
      return;
    endif;

		if(is_page_template(array('template-full-width-cover.php', 'template-cover.php'))) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- section-title -->
				<section class="cover-header <?php echo esc_attr($cover_classes); ?>" style="<?php echo esc_attr($background); ?>" alt="<?php echo esc_html($title); ?>">
					<div class="container">

						<?php

							$title = the_title('<h1 class="entry-title">', '</h1>');

							if(!empty($title)) {

								$title;

							}

						?>

						<hr class="hr">

						<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>

					</div>
				</section><!-- .section-title -->
				<!-- CONTAINER -->
			  <div class="container content-layout-wrapper">
					<!-- ROW -->
			    <div class="row">
      <?php
      return;
    endif;

		if(is_attachment()) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
				<div class="container content-layout-wrapper">
					<div class="entry-header">
						<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>

						<?php

							$title = the_title('<h1 class="entry-title">', '</h1>');

							if(!empty($title)) {

								$title;

							}

						?>

						<p>
	            <?php esc_html_e('Published ', 'dr'); ?>
							<?php echo esc_html(get_the_date()); ?>
	            <?php if($post->post_parent) {
	            	$parent_link = get_permalink($post->post_parent);
	            	$parent_title = get_the_title($post->post_parent);
	            	echo '<a href="' . esc_url($parent_link) . '">' . 'in '. esc_html($parent_title) . '</a>';
	            } ?>
	          </p>
					</div>
					<!-- ROW -->
					<div class="row">

      <?php
      return;
    endif;

    // Heading for blog and archives
    if(dierreweb_is_blog_archive()) :
      $title = (!empty($page_for_posts)) ? get_the_title($page_for_posts) : esc_html__('Blog', 'dr');

      if(is_author()) {
        the_post();
        $title = esc_html__('Posts by ', 'dr') . '<span class="vcard"><a class="url fn n by-author" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr(get_the_author()) . '" rel="author">' . esc_attr(get_the_author()) . '</a></span>';
				rewind_posts();
      }

      if(is_search()) {
        $title = esc_html__('Search results for: ', 'dr') . get_search_query();
      }

      if(is_tag()) {
        $title = esc_html__('Tag Archives: ', 'dr') . single_tag_title('', false);
      }

      if(is_category()) {
        $title = single_cat_title('', false);
      }

      if(is_date()) {
        if(is_day()) :
          $title = esc_html__('Daily Archives: ', 'dr') . get_the_date();

				elseif(is_month()) :
          $title = esc_html__('Monthly Archives: ', 'dr') . get_the_date(_x('F Y', 'monthly archives date format', 'dr'));

				elseif(is_year()) :
          $title = esc_html__('Yearly Archives: ', 'dr') . get_the_date(_x('Y', 'yearly archives date format', 'dr'));

				else :
					$title = esc_html__('Archives', 'dr');
				endif;
      }
			?>

			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
			  <div class="container content-layout-wrapper">
					<div class="entry-header">
						<?php if($breadcrumbs && !is_search()) dierreweb_current_breadcrumbs( 'pages' ); ?>
						<h1 class="entry-title">
							<?php echo wp_kses($title, dierreweb_get_allowed_html()); ?>
						</h1>
						<?php if(is_tag() || is_category()) : ?>
							<?php $category = get_queried_object(); ?>
							<div class="archive-count"><?php echo esc_html($category->count) . esc_html__(' posts', 'dr'); ?></div>
						<?php endif; ?>
						<?php if(is_tag() && tag_description()) : ?>
			  			<div class="archive-meta"><?php echo tag_description(); ?></div>
			  		<?php endif; ?>
			  		<?php if(is_category() && category_description()) : ?>
			  			<div class="archive-meta"><?php echo category_description(); ?></div>
			  		<?php endif; ?>
						<?php if(is_author()) : ?>
			  			<?php get_template_part('author-bio'); ?>
			  	  <?php endif; ?>
					</div>
					<!-- ROW -->
			    <div class="row">

      <?php
      return;
    endif;

		if(is_singular('post') && (!is_page_template(array('single-full-width-cover.php', 'single-cover.php', 'single-full-width-small.php')))) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
				<div class="container content-layout-wrapper">
					<div class="entry-header">
						<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>
						<div class="post-categories">
							<?php esc_url(the_category(', ')); ?>
						</div>

						<?php

							$title = the_title('<h1 class="entry-title">', '</h1>');

							if(!empty($title)) {

								$title;

							}

						?>

						<?php $subtitle = get_post_meta(get_the_ID(), 'subtitle', true); ?>
						<?php if(!empty($subtitle)) : ?>
							<h3 class="subtitle"><?php echo esc_html($subtitle); ?></h3>
						<?php endif; ?>
						<div class="meta-reading-time">
							<?php dierreweb_the_theme_svg('clock'); ?>

						</div>
					</div>
					<!-- ROW -->
					<div class="row">

      <?php
      return;
    endif;

		if(is_page_template('single-full-width-cover.php')) : ?>

			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- section-title -->
				<section class="cover-header cover-header-single <?php if($cover_fixed) echo esc_attr('cover-fixed'); ?>" style="<?php echo esc_attr($background); ?>" alt="<?php echo esc_html($title); ?>">
				</section><!-- .section-title -->
				<!-- CONTAINER -->
			  <div class="container content-layout-wrapper" role="main">
					<!-- ROW -->
					<div class="row">
						<div class="site-content col-md-8 col-sm-12 offset-md-2">
							<div class="entry-header">
							<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>
								<div class="post-categories">
									<?php esc_url(the_category(', ')); ?>
								</div>

								<?php

									$title = the_title('<h1 class="entry-title">', '</h1>');

									if(!empty($title)) {

										$title;

									}

								?>

								<?php $subtitle = get_post_meta(get_the_ID(), 'subtitle', true); ?>
								<?php if(!empty($subtitle)) : ?>
									<h3 class="subtitle"><?php echo esc_html($subtitle); ?></h3>
								<?php endif; ?>
								<div class="meta-reading-time">
									<?php dierreweb_the_theme_svg('clock'); ?>
									<span class="reading-time"><?php echo esc_html(dierreweb_reading_time()); ?></span>
								</div>
							</div>

      <?php
      return;
    endif;

		if(is_page_template('single-full-width-small.php')) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
			  <div class="container content-layout-wrapper" role="main">
					<!-- ROW -->
					<div class="row">
						<div class="site-content col-md-8 col-sm-12 offset-md-2">
							<div class="entry-header">
							<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>
								<div class="post-categories">
									<?php esc_url(the_category(', ')); ?>
								</div>

								<?php

									$title = the_title('<h1 class="entry-title">', '</h1>');

									if(!empty($title)) {

										$title;

									}

								?>

								<?php $subtitle = get_post_meta(get_the_ID(), 'subtitle', true); ?>
								<?php if(!empty($subtitle)) : ?>
									<h3 class="subtitle"><?php echo esc_html($subtitle); ?></h3>
								<?php endif; ?>
								<div class="post-meta">
		  						<span>
										<?php $post_author_id = get_post_field('post_author', $post_id); ?>
		  			        <a href="<?php echo esc_url(get_author_posts_url($post_author_id)); ?>">
		  								<?php esc_html(the_author_meta('display_name', 1)); ?>
		  							</a>
		  						</span>
		  						<span>
		  							<a href="<?php echo get_month_link($archive_year, $archive_month); ?>"><?php esc_html(the_time('j F, Y')); ?></a>
		  						</span>
		  					</div>
								<div class="meta-reading-time">
									<?php dierreweb_the_theme_svg('clock'); ?>
									<span class="reading-time"><?php echo esc_html(dierreweb_reading_time()); ?></span>
								</div>
							</div>
      <?php
      return;
    endif;

		if(is_page_template('single-cover.php')) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- section-title -->
				<section class="cover-header cover-header-single <?php if($cover_fixed) echo esc_attr('cover-fixed'); ?>" style="<?php echo esc_attr($background); ?>" alt="<?php echo esc_html($title); ?>">
				</section><!-- .section-title -->
					<!-- CONTAINER -->
					<div class="container content-layout-wrapper">
						<div class="entry-header">
							<?php if($breadcrumbs) dierreweb_current_breadcrumbs( 'pages' ); ?>
							<div class="post-categories">
								<?php esc_url(the_category(', ')); ?>
							</div>

							<?php

								$title = the_title('<h1 class="entry-title">', '</h1>');

								if(!empty($title)) {

									$title;

								}

							?>

							<?php $subtitle = get_post_meta(get_the_ID(), 'subtitle', true); ?>
							<?php if(!empty($subtitle)) : ?>
								<h3 class="subtitle"><?php echo esc_html($subtitle); ?></h3>
							<?php endif; ?>
							<div class="meta-reading-time">
								<?php dierreweb_the_theme_svg('clock'); ?>
								<span class="reading-time"><?php echo esc_html(dierreweb_reading_time()); ?></span>
							</div>
						</div>
						<!-- ROW -->
						<div class="row">
			<?php
			return;
		endif;

		if(is_singular('adoption') || dierreweb_is_adoption_archive()) : ?>
			<!-- MAIN CONTENT -->
			<main class="main-page-wrapper">
				<!-- CONTAINER -->
				<div class="container content-layout-wrapper">
					<!-- ROW -->
					<div class="row">
			<?php
			return;
		endif;

	}

}


/* ---------------------------------------------------------------------------------------------
   REDIRECT MAINTENANCE MODE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_maintenance_mode' ) ) {
	function dierreweb_maintenance_mode() {
		if( !get_theme_mod( 'dierreweb_maintenance_mode', false ) || is_user_logged_in() ) {
			return;
		}

    $page_id = dierreweb_pages_ids_from_template( 'maintenance' );
    $page_id = current( $page_id );

    if( !$page_id ) {
		  return;
		}

    if( !is_page( $page_id ) && !is_user_logged_in() ) {
      wp_redirect( esc_url( get_permalink( $page_id ) ) );
      exit();
    }
	}
  add_action( 'template_redirect', 'dierreweb_maintenance_mode', 10 );
}

/* ---------------------------------------------------------------------------------------------
   BUTTON TO TOP
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_scroll_top' ) ) {
	function dierreweb_scroll_top() {
		if( get_theme_mod( 'dierreweb_disable_scroll_to_top', false ) ) return; ?>

		<a href="#" class="scrollToTop" title="<?php esc_attr_e( 'Back to top', 'dr' ); ?>" role="button"></a>

		<?php
	}
  add_action('wp_footer', 'dierreweb_scroll_top', 0);
}

/* ---------------------------------------------------------------------------------------------
   STICKY SOCIAL
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_get_sticky_social' ) ) {
	function dierreweb_get_sticky_social() {
		if( !get_theme_mod( 'dierreweb_sticky_social_enable', false ) ) return;
		$classes = 'dierreweb-sticky-social';
		$classes .= ' dierreweb-sticky-social-' . esc_attr( dierreweb_get_sticky_social_classes() );
		$atts = array(
			'type'     => dierreweb_get_type_sticky_social(),
			'el_class' => $classes,
			'style'    => 'colored',
			'size'     => 'custom',
			'form'     => 'square',
			'align'    => 'center',
		);
		echo dierreweb_shortcode_social( $atts );
	}
	add_action( 'wp_footer', 'dierreweb_get_sticky_social', 1 );
}

/* ---------------------------------------------------------------------------------------------
   COOKIE POLICY
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_cookies_popup' ) ) {
	function dierreweb_cookies_popup() {
		if( !get_theme_mod( 'dierreweb_cookies_info', false ) ) return;
    $cookies_text = get_theme_mod( 'dierreweb_cookies_text' );
    $cookies_page = get_theme_mod( 'dierreweb_cookies_policy_page' ); ?>

    <div class="cookies-popup">
      <div class="cookies-inner">
        <div class="cookies-info-text">

					<?php echo do_shortcode( esc_html( $cookies_text ) ); ?>

				</div>

        <div class="cookies-buttons">

          <?php if( $cookies_page ) : ?>

            <a class="cookies-more-btn" href="<?php echo esc_url( get_permalink( $cookies_page ) ); ?>" target="_blank"><?php esc_html_e( 'More info', 'dr' ); ?></a>

					<?php endif ?>

					<a href="#" class="btn btn-primary cookies-accept-btn"><?php esc_html_e( 'Accept', 'dr' ); ?></a>
				</div>
      </div>
    </div>

		<?php
	}
  add_action( 'wp_footer', 'dierreweb_cookies_popup', 2 );
}

/* ---------------------------------------------------------------------------------------------
   PROMO POPUP
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_promo_popup' ) ) {
	function dierreweb_promo_popup() {
		if( !get_theme_mod( 'dierreweb_popup_display' ) ) {
			return;
		} ?>

		<div class="mfp-with-anim promo-popup" style="max-width: <?php echo esc_attr( get_theme_mod( 'dierreweb_popup_width' ) ); ?>px">
			<div class="popup-inner">

				<?php echo do_shortcode( get_theme_mod ( esc_html( 'dierreweb_popup_text' ) ) ); ?>

			</div>
		</div>

		<?php
	}
	add_action( 'wp_footer', 'dierreweb_promo_popup', 3 );
}

/* ---------------------------------------------------------------------------------------------
   HEADER BANNER
------------------------------------------------------------------------------------------------ */

if ( !function_exists( 'dierreweb_header_banner' ) ) {
	function dierreweb_header_banner() {
		// if( !get_theme_mod('header_banner' ) ) {
		// 	return;
		// }

		$banner_link = get_theme_mod( 'header_banner_link' ); ?>
		<div class="header-banner color-scheme-<?php echo esc_attr( get_theme_mod( 'header_banner_color' ) ); ?>">

			<?php if( get_theme_mod( 'header_close_btn' ) ) : ?>

				<a href="#" class="close-header-banner"></a>

			<?php endif ?>

			<?php if( $banner_link ) : ?>

				<a href="<?php echo esc_url( $banner_link ); ?>" class="header-banner-link"></a>

			<?php endif ?>

			<div class="container header-banner-container reset-mb-10">

				cazzo

			</div>
		</div>

		<?php
	}
	add_action( 'wp_footer', 'dierreweb_header_banner', 4 );
}

/* ---------------------------------------------------------------------------------------------
   AGE VERIFY
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_age_verify_popup' ) ) {
	function dierreweb_age_verify_popup() {
		if( !get_theme_mod( 'age_verify' ) ) {
			return;
		}

		$wrapper_classes = ' color-scheme-' . get_theme_mod( 'age_verify_color_scheme' ); ?>

		<div class="mfp-with-anim wd-age-verify<?php echo esc_attr( $wrapper_classes ); ?>">
			<div class="wd-age-verify-text">

				<?php echo do_shortcode( get_theme_mod( 'age_verify_text' ) ); ?>

			</div>

			<div class="wd-age-verify-text-error">

				<?php echo do_shortcode( get_theme_mod( 'age_verify_text_error' ) ); ?>

			</div>

			<div class="wd-age-verify-buttons">
				<a href="#" class="btn btn-color-primary wd-age-verify-allowed">

					<?php esc_html_e( 'I am 18 or Older', 'dr' ); ?>

				</a>

				<a href="#" class="btn wd-age-verify-forbidden">

					<?php esc_html_e( 'I am Under 18', 'dr' ); ?>

				</a>
			</div>
		</div>

		<?php
	}
	add_action( 'wp_footer', 'dierreweb_age_verify_popup', 5 );
}

// Preloader
if( !function_exists( 'dierreweb_preloader_template' ) ) {
	function dierreweb_preloader_template() {
		if( !get_theme_mod( 'dierreweb_preloader' ) ) {
			return;
		}

		$background_color = get_theme_mod( 'dierreweb_ciao' );

		$image_id = get_theme_mod( 'dierreweb_ciao_image' );
		$image = wp_get_attachment_image_url( $image_id, 'dierreweb_big' );

		?>
			<style class="preloader-style">
				html {
					overflow: hidden; }
			</style>
			<div class="preloader">
				<style>

					<?php if( isset( $background_color ) && $background_color ) : ?>
						.preloader {
							background-color: <?php echo esc_attr( $background_color ); ?> }
					<?php endif ?>

					<?php if( !isset($image) || ( isset( $image ) && !$image ) ) : ?>

						@keyframes preloader-Rotate {
						  0% {
								transform: scale(1) rotate(0deg); }
						  50% {
								transform: scale(0.8) rotate(360deg); }
						  100% {
								transform: scale(1) rotate(720deg); }
						}

						.preloader-img:before {
							content: "";
							display: block;
							width: 50px;
							height: 50px;
							border: 2px solid #BBB;
							border-top-color: #000;
							border-radius: 50%;
							animation: preloader-Rotate 2s cubic-bezier(0.63, 0.09, 0.26, 0.96) infinite; }

					<?php endif ?>

					@keyframes preloader-fadeOut {
					  from {
							visibility: visible; }
					  to {
							visibility: hidden; }
					}

					.preloader {
						position: fixed;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						opacity: 1;
						visibility: visible;
						z-index: 2500;
						display: flex;
						justify-content: center;
						align-items: center;
						animation: wd-preloader-fadeOut 20s ease both;
						transition: opacity .4s ease; }

					.preloader.preloader-hide {
						pointer-events: none;
						opacity: 0!important; }

					.preloader-img {
						max-width: 300px;
						max-height: 300px; }
				</style>

				<div class="preloader-img">

					<?php if( isset( $image ) && $image ) : ?>

						<img src="<?php echo esc_url( $image_url ); ?>" alt="Logo preloader">

					<?php endif ?>

				</div>
			</div>

		<?php
	}
	add_action('wp_head', 'dierreweb_preloader_template', 500);
}


// DA RIFARE
// More articles
if(!function_exists('dierreweb_more_articles')) {
	function dierreweb_more_articles() {
		if(is_singular('post')) :
			if(is_active_sidebar('area_side')) : ?>
			<div class="more-articles-box">
				<span class="chiudi lnr lnr-cross"></span>
				<?php dynamic_sidebar('area-side-menu'); ?>
			</div>
			<?php endif;
		endif;
	}
  add_action('wp_footer', 'dierreweb_more_articles', 0);
}

// Full screen search
if(!function_exists('dierreweb_full_screen_search')) {
	function dierreweb_full_screen_search() { ?>
		<div class="search-modal cover-modal" data-modal-target-string=".search-modal" aria-expanded="false">

			<div class="search-modal-inner modal-inner bg-body-background">

				<div class="section-inner">

					<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

					<form role="search" method="get" class="modal-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label class="screen-reader-text" for="<?php echo esc_attr( $unique_id ); ?>">
							<?php echo esc_html_x( 'Search for:', 'Label', 'dr' ); ?>
						</label>
						<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search for&hellip;', 'Placeholder', 'dr' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
						<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'Submit button', 'dr' ); ?></button>
					</form><!-- .search-form -->

					<a href="#" class="toggle search-untoggle fill-children-primary" data-toggle-target=".search-modal" data-toggle-screen-lock="true" data-toggle-body-class="showing-search-modal" data-set-focus="#site-header .search-toggle">
						<span class="screen-reader-text"><?php esc_html_e( 'Close search', 'dr' ); ?></span>
						<?php dierreweb_the_theme_svg( 'cross' ); ?>
					</a><!-- .search-toggle -->

				</div><!-- .section-inner -->

			</div><!-- .search-modal-inner -->

		</div><!-- .menu-modal -->

<?php
}

  add_action('dierreweb_before_header', 'dierreweb_full_screen_search');

}
