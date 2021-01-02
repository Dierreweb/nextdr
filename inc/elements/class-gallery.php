<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ---------------------------------------------------------------------------------------------
  OVERRRIDE WP DEFAULT GALLERY
------------------------------------------------------------------------------------------------ */

if( !function_exists( 'dierreweb_post_gallery' ) ) {
  function dierreweb_post_gallery( $output, $attr ) {

    //wp_enqueue_script( 'dierreweb-justifiedGallery' );

    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if( !$attr['orderby'] )
        unset( $attr['orderby'] );
    }

    extract( shortcode_atts( array(
      'order'   => 'ASC',
      'orderby' => 'menu_order ID',
      'id'      => $post->ID,
      'caption' => false,
      'view'		=> 'grid',
      'icontag' => 'dt',
      'itemtag' => 'a',
      'columns' => 3,
      'size'    => 'thumbnail',
      'include' => '',
      'exclude' => ''

    ), $attr ) );

    $id = intval( $id );
    if( 'RAND' == $order )
      $orderby = 'none';

    if( !empty( $include ) ) {
      $include = preg_replace( '/[^0-9,]+/', '', $include );
      $_attachments = get_posts( array(
        'include'        => $include,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => $order,
        'orderby'        => $orderby
      ) );

      $attachments = array();

      foreach( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }

    } elseif( !empty( $exclude ) ) {
      $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
      $attachments = get_children( array(
        'post_parent'    => $id,
        'exclude'        => $exclude,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => $order,
        'orderby'        => $orderby
      ) );
    } else {
      $attachments = get_children( array(
        'post_parent'    => $id,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => $order,
        'orderby'        => $orderby
      ) );
    }

    if( empty( $attachments ) )
      return '';

    if( is_feed() ) {
      $output = "\n";
      foreach( $attachments as $att_id => $attachment )
        $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
      return $output;
    }

    $itemtag = tag_escape( $itemtag );
    $columns = intval( $columns );
    $itemwidth = $columns > 0 ? floor( 100/$columns ) : 100;
    $float = is_rtl() ? 'right' : 'left';
    $selector = "gallery-{$instance}";
    $gallery_style = $gallery_div = $gallery_grid= '';

  	if( apply_filters( 'use_default_gallery_style', true ) )
  		$gallery_style = "
  		<style type='text/css'>
        .gallery-grid {
          width: 100%;
          display: flex;
          flex-wrap: wrap;
          list-style-type: none;
          padding: 0;
          margin: 0; }

  			// #{$selector} {
  			// 	margin: 0 auto;
  			// }
        //
  			#{$selector} .gallery-item {
          clear: both;
        }
  				//float: {$float};
  				margin-top: 10px;
  				text-align: center;
  				width: {$itemwidth}%;
  			}
        //
  			// #{$selector} img {
  			// 	border: 1px solid #fff;
  			// }
        //
  			// #{$selector} .gallery-caption {
  			// 	margin-left: 0;
  			// }

  		</style>
  		<!-- see gallery_shortcode() in wp-includes/media.php -->";

  	   $size_class = sanitize_html_class( $size );
       $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
       $gallery_grid = "<div class=\"gallery-grid\">";
       $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div . $gallery_grid);

       $i = 0;

       // foreach( $attachments as $id => $attachment ) {
       //   $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
       //
       //   $output .= "
       //   <{$icontag} class='gallery-item'>
       //    $link
       //   </{$icontag}>";
       //
       //  if( $columns > 0 && ++$i % $columns == 0 )
       //   $output .= '';
       // }

       // function add_class_attachment_link($html){
       //    $postid = get_the_ID();
       //    $html = str_replace('<a','<a class="isitwp"', $html);
       //    return $html;
       //  }
       //  add_filter('wp_get_attachment_link','add_class_attachment_link', 10, 1);

       // function prefix_content_gallery( $content ) {
       //   global $post;
       //
       //   $pattern     = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       //   $replacement = '<a$1href=$2$3.$4$5 data-rel="mfp" title="' . $post->post_title . '"$6>';
       //   $content     = preg_replace( $pattern, $replacement, $content );
       //
       //   return $content;
       //  }
       //  add_filter( 'wp_get_attachment_link','prefix_content_gallery', 10, 1 );

       foreach( $attachments as $id => $attachment ) {
         if( !empty( $attr['link'] ) && 'file' === $attr['link'] ) {
     			$link = wp_get_attachment_link( $id, $size, false, false );

          $output .= "
          <{$icontag} class='gallery-item'>
           $link
          </{$icontag}>";

     		} elseif( !empty( $attr['link'] ) && 'none' === $attr['link'] ) { // Nothing
     			$link = wp_get_attachment_image( $id, $size, false );

          $output .= "$link";
          // $output .= "
          // <{$icontag} class='cazz'>
          //  $link
          // </{$icontag}>";

     		} else {
     			$link = wp_get_attachment_link( $id, $size, true, false, false ); // Attachment page
          // $output .= "
          // <{$icontag} class='gallery-item'>
          //  $link
          // </{$icontag}>";
          $output .= "$link";
     		}

        if( $columns > 0 && ++$i % $columns == 0 )
         $output .= '';
       }

       // foreach($attachments as $id => $attachment) {
       //   $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
       //   $output .= "
       //    <{$icontag} class='gallery-item'>
       //      $link
       //    </{$icontag}>";
       //  if($columns > 0 && ++$i % $columns == 0)
       //   $output .= '';
       // }

      $output .= "
      <br style='clear: both;'/>
      </div>
      </div>\n";

      return $output;
  }

  add_filter( 'post_gallery', 'dierreweb_post_gallery', 10, 2 );
}
