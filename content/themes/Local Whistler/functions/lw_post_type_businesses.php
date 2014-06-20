<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // ---------------------------------------------------------------------------//

  add_action( 'init', 'create_businesses' );
  add_filter( 'post_updated_messages', 'create_business_messages' );
  add_action( 'contextual_help', 'create_business_help', 10, 3 );
  add_action( 'init', 'create_business_locations', 0 );
  add_action( 'init', 'create_business_types', 0 );
  add_filter( 'enter_title_here', 'change_business_placeholder' ); // Too WET
  add_action( 'admin_head', 'remove_mediabuttons' ); // Too WET



  // Add Business post type -------------------------------------------------- //

  function create_businesses() {
  	$labels = array(
  		'name'               => _x( 'Businesses', 'businesses' ),
  		'singular_name'      => _x( 'Business', 'business' ),
  		'menu_name'          => _x( 'Businesses', 'businesses' ),
  		'name_admin_bar'     => _x( 'Business', 'business'),
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
  		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  	);

  	register_post_type( 'business', $args );
  }



  // Custom update messages -------------------------------------------------- //

  function create_business_messages( $messages ) {

    global $post, $post_ID;

    $messages['business'] = array(
      0 => '',
      1 => sprintf( __('Business updated. <a href="%s">View business</a>'), esc_url( get_permalink($post_ID) ) ),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Business updated.'),
      5 => isset($_GET['revision']) ? sprintf( __('Business restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Business published. <a href="%s">View business</a>'), esc_url( get_permalink($post_ID) ) ),
      7 => __('Business saved.'),
      8 => sprintf( __('Business submitted. <a target="_blank" href="%s">Preview business</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
      9 => sprintf( __('Business scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview business</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
      10 => sprintf( __('Business draft updated. <a target="_blank" href="%s">Preview business</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
  }



  // Crate contextual help (top right tab) ----------------------------------- //

  function create_business_help( $contextual_help, $screen_id, $screen ) {

    if ( 'business' == $screen->id ) {

      // Add my_help_tab if current screen is My Admin Page
      $screen->add_help_tab( array(
          'id'	=> 'editing_businesses',
          'title'	=> __('Editing Businesses'),
          'content'	=> '<h2>' . __('Editing businesses') . '</h2><p>' . __('This page allows you to view / modify business details. Please make sure to fill out the available boxes with the appropriate details. Optional fields are marked and if they are left blank will not show up on the main business page.') . '</p>'
      ));

      // Add my_help_tab if current screen is My Admin Page
      $screen->add_help_tab( array(
          'id'	=> 'tagging_businesses',
          'title'	=> __('Tagging Businesses'),
          'content'	=> '<h2>' . __('Tagging businesses') . '</h2><p>' . __('People will filter the business based on the tags you add. The more tags, the better the search and filtering will be.') . '</p>'
      ));

      // Add my_help_tab if current screen is My Admin Page
      $screen->add_help_tab( array(
          'id'	=> 'categorising_businesses',
          'title'	=> __('Categorising Businesses'),
          'content'	=> '<h2>' . __('Categorising businesses') . '</h2><p>' . __('Businesses can be in multiple categories of on type and location. For example Rowland\'s Creekside pub would have a `type` of `Food &amp; Drink` and a `location` of `Creekside`. Each business should only have one location but can have multiple types.') . '</p>'
      ));

    }

    return $contextual_help;

  }



  // Add Business locations -------------------------------------------------- //

  function create_business_locations() {

    $labels = array(
      'name'              => _x( 'Location', 'location' ), // Deliberately singular
      'singular_name'     => _x( 'Location', 'location' ),
      'search_items'      => __( 'Search Locations' ),
      'all_items'         => __( 'Location' ),
      // 'parent_item'       => __( 'Parent Location' ),
      // 'parent_item_colon' => __( 'Parent Location:' ),
      'edit_item'         => __( 'Edit Location' ),
      'update_item'       => __( 'Update Location' ),
      'add_new_item'      => __( 'Add New Location' ),
      'new_item_name'     => __( 'New Location' ),
      'menu_name'         => __( 'Locations' )
    );

    $rewrite = array(
      'slug'              => 'location', // This controls the base slug that will display before each term
      'with_front'        => false, // Don't display the category base before "/locations/"
      'hierarchical'      => false // This will allow URL's like "/locations/boston/cambridge/"
    );

    $args = array(
      'labels'            => $labels,
      'rewrite'           => $rewrite,
      'hierarchical'      => false
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
      // 'parent_item'       => __( 'Parent Location' ),
      // 'parent_item_colon' => __( 'Parent Location:' ),
      'edit_item'         => __( 'Edit Type' ),
      'update_item'       => __( 'Update Type' ),
      'add_new_item'      => __( 'Add New Business Type' ),
      'new_item_name'     => __( 'New Business Type' ),
      'menu_name'         => __( 'Business Types' ),
    );

    $rewrite = array(
      'slug'              => 'type', // This controls the base slug that will display before each term
      'with_front'        => false, // Don't display the category base before "/locations/"
      'hierarchical'      => false // This will allow URL's like "/locations/boston/cambridge/"
    );

    $args = array(
      'labels'            => $labels,
      'rewrite'           => $rewrite,
      'hierarchical'      => false
    );

    register_taxonomy( 'business_type', 'business', $args );

  }



  // Custom placeholder text ------------------------------------------------- //

  function change_business_placeholder( $title ){

    $screen = get_current_screen();

    if  ( $screen->post_type == 'business' ) {
      return 'Enter business name here';
    }

  }

  // Remove `Add Media` button ----------------------------------------------- //

  function remove_mediabuttons() {

    $screen = get_current_screen();

    if( $screen->post_type == 'business' ) {
      remove_action( 'media_buttons', 'media_buttons' );
    }

  }

?>
