<?php get_header(); ?>

  <!-- index.php -->

  <?php

    if ( isset( $_GET['business_type'] ) && isset( $_GET['business_location'] ) ) :
      get_template_part( 'taxonomy' );
    else:
      get_template_part( 'partials/loop', 'index' );
    endif;

  ?>

<?php get_footer(); ?>
