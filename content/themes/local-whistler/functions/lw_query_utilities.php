<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  add_filter( 'query_vars', 'add_query_vars_filter' );



  // Return $_GET attributes ------------------------------------------------- //

  function put_get_attributes_in_query_format( $exclusions = '', $field = 'slug' ) {

    // Remove all whitespace from $excusions
    $exclusionsNoSpaces = preg_replace('/\s+/', '', $exclusions);

    // Make array from $exclusions
    $exclusionArray = explode(",", $exclusionsNoSpaces);

    // Create new array
    $queryArray = array();

    // If the URL contains variables
    if ( $_GET ) :

      foreach ( $_GET as $key => $value ) :

        // if ( $value == 'any' ) {
        //   $value = '';
        // }

        // If the slug isn't in the $exclusions array
        if ( !in_array( $key, $exclusionArray ) ) :

          $queryArray[] = array(
            'taxonomy' => $key,
            'terms' => $value,
            'field' => $field
          );

        endif;
      endforeach;
    endif;

    return $queryArray;

  }



  // the $_GET variable or the Wordpress variable ---------------------------- //

  function get_taxonomy_from_url_or_wordpress( $queryVar ) {

    // If the $_GET is set
    if ( isset( $_GET[ $queryVar ] ) ) :

      // Get the variable from the URL
      $result = $_GET[ $queryVar ];

    else :

      // If ?order= isn't set
      if ( $queryVar == 'order') :

        // Set the default order to newest first
        $result = 'date-desc';

      else:

        // Get the variable from Wordpress
        $result = get_query_var( $queryVar );

      endif;

    endif;

    return $result;

  }



  // Expose custom $_GET parameters to the WP_query function ----------------- //

  function add_query_vars_filter( $vars ){

    $vars[] = 'order';
    $vars[] = 'view';

    return $vars;

  }



  // Return the current view for filters (default: list) --------------------- //

  function get_view_type() {

    $viewType = 'list';

    if ( isset( $_GET['view'] ) ) {
      $viewType = $_GET['view'];
    }

    return $viewType;

  }



  // Remove key => value pairs from $_GET param ------------------------------ //

  // function remove_querystring_var( $url, $key ) {
  //
  //   if ( $url == '') {
  //     $url = '?'
  //   }
  //
  //   $url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
  //   $url = substr($url, 0, -1);
  //   return $url;
  //
  // }

?>