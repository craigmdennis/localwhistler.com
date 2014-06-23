<?php get_header(); ?>

<!-- taxonomy.php -->

<?php if ( have_posts() ) : the_post(); ?>

<?php $term =	$wp_query->queried_object; ?>

  <h1> Businesses in <?php echo $term->name; ?> </h1>

  <?php rewind_posts(); ?>

  <?php get_template_part( 'loop', 'archive' ); ?>

<?php get_footer();
