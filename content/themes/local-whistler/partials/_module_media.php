<?php $logo = get_field('logo'); ?>
<?php $featured = wp_get_attachment( get_post_thumbnail_id( $post->ID ), 'media--thumb' ); ?>

<?php if ( !empty($logo) || !empty($featured) ) : ?>

    <?php // echo '<pre>'; print_r( $featured ); echo '</pre>'; ?>

    <?php

      if ( !empty($logo) ) {
        $image     = $logo;
        $container = 'has-logo';
        $width     = $image['sizes']['media--thumb-width'];
        $height    = $image['sizes']['media--thumb-height'];
        $style     = 'margin-top: -' . $height/2 . 'px; margin-left: -' . $width/2 . 'px;';
        $classes   = ' js-color-target';
      }
      elseif ( !empty($featured) ) {
        $image     = $featured;
        $container = 'has-featured';
        $style     = '';
        $classes   = '';
      }

      $alt = $image['alt'];
      $src = $image['sizes']['media--thumb'];

    ?>

  <div class="<?php echo $container; ?>">

    <a class="media__link--logo media__link--left <?php echo $classes; ?>" href="<?php the_permalink(); ?>">
      <img
        class="media__logo js-color-trigger"
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
      <ul class="media__tags">
        <?php the_terms($post->ID, '', '<li class="media__tag">','</li><li class="media__tag">','</li>'); ?>
      </ul>
  </div>

<?php if ( !empty($logo) ) : ?>
</div>
<?php endif; ?>
