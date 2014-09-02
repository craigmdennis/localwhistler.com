<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  global $query_string;

  $search_term = get_search_query();
  $business_location = get_taxonomy_from_url_or_wordpress('business_location');
  $business_type = get_taxonomy_from_url_or_wordpress('business_type');
  $order = get_taxonomy_from_url_or_wordpress('order');
  $orderBy = 'date';
  $view = get_view_type();

  // Get the two parts of the order if they exist
  if ( strpos( $order, '-' ) ) {
    $orderArray = explode( '-', $order );
    $order = $orderArray[1];
    $orderBy = $orderArray[0];
  }

  if ( $search_term == '' ) {
    $search_term = get_taxonomy_from_url_or_wordpress('business_filter');
  }

  // Define custom query parameters
  $custom_query_args = array(
    's' => $search_term,
    'order' => $order,
    'orderBy' => $orderBy,
    'paged' => $paged,
    'post_type' => 'business',
    'business_location' => $business_location,
    'business_type' => $business_type
  );

  // print_r($custom_query_args);

  // Get current page and append to custom query parameters array
  $custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

  // Instantiate custom query
  $custom_query = new WP_Query( $custom_query_args );

  // Pagination fix
  $temp_query = $wp_query;
  $wp_query   = NULL;
  $wp_query   = $custom_query;

?>

<div class="row">
  <div class="col-xs-12 col-lg-3">
    <form id="filterForm" method="GET" action="/">

      <div id="controls">

        <?php include_once('partials/_filters.php'); ?>
        <?php include_once('partials/_toolbar.php'); ?>

      </div>

    </form>
  </div>

  <div class="col-xs-12 col-lg-9">

      <?php if ( $custom_query->have_posts() ) : ?>

        <div id="results">

          <ol id="resultsList" class="media--list js-color-container">

            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

              <li class="media hide-with-js">

                <?php get_template_part('partials/_module_media'); ?>

              </li>

            <?php endwhile; ?>

          </ol>

          <div class="hide-with-js">
            <?php get_template_part('partials/_pagination'); ?>
          </div>

        </div>

      <?php else : ?>

        <?php get_template_part('partials/_no-results'); ?>

      <?php endif; ?>

  </div>

  <?php

    wp_reset_postdata();

    // Reset main query object
    $wp_query = NULL;
    $wp_query = $temp_query;

  ?>

</div> <!-- END .row -->

<?php get_footer(); ?>
