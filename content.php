<?php
/**
  * The template for displaying Single Page
  */
?>

<div class="site-content col-md-9 col-sm-12" role="main">

  <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID();?>" <?php post_class();?> >
      <div class="meta-post-categories">

        <?php esc_url( the_category( ', ' ) ); ?>

      </div>
      <h2 class="entry-title">

        <?php the_title(); ?>

      </h2>
      <div class="entry-single">
        <figure class="entry-thumbnail">

          <?php the_post_thumbnail( 'dierreweb_single', array( 'class' => 'img-fluid', 'alt' => get_the_title() ) ); ?>

        </figure>

        <?php

        $caption = get_the_post_thumbnail_caption();

        if( $caption ) : ?>

          <figcaption class="entry-caption">

            <?php echo wp_kses_post( $caption );?>

          </figcaption>

        <?php endif ?>

      </div><!-- .entry-single -->
      <div class="entry-content">

        <?php the_content();

        wp_link_pages( array(
          'before' => '<div class="pagination">' . '<span class="page-links-title">' . esc_html__( 'Pages: ', 'dr' ) . '</span>',
          'after'  => '</div>'
        ) ); ?>

      </div><!-- .entry-content -->
    </article><!-- #post-<?php the_ID();?> -->

    <div class="single-footer">
      <div class="single-meta">

        <?php

          if( get_the_tag_list( '', ', ' ) ) : ?>

            <div class="single-meta-tags">

              <?php esc_html( the_tags( '', '' ) ); ?>

            </div><!-- .single-meta-tags -->

          <?php endif;

        if( get_theme_mod( 'blog_share' ) && dierreweb_is_social_link_enable( 'share' ) ) : ?>

          <?php if( function_exists( 'dierreweb_shortcode_social') )

            echo dierreweb_shortcode_social( array(
              'type'    => 'share',
              'tooltip' => 'yes',
              'style'   => 'colored'
            ) );

            ?>

        <?php endif ?>

      </div><!-- .single-meta -->
    </div><!-- .single-footer -->

    <?php dierreweb_posts_navigation(); ?>

    <?php comments_template(); ?>

  <?php endwhile;

  endif ?>

</div><!-- .site-content -->

<?php get_sidebar();
