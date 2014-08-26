<?php

  // Put the sorting into an array so we can loop over it
  // Weirdly the data-sort-order needs to be reversed
  // when sorting by date
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
      'value' => 'date-asc',
      'text' => 'Oldest First'
    ),
    array(
      'data-sort-target' => 'media__date',
      'data-sort-order' => 'asc',
      'value' => 'date-desc',
      'text' => 'Newest First'
    ),

  );

?>


<div class="toolbar">
  <div class="row">

    <div class="col-xs-12 col-sm-auto col-lg-12 col-toolbar">
      <div class="toolbar__action">
        <div class="btn-group">

        <a href="<?php echo add_query_arg( 'view', 'gallery' ); ?>" class="btn btn--default btn--icon-only btn--control" title="View as a gallery">
          <span class="btn__text">Gallery</span>
          <i class="btn__icon icon--after icon-thumbnails"></i>
        </a>

        <a href="<?php echo add_query_arg( 'view', 'list' ); ?>" class="btn btn--default btn--icon-only btn--control btn--last-visible" title="View as a list">
          <span class="btn__text">List</span>
          <i class="btn__icon icon--after icon-list"></i>
        </a>

        <a href="<?php echo add_query_arg( 'view', 'map' ); ?>" class="btn btn--default btn--icon-only btn--control show-with-js" title="View on a map">
          <span class="btn__text">Map</span>
          <i class="btn__icon icon--after icon-map"></i>
        </a>

      </div>
      </div>
    </div>


    <div class="col-xs-12 col-sm-auto col-lg-12 col-toolbar">
      <div class="toolbar__action">
        <div class="form__row--inline toolbar__action--sort">
          <label for="filterOrder" class="form__label">Sort Order:</label>
          <select id="filterOrder" class="form__control js__filter-sort js__chosen" name="order">

            <?php foreach ($orderOptions as $orderOption) : ?>

              <?php

                $selected = '';

                switch ( $orderOption['data-sort-order'] ) :
                  case $order_raw:
                    $selected = 'selected';
                    break;
                endswitch;

              ?>

              <option data-sort-target="<?php echo $orderOption['data-sort-target']; ?>" data-sort-order="<?php echo $orderOption['data-sort-order']; ?>" value="<?php echo $orderOption['value']; ?>" <?php echo $selected ?>><?php echo $orderOption['text']; ?></option>

            <?php endforeach; ?>

            <!-- <option value="">Popular</option> todo: work out how to sort popular -->
          </select>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-auto col-lg-12 col-toolbar">
      <div class="toolbar__action hide-with-js">
        <input
          id="filterSubmit"
          class="form__submit btn btn--primary"
          type="submit"
          value="Filter results"
          role="button" />
      </div>
    </div>


    <div class="col-xs-12 col-sm-auto col-lg-12 col-toolbar">
      <div class="toolbar__action toolbar__action--count">
        <label for="filterSearch" class="form__label js__count">
          <?php if ( have_posts() ) : ?>
            <?php echo $wp_query->found_posts; ?> businesses match
          <?php else : ?>
            No matches
          <?php endif; ?>
        </label>
      </div>
    </div>

  </div> <!-- END .row -->
</div>
