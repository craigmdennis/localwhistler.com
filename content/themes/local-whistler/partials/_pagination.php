<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php if ( is_singular('product') || $wp_query->max_num_pages > 1 ) : ?>

  <ul class="navigation">

    <li class="prev">

      <?php if (is_singular('product')) {
        previous_post_link( '%link' );
      } else {
        previous_posts_link( 'Previous' );
      } ?>

    </li>

    <li class="next">

      <?php if (is_singular('product')) {
        next_post_link( '%link' );
      } else {
        next_posts_link( 'Next' );
      } ?>

    </li>

  </ul>
<?php endif; ?>
