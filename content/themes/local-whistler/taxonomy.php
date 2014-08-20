<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  global $query_string;

  $search_term = get_search_query();
  $business_location = get_taxonomy_from_url_or_wordpress('business_location');
  $business_type = get_taxonomy_from_url_or_wordpress('business_type');
  $order = get_taxonomy_from_url_or_wordpress('order');
  $orderBy = 'title';
  $view = get_view_type();

  // Get the two parts of the order if they exist
  if ( strpos( $order, '-' ) ) {
    $orderArray = explode( '-', $order );
    $order = $orderArray[1];
    $orderBy = $orderArray[0];
  }

  // Add order to the generated query
  query_posts( $query_string . '&order=' . $order . '&orderby=' . $orderBy . '&post_type=business' );

?>

<div class="container">
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

</div>

<?php get_footer(); ?>
