<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php $types = array('product', 'business'); ?>

<?php if ( is_singular( $types ) || $wp_query->max_num_pages > 1 ) : ?>

  <ul class="navigation">

    <li class="prev">

      <?php if (is_singular( $types )) {
        previous_post_link( '%link' );
      } else {
        previous_posts_link( 'Previous' );
      } ?>

    </li>

    <li class="next">

      <?php if (is_singular( $types )) {
        next_post_link( '%link' );
      } else {
        next_posts_link( 'Next' );
      } ?>

    </li>

  </ul>
<?php endif; ?>
