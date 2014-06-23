<?php

  // Smart jquery inclusion
  add_action( 'wp_enqueue_scripts', 'lw_register_jquery' );
  add_action( 'wp_enqueue_scripts', 'lw_register_livereload' );


  // Deregister jQuery as it's included in the footer
  function lw_register_jquery() {
    wp_deregister_script('jquery');
  }

  // Add the liverelaod script if we're in the local environment
  function lw_register_livereload() {
    if ( WP_ENV == 'local' ) {
      wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
      wp_enqueue_script('livereload');
    }
  }

?>
