<?php get_header(); ?>

<?php

  $args = array(
  	'posts_per_page' => 1,
  	'post__in'  => get_option( 'sticky_posts' )
  );

?>

<?php query_posts( $args ); ?>

<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
  <?php include_once('partials/_module_media--featured.php'); ?>
<?php endwhile; endif; ?>

  <div class="content" role="main">
    <div class="row">

      <!-- WIP Predefined searches -->

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="media media--card pseudo-link" data-url="/?s=Pizza&business_location=creekside&business_type=&order=date-desc">
          <div class="media__image">
            <?php the_post_thumbnail('media--card'); ?>
          </div>
          <div class="media__heading">
            <h2 class="media__title title--overlay">
              <a href="/?s=Pizza&business_location=creekside&business_type=&order=date-desc">
                <span>Pizza in Creekside</span>
              </a>
            </h2>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="media media--card pseudo-link" data-url="/?s=&business_location=village&business_type=shop&order=date-desc">
          <div class="media__image">
            <?php the_post_thumbnail('media--card'); ?>
          </div>
          <div class="media__heading">
            <h2 class="media__title title--overlay">
              <a href="/?s=&business_location=village&business_type=shop&order=date-desc">
                <span>Shopping in Whistler Village</span>
              </a>
            </h2>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 last">
        <div class="media media--card pseudo-link" data-url="/?s=&business_location=function&business_type=activity&order=date-desc">
          <div class="media__image">
            <?php the_post_thumbnail('media--card'); ?>
          </div>
          <div class="media__heading">
            <h2 class="media__title title--overlay">
              <a href="/?s=&business_location=function&business_type=activity&order=date-desc">
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

        <?php $count = 1; ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <?php if (get_the_post_thumbnail() == '') : continue; ?>

          <?php else : ?>

            <?php

              if ( $count < 3 ) {
                $last = '';
              }
              else {
                $last = 'last';
              }

            ?>

            <div class="col-xs-12 col-sm-6 col-md-4 <?php echo $last; ?>">
              <div class="media media--card pseudo-link" data-url="<?php the_permalink(); ?>">
                <div class="media__image media__image--top">
                  <?php the_post_thumbnail('media--card'); ?>
                </div>
                <div class="media__heading">
                  <?php the_category(); ?>
                  <h2 class="media__title title--overlay">
                    <a href="<?php the_permalink(); ?>">
                      <span><?php the_title(); ?></span>
                    </a>
                  </h2>
                </div>
                <div class="media__body">
                  <p><?php the_excerpt(); ?></p>
                </div>
              </div>
            </div>

            <?php $count++; ?>

          <?php endif; ?>

        <?php endwhile; ?>

      <?php endif; ?>


    </div> <!-- END .row -->
  </div>

<?php get_footer(); ?>
