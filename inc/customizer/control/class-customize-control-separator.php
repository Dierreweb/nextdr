<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   	CUSTOM CUSTOMIZER CONTROL: SEPARATOR CONTROL
------------------------------------------------------------------------------------------------ */

if( class_exists( 'WP_Customize_Control' ) ) {

	if( !class_exists( 'Dierreweb_Separator' ) ) {
		Class Dierreweb_Separator extends WP_Customize_Control {
			public function render_content() {
				echo '<hr/>';
			}
		}
	}
}
