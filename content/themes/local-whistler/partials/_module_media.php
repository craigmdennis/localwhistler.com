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
        $width     = $image['sizes']['media--thumb-width'];
        $height    = $image['sizes']['media--thumb-height'];
        $style     = 'margin-top: -' . $height/2 . 'px; margin-left: -' . $width/2 . 'px;';
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

    <a class="media__link--logo media__link--left <?php if ( !empty($logo) ) : ?> js-color-target<?php endif; ?>" href="<?php the_permalink(); ?>">
      <img
        class="media__logo <?php if ( !empty($logo) ) : ?> js-color-trigger <?php endif; ?>"
        src="<?php echo $src; ?>"
        alt="<?php echo $alt; ?>"
        style="<?php echo $style; ?>"
      />
    </a>

<?php endif; ?>

  <div class="media__heading">
    <h2 class="media__title">
      <?php if ( is_single() ) : ?>
        <?php the_title(); ?>
      <?php else : ?>
        <a class="media__link--title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <?php endif; ?>
    </h2>
  </div>

  <div class="media__body">
    <p><?php the_excerpt(); ?></p>
  </div>

  <div class="media__footer">

      <a class="btn btn--default" href="<?php the_permalink(); ?>">View details</a>
      <time datetime="<?php the_time('c') ?>" class="media__date"><?php the_time('F j, Y'); ?></time>

      <?php if (get_post_type() == 'business_type') : ?>

        <ul class="tags">
          <?php the_terms($post->ID, 'business_filter', '<li class="tag__item">','</li><li class="tag__item">','</li>'); ?>
        </ul>

      <?php endif; ?>
  </div>

<?php if ( !empty($logo) ) : ?>
</div>
<?php endif; ?>
