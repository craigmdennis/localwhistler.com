<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // ---------------------------------------------------------------------------//

  add_filter( 'enter_title_here', 'change_placeholder' );
  add_action( 'admin_head', 'remove_mediabuttons' );



  // Custom placeholder text ------------------------------------------------- //

  function change_placeholder( $title ){

    $screen = get_current_screen();

    if ( $screen->post_type == 'business' ) {
      return 'Enter business name here';
    }

    if ( $screen->post_type == 'product' ) {
      return 'Enter product name here';
    }

  }



  // Remove `Add Media` button ----------------------------------------------- //

  function remove_mediabuttons() {

    $screen = get_current_screen();

    if ( $screen->post_type == 'business' || 'product' ) {
      remove_action( 'media_buttons', 'media_buttons' );
    }

  }


?>
