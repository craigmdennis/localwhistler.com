<header>
  <div class="row">
    <div class="col-xs-12">
      <div class="media media--featured">
        <?php if ( get_the_post_thumbnail() ) : ?>
          <div class="media__image">
            <?php the_post_thumbnail('media--featured'); ?>
          </div>
        <?php endif; ?>
        <div class="media__heading">
          <?php the_category(); ?>
          <h1 class="media__title title--large title--overlay">
            <a class="media__title__link" href="<?php the_permalink(); ?>">
              <span><?php the_title(); ?></span>
            </a>
          </h1>
          <?php if ( is_home() ) : ?>
            <div class="media__subtitle title--overlay">
              <p><span><?php the_excerpt(); ?></span></p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>
