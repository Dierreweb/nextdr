<?php
/**
  * The template for displaying Searchform
  */
?>

<div class="search">
  <form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <input type="search" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'dr' ); ?>" required/>
    <button class="search-submit" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'dr' ); ?>">

      <?php dierreweb_the_theme_svg( 'search' ); ?>

    </button>
  </form>
</div>
