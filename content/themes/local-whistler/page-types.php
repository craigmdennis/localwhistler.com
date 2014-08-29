<?php get_header(); ?>

<!-- page-types.php -->
  <div class="content">

    <?php $terms = get_terms('business_type'); ?>

    <div class="row">

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
