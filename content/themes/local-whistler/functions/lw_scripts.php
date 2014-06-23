<?php

  // Smart jquery inclusion
  add_action( 'wp_enqueue_scripts', 'lw_register_jquery' );
  add_action( 'wp_enqueue_scripts', 'lw_register_livereload' );


  // Add jQuery from Google CDN
  function lw_register_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
    wp_enqueue_script('jquery');
  }

  // Add the liverelaod script if we're in the local environment
  function lw_register_livereload() {
    if ( WP_ENV == 'local' ) {
      wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
    }
  }

?>
