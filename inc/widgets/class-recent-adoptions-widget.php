<?php

if(!defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   WIDGET RECENT ADOPTIONS
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'DIERREWEB_Recent_Adoptions' ) ) {
  Class DIERREWEB_Recent_Adoptions extends WPH_Widget {

    function __construct() {

      $widget_ops = array(
        'classname'   => 'widget_recent_adoptions',
        'description' => esc_html__( 'The most recent adoptions on your site', 'dr' ) );

        parent::__construct( 'recent_adoptions', esc_html__( 'DIERREWEB Recent Adoptions', 'dr' ), $widget_ops );

        $this->alt_option_name = 'widget_recent_adoptions';

        add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

    }

    function widget( $args, $instance ) {

      $cache = wp_cache_get( 'dierreweb_adoption_posts', 'widget' );

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
 				echo wp_kses_post( $before_title ) . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . wp_kses_post( $after_title );
      }

      $posts_per_page = ( isset( $instance['limit'] ) ) ? $instance['limit'] : 5;
      $show_date = ( isset( $instance['show_date'] ) ) ? $instance['show_date'] : true;
      $show_comments = ( isset( $instance['show_comments'] ) ) ? $instance['show_comments'] : true;
      $offset = ( isset( $instance['offset'] ) ) ? $instance['offset'] : 0;
      $orderby = ( isset( $instance['orderby'] ) ) ? $instance['orderby'] : 'date';
      $category = ( isset( $instance['category'] ) ) ? $instance['category'] : 'all';
      $order = ( isset( $instance['order'] ) ) ? $instance['order'] : 'DESC';
      $thumb = ( isset( $instance['thumb'] ) ) ? $instance['thumb'] : true;
      $thumb_height = ( isset( $instance['thumb_height'] ) ) ? $instance['thumb_height'] : 84;
 			$thumb_width = ( isset( $instance['thumb_width'] ) ) ? $instance['thumb_width'] : 84;

      // The Query
      $query = array(
        'post_type' => 'adoption',
        'post_status' => 'publish',
 				'offset'         => $offset,
 				'posts_per_page' => $posts_per_page,
 				'orderby'        => $orderby,
 				'order'          => $order
 			);

 			if( 'all' !== $category ) {
 				$query['tax_query'] = array(
 					array(
 						'taxonomy' => 'adopted',
 						'field'    => 'id',
 						'terms'    => $category
 					)
 				);
 			}

 			$posts = new WP_Query( $query );

      // The Loop
      if( $posts->have_posts() ) : ?>

        <ul class="recent-adoptions-list">

          <?php while( $posts->have_posts() ) : $posts->the_post(); ?>

            <li>
              <?php if( $thumb ) : ?>
                <?php if( has_post_thumbnail() ) : ?>
                  <a class="recent-adoption-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php esc_url( the_post_thumbnail( array( $thumb_width, $thumb_height), array( 'class' => 'img-fluid', 'alt' => esc_html( get_the_title() ) ) ) ); ?>
                  </a>
                <?php endif ?>
              <?php endif ?>

              <div class="recent-adoption-info">
                <h5 class="recent-adoption-title" >
                  <a href="<?php the_permalink(); ?>" title='<?php echo sprintf( esc_attr__( 'Link to %s', 'dr' ), the_title_attribute( 'echo=0' ) ); ?>' rel="bookmark">
                    <?php the_title(); ?>
                  </a>
                </h5>

                <?php if( $show_date ) : ?>
                  <a href="<?php echo esc_url( get_month_link( '', '' ) ); ?>">
                    <?php wp_kses_post( the_date( '', '<time class="adoption-date" datetime="' . get_the_date( 'c' ) . '">', '</time>' ) ); ?>
                  </a>
                <?php endif ?>

                <?php if( $show_comments ) : ?>
                  <a class="recent-adoption-comment" href="<?php comments_link(); ?>">
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

        wp_cache_set( 'dierreweb_recent_adoptions', $cache, 'widget' );

    }

    function update( $new_instance, $old_instance ) {

      $instance = $old_instance;
      $instance['title'] = sanitize_text_field( $new_instance['title'] );
      $instance['limit'] = intval( $new_instance['limit'] );
      $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : '';
      $instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : '';
      $instance['offset'] = intval( $new_instance['offset'] );
      $instance['order'] = stripslashes( $new_instance['order'] );
      $instance['orderby'] = stripslashes( $new_instance['orderby'] );
 			$instance['category'] = $new_instance['category'];
      $instance['thumb'] = isset( $new_instance['thumb'] ) ? (bool) $new_instance['thumb'] : '';
 			$instance['thumb_height'] = intval( $new_instance['thumb_height'] );
 			$instance['thumb_width'] = intval( $new_instance['thumb_width'] );

      $this->flush_widget_cache();

      $alloptions = wp_cache_get( 'alloptions', 'options' );
      if( isset( $alloptions['widget_recent_adoptions'] ) )
        delete_option( 'widget_recent_adoptions' );

      return $instance;
    }

    function flush_widget_cache() {
      wp_cache_delete( 'dierreweb_recent_adoptions', 'widget' );
    }

    function form( $instance ) {

      $defaults = array(
 				'title'         => esc_attr__( 'Recent Adoptions', 'dr' ),
 				'limit'         => 5,
 				'offset'        => 0,
 				'order'         => 'DESC',
 				'orderby'       => 'date',
 				'category'      => 'all',
 				'thumb'         => true,
 				'thumb_height'  => 84,
 				'thumb_width'   => 84,
 				'show_date'     => true,
 				'show_comments' => true
 			);

 			$instance = wp_parse_args( (array) $instance, $defaults );

      ?>

      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'dr' ); ?></label>
      	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
      </p>
      <p>
 				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'dr' ); ?></label>
 				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" style="width: 100%;">
          <option value="DESC" <?php selected( $instance['order'], 'DESC' ); ?>><?php esc_html_e( 'Descending', 'dr' ); ?></option>
          <option value="ASC" <?php selected( $instance['order'], 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'dr' ); ?></option>
        </select>
      </p>
      <p>
 				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Orderby', 'dr' ); ?></label>
 				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" style="width: 100%;">
          <option value="ID" <?php selected( $instance['orderby'], 'ID' ); ?>><?php esc_html_e( 'ID', 'dr' ); ?></option>
          <option value="author" <?php selected( $instance['orderby'], 'author' ); ?>><?php esc_html_e( 'Author', 'dr' ); ?></option>
          <option value="title" <?php selected( $instance['orderby'], 'title' ); ?>><?php esc_html_e( 'Title', 'dr' ); ?></option>
          <option value="date" <?php selected( $instance['orderby'], 'date' ); ?>><?php esc_html_e( 'Date', 'dr' ); ?></option>
          <option value="modified" <?php selected( $instance['orderby'], 'modified' ); ?>><?php esc_html_e( 'Modified', 'dr' ); ?></option>
          <option value="rand" <?php selected( $instance['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'dr' ); ?></option>
          <option value="comment_count" <?php selected( $instance['orderby'], 'comment_count' ); ?>><?php esc_html_e( 'Comment Count', 'dr' ); ?></option>
          <option value="menu_order" <?php selected( $instance['orderby'], 'menu_order' ); ?>><?php esc_html_e( 'Menu Order', 'dr' ); ?></option>
        </select>
 			</p>
      <p>
 				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category', 'dr' ); ?></label>
 				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" style="width: 100%;">
          <option value="all" <?php selected( $instance['category'], 'all' ); ?>><?php esc_html_e( 'All', 'dr' ); ?></option>
          <?php foreach( get_categories() as $category ) : ?>
            <option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['category'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
          <?php endforeach; ?>
 				</select>
 			</p>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Number of posts to show', 'dr' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" step="1" min="-1" value="<?php echo esc_attr( (int) $instance['limit'] ); ?>" />
      </p>
      <p>
 				<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Offset', 'dr' ); ?></label>
 				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( (int) $instance['offset'] ); ?>" />
        <small><?php esc_html_e( 'The number of posts to skip', 'dr' ); ?></small>
 			</p>
      <p>
 				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb' ) ); ?>" type="checkbox" <?php checked( $instance['thumb'] ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>"><?php esc_html_e( 'Display Thumbnail', 'dr' ); ?></label>
 			</p>
      <p>
 				<label style="display: block;" for="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>"><?php esc_html_e( 'Thumbnail (height)', 'dr' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_height' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( (int) $instance['thumb_height'] ); ?>"/ >
        <label style="display: block;" for="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>"><?php esc_html_e( 'Thumbnail (width)', 'dr' ); ?></label>
        <input style="display: block;" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( (int) $instance['thumb_width'] ); ?>" />
      </p>
      <p>
        <input id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" type="checkbox" <?php checked( $instance['show_date'] ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'dr' ); ?></label>
      </p>
      <p>
        <input id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" type="checkbox" <?php checked( $instance['show_comments'] ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>"><?php esc_html_e( 'Display post comments?', 'dr' ); ?></label>
      </p>

      <?php
    }
  }
}
