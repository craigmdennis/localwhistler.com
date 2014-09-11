<?php get_header(); ?>

<?php

  $args = array(
  	'posts_per_page' => 1,
  	'post__in'  => get_option( 'sticky_posts' )
  );

  if ( function_exists( 'get_field' ) ) {

    $cards = array(
      array(
        'title' => get_field('panel_1_title'),
        'search' => get_field('panel_1_search_string'),
        'image' => get_field('panel_1_image'),
      ),
      array(
        'title' => get_field('panel_2_title'),
        'search' => get_field('panel_2_search_string'),
        'image' => get_field('panel_2_image'),
      ),
      array(
        'title' => get_field('panel_3_title'),
        'search' => get_field('panel_3_search_string'),
        'image' => get_field('panel_3_image'),
      )
    );

  };

?>

<?php query_posts( $args ); ?>

<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
  <?php get_template_part('partials/_module_media--featured'); ?>
<?php endwhile; endif; ?>

  <div class="content" role="main">
    <div class="row">

      <?php if (!empty($cards)) : ?>
        <?php for ($i = 0, $size = count($cards); $i < $size; $i++) : ?>

          <?php
            $card = $cards[$i];
            $image = $card['image'];
            $title = $card['title'];
            $search = get_bloginfo('url') . '/' . $card['search'];
          ?>

          <div class="col-xs-12 col-sm-6 col-md-4">
            <a
              class="media media--card"
              href="<?php echo $search; ?>"
            >
              <div class="media__image">
                <img
                  src="<?php echo $image['sizes']['media--card']; ?>"
                  alt="<?php echo $image['alt']; ?>"
                />
              </div>
              <div class="media__heading">
                <h2 class="media__title title--overlay">
                    <span><span><?php echo $title; ?></span></span>
                </h2>
              </div>
            </a>
          </div>

        <?php endfor; ?>
      <?php endif; ?>

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
              <div class="media media--card">
                <a class="media__image media__image--top" href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('media--card'); ?>
                </a>
                <a class="media__heading has-category" href="<?php the_permalink(); ?>">
                  <h2 class="media__title title--overlay">
                      <span><span><?php the_title(); ?></span></span>
                  </h2>
                </a>
                <?php the_category(); ?>
                <a class="media__body" href="<?php the_permalink(); ?>">
                  <p><?php the_excerpt(); ?></p>
                </a>
              </div>
            </div>

            <?php $count++; ?>

          <?php endif; ?>

        <?php endwhile; ?>

      <?php endif; ?>

      <?php // Instagram Feed ?>
      <div class="col-xs-12">
        <ul class="row instagram">
          <?php require_once("partials/_instagram.php"); ?>
        </ul>
      </div>

    </div> <!-- END .row -->
  </div>

<?php get_footer(); ?>
