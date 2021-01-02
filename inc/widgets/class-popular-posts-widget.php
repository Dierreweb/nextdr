<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   WIDGET POPULAR POSTS
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'DIERREWEB_Popular_Posts' ) ) {
  Class DIERREWEB_Popular_Posts extends WPH_Widget {

    function __construct() {

      $widget_ops = array(
        'classname'   => 'widget_popular_posts',
    	  'description' => esc_html__( 'The most popular posts on your site', 'dr' ) );

        parent::__construct( 'popular_posts', esc_html__( 'DIERREWEB Popular Posts', 'dr' ), $widget_ops );

        $this->alt_option_name = 'widget_popular_posts';

        add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

    }

    function widget( $args, $instance ) {

      $cache = wp_cache_get( 'dierreweb_popular_posts', 'widget' );

      if( !is_array( $cache ) )
        $cache = array();

      if( !isset( $args['widget_id'] ) )
        $args['widget_id'] = $this->id;

      if( isset( $cache[$args['widget_id']] ) ) {
        echo $cache[$args['widget_id']];

        return;
      }

      ob_start();

      extract( $args );

      echo wp_kses_post( $before_widget );

      if( !empty( $instance['title'] ) ) {
 				echo wp_kses_post( $before_title ) . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . wp_kses_post( $after_title );
      }

      $posts_per_page = ( isset( $instance['limit'] ) ) ? $instance['limit'] : 5;
      $thumb = ( isset( $instance['thumb'] ) ) ? $instance['thumb'] : true;
      $thumb_height = ( isset( $instance['thumb_height'] ) ) ? $instance['thumb_height'] : 84;
 			$thumb_width = ( isset( $instance['thumb_width'] ) ) ? $instance['thumb_width'] : 84;
      $show_views = ( isset( $instance['views'] ) ) ? $instance['views'] : true;
      $show_comments = ( isset( $instance['show_comments'] ) ) ? $instance['show_comments'] : false;

      // Query goes here
      $query_args = array(
        'post_type'           => 'post',
        'posts_per_page'      => $posts_per_page,
        'meta_key'            => 'views',
        'orderby'             => 'meta_value_num',
        'order'               => 'DESC',
        'ignore_sticky_posts' => TRUE
      );

      // The Query
      $the_query = new WP_Query( $query_args );

      // The Loop
      if( $the_query->have_posts() ) : ?>

        <ul class="popular-posts-list">

          <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <li>

              <?php if( $thumb ) : ?>
                <?php if( has_post_thumbnail() ) : ?>
                  <a class="popular-post-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php esc_url( the_post_thumbnail( array( $thumb_width, $thumb_height), array( 'class' => 'img-fluid', 'alt' => esc_html( get_the_title() ) ) ) ); ?>
                  </a>
                <?php endif ?>
              <?php endif ?>

              <div class="popular-post-info">
                <h5 class="popular-post-title" >
                  <a href="<?php the_permalink(); ?>" title='<?php echo sprintf( esc_attr__( 'Link to %s', 'dr' ), the_title_attribute( 'echo=0' ) ); ?>' rel="bookmark">
                    <?php the_title(); ?>
                  </a>
                </h5>

                <?php if( $show_views ) : ?>
                  <time class="number-views"><?php echo esc_html( get_post_meta( get_the_ID(), 'views', true ) ) . esc_html__( ' Views', 'dr' ); ?></time>
                <?php endif ?>

                <?php if( $show_comments ) : ?>
                  <a class="popular-post-comment" href="<?php comments_link(); ?>">
                    <?php comments_number( esc_html__( 'No Comments', 'dr' ), esc_html__( '1 Comment', 'dr' ), esc_html__( '% Comments', 'dr' ) ); ?>
                  </a>
                <?php endif ?>

              </div>
            </li>

          <?php endwhile ?>

        </ul>

        <?php

        endif;

        // Restore original Post Data
        wp_reset_postdata();

        echo wp_kses_post( $after_widget );

        $cache[$args['widget_id']] = ob_get_flush();

        wp_cache_set( 'dierreweb_popular_posts', $cache, 'widget' );

    }

    function update( $new_instance, $old_instance ) {

      $instance = $old_instance;
      $instance['title'] = sanitize_text_field( $new_instance['title'] );
      $instance['limit'] = intval( $new_instance['limit'] );
      $instance['thumb'] = isset( $new_instance['thumb'] ) ? (bool) $new_instance['thumb'] : '';
 			$instance['thumb_height'] = intval( $new_instance['thumb_height'] );
 			$instance['thumb_width'] = intval( $new_instance['thumb_width'] );
      $instance['views'] = isset( $new_instance['views'] ) ? (bool) $new_instance['views'] : '';
      $instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : '';

      $this->flush_widget_cache();

      $alloptions = wp_cache_get( 'alloptions', 'options' );
      if( isset( $alloptions['widget_popular_posts'] ) )
        delete_option( 'widget_popular_posts' );

      return $instance;
    }

    function flush_widget_cache() {
      wp_cache_delete( 'dierreweb_popular_posts', 'widget' );
    }

    function form( $instance ) {

      $defaults = array(
 				'title'         => esc_attr__( 'Popular Posts', 'dr' ),
        'limit'         => 5,
        'thumb'         => true,
 				'thumb_height'  => 84,
 				'thumb_width'   => 84,
 				'views'         => true,
 				'show_comments' => false
 			);

      $instance = wp_parse_args( (array) $instance, $defaults );

      ?>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
          <?php esc_html_e( 'Title', 'dr' ); ?>
        </label>
      	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
      </p>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>">
          <?php esc_html_e( 'Number of posts to show', 'dr' ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" step="1" min="-1" value="<?php echo esc_attr( (int) $instance['limit'] ); ?>" />
      </p>

      <p>
 				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb' ) ); ?>" type="checkbox" <?php checked( $instance['thumb'] ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>">
          <?php esc_html_e( 'Display Thumbnail', 'dr' ); ?>
        </label>
 			</p>

      <p>
 				<label style="display: block;" for="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>">
          <?php esc_html_e( 'Thumbnail (height)', 'dr' ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_height' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( (int) $instance['thumb_height'] ); ?>" />
        <label style="display: block;" for="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>">
          <?php esc_html_e( 'Thumbnail (width)', 'dr' ); ?>
        </label>
        <input style="display: block;" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( (int) $instance['thumb_width'] ); ?>" />
      </p>

      <p>
        <input id="<?php echo esc_attr( $this->get_field_id( 'views' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'views' ) ); ?>" type="checkbox" <?php checked( $instance['views'] ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'views' ) ); ?>">
          <?php esc_html_e( 'Display post views?', 'dr' ); ?>
        </label>
      </p>

      <p>
        <input id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" type="checkbox" <?php checked( $instance['show_comments'] ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>">
          <?php esc_html_e( 'Display post comments?', 'dr' ); ?>
        </label>
      </p>

      <?php
    }
  }
}

if( !function_exists( 'dierreweb_popular_posts_views' ) ) {
  function dierreweb_popular_posts_views( $postID ) {

    $total_key = 'views';
    $total = get_post_meta( $postID, $total_key, true );

    // If current 'views' field is empty, set it to zero
    if( $total == '' ) {
      delete_post_meta( $postID, $total_key );
      add_post_meta( $postID, $total_key, '0' );
    } else {
    $total++;
    update_post_meta( $postID, $total_key, $total );
    }
  }
}

if( !function_exists( 'dierreweb_counter_popular_posts' ) ) {
  function dierreweb_counter_popular_posts( $post_id ) {
    if( !is_single() ) return;

    if( !is_user_logged_in() ) {
      // Get the post ID
      if( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
      }
      dierreweb_popular_posts_views( $post_id );
    }
  }
  add_action( 'wp_head', 'dierreweb_counter_popular_posts' );
}

if( !function_exists('dierreweb_add_views_column' ) ) {
  function dierreweb_add_views_column( $defaults ) {

    $defaults['post_views'] = 'View Count';

    return $defaults;
  }
  add_filter( 'manage_posts_columns', 'dierreweb_add_views_column' );
}

if( !function_exists('dierreweb_display_views' ) ) {
  function dierreweb_display_views( $column_name ) {
    if( $column_name === 'post_views' ) {
      echo (int) get_post_meta( get_the_ID(), 'views', true );
    }
  }
  add_action( 'manage_posts_custom_column', 'dierreweb_display_views', 5, 2 );
}
