<?php

  // Remove unwanted crap from the <head>
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

  // Kill the admin nag
  if (!current_user_can('edit_users')) {
  	add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
  	add_filter('pre_option_update_core', create_function('$a', "return null;"));
  }

?>
