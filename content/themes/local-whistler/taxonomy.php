<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  global $query_string;

  $search_term = get_search_query();
  $business_location = get_taxonomy_from_url_or_wordpress('business_location');
  $business_type = get_taxonomy_from_url_or_wordpress('business_type');
  $order = get_taxonomy_from_url_or_wordpress('order');
  $orderBy = get_taxonomy_from_url_or_wordpress('orderBy');
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

    <div id="results">

      <?php if ( $custom_query->have_posts() ) : ?>

          <ol id="resultsList" class="media--list js-color-container">

            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

              <?php if ( has_term('green', 'business_filter', $post->ID) ): ?>
                <?php $greenClass = 'is-green'; ?>
                <?php $greenLogo = '<div class="green-content">Environmentally Conscious</div>'; ?>
              <?php else: ?>
                <?php $greenClass = 'not-green'; ?>
                <?php $greenLogo = ''; ?>
              <?php endif; ?>

              <li class="media hide-with-mustard <?php echo $greenClass; ?>">

                <?php include('partials/_module_media.php'); ?>

              </li>

            <?php endwhile; ?>

          </ol>

          <div class="hide-with-mustard">
            <?php get_template_part('partials/_pagination'); ?>
          </div>

      <?php else : ?>

        <div class="content context__copy">

          <h2>There are no local businesses that match your search</h2>
          <p>Please select some different filters</p>

        </div>


      <?php endif; ?>

    </div>

  </div>

  <?php

    wp_reset_postdata();

    // Reset main query object
    $wp_query = NULL;
    $wp_query = $temp_query;

  ?>

</div> <!-- END .row -->

<?php get_footer(); ?>
