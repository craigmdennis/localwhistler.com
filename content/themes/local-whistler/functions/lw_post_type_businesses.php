<?php

  // ------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  add_action( 'init', 'create_businesses' );
  add_filter( 'post_updated_messages', 'create_business_messages' );
  add_action( 'contextual_help', 'create_business_help', 10, 3 );
  add_action( 'init', 'create_business_locations', 0 );
  add_action( 'init', 'create_business_types', 0 );
  add_action( 'init', 'create_business_filters', 0 );
  add_action( 'admin_menu' , 'remove_meta' );


  // Add Business post type -------------------------------------------------- //

  function create_businesses() {
  	$labels = array(
  		'name'                 => _x( 'Businesses', 'businesses' ),
  		'singular_name'        => _x( 'Business', 'business' ),
  		'menu_name'            => _x( 'Businesses', 'businesses' ),
  		'name_admin_bar'       => _x( 'Business', 'business'),
  		'add_new'              => _x( 'Add New', 'business' ),
  		'add_new_item'         => __( 'Add New Business' ),
  		'new_item'             => __( 'New Business' ),
  		'edit_item'            => __( 'Edit Business' ),
  		'view_item'            => __( 'View Business' ),
  		'all_items'            => __( 'All Businesses' ),
  		'search_items'         => __( 'Search Businesses' ),
  		'parent_item_colon'    => __( 'Parent Businesses:' ),
  		'not_found'            => __( 'No businesses found.' ),
  		'not_found_in_trash'   => __( 'No businesses found in Trash.' )
  	);

  	$args = array(
  		'labels'               => $labels,
  		'public'               => true,
  		'publicly_queryable'   => true,
  		'show_ui'              => true,
  		'show_in_menu'         => true,
  		'query_var'            => true,
  		'rewrite'              => array(
        'slug' => 'business',
        'with_front' => false
      ),
  		'capability_type'      => 'page',
  		'has_archive'          => true,
  		'hierarchical'         => false,
  		'menu_position'        => null,
  		'supports'             => array( 'title', 'editor', 'thumbnail', 'excerpt'),
      'menu_position'        => 5
  	);

  	register_post_type( 'business', $args );

  }



  // Custom update messages -------------------------------------------------- //

  function create_business_messages( $messages ) {

    global $post, $post_ID;

    $messages['business'] = array(
      0  => '',
      1  => sprintf( __('Business updated. <a href="%s">View business</a>'), esc_url( get_permalink($post_ID) ) ),
      2  => __('Custom field updated.'),
      3  => __('Custom field deleted.'),
      4  => __('Business updated.'),
      5  => isset($_GET['revision']) ? sprintf( __('Business restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6  => sprintf( __('Business published. <a href="%s">View business</a>'), esc_url( get_permalink($post_ID) ) ),
      7  => __('Business saved.'),
      8  => sprintf( __('Business submitted. <a target="_blank" href="%s">Preview business</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
      9  => sprintf( __('Business scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview business</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
      10 => sprintf( __('Business draft updated. <a target="_blank" href="%s">Preview business</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
  }



  // Crate contextual help (top right tab) ----------------------------------- //

  function create_business_help( $contextual_help, $screen_id, $screen ) {

    if ( 'business' == $screen->id ) {

      $screen->add_help_tab( array(
          'id'	     => 'editing_businesses',
          'title'	  => __('Editing Businesses'),
          'content'	=> '<h2>' . __('Editing businesses') . '</h2><p>' . __('This page allows you to view / modify business details. Please make sure to fill out the available boxes with the appropriate details. Required fields are marked and if they are left blank will trigger an error preventing you from publishing.') . '</p>'
      ));

      $screen->add_help_tab( array(
          'id'	     => 'filters',
          'title'	  => __('Filters'),
          'content'	=> '<h2>' . __('Filters') . '</h2><p>' . __('Filters are tags for each business. You can use as many as you like.') . '</p>'
      ));

      $screen->add_help_tab( array(
          'id'	     => 'business_types',
          'title'  	=> __('Business Types'),
          'content'	=> '<h2>' . __('Business types') . '</h2><p>' . __('Businesses can have multiple types. For example Rowland\'s Creekside pub would have a `type` of `Food &amp; Drink` but might also have `Retail Shop` as it sells wine and spirits. You could also set them up as seperate businesses.') . '</p>'
      ));

      $screen->add_help_tab( array(
          'id'	     => 'featured_images',
          'title'  	=> __('Featured Images'),
          'content'	=> '<h2>' . __('Featured images') . '</h2><p>' . __('Please make sure featured images are <em>at least</em> <strong>1024px wide by 600px high</strong> to ensure good quality. <br>Ideally images should be <strong>2048px wide by 1200px high</strong> for Retina screens.') . '</p>'
      ));



    }

    return $contextual_help;

  }



  // Add Business locations -------------------------------------------------- //

  function create_business_locations() {

    $labels = array(
      'name'              => _x( 'Locations', 'locations' ),
      'singular_name'     => _x( 'Location', 'location' ),
      'search_items'      => __( 'Search Locations' ),
      'all_items'         => __( 'Location' ),
      'parent_item'       => __( 'Parent Location' ),
      'parent_item_colon' => __( 'Parent Location:' ),
      'edit_item'         => __( 'Edit Location' ),
      'update_item'       => __( 'Update Location' ),
      'add_new_item'      => __( 'Add New Location' ),
      'new_item_name'     => __( 'New Location' ),
      'menu_name'         => __( 'Locations' )
    );

    $rewrite = array(
      'slug'              => 'location', // This controls the base slug that will display before each term
      'with_front'        => false, // Don't display the category base before "/locations/"
      'hierarchical'      => false
    );

    $args = array(
      'labels'            => $labels,
      'rewrite'           => $rewrite,
      'hierarchical'      => true
    );

    register_taxonomy( 'business_location', 'business', $args );

  }



  // Add Business types ------------------------------------------------------ //

  function create_business_types() {

    $labels = array(
      'name'              => _x( 'Business Types', 'types' ),
      'singular_name'     => _x( 'Business Type', 'type' ),
      'search_items'      => __( 'Search Business Types' ),
      'all_items'         => __( 'Business Types' ),
      'edit_item'         => __( 'Edit Type' ),
      'update_item'       => __( 'Update Type' ),
      'add_new_item'      => __( 'Add New Business Type' ),
      'new_item_name'     => __( 'New Business Type' ),
      'menu_name'         => __( 'Types' ),
    );

    $rewrite = array(
      'slug'              => 'type',
      'with_front'        => false,
      'hierarchical'      => false
    );

    $args = array(
      'labels'            => $labels,
      'rewrite'           => $rewrite,
      'hierarchical'      => false,
      'show_in_nav_menus' => true
    );

    register_taxonomy( 'business_type', 'business', $args );

  }



  // Add Business filters ------------------------------------------------------ //

  function create_business_filters() {

    $labels = array(
      'name'                        => _x( 'Filters', 'filters' ),
      'singular_name'               => _x( 'Filter', 'filter' ),
      'search_items'                => __( 'Search Filters' ),
      'all_items'                   => __( 'Filters' ),
      'edit_item'                   => __( 'Edit Filter' ),
      'update_item'                 => __( 'Update Filter' ),
      'add_new_item'                => __( 'Add New Filter' ),
      'new_item_name'               => __( 'New Filter' ),
      'menu_name'                   => __( 'Filters' ),
      'separate_items_with_commas'  => __( 'Separate filters with commas' ),
      'popular_items'               => __( 'Popular filters' ),
      'choose_from_most_used'       => __( 'Choose from the most used filters' ),
      'add_or_remove_items'         => __( 'Add or remove filters' ),
      'not_found'                   => __( 'No filters found' ),
    );

    $rewrite = array(
      'slug'                        => 'filter',
      'with_front'                  => false,
      'hierarchical'                => false
    );

    $args = array(
      'labels'                      => $labels,
      'rewrite'                     => $rewrite,
      'hierarchical'                => false,
      'show_in_nav_menus'           => true
    );

    register_taxonomy( 'business_filter', 'business', $args );

  }



  // Remove unwanted meta boxes ---------------------------------------------- //

  function remove_meta() {
    remove_meta_box( 'tagsdiv-business_type', 'business', 'side' );
    remove_meta_box( 'business_locationdiv', 'business', 'side' );
  }



  // Add help text to featured image meta box -------------------------------- //



?>
