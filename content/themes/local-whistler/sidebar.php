<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>

  <?php if ( !is_singular('product') ) : ?>
    <?php get_sidebar('social'); ?>
  <?php endif; ?>

  <div class="sidebar sidebar--main">
    <aside role="complementary">
      <div class="widget">
        <?php dynamic_sidebar( 'sidebar-main' ); ?>
      </div>
    </aside>
  </div>

<?php endif; ?>
