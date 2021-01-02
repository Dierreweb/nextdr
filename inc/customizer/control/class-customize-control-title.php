<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   	CUSTOM CUSTOMIZER CONTROL: TITLE
------------------------------------------------------------------------------------------------ */

if( class_exists( 'WP_Customize_Control' ) ) {

	if( !class_exists( 'Dierreweb_Title' ) ) {
		Class Dierreweb_Title extends WP_Customize_Control {

			public function render_content() {

				if( !empty( $this->label ) ) : ?>

					<h1 class="customize-control-title">

						<?php echo strtoupper(esc_html ( $this->label ) ); ?>

					</h1>

				<?php endif;
			}
		}
	}
}
