<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="row">

    <div class="col-xs-12">

      <div class="content context__copy">

        <h1 class="title--giant"><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </div>

  </div>

<?php endwhile; endif; ?>

<!-- page-types.php -->
<div class="content">

  <div class="row">

    <?php $terms = get_terms('business_type'); ?>

    <?php foreach ($terms as $term) : ?>

      <?php $url = get_bloginfo('url') . '/type/' . $term->slug . '/'; ?>

      <div class="col-xs-12 col-md-6 col-lg-4">

        <div class="media media--card pseudo-link" data-url="<?php echo $url; ?>">

          <?php $image = get_field( 'taxonomy_image', $term->taxonomy . '_' . $term->term_id ); ?>

          <div class="media__image">
            <a class="media__link" href="<?php echo $url; ?>">
              <img src="<?php echo $image['sizes']['media--card']; ?>" alt="<?php echo $image['alt']; ?>" />
            </a>
          </div>

          <div class="media__heading">
            <h2 class="media__title title--overlay">
              <a href="<?php bloginfo('url'); ?>/type/<?php echo $term->slug; ?>/">
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
