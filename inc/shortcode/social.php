<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   SOCIAL SHOTCODE
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_shortcode_social' ) ) {
	function dierreweb_shortcode_social( $atts ) {

		extract( shortcode_atts( array(
			'type'      => 'share',
			'align'     => '',
			'tooltip'   => 'no',
			'style'     => 'default',
			'el_class'  => '',
			'size'      => 'default',
			'form'      => 'circle',
			'color'     => 'dark',
			'page_link' => false
		), $atts ) );

		$target = "_blank";

		$classes = 'dierreweb-social-icons';
		$classes .= ' text-' . $align; // non funziona
		$classes .= ' icons-design-' . $style;
		$classes .= ' icons-size-' . $size;
		$classes .= ' color-scheme-' . $color;
		$classes .= ' social-' . $type;
		$classes .= ' social-form-' . $form;
		$classes .= ( $el_class ) ? ' ' . $el_class : '';

		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );

		if( !$page_link ) {
			$page_link = get_the_permalink();
		}

		// if(dierreweb_woocommerce_installed() && is_shop()) {
		// 	$page_link = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
		// }

		if( is_category() ) $page_link = get_category_link( get_queried_object()->term_id );
		if( is_home() && !is_front_page() ) $page_link = get_permalink( get_option( 'page_for_posts' ) );

		//$fb_share = get_theme_mod( 'share_fb', 1 );
		ob_start();

		?>

		<div class="<?php echo esc_attr( $classes ); ?>">

			<?php if( ( $type == 'share' && get_theme_mod( 'share_facebook' ) ) || ( $type == 'follow' && get_theme_mod( 'facebook' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'facebook' ) ) : 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-facebook">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Facebook', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'instagram' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'instagram' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-instagram">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Instagram', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( ( $type == 'share' && get_theme_mod( 'share_email' ) ) || ( $type == 'follow' && get_theme_mod( 'email' ) ) ) : ?>

				<a rel="nofollow" href="mailto:<?php echo '?subject=' . esc_html__( 'Check%20this%20', 'dr' ) . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-email">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Email', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( ( $type == 'share' && get_theme_mod( 'share_twitter' ) ) || ( $type == 'follow' && get_theme_mod( 'twitter' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'twitter' ) ) : 'https://twitter.com/share?url=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-twitter">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Twitter', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'youtube' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'youtube' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-youtube">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'YouTube', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( ( $type == 'share' && get_theme_mod( 'share_pinterest' ) ) || ( $type == 'follow' && get_theme_mod( 'pinterest' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'pinterest' ) ) : 'https://pinterest.com/pin/create/button/?url=' . esc_url( $page_link ) . '&media=' . $thumb_url[0]; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-pinterest">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Pinterest', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'tumblr' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'tumblr' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-tumblr">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Tumblr', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( ( $type == 'share' && get_theme_mod( 'share_linkedin' ) ) || ( $type == 'follow' && get_theme_mod( 'linkedin' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'linkedin_link' ) ) : 'https://www.linkedin.com/shareArticle?mini=true&url=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-linkedin">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Linkedin', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'vimeo' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'vimeo' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-vimeo">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Vimeo', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'flickr' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'flickr' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-flickr">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Flickr', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'github' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'github' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-github">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'GitHub', 'dr'); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'dribbble' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'dribble' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-dribbble">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Dribbble', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'behance' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'behance' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-behance">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Behance', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'soundcloud' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'soundcloud' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-soundcloud">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Soundcloud', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'spotify' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'spotify' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-spotify">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Spotify', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( ( $type == 'share' && get_theme_mod( 'share_ok' ) ) || ( $type == 'follow' && get_theme_mod( 'ok' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'ok' ) ) : 'https://connect.ok.ru/offer?url=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-ok">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Odnoklassniki', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'share' && get_theme_mod( 'share_whatsapp' ) || ( $type == 'follow' && get_theme_mod( 'whatsapp' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? ( get_theme_mod( 'whatsapp' ) ) : 'https://wa.me/?text=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-whatsapp">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'WhatsApp', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'share' && get_theme_mod( 'share_vk' ) || ( $type == 'follow' && get_theme_mod( 'vk' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? ( get_theme_mod( 'vk' ) ) : 'https://vk.com/share.php?url=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-vk">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'VK', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'snapchat' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'snapchat' ) ) : '' . esc_url( $page_link ); ?>"target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-snapchat">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Snapchat', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'follow' && get_theme_mod( 'tiktok' ) != '' ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'tiktok' ) ) : '' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-tiktok">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'TikTok', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( ( $type == 'share' && get_theme_mod( 'share_viber' ) ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'viber' ) ) : 'https://www.viber://forward?text=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-viber">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Viber', 'dr' ); ?></span>
				</a>

			<?php endif ?>

			<?php if( $type == 'share' && get_theme_mod( 'share_telegram' ) || ( $type == 'follow' && get_theme_mod( 'telegram' ) != '' ) ) : ?>

				<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url( get_theme_mod( 'tg' ) ) : 'https://telegram.me/share/url?url=' . esc_url( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == 'yes' ) echo 'dierreweb-tooltip'; ?> dierreweb-social-icon social-tg">
					<i></i>
					<span class="dierreweb-social-icon-name"><?php esc_html_e( 'Telegram', 'dr' ); ?></span>
				</a>

			<?php endif ?>

		</div>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}



function prova_social( $wp_customize ) {

	/* ------------------------------------------------------------------------
	 * SOCIAL SECTION
	 * ------------------------------------------------------------------------ */

	$wp_customize->add_section( 'dierreweb_social_section', array(
		'title'    => esc_html__( 'Social Network', 'dr' ),
		'priority' => 90,
		'panel'		 => 'dierreweb_theme_options'
	) );

	$wp_customize->add_setting( 'dierreweb_sticky_social_enable', array(
		'default'           => false,
		'sanitize_callback' => 'dierreweb_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'dierreweb_sticky_social_enable', array(
		'type'        => 'checkbox',
		'section'     => 'dierreweb_social_section',
		'settings'    => 'dierreweb_sticky_social_enable',
		'label'       => esc_html__( 'Sticky social links', 'dr' ),
		'description' => esc_html__( 'Social buttons will be fixed on the screen when you scroll the page.', 'dr' )
	) );

	/* Separator --------------------- */

	$wp_customize->add_setting( 'dierreweb_social_section_separator_1', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );

	$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_social_section_separator_1', array(
		'section'	=> 'dierreweb_social_section'
	) ) );

	$wp_customize->add_setting( 'dierreweb_sticky_social_type', array(
		'default'           => 'follow',
		'sanitize_callback' => 'dierreweb_sanitize_select'
	) );

	$wp_customize->add_control( 'dierreweb_sticky_social_type', array(
		'type'     => 'select',
		'section'  => 'dierreweb_social_section',
		'settings' => 'dierreweb_sticky_social_type',
		'label'    => esc_html__( 'Sticky social links type', 'dr' ),
		'choices'  => array(
			'share'	 => esc_html__( 'Share', 'dr' ),
			'follow' => esc_html__( 'Follow', 'dr' )
		)
	) );

	/* Separator --------------------- */

	$wp_customize->add_setting( 'dierreweb_social_section_separator_2', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );

	$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_social_section_separator_2', array(
		'section'	=> 'dierreweb_social_section'
	) ) );

	$wp_customize->add_setting( 'dierreweb_sticky_social_position', array(
		'default'           => 'left',
		'sanitize_callback' => 'dierreweb_sanitize_select'
	) );

	$wp_customize->add_control( 'dierreweb_sticky_social_position', array(
		'type'     => 'select',
		'section'  => 'dierreweb_social_section',
		'settings' => 'dierreweb_sticky_social_position',
		'label'    => esc_html__( 'Sticky social links position', 'dr' ),
		'choices'  => array(
			'left'	=> esc_html__( 'Left', 'dr' ),
			'right'	=> esc_html__( 'Right', 'dr' )
		)
	) );

	/* Separator --------------------- */

	$wp_customize->add_setting( 'dierreweb_social_section_separator_3', array(
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );

	$wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_social_section_separator_3', array(
		'section'	=> 'dierreweb_social_section'
	) ) );

	 // Social share
 	 $wp_customize->add_setting( 'facebook', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'facebook', array(
		 'label'    => esc_html__( 'Facebook Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'facebook',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'instagram', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'instagram', array(
		 'label'    => esc_html__( 'Instagram Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'instagram',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'twitter', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'twitter', array(
		 'label'    => esc_html__( 'Twitter Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'twitter',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'youtube', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'youtube', array(
		 'label'    => esc_html__( 'Youtube Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'youtube',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'pinterest', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'pinterest', array(
		 'label'    => esc_html__( 'Pinterest Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'pinterest',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'tumblr', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'tumblr', array(
		 'label'    => esc_html__( 'Tumblr Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'tumblr',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'linkedin', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'linkedin', array(
		 'label'    => esc_html__( 'Linkedin Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'linkedin',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'vimeo', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'vimeo', array(
		 'label'    => esc_html__( 'Vimeo Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'vimeo',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'flickr', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'flickr', array(
		 'label'    => esc_html__( 'Flickr Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'flickr',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'github', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'github', array(
		 'label'    => esc_html__( 'Github Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'github',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'dribbble', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'dribbble', array(
		 'label'    => esc_html__( 'Dribbble Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'dribbble',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'behance', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'behance', array(
		 'label'    => esc_html__( 'Behance Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'behance',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'soundcloud', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'soundcloud', array(
		 'label'    => esc_html__( 'Soundcloud Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'soundcloud',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'spotify', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'spotify', array(
		 'label'    => esc_html__( 'Spotify Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'spotify',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'ok', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'ok', array(
		 'label'    => esc_html__( 'OK Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'ok',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'whatsapp', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'whatsapp', array(
		 'label'    => esc_html__( 'Whatsapp Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'whatsapp',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'vk', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'vk', array(
		 'label'    => esc_html__( 'VK Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'vk',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'snapchat', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'snapchat', array(
		 'label'    => esc_html__( 'Snapchat Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'snapchat',
		 'type'     => 'text'
 	 ) );

	 $wp_customize->add_setting( 'tiktok', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'tiktok', array(
		 'label'    => esc_html__( 'Tiktok Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'tiktok',
		 'type'     => 'text'
 	 ) );



	 $wp_customize->add_setting( 'telegram', array(
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
		 'default'           => '#',
		 'transport'         => 'refresh'
 	 ) );

 	 $wp_customize->add_control( 'telegram', array(
		 'label'    => esc_html__( 'Telegram Link', 'dr' ),
		 'section'  => 'dierreweb_social_section',
		 'settings' => 'telegram',
		 'type'     => 'text'
 	 ) );

	$wp_customize->add_setting( 'email', array(
		'default'           => true,
		'sanitize_callback' => 'dierreweb_sanitize_checkbox',
		'transport'         => 'refresh'
	) );


	$wp_customize->add_control( 'email', array(
		'type'     => 'checkbox',
		'section'  => 'dierreweb_social_section',
		'settings' => 'email',
		'label'    => esc_html__( 'Email for social links', 'dr' ),
	) );

  /* Separator --------------------- */

  $wp_customize->add_setting( 'dierreweb_social_section_separator_4', array(
 	 'sanitize_callback' => 'wp_filter_nohtml_kses'
  ) );

  $wp_customize->add_control( new Dierreweb_Separator( $wp_customize, 'dierreweb_social_section_separator_4', array(
 	 'section'	=> 'dierreweb_social_section'
  ) ) );

  $social_shares = dierreweb_get_social_share();

	foreach( $social_shares as $key => $social_share) {
 	 $wp_customize->add_setting( $key, array(
 		 'transport'         => 'refresh',
		 'default'           => array($key[0], $key[1], $key[3]),
 		 'type'              => 'theme_mod',
 		 'sanitize_callback' => 'wp_filter_nohtml_kses'
 	 ) );

 	 $wp_customize->add_control( $key, array(
 		 'label'    => esc_html__( $social_share, 'dr' ),
 		 'section'  => 'dierreweb_social_section',
		 'settings' => $key,
 		 'type'     => 'checkbox'
 	 ) );
  }
}
add_action( 'customize_register', 'prova_social' );

// Social profiles
if( !function_exists( 'dierreweb_get_social_link' ) ) {
	function dierreweb_get_social_link() {
		$social_sites = array(
		 'facebook',
		 'instagram',
		 'twitter',
		 'pinterest',
		 'youtube',
		 'tumblr',
		 'linkedin',
		 'vimeo',
		 'flickr',
		 'github',
		 'dribbble',
		 'behance',
		 'soundcloud',
		 'spotify',
		 'ok',
		 'vk',
		 'whatsapp',
		 'snapchat',
		 'telegram',
		 'tiktok'
		);

  	return $social_sites = apply_filters( 'dierreweb_get_social_link_in_the_customizer', $social_sites );
	}
}

if( !function_exists( 'dierreweb_get_social_share' ) ) {
	function dierreweb_get_social_share() {
		$social_share = array(
		 'share_facebook'  => esc_html__( 'Share in Facebook', 'dr' ),
		 'share_twitter'   => esc_html__( 'Share in Twitter', 'dr' ),
		 'share_pinterest' => esc_html__( 'Share in Pinterest', 'dr' ),
		 'share_linkedin'  => esc_html__( 'Share in Linkedin', 'dr' ),
		 'share_ok'        => esc_html__( 'Share in OK', 'dr' ),
		 'share_whatsapp'  => esc_html__( 'Share in Whatsapp', 'dr' ),
		 'share_vk'        => esc_html__( 'Share in VK', 'dr' ),
		 'share_telegram'  => esc_html__( 'Share in Telegram', 'dr' ),
		 'share_viber'		 => esc_html__( 'Share in Viber', 'dr' ),
		 'share_email'     => esc_html__( 'Email for share links', 'dr' )
		);

		return $social_share = apply_filters( 'dierreweb_get_social_share_in_the_customizer', $social_share);
	}
}

/* ---------------------------------------------------------------------------------------------
   SHARE BUTTONS ENABLED
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_is_social_link_enable' ) ) {
	function dierreweb_is_social_link_enable( $type ) {
		$result = false;
		if( $type == 'share' && ( get_theme_mod( 'share_facebook' ) || get_theme_mod( 'share_twitter' ) || get_theme_mod( 'share_linkedin' ) || get_theme_mod( 'share_pinterest' ) || get_theme_mod( 'share_ok' ) || get_theme_mod( 'share_whatsapp' ) || get_theme_mod( 'share_email' ) || get_theme_mod( 'share_vk' ) || get_theme_mod( 'share_telegram' ) || get_theme_mod( 'share_viber' ) ) ) {
			$result = true;
		}
		if( $type == 'follow' &&  ( get_theme_mod( 'facebook' ) ||
		get_theme_mod( 'twitter' ) || get_theme_mod( 'instagram' ) ||
		get_theme_mod( 'pinterest' ) || get_theme_mod( 'youtube' ) ||
		get_theme_mod( 'tumblr' ) || get_theme_mod( 'linkedin' ) ||
		get_theme_mod( 'vimeo' ) || get_theme_mod( 'flickr' ) ||
		 get_theme_mod( 'github' ) || get_theme_mod( 'dribbble' ) ||
		 get_theme_mod( 'behance' ) || get_theme_mod( 'soundcloud' ) ||
		 get_theme_mod( 'spotify' ) || get_theme_mod( 'ok' ) ||
		get_theme_mod( 'whatsapp' ) || get_theme_mod( 'vk' ) ||
		get_theme_mod( 'snapchat' ) || get_theme_mod( 'telegram' ) ) ) {
			$result = true;
		}

		return $result;
	}
}
