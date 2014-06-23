<?php

  // ToDo: Add exceptions param
  function list_directory( $directory, $filetype ) {

    // Get only the filetypes we want
    $dir = THEME_PATH . '/' . $directory;
    $files = glob( $dir . '/*' . $filetype);

    // Check to make sure the directory actually exists
    if ( file_exists( $dir ) ) {

      foreach ( $files as $file) {

        // Store the filename
        $filename = basename( $file );

        // Match the file type an do special things
        switch ($filetype) {

          // For stylesheets
          case '.css':
            echo '<link rel="stylesheet" href="' . get_bloginfo('template_directory') . '/' . $directory  . '/' . $filename . '"/>';
          break;

          // For scripts
          case '.js':
            echo '<script src="' . get_bloginfo('template_directory') . '/' . $directory . '/' . $filename . '"/>';
          break;

        } // END switch

      } // END foreach

    } // END if directory exists

  } // END list_directory

?>
