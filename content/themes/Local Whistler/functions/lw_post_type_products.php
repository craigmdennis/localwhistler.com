<?php

  add_action( 'init', 'create_businesses' );
  /**
   * Register a book post type.
   *
   * @link http://codex.wordpress.org/Function_Reference/register_post_type
   */
  function create_businesses() {
  	$labels = array(
  		'name'               => _x( 'Businesses' ),
  		'singular_name'      => _x( 'Business' ),
  		'menu_name'          => _x( 'Businesses' ),
  		'name_admin_bar'     => _x( 'Business'),
  		'add_new'            => _x( 'Add New', 'business' ),
  		'add_new_item'       => __( 'Add New Business' ),
  		'new_item'           => __( 'New Business' ),
  		'edit_item'          => __( 'Edit Business' ),
  		'view_item'          => __( 'View Business' ),
  		'all_items'          => __( 'All Businesses' ),
  		'search_items'       => __( 'Search Businesses' ),
  		'parent_item_colon'  => __( 'Parent Businesses:' ),
  		'not_found'          => __( 'No businesses found.' ),
  		'not_found_in_trash' => __( 'No businesses found in Trash.' )
  	);

  	$args = array(
  		'labels'             => $labels,
  		'public'             => true,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
  		'query_var'          => true,
  		'rewrite'            => array( 'slug' => 'business' ),
  		'capability_type'    => 'post',
  		'has_archive'        => true,
  		'hierarchical'       => false,
  		'menu_position'      => null,
  		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
  	);

  	register_post_type( 'business', $args );
  }

?>
