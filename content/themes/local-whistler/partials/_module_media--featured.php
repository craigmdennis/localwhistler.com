<?php $attachments = new Attachments( 'premium_gallery' ); ?>

<?php if ( get_the_post_thumbnail() || $attachments->exist() ) : ?>

  <header>
    <div class="row">
      <div class="col-xs-12">

        <?php if ( $attachments->exist() ) : ?>
        <div class="media media--gallery">
        <?php else : ?>
        <div class="media media--featured">
        <?php endif; ?>

          <div class="media__image">

            <?php // If there are attachments in the gallery ?>
            <?php if( $attachments->exist() ) : ?>

              <?php // Use a slider ?>
              <div class="owl-wrapper-outer">
                <ul class="slider">

                  <?php // And put the featured image first ?>
                  <?php if ( get_the_post_thumbnail() ) : ?>
                    <li class="slider__item">
                      <?php the_post_thumbnail('media--featured'); ?>
                    </li>
                  <?php endif; ?>

                  <?php // Loop through all the images ?>
                  <?php while( $attachment = $attachments->get() ) : ?>
                    <li class="slider_item">
                      <?php echo $attachments->image( 'media--featured' ); ?>
                    </li>
                  <?php endwhile; ?>

                </ul>
              </div>

            <?php // Else just use the featured image if it exists ?>
            <?php elseif ( get_the_post_thumbnail() ) : ?>

              <?php the_post_thumbnail('media--featured'); ?>

            <?php endif; ?>
          </div>

          <div class="media__heading">

            <?php the_category(); ?>

            <h1 class="media__title title--large title--overlay">

              <?php if ( is_single() || is_page() ) : ?>
                <span><span><?php the_title(); ?></span></span>
              <?php else : ?>
                <a class="media__title__link" href="<?php the_permalink(); ?>">
                  <span><?php the_title(); ?></span>
                </a>
              <?php endif; ?>

            </h1>

            <?php if ( is_home() ) : ?>
              <div class="media__subtitle title--overlay">
                <p><span><?php the_excerpt(); ?></span></p>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div> <!-- END .col -->
    </div> <!-- END .row -->
  </header>

<?php endif; ?>
