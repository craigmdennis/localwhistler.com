<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  add_action( 'wp_enqueue_scripts', 'lw_deregister_jquery' );



  // Deregister jQuery as it's included in the footer ------------------------ //

  function lw_deregister_jquery() {
    wp_deregister_script('jquery');
  }

?>
