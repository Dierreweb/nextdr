<?php

use function Genesis\CustomBlocks\add_block;
use function Genesis\CustomBlocks\add_field;

if( !function_exists( 'register_dr_text_block' ) ) {
  function register_dr_text_block() {
    add_block( 'dr-text', array(
      'icon' => 'waves'
    ) );

    add_field( 'dr-text', 'title' );

    add_field( 'dr-text', 'description', array(
      'control' => 'textarea'
    ) );

    add_field( 'dr-text', 'cta', array(
      'control' => 'text',
      'width' => '50',
    ) );

    add_field( 'dr-text', 'cta-link', array(
      'control' => 'text',
      'width' => '50',
    ) );
  }
  add_action( 'genesis_custom_blocks_add_blocks', 'register_dr_text_block' );
}

if( !function_exists( 'register_dr_member_block' ) ) {
  function register_dr_member_block() {
    add_block( 'dr-member', array(
      'icon' => 'group'
    ) );

    add_field( 'dr-member', 'name-member-1', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'name-member-2', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'name-member-3', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'name-member-4', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'position-member-1', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'position-member-2', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'position-member-3', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'position-member-4', array(
      'width'   => '25',
      'control' => 'text'
    ) );

    add_field( 'dr-member', 'image-member-1', array(
      'control' => 'image',
      'width' => '25'
    ) );

    add_field( 'dr-member', 'image-member-2', array(
      'control' => 'image',
      'width' => '25'
    ) );

    add_field( 'dr-member', 'image-member-3', array(
      'control' => 'image',
      'width' => '25'
    ) );

    add_field( 'dr-member', 'image-member-4', array(
      'control' => 'image',
      'width' => '25'
    ) );

    add_field( 'dr-member', 'facebook-link-member-1', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'facebook-link-member-2', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'facebook-link-member-3', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'facebook-link-member-4', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'twitter-link-member-1', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'twitter-link-member-2', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'twitter-link-member-3', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'twitter-link-member-4', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'linkedin-link-member-1', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'linkedin-link-member-2', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'linkedin-link-member-3', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'linkedin-link-member-4', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'instagram-link-member-1', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'instagram-link-member-2', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'instagram-link-member-3', array(
      'width'   => '25',
      'control' => 'url'
    ) );

    add_field( 'dr-member', 'instagram-link-member-4', array(
      'width'   => '25',
      'control' => 'url'
    ) );

  }
  add_action( 'genesis_custom_blocks_add_blocks', 'register_dr_member_block' );
}
