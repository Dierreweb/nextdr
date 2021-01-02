<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( !class_exists( 'CMB2_Field_Slider' ) ) {

  /**
   * Class CMB2_Field_Slider
   */

  class CMB2_Field_Slider {

    public function __construct() {
      add_action( 'cmb2_render_slider', array( $this, 'cmb2_render_slider' ), 10, 5 );
    }

    public function cmb2_render_slider( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {

    	$slider = $field_type_object->_desc( true );
    	$slider .= '<div class="cmb2-slider"></div>';

    	$slider .= $field_type_object->input( array(
    		'type'       => 'hidden',
    		'class'      => 'cmb2-slider-value',
    		'readonly'   => 'readonly',
    		'data-start' => absint( $field_escaped_value ),
    		'data-min'   => $field->min(),
    		'data-step'  => $field->step(),
    		'data-max'   => $field->max(),
    		'desc'       => '',
    	));

    	$slider .= '<span class="cmb2-slider-value-display">' . $field->value_label() . ' <strong><span class="cmb2-slider-value-text"></span></strong></span>';

    	echo $slider;
    }
  }
}

$cmb2_field_slider = new CMB2_Field_Slider();
