<div class="form--filters">

  <form id="filterForm" method="GET" action="/">

    <!-- possible to set by cookies -->
    <input id="filterView" type="hidden" name="view" value="<?php echo get_view_type(); ?>">

    <div id="filterSearchArea" class="form__row">
      <label for="filterSearch" class="form__label form__label--search">Search by keyword</label>
      <input id="filterSearch" class="form__text" type="search" placeholder="e.g. Organic" name="s" value="<?php the_search_query(); ?>">
    </div>

    <?php $taxonomies = get_taxonomies( array('public'   => true, '_builtin' => false) , 'object', 'and' ); ?>

    <?php if  ( $taxonomies ) : ?>
      <?php foreach ( $taxonomies as $taxonomy ) : ?>

        <?php $terms = get_terms( $taxonomy->name ); ?>
        <?php $count = count($terms); ?>

        <?php if ( $count > 0 ) : ?>

          <?php

            $taxonomyName = $taxonomy->name;
            $taxonomySlug =  $taxonomy->rewrite['slug'];
            $taxonomySlugCapital = ucfirst( $taxonomySlug );

          ?>

          <!--  Skip the business filters -->
          <?php if ( $taxonomy->name == 'business_filter' ) : continue; endif; ?>

          <div class="form__row--<?php echo $taxonomySlug; ?>">
            <label for="filter<?php echo $taxonomySlugCapital; ?>" class="form__label"><?php echo $taxonomyName; ?></label>
            <select id="filter<?php echo $taxonomySlugCapital; ?>" class="form__select js__filter-<?php echo $taxonomySlug; ?>" name="business_<?php echo $taxonomySlug; ?>">
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
    <div class="form__row--sort">
      <label for="filterOrder" class="form__label">Sort Order</label>
      <select id="filterOrder" class="form__select js__filter-sort" name="order">

        <?php

          // Put the sorting into an array so we can loop over it
          $orderOptions = array(
            array(
              'data-sort-target' => 'media__title',
              'data-sort-order' => 'asc',
              'value' => 'asc',
              'text' => 'A-Z'
            ),
            array(
              'data-sort-target' => 'media__title',
              'data-sort-order' => 'desc',
              'value' => 'desc',
              'text' => 'Z-A'
            ),
            array(
              'data-sort-target' => 'media__date',
              'data-sort-order' => 'desc',
              'value' => 'date-desc',
              'text' => 'Newest First'
            ),
            array(
              'data-sort-target' => 'media__date',
              'data-sort-order' => 'asc',
              'value' => 'date-asc',
              'text' => 'Oldest First'
            ),

          );

        ?>
        <?php foreach ($orderOptions as $orderOption) : ?>

          <?php

            $selected = '';

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
    <div class="form__row hide-with-js">
      <input id="filterSubmit" class="form__submit btn--primary" type="submit" value="Filter results" />
    </div>

  </form>

</div>
