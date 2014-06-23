<?php

  // Smart jquery inclusion
  add_action( 'wp_enqueue_scripts', 'lw_register_jquery' );


  function lw_register_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
    wp_enqueue_script('jquery');
  }

?>
