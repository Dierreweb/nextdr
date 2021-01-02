<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( !class_exists( 'CMB2_Switch_Button_Set' ) ) {

  /**
   * Class CMB2_Switch_Button_Set
   */

  class CMB2_Switch_Button_Set {

    public function __construct() {
      add_filter( 'cmb2_render_button_set', array( $this, 'cmb2_render_button_set' ), 10, 5 );
    }

		public function cmb2_render_button_set( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	  	$buttonset = '<div class="dierreweb-btns">';
    	$conditional_value = ( isset($field->args['attributes']['data-conditional-value'] ) ? 'data-conditional-value="' . esc_attr( $field->args['attributes']['data-conditional-value'] ) . '"' : '' );
    	$conditional_id = ( isset( $field->args['attributes']['data-conditional-id'] ) ?' data-conditional-id="' . esc_attr( $field->args['attributes']['data-conditional-id'] ) . '"' : '' );
    	//$default_value = $field->args['attributes']['default'];

    	foreach( $field->options() as $value => $item ) {
				$selected_input = ( $escaped_value == $value ) ? 'checked="checked"' : '';
				$selected_label = ( $escaped_value == $value ) ? ' btn-active' : '';
				$buttonset .= '<input ' . $conditional_value . $conditional_id . ' type="radio" id="' . $field->args['_id'] . '-' . esc_attr($value) . '" name="' . $field->args['_name'] . '" value="' . esc_attr($value) . '" ' . $selected_input . '>
				<label class="btn-item' . $selected_label . '" for="' . $field->args['_name'] . '-' . esc_attr( $value ) . '"><span>' . esc_html( $item ) . '</span></label>';
    	}

	    $buttonset .= '</div>';
	    $buttonset .= $field_type_object->_desc( true );

	    echo $buttonset;
		}
  }
}

$cmb2_button_set = new CMB2_Switch_Button_Set();
