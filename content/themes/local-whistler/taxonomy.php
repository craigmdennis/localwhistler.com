<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  if (isset( GET['search'] ) ) {
    // Set the search input value
  }

  if (isset( GET['location'] ) ) {
    // Set the location 'selected' option
  }

  if (isset( GET['type'] ) ) {
    // Set the type 'selected' option
  }

  // Then we can chang the URL to ?location=creekside&type=food-drink&search=some%20words

?>

<?php if ( have_posts() ) : the_post(); ?>

  <div id="filterSearchArea" class="filter__wrapper">
    <label for="filterSearch">Search by keyword</label>
    <input id="filterSearch" type="search" placeholder="e.g. Yam Fries">
  </div>


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

        <div class="filter__wrapper">
          <label for="filter<?php echo $taxonomySlugCapital; ?>"><?php echo $taxonomyName; ?></label>
          <select id="filter<?php echo $taxonomySlugCapital; ?>" class="filter__<?php echo $taxonomySlug; ?>">
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
  <div class="filter__wrapper">
    <label for="filterSort">Select Sort Order</label>
    <select id="filterSort">
      <option data-sort-target="result__title" data-sort-order="asc">A-Z</option>
      <option data-sort-target="result__title" data-sort-order="desc">Z-A</option>
      <option data-sort-target="result__date-published", data-sort-order="asc">Newest First</option>
      <option data-sort-target="result__date-published", data-sort-order="desc">Oldest First</option>
      <!-- <option value="">Popular</option> Not sure how to do this yet -->
    </select>
  </div>

  <div id="results">
  </div>

  <!-- Initial loading in case JS fails-->
  <!-- <noscript>
    <?php query_posts('post_type=business&order=asc'); ?>

    <?php if ( have_posts() ) : ?>

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

    <?php endif; ?>
  <noscript> -->


  <?php rewind_posts(); ?>

<?php endif; ?>

<?php get_footer(); ?>
