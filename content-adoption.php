<?php
/**
 * The template for displaying single adopted
 */

  $pet_desc = get_post_meta( get_the_ID(), 'pet_desc', true );
  $pet_sex = get_post_meta( get_the_ID(), 'pet_sex', true );
  $pet_age = get_post_meta( get_the_ID(), 'pet_age', true );
  $pet_vac = get_post_meta( get_the_ID(), 'pet_vac', true );
  $pet_other_desc = get_post_meta( get_the_ID(), 'features_metabox', true );
?>

<div class="site-content col-md-8 col-sm-12" role="main">

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
  </article><!-- post-<?php the_ID(); ?> -->

  <?php

  if( comments_open() || get_comments_number() ) :

    comments_template();

  endif; ?>

  <div class="meta-navigation">

    <?php dierreweb_posts_navigation(); ?>

  </div>

  <!-- dierreweb_related_portfolio(); -->

</div><!-- .site-content -->

<aside class="sidebar-content col-md-4 col-sm-12  ">
  <div class="sidebar-adoption">

    <?php if( $pet_desc ) : ?>
      <div class="adoption-description">
        <h2 class="post-single-title"><?php esc_html_e( 'About ', 'dr' ) . the_title();?></h2>
        <p><?php echo esc_html( $pet_desc ); ?></p>
      </div>
    <?php endif ?>

    <?php if( $pet_sex || $pet_age || $pet_vac) : ?>
      <div class="adoption-details">
        <?php if( $pet_sex ) : ?>
          <h4>
            <i class="flaticon-010-pawprints"></i>

            <?php esc_html_e( 'Age', 'dr' ); ?>

          </h4>
          <p><?php echo esc_html( $pet_sex ); ?></p>
        <?php endif ?>

        <?php if( $pet_age ) : ?>
          <h4>
            <i class="flaticon-010-pawprints"></i>

            <?php esc_html_e( 'Age', 'dr' ); ?>

          </h4>
          <p><?php echo esc_html( $pet_age ); ?></p>
        <?php endif ?>

        <?php if( $pet_vac ) : ?>
          <h4>
            <i class="flaticon-010-pawprints"></i>

            <?php esc_html_e( 'Vaccinated', 'dr' ); ?>

          </h4>
          <p><?php echo esc_html( $pet_vac ); ?></p>
        <?php endif ?>

      </div>
    <?php endif ?>

    <?php if( $pet_other_desc ) : ?>
      <div class="adoption-other-details">
        <?php foreach( (array) $pet_other_desc as $key => $pets ) {
          if( $pets['pet_other_desc'] ) : ?>
            <h4>
              <i class="flaticon-010-pawprints"></i>

              <?php echo esc_html( $pets['pet_other_desc'] ); ?>

            </h4>
          <?php endif;
        } ?>

      </div>

    <?php endif ?>

  </div><!-- .sidebar-dadoption -->
</aside><!-- .sidebar-content -->

<?php endwhile; endif ?>
