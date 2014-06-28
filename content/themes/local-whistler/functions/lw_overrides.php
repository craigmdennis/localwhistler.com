<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // ---------------------------------------------------------------------------//

  add_filter( 'enter_title_here', 'change_placeholder' );
  add_action( 'admin_head', 'remove_mediabuttons' );
  add_filter( 'wp_tag_cloud', 'remove_tag_cloud', 10, 2 );
  add_filter( 'tiny_mce_before_init', 'forcePasteAsPlainText' );
  add_filter( 'teeny_mce_before_init', 'forcePasteAsPlainText' );
  add_filter( 'teeny_mce_plugins', 'loadPasteInTeeny' );
  add_filter( 'mce_buttons_2', 'removePasteAsPlainTextButton' );



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



  // Remove tag cloud from taxonomy admin area ------------------------------- //

  function remove_tag_cloud ( $return, $args ) {
    return false;
  }



  // Paste as plain text by default ------------------------------------------ //

  function forcePasteAsPlainText( $mceInit ) {

    global $tinymce_version;

    if ( $tinymce_version[0] < 4 ) {
      $mceInit[ 'paste_text_sticky' ] = true;
      $mceInit[ 'paste_text_sticky_default' ] = true;
    } else {
      $mceInit[ 'paste_as_text' ] = true;
    }

    return $mceInit;
  }

  function loadPasteInTeeny( $plugins ) {

    return array_merge( $plugins, (array) 'paste' );

  }

  function removePasteAsPlainTextButton( $buttons ) {

    if( ( $key = array_search( 'pastetext', $buttons ) ) !== false ) {
      unset( $buttons[ $key ] );
    }

    return $buttons;

  }

?>
