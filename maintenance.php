<?php
/**
  * Template name: Maintenance
  */

get_header(); ?>

  <div class="maintenance-content container" role="main">

    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">

          <?php the_content(); ?>

        </div>
      </article><!-- .post-<?php the_ID(); ?> -->

    <?php endwhile;

    endif ?>

  </div>

<?php get_footer();
