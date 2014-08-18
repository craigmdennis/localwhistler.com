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
  add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );



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

    if ( $screen->post_type === 'business' ) {
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

function my_toolbars( $toolbars ) {
  // Uncomment to view format of $toolbars
  /*
  echo '< pre >';
    print_r($toolbars);
  echo '< /pre >';
  die;
  */

  // Add a new toolbar called "Very Simple"
  // - this toolbar has only 1 row of buttons
  $toolbars['Very Simple' ] = array();
  $toolbars['Very Simple' ][1] = array('bold', 'link', 'unlink', 'undo', 'redo' );

  // Edit the "Full" toolbar and remove 'code'
  // - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
  if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
  {
      unset( $toolbars['Full' ][2][$key] );
  }

  // remove the 'Basic' toolbar completely
  // unset( $toolbars['Basic' ] );

  // return $toolbars - IMPORTANT!
  return $toolbars;
}

?>
