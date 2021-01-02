<?php
/**
  * The template for displaying Content Page
  */
?>

<?php
  $blog_design = 'blog-design-masorny blog-design ';
  $blog_design .= ' col-md-6 col-sm-12';
  $random = 'carousel-' . rand(100,999);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $blog_design ) ); ?>>
  <div class="article-inner">

    <header class="entry-header">
      <figure id="<?php echo esc_attr( $random ); ?>" class="entry-thumbnail">

        <div class="post-img-wrapp">

          <?php

          if( has_post_thumbnail() && !post_password_required() ) {

    				$image_url = get_the_post_thumbnail_url( $post->ID, 'dierreweb_quad' ); ?>

            <a href="<?php the_permalink(); ?>">

              <?php the_post_thumbnail( $image_url, array( 'class' => 'img-fluid', 'alt' => get_the_title() ) ); ?>

            </a>

        </div>

        <div class="post-image-mask">
          <span class="flaticon-010-pawprints"></span>
        </div>

          <?php

  			}

        ?>

      </figure>
    </header>

    <div class="article-body">
      <div class="meta-post-categories">

        <?php esc_url( the_category( ', ' ) ); ?>

      </div>

      <?php

        $title = the_title( '<h1 class="article-title"><a href="'  . get_the_permalink() . '" rel="bookmark">', '</a></h1>' );

        if( !empty( $title ) ) {
          esc_html( $title );
        }

        ?>

        <div class="entry-meta">
          <span class="meta-author">

            <?php esc_html_e( 'By ', 'dr' );?>

            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">

              <?php esc_html( the_author() ); ?>

            </a>
          </span>
          <span class="meta-date">
            <a href="<?php echo esc_url( get_month_link( $archive_year, $archive_month ) ); ?>">

              <?php echo esc_html( get_the_date() ); ?>

            </a>
          </span>
          <span class="meta-reply">

  					<?php
  						$comment_link_template = '<span class="replies-count">%s</span> <span class="replies-count-label">%s</span>';

  					comments_popup_link(
  						sprintf( $comment_link_template, '0', esc_html__( 'comments', 'dr' ) ),
  						sprintf( $comment_link_template, '1', esc_html__( 'comment', 'dr' ) ),
  						sprintf( $comment_link_template, '%', esc_html__( 'comments', 'dr' ) )
  					); ?>

           </span>
        </div><!-- .entry-meta -->

      <?php

      $excerpt_display = get_theme_mod( 'dierreweb_display_excerpts', false );

      $excerpt = esc_html( get_the_excerpt() );

       if( !$excerpt_display ) :

        if( $excerpt ) : ?>

          <div class="post-content">

            <?php echo apply_filters( 'the_excerpt', $excerpt ); ?>

          </div>

        <?php endif;

      endif;

      $read_more_display = get_theme_mod( 'dierreweb_display_read_more', true );

      if( $read_more_display ) : ?>

        <p class="read-more-section">

          <?php echo dierreweb_read_more_tag(); ?>

        </p>

      <?php endif ?>

    </div>
  </div>
</article><!-- post-<?php the_ID(); ?> -->
