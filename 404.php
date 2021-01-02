<?php
/**
  * The template for displaying 404
  */

get_header(); ?>

  <div class="site-content col-md-12 col-sm-12" role="main">
    <header class="page-header">
  		<h2 class="entry-title">

        <?php esc_html_e( 'Oops, nothing found!', 'dr' ); ?>

      </h2>
  	</header><!-- .page-header -->
    <div class="page-wrapper">
      <h2>

        <?php esc_html_e( 'This is somewhat embarrassing, isn’t it?', 'dr' ); ?>

      </h2>
      <p>

        <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'dr' ); ?>

      </p>

      <?php get_search_form(); ?>

    </div><!-- .page-wrapper -->
  </div><!-- .site-content -->

<?php get_footer();
