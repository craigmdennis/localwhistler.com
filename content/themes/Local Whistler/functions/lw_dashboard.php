<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // ---------------------------------------------------------------------------//

  add_action( 'admin_init', 'remove_dashboard_meta' );
  add_action( 'wp_dashboard_setup', 'add_dashboard_support' );



  // Remove some dashboard widgets ------------------------------------------- //

  function remove_dashboard_meta() {
    // remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    // remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
}



  // Add a support dashbaord widget ------------------------------------------ //

  function create_dashboard_support_widget() {
  	echo "<p><strong>We hope you like your new site. We spent a lot of time making sure that it works properly.</strong></p>

    <p>If you find that something's not working as you expected or something breaks, or if you have a need for some <strong>additional features</strong>, please drop us an email and we will be happy to help.</p>
    <p>We'll also check in on you from time-to-time to make sure everything is running smoothly.</p>

    <a class='button button-primary' href='mailto:support@simplebitdesign.com' target='_blank'>Get in touch</a> ";
  }

  function add_dashboard_support() {
  	wp_add_dashboard_widget('create_dashboard_support_widget', 'Support', 'create_dashboard_support_widget');
  }

?>
