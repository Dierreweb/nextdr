<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   RECENT COMMENTS WIDGET
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'DIERREWEB_Recent_Comments' ) ) {
	Class DIERREWEB_Recent_Comments extends WPH_Widget {

		function __construct() {

			$widget_ops = array(
				'classname' 	=> 'widget_recent_comments',
				'description' => __( 'Displays recent comments with user avatars.', 'dr' ) );

				parent::__construct( 'recent_comments', esc_html__( 'DIERREWEB Recent Comments', 'dr' ), $widget_ops );

				$this->alt_option_name = 'widget_recent_comments';

				add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

		}

		function widget( $args, $instance ) {

			$cache = wp_cache_get( 'widget_recent_comments', 'widget' );

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

			$avatar = ( isset( $instance['avatar'] ) ) ? $instance['avatar'] : true;
 			$avatar_size = ( isset( $instance['avatar_size'] ) ) ? $instance['avatar_size'] : 84;
			$number_of_comments = ( isset( $instance['number_of_comments'] ) ) ? $instance['number_of_comments'] : 3;
			$date = ( isset( $instance['date'] ) ) ? $instance['date'] : true;

			echo wp_kses_post( $before_widget );

			if( !empty( $widget_title ) ) {

				echo $before_title . wp_kses_post( $widget_title ) . $after_title;

			} ?>

				<ul class="recent-comments-list">

					<?php

					if( $number_of_comments == 0 ) {
						$number_of_comments = 3;
					}

					$args = array(
						'orderby'		=> 'date',
						'number'		=> $number_of_comments,
						'status'		=> 'approve',
					);

					global $comment;

					// The Query
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query( $args );

					// Comment Loop
					if( $comments ) {
						foreach( $comments as $comment ) { ?>

							<li>

								<?php if( $avatar ) : ?>
									<a class="recent-comment-thumbnail" href="<?php the_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>" rel="bookmark">
										<?php echo get_avatar( get_comment_author_email( $comment->comment_ID ), $avatar_size ); ?>
									</a>
	              <?php endif ?>

								<div class="recent-comment-info">
									<h5 class="recent-comment-title">
										<a href="<?php the_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>" rel="bookmark">
											<?php echo wp_kses_post( get_comment_author() ); ?>
										</a>
									</h5>

									<?php if( $date ) : ?>
										<p class="comment-date">
											<?php echo wp_kses_post( get_comment_date( get_option( 'date_format' ) ) ); ?>
										</p>
									<?php endif ?>

								</div>
							</li>

							<?php
						}
					}
					?>

				</ul>

			<?php

			echo wp_kses_post( $after_widget );

			ob_get_flush();

			wp_cache_set( 'widget_recent_comments', $cache, 'widget' );

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
      $instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['number_of_comments'] = is_int( intval( $new_instance['number_of_comments'] ) ) ? intval( $new_instance['number_of_comments'] ) : 3;
			$instance['avatar'] = isset( $new_instance['avatar'] ) ? (bool) $new_instance['avatar'] : '';
			$instance['avatar_size'] = intval( $new_instance['avatar_size'] );
			$instance['date'] = isset( $new_instance['date'] ) ? (bool) $new_instance['date'] : '';

			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if( isset( $alloptions['widget_recent_comments'] ) )
				delete_option( 'widget_recent_comments' );

			return $instance;
		}

		function flush_widget_cache() {
      wp_cache_delete( 'widget_recent_comments', 'widget' );
    }

		function form( $instance ) {

			$defaults = array(
 				'title'              => esc_attr__( 'Recent Comments', 'dr' ),
				'avatar'             => true,
 				'avatar_size'        => 84,
				'number_of_comments' => 3,
				'date'               => true
			);

			$instance = wp_parse_args( (array) $instance, $defaults );

			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'dr' ); ?></label>
      	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar' ) ); ?>" type="checkbox" <?php checked( $instance['avatar'] ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>"><?php esc_html_e( 'Display Avatar', 'dr' ); ?></label>
			</p>
			<p>
				<label style="display: block;" for="<?php echo esc_attr( $this->get_field_id( 'avatar_size' ) );?>"><?php esc_html_e( 'Avatar (size)', 'dr' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar_size' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( (int) $instance['avatar_size'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>"><?php esc_html_e( 'Number of comments to display', 'dr' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_comments' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['number_of_comments'] ); ?>" />
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" type="checkbox" <?php checked( $instance['date'] ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php esc_html_e( 'Display date', 'dr' ); ?></label>
			</p>

			<?php
		}
	}
}
