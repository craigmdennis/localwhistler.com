<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  // Adding actions means they are only run on the front-end
  add_action( 'wp_enqueue_scripts', 'lw_deregister_scripts' );
  add_action( 'wp_enqueue_scripts', 'lw_enqueue_global' );

  // Dynamically added if browser 'Cuts the mustard'
  // Uncomment to load for all browsers
  // add_action( 'wp_enqueue_scripts', 'lw_enqueue_filtering' );



  // Deregister scripts ------------------------------------------------------ //

  function lw_deregister_scripts() {
    wp_deregister_script('jquery');
  };



  // Add filtering scripts --------------------------------------------------- //

  function lw_enqueue_filtering() {

    wp_register_script(
      'filtering', get_template_directory_uri() . '/scripts/filtering.js',
      array(),
      NULL,
      true
    );

    // Registered in functions/lw_post_data.php
    wp_enqueue_script( 'filtering' );

    // If it's the filtering pages
    if (is_search() || taxonomy_exists('business_location') || taxonomy_exists('business_type')) {

      // Only use the filtering.js on pages that need it.
      wp_enqueue_script('filtering');

    }

  };



  // Add global scripts ------------------------------------------------------ //

  function lw_enqueue_global() {

    wp_register_script(
      'global', get_template_directory_uri() . '/scripts/script.js',
      array(),
      NULL,
      true
    );

    wp_enqueue_script( 'global' );

  }

?>
