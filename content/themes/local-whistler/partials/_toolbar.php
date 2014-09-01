<?php

  // Put the sorting into an array so we can loop over it
  // Weirdly the data-sort-order needs to be reversed
  // when sorting by date
  $orderOptions = array(
    array(
      'data-sort-order' => 'ASC',
      'data-sort-by' => 'title',
      'text' => 'A-Z'
    ),
    array(
      'data-sort-order' => 'DESC',
      'data-sort-by' => 'title',
      'text' => 'Z-A'
    ),
    array(
      'data-sort-order' => 'ASC',
      'data-sort-by' => 'date',
      'text' => 'Oldest First'
    ),
    array(
      'data-sort-order' => 'DESC',
      'data-sort-by' => 'date',
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
          <i class="btn__icon icon-thumbnails"></i>
        </a>

        <a href="<?php echo add_query_arg( 'view', 'list' ); ?>" class="btn btn--default btn--icon-only btn--control btn--last-visible" title="View as a list">
          <span class="btn__text">List</span>
          <i class="btn__icon icon-list"></i>
        </a>

        <a href="<?php echo add_query_arg( 'view', 'map' ); ?>" class="btn btn--default btn--icon-only btn--control show-with-js" title="View on a map">
          <span class="btn__text">Map</span>
          <i class="btn__icon icon-map"></i>
        </a>

      </div>
      </div>
    </div>


    <div class="col-xs-12 col-sm-auto col-lg-12 col-toolbar">
      <div class="toolbar__action toolbar__action--sort">
        <div class="form__row--inline">
          <label for="filterOrder" class="form__label">Sort Order:</label>
          <select id="filterOrder" class="form__control js__filter-sort js__chosen" name="order">

            <?php foreach ($orderOptions as $orderOption) : ?>

              <?php

                $selected = '';
                $new_order = $orderOption['data-sort-order'];
                $new_orderBy = $orderOption['data-sort-by'];
                $new_target = $orderOption['data-sort-target'];

                if ( $new_order == $order && $new_orderBy == $orderBy ) {
                  $selected = 'selected';
                }

              ?>

              <option
                data-sort-target="media__<?php echo $new_orderBy; ?>"
                data-sort-order="<?php echo $new_order; ?>"
                data-sort-by="<?php echo $new_orderBy; ?>"
                value="<?php echo $new_orderBy . '-' . $new_order; ?>"
                <?php echo $selected ?>><?php echo $orderOption['text']; ?>
              </option>

              <?php // Reset the selected value ?>
              <?php $selected = ''; ?>

            <?php endforeach; ?>
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
            <?php echo $custom_query->found_posts; ?> businesses match
          <?php else : ?>
            No matches
          <?php endif; ?>
        </label>
      </div>
    </div>

  </div> <!-- END .row -->
</div>
