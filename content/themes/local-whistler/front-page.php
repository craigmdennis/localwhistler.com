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


  <div class="container">
    <div class="media media--featured">
      <div class="media__image">
        <?php the_post_thumbnail('media--featured'); ?>
      </div>
      <div class="media__heading">
        <?php the_category(); ?>
        <h1 class="media__title title--large">
          <a class="media__title__link" href="<?php the_permalink(); ?>">
            <span><?php the_title(); ?></span>
          </a>
        </h1>
        <div class="media__subtitle">
          <p><span><?php the_excerpt(); ?></span></p>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; endif; ?>

<div class="container">
  <div class="border">
    <div class="content">

      <!-- Predefined searches -->

      <div class="span-4">
        <div class="media media--card" data-url="<?php the_permalink(); ?>">
          <div class="media__image">
            <img src="http://placehold.it/670x446" />
          </div>
          <div class="media__heading">
            <h2 class="media__title">
              <a href="#">
                <span>Pizza in Creekside</span>
              </a>
            </h2>
          </div>
        </div>
      </div>

      <div class="span-4">
        <div class="media media--card" data-url="<?php the_permalink(); ?>">
          <div class="media__image">
            <img src="http://placehold.it/670x446" />
          </div>
          <div class="media__heading">
            <h2 class="media__title">
              <a href="#">
                <span>Shopping in The Village</span>
              </a>
            </h2>
          </div>
        </div>
      </div>

      <div class="span-4">
        <div class="media media--card" data-url="<?php the_permalink(); ?>">
          <div class="media__image">
            <img src="http://placehold.it/670x446" />
          </div>
          <div class="media__heading">
            <h2 class="media__title">
              <a href="#">
                <span>Activities in Function</span>
              </a>
            </h2>
          </div>
        </div>
      </div>



      <?php

        $args = array(
          'post_per_page' => 3,
          'post_type' => 'post',
          'post__not_in'  => get_option( 'sticky_posts' )
        );

      ?>

      <?php query_posts( $args ); ?>

      <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <?php if (get_the_post_thumbnail() == '') : continue; ?>

          <?php else : ?>

            <div class="span-4">
              <div class="media media--card" data-url="<?php the_permalink(); ?>">
                <div class="media__image">
                  <?php the_post_thumbnail('media--card'); ?>
                </div>
                <div class="media__heading">
                  <?php the_category(); ?>
                  <h2 class="media__title">
                    <a href="<?php the_permalink(); ?>">
                      <span><?php the_title(); ?></span>
                    </a>
                  </h2>
                </div>
                <div class="media__body context__copy">
                  <p><?php the_excerpt(); ?></p>
                </div>
              </div>
            </div>

          <?php endif; ?>

        <?php endwhile; ?>

      <?php endif; ?>


    </div> <!-- END .content -->
  </div> <!-- END .border -->
</div> <!-- END .container -->

<?php get_footer(); ?>
