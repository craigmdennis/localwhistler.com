<?php // Need to make this more generic ?>

<?php $logo = get_field('logo'); ?>
<?php if ( !empty($logo) ) : ?>

  <?php // echo '<pre>'; print_r( $logo ); echo '</pre>'; ?>

  <?php $width =  $logo['sizes']['media--thumb-width']; ?>
  <?php $height =  $logo['sizes']['media--thumb-height']; ?>

  <a class="media__link--logo media__link--left media__thumb js-color-target" href="<?php the_permalink(); ?>">
    <img
      class="media__logo js-color-trigger"
      src="<?php echo $logo['sizes']['media--thumb']; ?>"
      alt="<?php echo $logo['alt']; ?>"
      style="margin-top: -<?php echo $height/2; ?>px; margin-left: -<?php echo $width/2; ?>px;"
    />
  </a>

<?php endif; ?>

  <div class="media__heading">
    <h2 class="media__title">
      <a class="media__link--title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
  </div>

  <div class="media__body">

    <?php if ( 'product' == get_post_type() ) : ?>
      <?php the_content(); ?>
    <?php else: ?>
      <?php the_excerpt(); ?>
    <?php endif; ?>

  </div>

  <div class="media__footer">
    <time datetime="<?php the_time('c') ?>" class="media__date"><?php the_time('F j, Y'); ?></time>
    <ul class="media__tags">
      <?php the_terms($post->ID,'business_filter', '<li class="media__tag">','</li><li class="media__tag">','</li>'); ?>
    </ul>
  </div>
</div>
