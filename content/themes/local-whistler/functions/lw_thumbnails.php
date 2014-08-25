<?php

  // Add thumbnail support
  add_theme_support( 'post-thumbnails' );

  // Add custom thumbnail sizes
  add_image_size( 'media--featured', 1200, 800 );
  add_image_size( 'media--card', 800, 600 );
  add_image_size( 'media--thumb', 150, 9999 );

?>
