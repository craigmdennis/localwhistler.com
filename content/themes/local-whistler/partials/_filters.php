<?php

  // Get the search term or the taonomy term
  $searchFilter = '';

  if ( (get_search_query() == '') && (get_query_var( 'taxonomy' ) == 'business_filter') ) :
    $searchFilter = single_term_title('', false);
  else :
    $searchFilter = get_search_query();
  endif;

?>

<!-- possible to set by cookies -->
<div class="form--filters">
  <div class="row">

    <input id="filterView" type="hidden" name="view" value="<?php echo get_view_type(); ?>">

    <?php $taxonomies = get_taxonomies( array(
      'public'   => true,
      '_builtin' => false
      ) , 'object', 'and' ); ?>

    <?php if  ( $taxonomies ) : ?>
      <?php foreach ( $taxonomies as $taxonomy ) : ?>

        <?php $terms = get_terms( $taxonomy->name ); ?>
        <?php $count = count($terms); ?>

        <?php if ( $count > 0 ) : ?>

          <?php

            $taxonomyName = $taxonomy->labels->singular_name;
            $taxonomySlug =  $taxonomy->rewrite['slug'];
            $taxonomySlugCapital = ucfirst( $taxonomySlug );

          ?>

          <!--  Skip the business filters -->
          <?php if ( $taxonomy->name == 'business_filter' ) : continue; endif; ?>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">
              <div class="form__group form__group--<?php echo $taxonomySlug; ?>">
                <label for="filter<?php echo $taxonomySlugCapital; ?>" class="form__label"><?php echo $taxonomyName; ?></label>
                <select id="filter<?php echo $taxonomySlugCapital; ?>" class="form__control js__chosen js__filter-<?php echo $taxonomySlug; ?>" name="business_<?php echo $taxonomySlug; ?>">
                  <option value="">Any</option>

                  <?php foreach ( $terms as $term ) : ?>

                    <?php

                      $selected = '';

                      switch ( $term->slug ) :
                        case $business_type:
                          $selected = 'selected';
                          break;
                        case $business_location:
                          $selected = 'selected';
                          break;
                      endswitch;

                    ?>

                    <option value="<?php echo $term->slug; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>

                  <?php endforeach; ?>
                </select>
              </div>
            </div>

          <?php endif; // END if count > 0 ?>
      <?php endforeach; // END foreach $taxonomies as $taxonomy ?>
    <?php endif; // END if $taxonomies ?>

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">
      <div id="filterSearchArea" class="form__row">
        <label for="filterSearch" class="form__label form__label--search">Search by keyword</label>
        <input id="filterSearch" class="form__control form__control--inset" type="search" placeholder="e.g. Organic" name="s" value="<?php echo $searchFilter ?>">
      </div>
    </div>

  </div> <!-- END .row -->
</div>
