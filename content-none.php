<?php
/**
  * The template for displaying a "No posts found" message
  */
?>

<article id="post-0" <?php post_class( esc_attr( 'not-found' ) ); ?>>
  <header class="entry-header">
		<h1 class="entry-title">

      <?php esc_html_e( 'Nothing found!', 'dr' ); ?>

    </h1>
	</header><!-- .entry-header -->
  <div class="page-wrapper">
		<p>

      <?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'dr' ); ?>

    </p>

    <?php get_search_form(); ?>

	</div><!-- .page-wrapper -->
  <span>

    <?php dierreweb_the_theme_svg( 'search' ); ?>

  </span>
  <h1>

    <?php esc_html_e( 'Nothing found!', 'dr' ); ?>

  </h1>
  <p>

    <?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'dr' ); ?>

  </p>

  <?php get_search_form(); ?>

</article>
