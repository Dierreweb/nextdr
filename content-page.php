<?php
/**
  * The template for displaying Single Page
  */
?>

<div class="site-content col-md-12 col-sm-12" role="main">

<?php

  if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry-content">

        <?php the_content();

        wp_link_pages( array(
          'before' => '<div class="pagination">' . '<span class="page-links-title">' . esc_html__( 'Pages:', 'dr' ) . '</span>',
          'after' => '</div>',
        ) ); ?>

      </div><!-- .entry-content -->
    </article><!-- #post-<?php the_ID(); ?> -->

    <?php

    if( get_theme_mod( 'comments_on_page' ) && comments_open() || get_comments_number() ) :

      comments_template();

    endif;

  endwhile;

  endif ?>

</div><!-- .site-content -->
