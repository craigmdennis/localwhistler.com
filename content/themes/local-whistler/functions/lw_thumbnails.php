<?php

  // Add thumbnail support
  add_theme_support( 'post-thumbnails' );

  // Add custom thumbnail sizes
  add_image_size( 'media--featured', 1200, 800 );
  add_image_size( 'media--card', 800, 600 );
  add_image_size( 'media--thumb', 150, 150 );


  function wp_get_attachment( $attachment_id, $thumbnail_size = 'thumbnail' ) {

    $attachment = get_post( $attachment_id );
    return array(
      'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
      'caption' => $attachment->post_excerpt,
      'description' => $attachment->post_content,
      'url' => $attachment->guid,
      'href' => get_permalink( $attachment->ID ),
      'sizes' => array(
        $thumbnail_size => wp_get_attachment_image_src( $attachment_id )[0],
        $thumbnail_size . '-width' => wp_get_attachment_image_src( $attachment_id )[1],
        $thumbnail_size . '-height' => wp_get_attachment_image_src( $attachment_id )[2]
      ),
      'title' => $attachment->post_title
    );
  }

?>
