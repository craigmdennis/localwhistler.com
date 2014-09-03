<?php

  // Set Constants
  define('THEME_PATH', dirname(__FILE__) );

  // Include external libraries
  require_once(get_template_directory() . '/functions/vendor/mobile-detect.php');

  // Performance
  require_once(get_template_directory() . '/functions/lw_perf.php');

  // Browser sniffing
  require_once(get_template_directory() . '/functions/lw_devices.php');

  // Custom post types
  require_once(get_template_directory() . '/functions/lw_post_type_businesses.php');
  require_once(get_template_directory() . '/functions/lw_post_type_products.php');

  // Custom dashboard widgets
  require_once(get_template_directory() . '/functions/lw_dashboard.php');

  // Custom theme options
  require_once(get_template_directory() . '/functions/lw_sidebars.php');
  require_once(get_template_directory() . '/functions/lw_options.php');

  // Misc Functions
  require_once(get_template_directory() . '/functions/lw_comments.php');
  require_once(get_template_directory() . '/functions/lw_links.php');
  require_once(get_template_directory() . '/functions/lw_attachments.php');
  require_once(get_template_directory() . '/functions/lw_query_utilities.php');
  require_once(get_template_directory() . '/functions/lw_thumbnails.php');
  require_once(get_template_directory() . '/functions/lw_security.php');
  require_once(get_template_directory() . '/functions/lw_menus.php');
  require_once(get_template_directory() . '/functions/lw_scripts.php');
  require_once(get_template_directory() . '/functions/lw_overrides.php');
  require_once(get_template_directory() . '/functions/lw_taxonomies.php');
  require_once(get_template_directory() . '/functions/lw_json.php');

  // SANDBOX - Things that haven't been organised yet

?>
