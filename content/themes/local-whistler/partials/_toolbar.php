<div class="toolbar">

  <div class="toolbar__count js-result-count">
    <?php if ( have_posts() ) : ?>
      Found: <?php echo $wp_query->found_posts; ?>
    <?php else : ?>
      No businesses found.
    <?php endif; ?>
  </div>

  <ul id="views" class="toolbar__actions">
    <li class="toolbar__item">
      <a href="<?php echo add_query_arg( 'view', 'gallery' ); ?>" class="toolbar__button">
        <span class="toolbar__button-text">Gallery</span>
        <i class="toolbar__ion icon-picture"></i>
      </a>
      </li>
    <li class="toolbar__item">
      <a href="<?php echo add_query_arg( 'view', 'list' ); ?>" class="toolbar__button">
        <span class="toolbar__button-text">List</span>
        <i class="toolbar__ion icon-list"></i>
      </a>
      </li>
    <li class="toolbar__item">
      <a href="<?php echo add_query_arg( 'view', 'map' ); ?>" class="toolbar__button">
        <span class="toolbar__button-text">Map</span>
        <i class="toolbar__ion icon-map"></i>
      </a>
    </li>
  </ul>
</div>
