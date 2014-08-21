<div class="toolbar">

  <div class="toolbar__count js-result-count">
    <?php if ( have_posts() ) : ?>
      Found: <?php echo $wp_query->found_posts; ?>
    <?php else : ?>
      No businesses found.
    <?php endif; ?>
  </div>

    <div class="btn-group toolbar__actions">

      <a href="<?php echo add_query_arg( 'view', 'gallery' ); ?>" class="btn btn--default btn--icon-only" title="View as a gallery">
        <span class="btn__text">Gallery</span>
        <i class="btn__icon icon--after icon-thumbnails"></i>
      </a>

      <a href="<?php echo add_query_arg( 'view', 'list' ); ?>" class="btn btn--default btn--icon-only" title="View as a list">
        <span class="btn__text">List</span>
        <i class="btn__icon icon--after icon-list"></i>
      </a>

      <a href="<?php echo add_query_arg( 'view', 'map' ); ?>" class="btn btn--default btn--icon-only show-with-js" title="View on a map">
        <span class="btn__text">Map</span>
        <i class="btn__icon icon--after icon-map"></i>
      </a>
</div>
