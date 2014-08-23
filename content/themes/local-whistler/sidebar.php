<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
  <div class="col-xs-12 col-lg-3">
    <div class="sidebar">
      <aside class="widget" role="complementary">
        <?php dynamic_sidebar( 'main-sidebar' ); ?>
      </aside>
    </div>
  </div>
<?php endif; ?>
