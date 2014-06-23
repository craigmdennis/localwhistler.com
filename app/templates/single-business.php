<?php get_header(); ?>
<!-- single-business.php -->

  <?php

    // Detect if plugin functions exist and assign values
    if ( function_exists( 'get_geocode_latlng' ) ) {
      $map_latlng = get_geocode_latlng( $post->ID );
      $map_address = get_geocode_address( $post->ID );
      $map_zoom = '&zoom=15';
      $map_size   = '&size=500x500';
      $map_markers = '&markers=red|' . $map_latlng;
      $map_center = '&center=' . $map_latlng;

      $map_name_address = 'q=' . get_the_title() . ', ' . $map_address; // Used when leaving to web maps
      $map_string = $map_center . $map_zoom . $map_size . $map_markers; // Used when leaving to app maps

      $map_base   = ( $detect->isiOS() ? ( $detect->isAndroidOS() ? 'geo:' . $map_latlng . '&daddr=' . $map_name_address : 'http://maps.apple.com/?' . $map_name_address) : 'https://maps.google.com/?' . $map_name_address );
    }

    if ( function_exists( 'get_field' ) ) {
      $url_logo_src = get_field('logo');
      $url_website  = get_field('website');
    }

  ?>

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <article role="main" class="primary-content" id="post-<?php the_ID(); ?>">
            <header>
                <h1><?php the_title(); ?></h1>
            </header>

            <?php the_post_thumbnail('business_hero');?>

            <?php if (( $url_logo_src && $url_website ) !== "" ) : ?>

              <a href="http://<?php echo $url_website ?>" target="_blank">
                <img src="<?php echo $url_logo_src ?>">
              </a>

            <?php elseif ( $url_logo_src !== "" ) : ?>

              <img src="<?php echo $url_logo_src ?>">

            <?php endif; ?>

            <?php the_content(); ?>

            <?php if ( $map_latlng ) : ?>

              <a href="<?php echo $map_base; ?>" target="_blank">
                <img src="http://maps.googleapis.com/maps/api/staticmap?<?php echo $map_string ?>">
              </a>

            <?php endif; ?>

            <?php the_taxonomies(); ?>

            <footer class="entry-meta">
              <p>Posted <strong><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></strong> on <time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l, F jS, Y') ?></time> &middot; <a href="<?php the_permalink(); ?>">Permalink</a></p>
            </footer>

            <?php endwhile; // end of the loop. ?>
        </article>

<?php get_footer(); ?>
