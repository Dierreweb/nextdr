<?php
/**
  * The template for displaying Author Bio
  */

//if( !get_theme_mod( 'blog_author_bio' ) ) return;

?>

<div class="author-info">
  <div class="author-avatar">

    <?php

      $author_bio_avatar_size = apply_filters( 'twentythirteen_author_bio_avatar_size', 96 );

      echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', 'author-avatar' ); ?>

  </div><!-- .author-avatar -->
  <div class="author-description">
    <h4>

      <?php printf( esc_html__( 'About %s', 'dr' ), get_the_author() ); ?>

    </h4>
		<p class="author-area-info">

      <?php esc_html( the_author_meta( 'description' ) ); ?>

    </p>
    <span class="author-title">
  		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">

        <?php printf( esc_html__( 'View all posts by %s', 'dr' ), get_the_author() ); ?>

  		</a>
    </span>
	</div><!-- .author-description -->
</div><!-- .author-info -->
