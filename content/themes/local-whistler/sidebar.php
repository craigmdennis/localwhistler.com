<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>

  <?php get_sidebar('social'); ?>

  <div class="sidebar sidebar--main">
    <aside role="complementary">
      <div class="widget">
        <?php dynamic_sidebar( 'sidebar-main' ); ?>
      </div>
    </aside>
  </div>

<?php endif; ?>
