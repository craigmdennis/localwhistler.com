<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // ---------------------------------------------------------------------------//

  add_action( 'init', 'create_products' );
  add_filter( 'post_updated_messages', 'create_product_messages' );
  add_action( 'contextual_help', 'create_product_help', 10, 3 );



  // Add Product post type -------------------------------------------------- //

  function create_products() {
  	$labels = array(
  		'name'               => _x( 'Products', 'products' ),
  		'singular_name'      => _x( 'Product', 'product' ),
  		'menu_name'          => _x( 'Products', 'products' ),
  		'name_admin_bar'     => _x( 'Product', 'product'),
  		'add_new'            => _x( 'Add New', 'products' ),
  		'add_new_item'       => __( 'Add New Product' ),
  		'new_item'           => __( 'New Product' ),
  		'edit_item'          => __( 'Edit Product' ),
  		'view_item'          => __( 'View Product' ),
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
  		'rewrite'              => array(
        'slug' => 'product',
        'with_front' => false
      ),
  		'capability_type'    => 'page',
  		'has_archive'        => 'local-products',
  		'hierarchical'       => false,
  		'menu_position'      => null,
  		'supports'           => array( 'title', 'editor', 'thumbnail' ),
      'menu_position'      => 6
  	);

  	register_post_type( 'product', $args );

  }



  // Custom update messages -------------------------------------------------- //

  function create_product_messages( $messages ) {

    global $post, $post_ID;

    $messages['product'] = array(
      0  => '',
      1  => sprintf( __('Product updated. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
      2  => __('Custom field updated.'),
      3  => __('Custom field deleted.'),
      4  => __('Product updated.'),
      5  => isset($_GET['revision']) ? sprintf( __('Product restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6  => sprintf( __('Product published. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
      7  => __('Product saved.'),
      8  => sprintf( __('Product submitted. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
      9  => sprintf( __('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
      10 => sprintf( __('Product draft updated. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
  }



  // Crate contextual help (top right tab) ----------------------------------- //

  function create_product_help( $contextual_help, $screen_id, $screen ) {

    if ( 'product' == $screen->id ) {

      // Add my_help_tab if current screen is My Admin Page
      $screen->add_help_tab( array(
          'id'	     => 'editing_products',
          'title'	  => __('Editing Products'),
          'content'	=> '<h2>' . __('Editing products') . '</h2><p>' . __('This page allows you to view / modify product details. Please make sure to fill out the available boxes with the appropriate details. Optional fields are marked and if they are left blank will not show up on the main product page.') . '</p>'
      ));

    }

    return $contextual_help;

  }

?>
