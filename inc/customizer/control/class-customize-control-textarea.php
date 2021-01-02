<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   	CUSTOM CUSTOMIZER CONTROL: TEXT EDITOR
------------------------------------------------------------------------------------------------ */

if( class_exists( 'WP_Customize_Control' ) ) {

  if( !class_exists( 'Dierreweb_Text_Area' ) ) {
    Class Dierreweb_Text_Area extends WP_Customize_Control {

      public $type = 'textarea';

      public function render_content() { ?>

        <label>
          <span class="customize-text_editor">

            <?php echo esc_html( $this->label ); ?>

          </span>

          <?php
            $settings = array( 'textarea_name' => $this->id );

            do_action( 'admin_print_footer_scripts' );
            wp_editor( $this->value(), $this->id, $settings );
          ?>

        </label>

      <?php
      }
    }
  }
}
