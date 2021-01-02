<?php
/**
	* The template for displaying the Footer
	*/

if( dierreweb_needs_footer() ) : ?>

</div><!-- .row -->
</div><!-- .container -->
</main><!-- .main-page-wrapper -->

<?php
	$footer = get_theme_mod( 'dierreweb_disable_footer' );
	$footer_widget = get_theme_mod( 'footer_widget' );
	$footer_text_color = dierreweb_get_footer_color();
	$footer_background_image_id = get_theme_mod( 'dierreweb_footer_background_image' );
	$footer_background_image = wp_get_attachment_image_url( $footer_background_image_id, 'dierreweb_big' );
	$footer_background_image_url = $footer_background_image;
	$has_background_image = ( isset( $footer_background_image_url) && !empty( $footer_background_image_url ) );
	$footer_copyright_columns = dierreweb_get_footer_column_class();
	$footer_copyrights = get_theme_mod( 'dierreweb_footer_copyright' );
	$footer_copyrights_text = get_theme_mod( 'dierreweb_footer_copyright_text' );
	$footer_copyrights_text2 = get_theme_mod( 'dierreweb_footer_copyright_text2' );
	$prefooter_area = get_theme_mod( 'dierreweb_prefooter_area' );

	// Custom fields
	$disable_footer = get_post_meta( get_the_ID(), 'footer' );
	$disable_prefooter = get_post_meta( get_the_ID(), 'prefooter' );
	$disable_sidebar_footer = get_post_meta( get_the_ID(), 'sidebar_footer' );
	$disable_copyrights = get_post_meta( get_the_ID(), 'copyrights' );
?>

<?php if( $prefooter_area && !$disable_prefooter ) : ?>

	<div class="prefooter">
		<div class="container">

			<?php echo do_shortcode( esc_html( $prefooter_area ) ); ?>

		</div>
	</div><!-- .prefooter -->

<?php endif ?>

<?php if( !$footer && !$disable_footer ) : ?>

	<!-- FOOTER -->
	<footer class="footer-container color-scheme-<?php echo esc_attr( $footer_text_color ); ?>" <?php if( $has_background_image ) echo 'style="background-image: url(' . esc_url( $footer_background_image_url) . ');"';?> role="footer">

		<?php if( is_active_sidebar( 'footer-sidebar-1' ) || is_active_sidebar( 'footer-sidebar-2' ) || is_active_sidebar( 'footer-sidebar-3' ) || is_active_sidebar('footer-sidebar-4' ) ) : ?>

		<?php $count = 0;

			if( is_active_sidebar( 'footer-sidebar-1' ) ) : $count++; endif;
			if( is_active_sidebar( 'footer-sidebar-2' ) ) : $count++; endif;
			if( is_active_sidebar( 'footer-sidebar-3' ) ) : $count++; endif;
			if( is_active_sidebar( 'footer-sidebar-4') ) : $count++; endif;

			$row = 'col-lg-' . 12 / $count . ' col-md-' . 12 / $count . ' col-sm-12';

		endif ?>

		<?php if( is_active_sidebar( 'footer-sidebar-1', 'footer-sidebar-2', 'footer-sidebar-3', 'footer-sidebar-4' ) && !$footer_widget && !$disable_sidebar_footer ) : ?>

		<aside class="main-footer container">
	    <div class="row">

	      <?php if( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>

	        <div class="footer-column footer-column-1 <?php echo esc_attr( $row ); ?>">

	          <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>

	        </div>

	      <?php endif;

	      if( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>

	        <div class="footer-column footer-column-2 <?php echo esc_attr( $row ); ?>">

	          <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>

	        </div>

	      <?php endif;

	      if( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>

	        <div class="footer-column footer-column-3 <?php echo esc_attr( $row ); ?>">

	          <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>

	        </div>

	      <?php endif;

	      if( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>

	        <div class="footer-column footer-column-4 <?php echo esc_attr( $row ); ?>">

	          <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>

	        </div>

	      <?php endif ?>

	    </div>
		</aside><!-- .footer-sidebar -->

		<?php endif;


		if( !$footer_copyrights && !$disable_copyrights ) : ?>

		<footer class="footer-copyrights copyrights-<?php echo esc_attr( $footer_copyright_columns ); ?>">
			<div class="container">
				<div class="min-footer row">
				  <div class="col-left">

				    <?php	if( $footer_copyrights_text ) :

				      echo do_shortcode( esc_html( $footer_copyrights_text ) );

				    else : ?>

				      <small>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'All rights reserved', 'dr' ); ?></small>

						<?php endif ?>

				  </div>

					<?php	if( $footer_copyrights_text2 ) : ?>

						<div class="col-right">

					  	<?php echo do_shortcode( esc_html( $footer_copyrights_text2 ) ); ?>

						</div>

					<?php endif ?>

				</div><!-- .min-footer -->
			</div>
		</footer><!-- .footer-copyrights -->

		<?php endif ?>

	</footer><!-- .footer-container -->

<?php endif;

endif ?>

</div><!-- .website-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
