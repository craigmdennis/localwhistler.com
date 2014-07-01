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

  // Add order to the generated query
  query_posts( $query_string . '&order=' . $order . '&orderby=' . $orderBy . '&post_type=business' );

?>

  <!-- <div class="hero--spaced">
    <img class="hero__image" src="http://p-hold.com/happy/960/600/blur" />
    <div class="hero__overlay">
      <h2 class="hero__title">Health &amp; Wellness</h2>
    </div>
  </div> -->

    <?php require_once('partials/_filters.php'); ?>

    <?php if ( have_posts() ) : ?>

      <?php require_once('partials/_toolbar.php'); ?>

    <?php endif; // End have_posts() ?>

  <?php rewind_posts(); ?>

  <!-- todo: break the results and the filters into seperate files -->
  <!-- todo: create custom templates for maps, list and gallery views -->
  <!-- todo: append a $_GET variable for view -->

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
