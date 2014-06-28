<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  global $query_string;

  $getSearch = get_search_query();
  $getLocation = get_taxonomy_from_url_or_wordpress('business_location');
  $getType = get_taxonomy_from_url_or_wordpress('business_type');
  $getOrder = get_taxonomy_from_url_or_wordpress('order');

  // Default order by newest first
  $orderBy = 'title';
  $order = $getOrder;

  // Get the two parts of the order if they exist
  if ( strpos( $getOrder, '-' ) ) {
    $order = explode( '-', $getOrder )[1];
    $orderBy = explode( '-', $getOrder )[0];
  }

  // If the params are empty add a ?
  // If the params contain 'view'
    // Remove view param and value

  // if ( isset( $_GET['view'] ) ) {
  //   $urlQueryString = substr_replace( $urlQueryString, '', 'view=' . $_GET['view'] );
  // }
  // // If there are no $_GET paramaters or there is no ?, add one
  // if ( $urlQueryString == '' || !strpos( '?', $urlQueryString ) ) {
  //   $urlQueryString = '?' . $urlQueryString;
  // }

  // Add order to the generated query
  query_posts( $query_string . '&order=' . $order . '&orderby=' . $orderBy . '&post_type=business' );

?>

  <?php require_once('partials/_filters.php'); ?>

  <?php if ( have_posts() ) : ?>

    <?php require_once('partials/_toolbar.php'); ?>

  <?php endif; // End have_posts() ?>

  <!-- todo: break the results and the filters into seperate files -->
  <!-- todo: create custom templates for maps, list and gallery views -->
  <!-- todo: append a $_GET variable for view -->

  <div id="results">

    <?php if ( have_posts() ) : ?>

      <?php if ( isset($_GET['view']) && ( $_GET['view'] == ('map') ) ) : ?>

        <div id="resultsMap">

          <?php while ( have_posts() ) : the_post(); ?>

            <?php include('partials/_module_map.php'); ?>

          <?php endwhile; ?>

        </div>

      <?php else : ?>

        <ol id="resultsList" class="media__list">

          <?php while ( have_posts() ) : the_post(); ?>

            <?php include('partials/_module_media.php'); ?>

          <?php endwhile; ?>

        </ol>

      <?php endif; ?>

    <?php endif; ?>

  </div>

<?php get_footer(); ?>
