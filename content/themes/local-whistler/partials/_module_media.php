<?php if ( function_exists('get_field') ) : ?>
<?php $logo = get_field('logo'); ?>
<?php endif; ?>

<?php $featured = wp_get_attachment( get_post_thumbnail_id( $post->ID ), 'media--thumb' ); ?>

<?php if ( !empty($logo) || get_the_post_thumbnail() != '' ) : ?>

    <?php // echo '<pre>'; print_r( $featured ); echo '</pre>'; ?>

    <?php

      if ( !empty($logo) ) {
        $image     = $logo;
        $container = 'has-logo';
        $width     = $image['sizes']['media--thumb-retina-width'];
        $height    = $image['sizes']['media--thumb-retina-height'];
        $src       = $image['sizes']['media--thumb-retina'];
        $style     = 'margin-top: -' . $height/4 . 'px; margin-left: -' . $width/4 . 'px;';

        if ( $width <= 300 && $height <= 300) {
          $width     = $image['sizes']['media--thumb-width'];
          $height    = $image['sizes']['media--thumb-height'];
          $src       = $image['sizes']['media--thumb'];
          $style     = 'margin-top: -' . $height/2 . 'px; margin-left: -' . $width/2 . 'px;';
        }
      }
      elseif ( !empty($featured) ) {
        $image     = $featured;
        $container = 'has-featured';
        $style     = '';
      }

      $alt = $image['alt'];
      $src = $image['sizes']['media--thumb'];

    ?>


  <div class="<?php echo $container; ?>">

    <div class="media__logo-container">

      <a class="media__link--logo media__link--left <?php if ( !empty($logo) ) : ?> js-color-target<?php endif; ?>" href="<?php the_permalink(); ?>">
        <img
          class="media__logo <?php if ( !empty($logo) ) : ?> js-color-trigger <?php endif; ?>"
          src="<?php echo $src; ?>"
          alt="<?php echo $alt; ?>"
          style="<?php echo $style; ?>"
        />
      </a>

    </div>

    <?php if (isset( $greenLogo )) : ?>
      <?php echo $greenLogo; ?>
    <?php endif; ?>

<?php endif; ?>

  <?php if ( !is_single() ) : ?>
  <a class="media__link--container" href="<?php the_permalink(); ?>">
  <?php endif; ?>

    <div class="media__heading">
      <h2 class="media__title">
        <?php the_title(); ?>
      </h2>
    </div>

    <div class="media__body">
      <p><?php the_excerpt(); ?></p>
    </div>

  <?php if ( !is_single() ) : ?>
  </a>
  <?php endif; ?>

  <?php if (get_post_type() == 'business') : ?>

    <div class="media__footer">

      <ul class="tags">
        <?php the_terms($post->ID, 'business_filter', '<li class="tag__item">','</li><li class="tag__item">','</li>'); ?>
      </ul>

      <time datetime="<?php the_time('c') ?>" class="media__date"><?php the_time('F j, Y'); ?></time>

    </div>

  <?php endif; ?>

<?php if ( !empty($logo) ) : ?>
</div>
<?php endif; ?>
