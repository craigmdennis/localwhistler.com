<?php

  add_action( 'init', 'create_products' );
  /**
   * Register a book post type.
   *
   * @link http://codex.wordpress.org/Function_Reference/register_post_type
   */
  function create_products() {
  	$labels = array(
  		'name'               => _x( 'Products', 'products' ),
  		'singular_name'      => _x( 'Product' ),
  		'menu_name'          => _x( 'Products' ),
  		'name_admin_bar'     => _x( 'Product'),
  		'add_new'            => _x( 'Add New', 'products' ),
  		'add_new_item'       => __( 'Add New Product' ),
  		'new_item'           => __( 'New Product' ),
  		'edit_item'          => __( 'Edit Products' ),
  		'view_item'          => __( 'View Products' ),
  		'all_items'          => __( 'All Products' ),
  		'search_items'       => __( 'Search Products' ),
  		'parent_item_colon'  => __( 'Parent Products:' ),
  		'not_found'          => __( 'No products found.' ),
  		'not_found_in_trash' => __( 'No products found in Trash.' )
  	);

  	$args = array(
  		'labels'             => $labels,
  		'public'             => true,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
  		'query_var'          => true,
  		'rewrite'            => array( 'slug' => 'product' ),
  		'capability_type'    => 'post',
  		'has_archive'        => true,
  		'hierarchical'       => false,
  		'menu_position'      => null,
  		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
  	);

  	register_post_type( 'product', $args );
  }

?>
