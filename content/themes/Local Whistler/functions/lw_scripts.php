<?php

  // Smart jquery inclusion
  if (!is_admin()) {
  	wp_deregister_script('jquery');
  	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
  	wp_enqueue_script('jquery');
  }

  // Add google analytics to footer
  function add_google_analytics() {
  	echo '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
  	echo '<script type="text/javascript">';
  	echo 'var pageTracker = _gat._getTracker("UA-XXXXX-X");';
  	echo 'pageTracker._trackPageview();';
  	echo '</script>';
  }

  add_action('wp_footer', 'add_google_analytics');

?>
