<?php

  // Custom Dashboard Widgets
  function custom_dashboard_widget() {
  	echo "<p>Dearest Client, Here&rsquo;s how to do that thing I told you about yesterday...</p>";
  }
  function add_custom_dashboard_widget() {
  	wp_add_dashboard_widget('custom_dashboard_widget', 'How to Do Something in WordPress', 'custom_dashboard_widget');
  }
  add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

?>
