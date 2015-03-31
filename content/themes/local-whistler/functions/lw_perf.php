<?php

// -------------------------------------------------------------------------- //
// All actions are called at the top.
// They should be self explanitory and in the order in which the functions
// appear in the file.
// ---------------------------------------------------------------------------//

  add_action( 'wp_update_nav_menu', 'updateMenu' );



// Create transient for menu -------------------------------------------------//
  function getThemesMenu() {
      $menu = get_transient('cfMenu');

      if (false === $menu) {
                  // parameter echo will return the menu instead of echoing it
          $menu = wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => 0 ) );
          set_transient('cfMenu', $menu, 60*3);
      }

      return $menu;
  }

// Delete the transient when the menu updates --------------------------------//
  function updateMenu() {
      delete_transient('cfMenu');
  }

?>
