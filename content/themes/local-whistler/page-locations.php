<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php if (get_the_content() != '') : ?>

    <div class="row">

      <div class="col-xs-12">

        <div class="content context__copy">

          <h1 class="title--giant"><?php the_title(); ?></h1>

          <?php the_content(); ?>

        </div>

      </div>

    </div>

  <?php endif; ?>

<?php endwhile; endif; ?>

<!-- page-locations.php -->
<div class="content">

  <?php $terms = get_terms('business_location'); ?>

  <div class="row">

      <?php foreach ($terms as $term) : ?>

        <?php $url = get_bloginfo('url') . '/location/' . $term->slug . '/'; ?>

        <div class="col-xs-12 col-md-6 col-lg-4">

          <div class="media media--card pseudo-link" data-url="<?php echo $url; ?>">

            <div class="media__image">
              <a href="<?php echo $url; ?>">
              <img src="http://maps.googleapis.com/maps/api/staticmap?scale=2&center=<?php echo $term->name; ?>, Whistler, BC,&zoom=15&size=400x300&maptype=road", alt="Map of <?php echo $term->name; ?>" />
              </a>
            </div>

            <div class="media__heading">
              <h2 class="media__title title--overlay">
                <a href="<?php echo $url; ?>">
                  <span><?php echo $term->name ; ?></span>
                </a>
              </h2>
            </div>

          </div>

        </div>

      <?php endforeach; ?>

  </div>

</div>

<?php get_footer(); ?>
