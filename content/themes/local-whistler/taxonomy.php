<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  global $query_string;

  $search_term = get_search_query();
  $business_location = get_taxonomy_from_url_or_wordpress('business_location');
  $business_type = get_taxonomy_from_url_or_wordpress('business_type');
  $order_raw = get_taxonomy_from_url_or_wordpress('order');
  $orderBy = 'title';
  $view = get_view_type();

  // Get the two parts of the order if they exist
  if ( strpos( $order_raw, '-' ) ) {
    $orderArray = explode( '-', $order_raw );
    $order = $orderArray[1];
    $orderBy = $orderArray[0];
  }

  // Add order to the generated query
  query_posts( $query_string . '&order=' . $order . '&orderby=' . $orderBy . '&post_type=business' );

?>

<div class="row">
  <div class="col-xs-12 col-lg-3">
    <form id="filterForm" method="GET" action="/">

      <?php if ( !isset($_GET['view']) ) : ?>
        <div id="controls" data-spy="affix" data-offset-top="98" data-offset-bottom="227">
      <?php endif; ?>

        <?php include_once('partials/_filters.php'); ?>
        <?php include_once('partials/_toolbar.php'); ?>

      <?php if ( !isset($_GET['view']) ) : ?>
        </div>
      <?php endif; ?>

    </form>
  </div>

  <?php rewind_posts(); ?>

  <div class="col-xs-12 col-lg-9">

      <?php if ( have_posts() ) : ?>

        <div id="results">

          <ol id="resultsList" class="media--list js-color-container">

            <?php while ( have_posts() ) : the_post(); ?>

              <li class="media hide-with-js">

                <?php get_template_part('partials/_module_media'); ?>

              </li>

            <?php endwhile; ?>

          </ol>

        </div>

      <?php else : ?>

        <?php get_template_part('partials/_no-results'); ?>

      <?php endif; ?>

  </div>

</div> <!-- END .row -->

<?php get_footer(); ?>
