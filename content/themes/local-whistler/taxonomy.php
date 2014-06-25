<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  // todo: get url variables

  if (isset( $_GET['search'] ) ) {
    // Set the search input value
  }

  if (isset( $_GET['business_location'] ) ) {
    // Set the location 'selected' option
  }

  if (isset( $_GET['business_type'] ) ) {
    // Set the type 'selected' option
  }

  // for each taxonomy
  // if $_GET set
    // use get in query $args
  // if ! set
    // omit that loop for the query $args

  // todo: Create the following query by looping through each taxonomy.
  // todo: Build a function to loop through each taxonomy and apply run callbacks
  $args = array(
    'post_type' => array('business'),
    'tax_query' => array(
      'relation' => 'OR',
       array(
         'taxonomy' => 'business_type',
         'terms' => 'health', // Use $_GET variable if isset
         'field' => 'slug'
       ),
       array(
         'taxonomy' => 'business_location',
         'terms' => 'village', // Use $_GET variable if isset
         'field' => 'slug'
       ),
    )
  );

  echo '<pre>';
  print_r( query_posts($args) );
  echo '</pre>';

  // todo: change the URL to ?business_location=creekside&business_type=food-drink,health&search=some%20words

?>

<?php if ( have_posts() ) : the_post(); ?>

  <div id="filterSearchArea" class="form__row">
    <label for="filterSearch">Search by keyword</label>
    <input id="filterSearch" type="search" placeholder="e.g. Yam Fries">
  </div>

  <?php // echo '<pre>'; print_r( $wp_query ); echo '</pre>'; ?>


  <?php

    $args = array( 'public' => true, '_builtin' => false );
    $output = 'object';
    $operator = 'and';
    $taxonomies = get_taxonomies( $args, $output, $operator );
    $currentTaxonomy = $wp_query->queried_object;

  ?>

  <?php if  ( $taxonomies ) : ?>
    <?php foreach ( $taxonomies as $taxonomy ) : ?>

      <?php $terms = get_terms( $taxonomy->name ); ?>
      <?php $count = count($terms); ?>

      <?php if ( $count > 0 ) : ?>

        <?php

          $taxonomyName = $taxonomy->labels->name;
          $taxonomySlug =  $taxonomy->rewrite['slug'];
          $taxonomySlugCapital = ucfirst( $taxonomySlug );

        ?>

        <!--  Skip the business filters -->
        <?php if ( $taxonomy->name == 'business_filter' ) : continue; endif; ?>

        <div class="form__row">
          <label for="filter<?php echo $taxonomySlugCapital; ?>"><?php echo $taxonomyName; ?></label>
          <select id="filter<?php echo $taxonomySlugCapital; ?>" class="js__filter-<?php echo $taxonomySlug; ?>">
            <option value="">Any</option>
            <?php foreach ( $terms as $term ) : ?>

              <?php

                if ( $currentTaxonomy->slug == $term->slug ) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }

              ?>

              <option value="<?php echo $term->slug; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>

              <?php $selected = ""; ?>

            <?php endforeach; ?>
          </select>
        </div>

      <?php endif; // END if count > 0 ?>
    <?php endforeach; // END foreach $taxonomies as $taxonomy ?>
  <?php endif; // END if $taxonomies ?>

  <!-- Hard coded sort options -->
  <div class="form__row">
    <label for="filterSort">Select Sort Order</label>
    <select id="filterSort" class="js__filter-sort">
      <option data-sort-target="result__title" data-sort-order="asc">A-Z</option>
      <option data-sort-target="result__title" data-sort-order="desc">Z-A</option>
      <option data-sort-target="result__date-published", data-sort-order="asc">Newest First</option>
      <option data-sort-target="result__date-published", data-sort-order="desc">Oldest First</option>
      <!-- <option value="">Popular</option> todo: work out how to sort popular -->
    </select>
  </div>

  <!-- todo: make sure filter form works with no js -->
  <div class="form__row">
    <input id="filterSubmit" type="submit" value="Filter" />
  </div>

  <div id="results">
  </div>

  <!-- todo: disable initial filter.js function and write the page normally -->

    <!-- <?php if ( have_posts() ) : ?>

      <div id="results">
        <ul id="results__list">

          <?php while ( have_posts() ) : the_post(); ?>

            <li class="restul__item">
              <h2 class="result__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <a href="<?php the_permalink(); ?>"><img src="<?php the_field('logo'); ?>" /></a>
              <?php the_excerpt(); ?>
              <span class="result__date-published"><?php the_date(); ?></a>
            </li>

          <?php endwhile; ?>

        </ul>
      </div>

    <?php endif; ?> -->

  <?php rewind_posts(); ?>

<?php endif; ?>

<?php get_footer(); ?>
