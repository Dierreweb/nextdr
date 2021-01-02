<?php

if ( ! defined( 'DIERREWEB_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/* ---------------------------------------------------------------------------------------------
  OVERRRIDE WP BLOCK DEFAULT GALLERY
------------------------------------------------------------------------------------------------ */

function dierreweb_wrap_gallery_block( $block_content, $block ) {
	if ( 'core/gallery' !== $block['blockName'] ) {
		return $block_content;
	}

  $new_content = '';
  $classes = '';
  $id = '';

  if( !empty( $blocks['attrs']['anchor'] ) ) {
    $id .= sprintf( '#id=%s', $blocks['attrs']['anchor'] );
  }

  if( !empty( $block['attrs']['columns'] ) ) {
    $classes .= sprintf( '%s ', $block['attrs']['columns'] );
  }

  if( !empty( $block['attrs']['align'] ) ) {
    $classes .= sprintf( 'align%s ', $block['attrs']['align'] );
  }

  if( $block['attrs']['imageCrop'] !== false ) {
    $classes .= 'is-cropped ';
  }

  if( !empty( $block['attrs']['className'] ) ) {
    $classes .= sprintf( '%s', $block['attrs']['className'] );
  }

  $items = count( $block['attrs']['ids'] ); //numero elementi

  $new_content .= "<figure $id class='wp-block-gallery columns-$classes'><ul class='blocks-gallery-grid'>";

  foreach( (array) $block['attrs']['ids'] as $idx => $attachment_id ) {

    if( empty( $block['sizeSlug'] ) ) {
      $block['sizeSlug'] = 'full';
    }

    $figcaption = '';

    if( !empty( $block['attrs']['caption'] ) ) {
      $figcaption .= '<figcaption class="blocks-gallery-item__caption">' . sprintf( '%s ', $block['attrs']['caption'] ) . '</figcaption>';
    }

    $src = wp_get_attachment_url( $attachment_id );
    $srcset = wp_get_attachment_image_srcset( $attachment_id, $block['sizeSlug'], null );
    $sizes = wp_get_attachment_image_sizes( $attachment_id, $block['sizeSlug'], null );

    $new_content .= "<li class='blocks-gallery-item'>";
    $href = '';

    switch ($block['attrs']['linkTo']) {
      case 'LINK_DESTINATION_MEDIA':
          $href = wp_get_attachment_url( $attachment_id );
          break;
      case 'LINK_DESTINATION_ATTACHMENT':
          $href = wp_get_attachment_image_url( $attachment_id );
          break;
      // case 'none':
      //     $href = "i equals 1";
      //     break;
      }

    $new_content .= "<img src='{$src}' data-id='{$attachment_id}' data-full-url='{$src}' data-link='' srcset='{$srcset}' sizes='{$sizes}' class='wp-image-{$attachment_id}' alt='' />";
    $new_content .= $figcaption;
    $new_content .= "</li>";
  }

  $new_content .= '</ul></figure>';

	return $new_content;
}

add_filter( 'render_block', 'dierreweb_wrap_gallery_block', 10, 2 );
