<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

?>
<!-- related posts -->
<div class="related-posts">
  <h3 class="related-title">

    <?php esc_html_e('Related Posts ', 'dr' ); ?>

  </h3>

  <?php

  $related = new WP_Query( array(
    'category__in'   => wp_get_post_categories( $post->ID ),
    'posts_per_page' => 3,
    'post__not_in'   => array( $post->ID )
  ) );

  if( $related->have_posts() ) : while( $related->have_posts() ) : $related->the_post() ;?>
    <?php get_template_part( 'content', get_post_format() ); ?>
  <?php endwhile; endif;

  wp_reset_postdata(); ?>

</div><!-- .related posts -->
