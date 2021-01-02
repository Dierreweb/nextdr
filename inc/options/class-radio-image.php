<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( !class_exists( 'CMB2_Radio_Image' ) ) {

  /**
   * Class CMB2_Radio_Image
   */

  class CMB2_Radio_Image {

    public function __construct() {
      add_action( 'cmb2_render_radio_image', array( $this, 'callback' ), 10, 5 );
      add_filter( 'cmb2_list_input_attributes', array( $this, 'attributes' ), 10, 4 );
    }

    public function callback( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
      echo $field_type_object->radio();
    }

    public function attributes( $args, $defaults, $field, $cmb ) {
      if( $field->args['type'] == 'radio_image' && isset( $field->args['images'] ) ) {
        foreach( $field->args['images'] as $field_id => $image ) {
          if( $field_id == $args['value'] ) {
            // $image = trailingslashit($field->args['images_path']) . $image;
            $args['label'] = '<img src="' . $image . '" alt="' . $args['value'] . '" title="' . $args['label'] . '" />' . '<span>' . $args['label'] . '</span>';
            }
          }
        }
        return $args;
    }
  }
}

$cmb2_radio_image = new CMB2_Radio_Image();
