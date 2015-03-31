<?php get_header(); ?>

  <!-- index.php -->

  <?php

    // Redirect all references to businesses to use the taxonomy (filtering) template
    if ( ( isset( $_GET[ 'business_type' ] ) && isset( $_GET[ 'business_location' ] ) ) || is_post_type_archive( 'business' ) ) :
      get_template_part( 'taxonomy' );
    else:
      get_template_part( 'partials/loop', 'index' );
    endif;

  ?>

<?php get_footer(); ?>
