<?php

  // -------------------------------------------------------------------------- //
  // All actions are called at the top.
  // They should be self explanitory and in the order in which the functions
  // appear in the file.
  // --------------------------------------------------------------------------//

  // Adding actions means they are only run on the front-end
  add_action( 'wp_enqueue_scripts', 'lw_deregister_scripts' );
  add_action( 'wp_enqueue_scripts', 'lw_enqueue_global' );

  // Dynamically added if browser 'Cuts the mustard'
  // Uncomment to load for all browsers
  add_action( 'wp_enqueue_scripts', 'lw_enqueue_filtering' );



  // Deregister scripts ------------------------------------------------------ //

  function lw_deregister_scripts() {
    wp_deregister_script('jquery');
  };



  // Add filtering scripts --------------------------------------------------- //

  function lw_enqueue_filtering() {

    wp_register_script(
      'filtering', get_template_directory_uri() . '/scripts/filtering.js',
      array(),
      NULL,
      true
    );

    // Localize the script with our data.
    wp_localize_script( 'filtering', 'lw_post_data', lw_post_data() );

    // Registered in functions/lw_post_data.php
    // wp_enqueue_script( 'filtering' );

    // If it's the filtering pages
    if (is_search() || taxonomy_exists('business_location') || taxonomy_exists('business_type') || is_post_type_archive( 'business') ){

      // Only use the filtering.js on pages that need it.
      wp_enqueue_script('filtering');

    }

  };



  // Add global scripts ------------------------------------------------------ //

  function lw_enqueue_global() {

    wp_register_script(
      'global', get_template_directory_uri() . '/scripts/script.js',
      array(),
      NULL,
      true
    );

    wp_enqueue_script( 'global' );

  };



  // Localize Post Data ------------------------------------------------------ //

  function lw_post_data() {

    $transient_key = 'filter_data';
    $data = get_transient( $transient_key );

    if ( $data == '' ) {

      $args = array(
        'post_type' => 'business',
        'posts_per_page' => -1
      );

      $postsArray = array();

      // The Query
      query_posts( $args );

      // The Loop
      while ( have_posts() ) : the_post();

        $id = get_the_ID();
        $url = get_permalink();
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $date = get_the_date();
        $filters = get_the_terms($id, 'business_filter');
        $locations = get_the_terms($id, 'business_location');
        $types = get_the_terms($id, 'business_type');

        // echo '<pre>';
        // print_r($filters);
        // echo '</pre>';

        $filterArray = array();
        $typeArray = array();
        $locationArray = array();

        if ( !empty( $filters ) ) {
          foreach ( $filters as $filter_slug => $filter ) {

            // echo '<pre>';
            // print_r( $filter_slug );
            // echo '</pre>';
            $tmpFilterArray = array(
              'slug' => $filter->slug,
              'title' => $filter->name
            );

            array_push($filterArray, $tmpFilterArray);
          }
        }

        if ( !empty( $locations ) ) {
          foreach ($locations as $location ) {

            $tmpLocArray = array(
              'slug' => $location->slug
            );

            array_push($locationArray, $tmpLocArray);
          }
        }

        if ( !empty( $types ) ) {
          foreach ($types as $type ) {

            $tmpTypeArray = array(
              'slug' => $type->slug
            );

            array_push($typeArray, $tmpTypeArray);
          }
        }

        if ( function_exists('get_field') ) {
          $logo = get_field('logo');
          $sizes = $logo['sizes'];

          // echo '<pre>';
          // print_r( $sizes );
          // echo '</pre>';

          $logoArray = array(
            'alt' => $logo['alt'],
            'sizes' => array(
              'media--thumb' => $sizes['media--thumb'],
              'media--thumb-width' => $sizes['media--thumb-width'],
              'media--thumb-height' => $sizes['media--thumb-height'],
              'media--thumb-retina' => $sizes['media--thumb-retina'],
              'media--thumb-retina-width' => $sizes['media--thumb-retina-width'],
              'media--thumb-retina-height' => $sizes['media--thumb-retina-height']
            )
          );
        }

        if ( function_exists( 'get_geocode_latlng' ) ) {
          $map_latlng = get_geocode_latlng( $id );
        }

        $post = array(
          'id' => $id,
          'url' => $url,
          'title' => $title,
          'excerpt' => $excerpt,
          'date' => $date,
          'taxonomy_business_filter' => $filterArray,
          'taxonomy_business_location' => $locationArray,
          'taxonomy_business_type' => $typeArray,
          'custom_fields' => array(
            'martygeocoderlatlng' => $map_latlng
          ),
          'acf' => array(
            'logo' => $logoArray
          )

        );

        array_push($postsArray,$post);

      endwhile;

      $data = json_encode( $postsArray );
      // $fp = fopen('results.json', 'w');
      // fwrite($fp, $data);
      // fclose($fp);

      wp_reset_query();

      // set_transient( $transient_key, $data, 60 * 60 * 24 * 14 ); // two weeks
      // need to hook into post_update, post_delete, post_publish to destroy the transient

    };

    return $data;

  }

?>
