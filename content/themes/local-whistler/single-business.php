<?php get_header(); ?>
<!-- single-business.php -->

  <?php

    // Detect if plugin functions exist and assign values
    if ( function_exists( 'get_geocode_latlng' ) ) {
      $map_address = str_replace(" ", "+", get_geocode_address( $post->ID ) );
      $map_latlng = get_geocode_latlng( $post->ID );
      $map_zoom = '&zoom=15';
      $map_size   = '&size=960x300';
      $map_markers = '&markers=red|' . $map_latlng;
      $map_center = '&center=' . $map_latlng;

      $map_name_address = 'q=' . $map_address; // Used when leaving to web maps
      $map_string = $map_center . $map_zoom . $map_size . $map_markers; // Used when leaving to app maps

      $map_app   = ( $detect->isiOS() ? ( $detect->isAndroidOS() ? 'geo:' . $map_latlng . '&daddr=' . $map_name_address : 'http://maps.apple.com/?' . $map_name_address) : 'https://maps.google.com/?' . $map_name_address );
    }

    if ( function_exists( 'get_field' ) ) {
      $url_logo_src   = get_field('logo');
      $url_website    = get_field('website');
      $directions     = get_field('directions');
      $alert          = get_field('alert_message');
      $opening_hours  = array(
        'monday' => get_field('monday'),
        'tuesday' => get_field('tuesday'),
        'wednesday' => get_field('wednesday'),
        'thursday' => get_field('thursday'),
        'friday' => get_field('friday'),
        'saturday' => get_field('saturday'),
        'sunday' => get_field('sunday'),
      );
    }

  ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div role="main" class="business content" id="post-<?php the_ID(); ?>">

      <header>
        <div class="header" id="name">
          <h1 class="business__title"><?php the_title(); ?></h1>
        </div>
      </header>

      <?php $attachments = new Attachments( 'premium_gallery' ); /* pass the instance name */ ?>

      <?php if( $attachments->exist() ) : ?>

        <ul class="bxslider">

          <li><?php the_post_thumbnail('business_hero'); ?></li>

          <?php while( $attachment = $attachments->get() ) : ?>
            <li>
              <?php echo $attachments->image( 'business_hero' ); ?>
            </li>

          <?php endwhile; ?>
        </ul>

      <?php else: ?>

        <?php the_post_thumbnail('business_hero');?>

      <?php endif; ?>

      <?php if ( $alert != '' ) : ?>

        <div class="alert">
          <?php echo $alert; ?>
        </div>

      <?php endif; ?>

      <?php if (( $url_logo_src && $url_website ) !== '' ) : ?>

        <div class="business__logo">
          <a class="logo__link" href="http://<?php echo $url_website ?>" target="_blank">
            <img class="logo__image" src="<?php echo $url_logo_src ?>">
          </a>
        </div>

      <?php elseif ( $url_logo_src !== '' ) : ?>

        <div class="business__logo">
          <img class="logo__image" src="<?php echo $url_logo_src ?>">
        </div>

      <?php endif; ?>

      <div class="business__excerpt">
        <?php the_content(); ?>
      </div>

      <?php if ( $map_address != '' ) : ?>

        <div class="map--static">
          <img class="map__image-static" src="http://maps.googleapis.com/maps/api/staticmap?scale=2<?php echo $map_string ?>">
          <a class="map__link" href="<?php echo $map_app; ?>" target="_blank">Open in maps</a>
        </div>

      <?php endif; ?>

      <?php if ( $directions != '' ) : ?>

        <div class="address__directions">
          <p><?php echo $directions; ?></p>
        </div>

      <?php endif; ?>

      <?php // if ( $opening_hours != '' ) : // Need some better detection ?>

        <div class="business__hours">
          <ul>
          <?php foreach ( $opening_hours as $day => $time ) : ?>
            <li>
              <span class="business__hours__day"><?php echo ucfirst( $day ); ?>: </span>
              <span class="business__hours__time"><?php echo $time; ?></span>
            </li>
          <?php endforeach; ?>
          </ul>
        </div>

      <?php // endif; ?>

      <div class="business__tags">
        <?php the_taxonomies(); ?>
      </div>

      <!-- <footer>
        <div class="footer business__meta">

        <p>Posted <strong><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></strong> on <time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l, F jS, Y') ?></time> &middot; <a href="<?php the_permalink(); ?>">Permalink</a></p>

        </div>
      </footer> -->

    </div>

  <?php endwhile; endif; // end of the loop. ?>

<?php get_footer(); ?>
