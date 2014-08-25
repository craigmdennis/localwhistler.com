<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
  <div class="sidebar">
    <aside class="widget" role="complementary">
      <?php dynamic_sidebar( 'main-sidebar' ); ?>
    </aside>
  </div>
<?php endif; ?>
