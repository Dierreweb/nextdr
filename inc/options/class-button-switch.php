<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( !class_exists( 'CMB2_Switch_Button_Switch' ) ) {

  /**
   * Class CMB2_Switch_Button_Switch
   */

  class CMB2_Switch_Button_Switch {

    public function __construct() {
      add_filter( 'cmb2_render_button_switch', array( $this, 'cmb2_render_button_switch' ), 10, 5 );
    }

		public function cmb2_render_button_switch( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
			$switch = '<div class="dierreweb-btns">';
		  $switch .= $field_type_object->_desc( true );
			$conditional_value = ( isset( $field->args['attributes']['data-conditional-value']) ? 'data-conditional-value="' . esc_attr( $field->args['attributes']['data-conditional-value'] ) . '"' : '' );
		  $conditional_id = ( isset( $field->args['attributes']['data-conditional-id'] ) ? ' data-conditional-id="' . esc_attr( $field->args['attributes']['data-conditional-id'] ) . '"' : '' );
		  $label_on = ( isset( $field->args['label'] ) ? esc_attr( $field->args['label']['on'] ) : 'On' );
		  $label_off = ( isset($field->args['label'] ) ? esc_attr( $field->args['label']['off'] ) : 'Off' );
		  $switch .= '<input ' . $conditional_value . $conditional_id . ' type="radio" id="' . $field->args['_id'] . '-1"  name="' . esc_attr( $field->args['_name'] ) . '" value="1"' . ( $escaped_value == 1 ? 'checked="checked"' : '' ) . '/>
			<input ' . $conditional_value.$conditional_id . ' type="radio" id="' . $field->args['_id'] . '-2" name="' . esc_attr( $field->args['_name'] ) . '" value="0" ' . ( ( $escaped_value == '' || $escaped_value == 0 ) ? 'checked="checked"' : '' ) . '/>
			<label class="btn-item' . ( $escaped_value == 1 ? ' btn-switch-active' : '' ) . '" for="' . $field->args['_name'] . '-1"><span>' . $label_on . '</span></label>
			<label class="btn-item' . ( ( $escaped_value == '' || $escaped_value == 0 ) ? ' btn-active' : '' ) . '" for="' . $field->args['_name'] . '-2"><span>' . $label_off . '</span></label>';
			$switch .= '</div>';

			echo $switch;
		}
  }
}

$cmb2_button = new CMB2_Switch_Button_Switch();
