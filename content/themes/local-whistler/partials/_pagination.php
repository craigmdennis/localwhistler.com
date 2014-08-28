<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
  <ul class="navigation">
      <li class="prev">
          <?php previous_posts_link( __( 'Previous page' ) ); ?>
      </li>
      <li class="next">
          <?php next_posts_link( __( 'Next page' ) ); ?>
      </li>
  </ul>
<?php endif; ?>
