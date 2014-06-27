<?php get_header(); ?>
<!-- taxonomy.php -->

<?php

  $getSearch = get_search_query();
  $getLocation = get_taxonomy_from_url_or_wordpress('business_location');
  $getType = get_taxonomy_from_url_or_wordpress('business_type');
  $getOrder = get_taxonomy_from_url_or_wordpress('order');
  $orderBy = 'date';

  // Get the two parts of the order if they exist
  if ( strpos( $getOrder, '-' ) ) {
    $order = explode( '-', $getOrder )[1];
    $orderBy = explode( '-', $getOrder )[0];
  }

  // todo: Build a function to loop through each taxonomy and apply run callbacks

  // Set custom Wordpress query if using $_GET (it means we're using multiple filters)
  if ( $_GET ) :

    // // Build a query based on the $_GET attributes
    // // If none exist we can assume a normal wordpress url structure
    $taxSubQuery = put_get_attributes_in_query_format( 's, order' );

  endif;

  $args = array(
    'post_type' => 'business',
    // 'tax_query' => array(
    //   'relation' => 'AND',
    //   $taxSubQuery
    // ),
    'orderby' => $orderBy,
    'order' => $getOrder,
    'public' => true,
    '_builtin' => false
  );

?>

<form method="GET" action="/">

  <!-- Only search businesses -->
  <!-- <input type="hidden" name="post_type" value="business" /> -->

  <div id="filterSearchArea" class="form__row">
    <label for="filterSearch">Search by keyword</label>
    <input id="filterSearch" type="search" placeholder="e.g. Yam Fries" name="s" value="<?php the_search_query(); ?>">
  </div>

  <?php $taxonomies = get_taxonomies( array('public'   => true, '_builtin' => false) , 'object', 'and' ); ?>

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
          <label for="filter<?php echo $taxonomySlugCapital; ?>"><?php echo $taxonomy->name; ?></label>
          <select id="filter<?php echo $taxonomySlugCapital; ?>" class="js__filter-<?php echo $taxonomySlug; ?>" name="business_<?php echo $taxonomySlug; ?>">
            <option value="">Any</option>

            <?php foreach ( $terms as $term ) : ?>

              <?php

                $selected = '';

                switch ( $term->slug ) :
                  case $getType:
                    $selected = 'selected';
                    break;
                  case $getLocation:
                    $selected = 'selected';
                    break;
                endswitch;

              ?>

              <option value="<?php echo $term->slug; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>

            <?php endforeach; ?>
          </select>
        </div>

      <?php endif; // END if count > 0 ?>
    <?php endforeach; // END foreach $taxonomies as $taxonomy ?>
  <?php endif; // END if $taxonomies ?>

  <!-- Hard coded sort options -->
  <div class="form__row">
    <label for="filterOrder">Sort Order</label>
    <select id="filterOrder" class="js__filter-sort" name="order">

      <?php

        $orderOptions = array(
          array(
            'data-sort-target' => 'result__title',
            'data-sort-order' => 'asc',
            'value' => 'asc',
            'text' => 'A-Z'
          ),
          array(
            'data-sort-target' => 'result__title',
            'data-sort-order' => 'desc',
            'value' => 'desc',
            'text' => 'Z-A'
          ),
          array(
            'data-sort-target' => 'result__date-published',
            'data-sort-order' => 'asc',
            'value' => 'date-asc',
            'text' => 'Newest First'
          ),
          array(
            'data-sort-target' => 'result__date-published',
            'data-sort-order' => 'desc',
            'value' => 'date-desc',
            'text' => 'Oldest First'
          ),

        );

      ?>
      <?php foreach ($orderOptions as $orderOption) : ?>

        <?php

          $selected = '';

          print_r( $orderOption['value'] );

          switch ( $orderOption['value'] ) :
            case $getOrder:
              $selected = 'selected';
              break;
          endswitch;

        ?>

        <option data-sort-target="<?php echo $orderOption['data-sort-target']; ?>" data-sort-order="<?php echo $orderOption['data-sort-order']; ?>" value="<?php echo $orderOption['value']; ?>" <?php echo $selected ?>><?php echo $orderOption['text']; ?></option>

      <?php endforeach; ?>

      <!-- <option value="">Popular</option> todo: work out how to sort popular -->
    </select>
  </div>

  <!-- todo: make sure filter form works with no js -->
  <div class="form__row js__hide">
    <input id="filterSubmit" type="submit" value="Filter results" />
  </div>

</form>

<!-- todo: disable initial filter.js function and write the page normally -->

<div id="results">

  <!-- If no JS -->
  <!-- <noscript> -->
    <?php query_posts( $args ); ?>
    <?php if ( have_posts() ) : ?>

      <div class="result__count">Found: <?php echo $wp_query->found_posts; ?></div>

        <ul id="results__list">

          <?php while ( have_posts() ) : the_post(); ?>

            <li class="result__item" data-fjs="true">
              <h2 class="result__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <a href="<?php the_permalink(); ?>"><img src="<?php the_field('logo'); ?>" /></a>
              <?php the_excerpt(); ?>
              <span class="result__date-published"><?php the_date(); ?></a>
            </li>

          <?php endwhile; ?>

        </ul>

      </div>

    <?php else: ?>

      <div class="result__count">No business match your criteria. Please try again.</div>

    <?php endif; ?>
  <!-- </noscript> -->

</div>

<?php get_footer(); ?>
