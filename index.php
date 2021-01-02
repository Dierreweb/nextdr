<?php
/**
  * The template for displaying Index
  */

get_header(); ?>

<?php $columns = get_theme_mod( 'dierreweb_post_grid_columns', 'columns-2' ); ?>

    <?php if( is_author() && get_the_author_meta( 'description' ) ) : ?>

      <div class="col-md-12 col-sm-12">

        <?php get_template_part( 'author-bio' ); ?>

    </div>

    <?php endif;

    if( is_tag() && tag_description() ) : ?>

      <div class="archive-meta">

        <?php echo tag_description(); ?>

      </div>

    <?php endif;
    if( is_category() && category_description() ) : ?>

      <div class="archive-meta">

        <?php echo category_description(); ?>

      </div>

    <?php endif ?>

  <div class="site-content col-md-9 col-sm-12" role="main">

    <?php $post_grid_column_classes = dierreweb_get_post_grid_column_classes(); ?>

  		<div class="<?php echo esc_attr( 'masorny-container row' ); ?>">

  			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

  				<?php get_template_part( 'preview', get_post_format() ); ?>

  			<?php endwhile ?>

        <?php	else : ?>

  		    <?php get_template_part( 'content-none' ); ?>

  		  <?php endif ?>

      </div>

			<?php query_pagination(); ?>

  </div><!-- .site-content -->

  <?php get_sidebar();

get_footer();
