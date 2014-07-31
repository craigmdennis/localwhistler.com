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
    $orderArray = explode( '-', $getOrder );
    $order = $orderArray[1];
    $orderBy = $orderArray[0];
  }

  // Add order to the generated query
  query_posts( $query_string . '&order=' . $order . '&orderby=' . $orderBy . '&post_type=business' );

?>

<?php require_once('partials/_filters.php'); ?>

<?php require_once('partials/_toolbar.php'); ?>

<?php rewind_posts(); ?>

  <div id="results">

    <?php if ( have_posts() ) : ?>

        <ol id="resultsList" class="media__list">

          <?php while ( have_posts() ) : the_post(); ?>

            <?php include('partials/_module_media.php'); ?>

          <?php endwhile; ?>

        </ol>

    <?php endif; ?>

  </div>

<?php get_footer(); ?>
