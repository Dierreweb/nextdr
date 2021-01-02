<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
   	CUSTOM CUSTOMIZER CONTROL: MULTIPLE CHECKBOXES
------------------------------------------------------------------------------------------------ */

if( class_exists( 'WP_Customize_Control' ) ) {

	if( !class_exists( 'Dierreweb_Checkbox_Multiple' ) ) {
		Class Dierreweb_Checkbox_Multiple extends WP_Customize_Control {

			public $type = 'checkbox-multiple';

			public function render_content() {

				if( empty( $this->choices ) ) :
					return;
				endif;

				if( !empty( $this->label ) ) : ?>

					<span class="customize-control-title">

						<?php echo esc_html( $this->label ); ?>

					</span>

				<?php endif;

				if( !empty( $this->description ) ) : ?>

					<span class="description customize-control-description">

						<?php echo esc_html( $this->description ); ?>

					</span>

				<?php endif;

				$multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

				<ul>

					<?php foreach( $this->choices as $value => $label ) : ?>

						<li>
							<label>
								<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />

								<?php echo esc_html( $label ); ?>

							</label>
						</li>

					<?php endforeach;?>

				</ul>

				<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />

				<?php
			}
		}
	}
}
