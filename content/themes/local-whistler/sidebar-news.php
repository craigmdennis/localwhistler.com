<?php if ( is_active_sidebar( 'sidebar-news' ) ) : ?>
  <div class="sidebar">
    <aside role="complementary">
      <div class="widget">
        <?php dynamic_sidebar( 'sidebar-news' ); ?>
      </div>
    </aside>
  </div>
<?php endif; ?>
