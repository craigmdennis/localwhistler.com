<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  add_action( 'wp_enqueue_scripts', 'lw_deregister_jquery' );
  // add_action( 'wp_enqueue_scripts', 'abcd' );



  // Deregister jQuery as it's included in the footer ------------------------ //

  function lw_deregister_jquery() {
    wp_deregister_script('jquery');
  }



  // Add the liverelaod script if we're in the local environment ------------- //

  // function abcd() {
    // if ( WP_ENV == 'local' ) {
    //   wp_register_script('livereload', get_template_directory_uri() . '/node_modules/grunt-contrib-watch/tasks/lib/livereload.js', null, '1', false);
    //   wp_enqueue_script('livereload');
    // }
  // }

?>
