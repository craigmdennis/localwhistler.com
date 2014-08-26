<div class="sidebar">
  <aside role="complementary">
    <div class="widget">
      <p>Posted <strong><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></strong> on <time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l, F jS, Y') ?></time></p>
    </div>
  </aside>
</div>
