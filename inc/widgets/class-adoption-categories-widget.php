<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   WIDGET ADOPTION CATEGORIES
------------------------------------------------------------------------------------------------ */

if( !class_exists( 'DIERREWEB_Adoption_Categories' ) ) {

  class DIERREWEB_Adoption_Categories extends WPH_Widget {

    public function __construct() {
      $widget_ops = array(
        'classname'   => 'widget_adoption_categories',
        'description' => esc_html__( 'A list or dropdown of categories.', 'dr' ) );

      parent::__construct( 'adoption_categories', esc_html__( 'Dierreweb Adoption Categories', 'dr' ), $widget_ops );
    }

    public function widget( $args, $instance ) {

      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Adoption Categories', 'dr' ) : $instance['title'], $instance, $this->id_base );
      $c = !empty($instance['count']) ? '1' : '0';
      $h = !empty($instance['hierarchical']) ? '1' : '0';
      $d = !empty($instance['dropdown']) ? '1' : '0';

      echo $args['before_widget'];
      if( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
      }

      $cat_args = array(
        'orderby'      => 'name',
        'show_count'   => $c,
        'hierarchical' => $h,
        'taxonomy'     => 'adopted',
        'id'           => 'adopted'
      );

      if( $d ) {
        $cat_args['show_option_none'] = esc_html__( 'Select Category', 'dr' );
        wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
      ?>

    <script type='text/javascript'>
    /* <![CDATA[ */
      var dropdown = document.getElementById("adopted");
      function onCatChange() {
        if(dropdown.options[dropdown.selectedIndex].value > 0) {
          location.href = "<?php echo esc_url(home_url()); ?>/adopted/"+dropdown.options[dropdown.selectedIndex].value;
        }
      }
      dropdown.onchange = onCatChange;
    /* ]]> */
    </script>

    <?php
      } else { ?>
      <ul>
      <?php
        $cat_args['title_li'] = '';
          wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
      ?>
      </ul>
      <?php
      }

      echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['count'] = !empty( $new_instance['count'] ) ? 1 : 0;
      $instance['hierarchical'] = !empty( $new_instance['hierarchical'] ) ? 1 : 0;
      $instance['dropdown'] = !empty( $new_instance['dropdown'] ) ? 1 : 0;

      return $instance;
    }

    public function form( $instance ) {
      //Defaults
      $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
      $title = esc_attr( $instance['title'] );
      $count = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
      $hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
      $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
      ?>

      <p>
      	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
      		<?php esc_html_e( 'Title:', 'dr' ); ?>
      	</label>
      	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
      </p>

      <p>
  			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>"<?php checked( $dropdown ); ?>/>
        <label for="<?php echo esc_attr( $this->get_field_id('dropdown') ); ?>"><?php esc_html_e('Display as dropdown', 'dr'); ?></label><br/>
        <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"<?php checked( $count ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Show post counts', 'dr' ); ?></label><br/>
        <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>"<?php checked($hierarchical ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id ('hierarchical' ) ); ?>"><?php esc_html_e( 'Show hierarchy', 'dr' ); ?></label>
      </p>
      <?php
    }
  }
}
