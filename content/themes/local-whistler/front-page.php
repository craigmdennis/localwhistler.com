<?php get_header(); ?>

<?php

  $args = array(
  	'posts_per_page' => 1,
  	'post__in'  => get_option( 'sticky_posts' )
  );

?>

<?php query_posts( $args ); ?>

<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>

  <div class="hero">
    <div class="hero__image">
      <?php the_post_thumbnail('full'); ?>
    </div>
    <div class="hero__body">
      <?php the_category(); ?>
      <h1 class="hero__title"><?php the_title(); ?></h1>
      <?php the_excerpt(); ?>
    </div>
  </div>

<?php endwhile; endif; ?>

<?php

  $args = array(
    'post_per_page' => 3,
    'post_type' => 'post',
    'post__not_in'  => get_option( 'sticky_posts' )
  );

?>

<?php query_posts( $args ); ?>

<div class="container">

  <?php if ( have_posts() ) : ?>

    <div class="row">

      <?php while ( have_posts() ) : the_post(); ?>

      <div class="span-4">
        <div class="card">
          <div class="card__image">
            <figure>
              <!-- <?php the_post_thumbnail(); ?> -->
              <img src="http://placehold.it/300">
            </figure>
          </div>
          <div class="card__heading">
            <?php the_category(); ?>
            <h2 class="card__title"><?php the_title(); ?></h2>
          </div>
          <div class="card__body">
            <p><?php the_excerpt(); ?></p>
          </div>
        </div>
      </div>

      <?php endwhile; ?>

    </div>

  <?php endif; ?>

</div>

<?php get_footer(); ?>
