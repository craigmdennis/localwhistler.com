<?php get_header(); ?>

<?php

  $args = array(
  	'posts_per_page' => 1,
  	'post__in'  => get_option( 'sticky_posts' )
  );

?>

<?php query_posts( $args ); ?>

<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>

  <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
  <?php $url = $thumb['0']; ?>


  <div class="hero">
    <div class="hero__image" style="background-image: url(<?php echo $url; ?>);">

      <div class="container">
        <div class="hero__body">
          <?php the_category(); ?>
          <h1 class="hero__title"><?php the_title(); ?></h1>
          <div class="hero__subtitle">
            <?php the_excerpt(); ?>
          </div>
        </div>
      </div>

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

<div class="container content">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php if (get_the_post_thumbnail() == '') : continue; ?>

      <?php else : ?>

        <div class="span-4">
          <div class="card">
            <div class="card__image">
              <figure>
                <?php the_post_thumbnail('small'); ?>
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

      <?php endif; ?>

    <?php endwhile; ?>

  <?php endif; ?>

</div>

<?php get_footer(); ?>
