<?php

  // Set Constants
  define('THEME_PATH', dirname(__FILE__) );

  // Include external libraries
  require_once('functions/vendor/mobile-detect.php');

  // Browser sniffing
  require_once('functions/lw_devices.php');

  // Custom post types
  require_once('functions/lw_post_type_businesses.php');
  require_once('functions/lw_post_type_products.php');

  // Custom dashboard widgets
  require_once('functions/lw_dashboard.php');

  // Custom theme options

  // Misc Functions
  require_once('functions/lw_comments.php');
  require_once('functions/lw_sidebar.php');
  require_once('functions/lw_links.php');
  require_once('functions/lw_query_utilities.php');
  require_once('functions/lw_thumbnails.php');
  require_once('functions/lw_security.php');
  require_once('functions/lw_menus.php');
  require_once('functions/lw_scripts.php');
  require_once('functions/lw_overrides.php');
  require_once('functions/lw_taxonomies.php');

  // SANDBOX - Things that haven't been organised yet

?>
