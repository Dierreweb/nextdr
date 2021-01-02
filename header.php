<?php
/**
	* The template for displaying the Header
	*/
?>

<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type');?>" charset="<?php bloginfo('charset');?>"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta name="description" content="<?php bloginfo('description');?>"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>">

  <?php wp_head();?>

	</head>

	<?php

	if( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}

	?>

	<?php
		// $footer = get_theme_mod('dierreweb_disable_footer', false);
		// $footer_text_color = get_theme_mod('dierreweb_footer_text_color');
		// $footer_background_image_id = get_theme_mod('dierreweb_footer_background_image');
		// $footer_background_image = wp_get_attachment_image_url($footer_background_image_id, 'dierreweb_big');
		// $footer_background_image_url = esc_url($footer_background_image);
		// $has_background_image = (isset($footer_background_image_url) && !empty($footer_background_image_url));

		$header_topbar = get_theme_mod('dierreweb_header_topbar', false);
		$header_topbar_color = dierreweb_get_color_header_topbar();
		$header_topbar_columns = dierreweb_get_header_column_classes();
		$header_topbar_text = get_theme_mod('dierreweb_header_topbar_text');
		$header_topbar_text2 = get_theme_mod('dierreweb_header_topbar_text2');

		$classes = '';
		$classes .= 'topbar-' . $header_topbar_columns;
		$classes .= ' color-scheme-' . $header_topbar_color;
	?>

<body <?php body_class(); ?>>

	<div class="website-wrapper">

	<?php if( dierreweb_needs_header() ) : ?>

		<?php do_action('dierreweb_before_header'); ?>

		<header class="header header-scroll-stick header-sticky-real" <?php if(has_header_image()) echo 'style="background-image: url(' . get_header_image() . ');"';?> role="banner">

			<div class="main-header">

				<?php if(!$header_topbar) : ?>

				<div class="topbar-header <?php echo esc_attr($classes);?>">
					<div class="container">
						<div class="min-header row">
							<div class="col-left">

								<?php	if($header_topbar_text) : ?>

									<?php echo do_shortcode(esc_html($header_topbar_text));?>

								<?php else : ?>

									<small>&copy; <?php echo date('Y');?> <a href="<?php echo esc_url(home_url('/'));?>"> <?php bloginfo('name');?></a>. <?php esc_html_e('All rights reserved', 'dr');?></small>

								<?php endif ?>

							</div>

							<?php	if($header_topbar_text2) : ?>

								<div class="col-right">
									<?php echo do_shortcode(esc_html($header_topbar_text2));?>
								</div>

							<?php endif ?>

						</div>
					</div>
				</div>

			<?php endif ?>

			<div class="progress-container">
				<div class="progress-bar"></div>
			</div>
				<div class="general-header sticky-row">
					<div class="container" style="background: blue;">
						<div class="header-inner flex-row row justify-content-between align-items-center">
							<div class="d-flex align-items-center">

								<?php

								dierreweb_the_custom_logo();

								?>

							</div>

							<div class="d-flex align-items-center">
								<nav class="navigation">

									<?php
									wp_nav_menu([
										'menu'            => 'header',
										'theme_location'  => 'header',
										'container'       => 'div',
										'container_id'    => '',
										'container_class' => '',
										'menu_id'         => false,
										'menu_class'      => 'menu d-lg-flex d-none', // js-clone-nav
										'depth'           => 3,
										'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
										'walker'          => new Dierreweb_New_Walker()
									]);
									?>

								</nav>
								<a href="#" data-toggle="modal" data-target="#search" class="icon-search" data-toggle="tooltip" title="<?php esc_html_e('Search', 'dr');?>">

									<?php dierreweb_the_theme_svg('search');?>

								</a>

								<a class="burger js-menu-toggle d-block d-lg-none"><i></i></a>
								<a class="burger js-side-menu-toggle d-lg-block d-none"><i></i></a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</header><!-- END HEADER -->
		<div class="close-side"></div>

		<?php dierreweb_title_heading(); ?>

	<?php endif; ?>
