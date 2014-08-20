<li class="media hide-with-js">
  <?php $logo = get_field('logo'); ?>
  <?php if ( !empty($logo) ) : ?>
    <a class="media__link--logo media__link--left media__thumb" href="<?php the_permalink(); ?>">
      <img class="media__logo" src="<?php echo $logo['sizes']['media--thumb']; ?>" alt="<?php echo $logo['alt']; ?>" />
    </a>
  <?php endif; ?>
  <div class="media__body context__copy">
    <h2 class="media__title">
      <a class="media__link--title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <?php the_excerpt(); ?>
  </div>

  <div class="media__footer">
    <time datetime="<?php the_time('c') ?>" class="media__date"><?php the_time('F j, Y'); ?></time>
    <ul class="media__tags">
      <?php the_terms($post->ID,'business_filter', '<li class="media__tag">','</li><li class="media__tag">','</li>'); ?>
    </ul>
  </div>

</li>
