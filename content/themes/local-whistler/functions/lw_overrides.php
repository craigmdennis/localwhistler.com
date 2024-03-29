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
  add_filter( 'excerpt_more', 'new_excerpt_more' );
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
  add_filter( 'embed_oembed_html', 'responsive_video_embed', 99, 4);
  add_action( 'admin_menu', 'remove_menus' );
  add_action( 'admin_menu', 'rename_posts_menu' );

  remove_filter('the_excerpt', 'wpautop');




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



  // Add custom toolbar for ACF ---------------------------------------------- //

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
    // Delete from array code http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
    if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
    {
        unset( $toolbars['Full' ][2][$key] );
    }

    return $toolbars;
  }



  // Add custom excerpt length ----------------------------------------------- //

  function new_excerpt_more( $more ) {
    // return '... <a class="more-link" href="' . get_permalink() . '">Read more</a>';
    return '...';
  }


  // Wrap oembeds in responsive markup --------------------------------------- //
  function responsive_video_embed($html, $url, $attr, $post_id) {
    return '<div class="video-embed">' . $html . '</div>';
  }



  // Custom excerpt length --------------------------------------------------- //
  function custom_excerpt_length( $length ) {
    return 20;
  }



  // Remove menu items ------------------------------------------------------- //
  function remove_menus() {
    global $menu;
    global $submenu;

    // echo '<pre>';
    // print_r($menu);
    // print_r($submenu);
    // echo '</pre>';

    // If you're not the site creator
    // Hide some menus
    if ( wp_get_current_user()->ID != 1 ) {
      unset($menu[25]); // Removes 'Comments'.
      unset($menu[65]); // Removes 'Plugins'.
      unset($submenu['index.php'][10]); // Removes 'Updates'.
      unset($submenu['themes.php'][5]); // Removes 'Themes'.
      unset($submenu['themes.php'][6]); // Removes 'Customize'.
      unset($submenu['themes.php'][11]); // Removes 'Editor'.
      unset($submenu['options-general.php'][41]); // Removes 'Geocoder'.
      unset($submenu['options-general.php'][42]); // Removes 'Super Cache'.
    }
  }



  // Rename post menu item --------------------------------------------------- //
  function rename_posts_menu() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News Items';
    $submenu['edit.php'][10][0] = 'Add News Item';
  }


?>
