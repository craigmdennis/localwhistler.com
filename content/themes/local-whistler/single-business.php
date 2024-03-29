<?php get_header(); ?>
<!-- single-business.php -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php

  // Detect if plugin functions exist and assign values
  if ( function_exists( 'get_geocode_latlng' ) ) {
    $address = get_geocode_address( $post->ID );
    $map_address = str_replace(" ", "+", $address );
    $map_latlng = get_geocode_latlng( $post->ID );
    $map_zoom = '&zoom=15';
    $map_size   = '&size=960x300';
    $map_markers = '&markers=red|' . $map_latlng;
    $map_center = '&center=' . $map_latlng;

    $map_name_address = 'q=' . $map_address; // Used when leaving to web maps
    $map_string = $map_center . $map_zoom . $map_size . $map_markers; // Used when leaving to app maps

    $map_app   = ( $detect->isiOS() ? ( $detect->isAndroidOS() ? 'geo:' . $map_latlng . '&daddr=' . $map_name_address : 'http://maps.apple.com/?' . $map_name_address) : 'https://maps.google.com/?' . $map_name_address );

    $address_list = explode( ',', $address );

  }

  if ( function_exists( 'get_field' ) ) {
    $logo           = get_field('logo');
    $url_website    = get_field('website');
    $phone          = get_field('phone_number');
    $email          = get_field('email_address');
    $directions     = get_field('directions');
    $alert_content  = get_field('alert_message');
    $video_url      = get_field('premium_video');
    $message_content= get_field('premium_message');
    $message_title  = get_field('premium_message_title');

    $opening_hours = array(
      'monday'      => get_field('monday'),
      'tuesday'     => get_field('tuesday'),
      'wednesday'   => get_field('wednesday'),
      'thursday'    => get_field('thursday'),
      'friday'      => get_field('friday'),
      'saturday'    => get_field('saturday'),
      'sunday'      => get_field('sunday'),
    );

    $social = array(
      'pinterest'    => get_field('pinterest_username'),
      'twitter'      => get_field('twitter_username'),
      'facebook'     => get_field('facebook_url'),
      'youtube'      => get_field('youtube_username'),
      'flickr'       => get_field('flickr_username'),
      'vimeo'        => get_field('vimeo_username'),
      'instagram'    => get_field('instagram_username'),
      'trip-advisor' => get_field('trip_advisor_url'),
      'yelp'         => get_field('yelp_url')
    );

  }

  if ( !empty($logo) ) {
    $width   = $logo['sizes']['media--thumb-width'];
    $height  = $logo['sizes']['media--thumb-height'];
    $alt     = $logo['alt'];
    $src     = $logo['sizes']['media--thumb'];
  }

  if ( has_term('green', 'business_filter', $post->ID) ):
    $greenClass = 'is-green';
    $greenLogo = '<div class="green-content">Environmentally Conscious</div>';
  else:
    $greenClass = 'not-green';
    $greenLogo = '';
  endif;

?>

<?php if ( get_field('alert_message') != '' ) : ?>
  <div class="has-alert">
<?php endif; ?>

<?php include_once('partials/_module_media--featured.php'); ?>

<?php if ( $alert_content != '' ) : ?>

  <div class="alert alert--warning">
    <i class="icon-attention icon--fixed-left icon--large"></i>
    <?php echo $alert_content; ?>
  </div>

<?php endif; ?>

<div class="row">

  <div class="col-xs-12 col-md-8 col-lg-9 <?php echo $greenClass; ?>">

    <?php if ( !empty($logo) ): ?>
    <div class="content-header">
      <div class="media media--single js-color-container js-color-target">
        <img
          class="js-color-trigger"
          src="<?php echo $src; ?>"
          alt="<?php echo $alt; ?>"
          width="<?php echo $width; ?>"
          height="<?php echo $height; ?>"
        />
      </div>
      <?php echo $greenLogo; ?>
    </div>
    <?php endif; ?>

    <div id="details" class="content context__copy">

      <?php the_content(); ?>

    </div>

    <?php if ( $video_url != '' ) : ?>
      <div id="video" class="content context__copy">
        <div class="video-embed">
          <?php echo wp_oembed_get('http://' . $video_url); ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($message_title != '' || $message_content != '') : ?>
      <div id="message" class="content context__copy">

        <?php if ($message_title != '') : ?>
          <h3><?php echo $message_title; ?></h3>
        <?php endif; ?>

        <?php if ($message_content != '') : ?>
          <blockquote>
            <!-- <i class="icon-quotes"></i> -->
            <?php echo $message_content; ?>
          </blockquote>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <?php if ( $directions != '' || $address != '' ) : ?>
      <div id="location" class="content context__copy">

        <?php if( $address != '' ) : ?>
          <h3><i class="icon-signpost icon--before"></i>Address</h3>
          <p><?php echo $address; ?></p>
        <?php endif; ?>

        <?php if ( $directions != '' ) : ?>
          <p><?php echo $directions; ?></p>
        <?php endif; ?>

        <?php if ( $map_address != '' ) : ?>

          <div class="map--static">
            <img class="map__image-static" src="http://maps.googleapis.com/maps/api/staticmap?scale=2<?php echo $map_string ?>">
            <a class="btn btn--default" href="<?php echo $map_app; ?>" target="_blank">Open in maps<i class="icon-external icon--after"></i></a>
          </div>

        <?php endif; ?>

      </div>
    <?php endif; ?>

    <?php get_template_part('partials/_pagination'); ?>

  </div>

  <div class="col-xs-12 col-md-4 col-lg-3">

    <div class="sidebar">
      <div class="widget">
        <h3 class="widget-title">Contact Info</h3>
        <ul>
          <?php if ( $url_website != '' ) : ?>
            <li id="website">
              <a href="http://<?php echo $url_website; ?>" target="_blank">
                <i class="icon-globe icon--before"></i>
                Visit their website
              </a>
            </li>
          <?php endif; ?>

          <?php if ( $email != '' ) : ?>
            <li id="email">
              <a href="mailto:<?php echo $email; ?>" target="_blank">
                <i class="icon-email icon--before"></i>
                Send an email
              </a>
            </li>
          <?php endif; ?>

          <?php if ( $phone != '' ) : ?>
            <li id="phone">
              <a href="tel:<?php echo $phone; ?>" target="_blank">
                <i class="icon-phone icon--before"></i>
                <?php echo $phone; ?>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <?php if (
      get_field('monday') != '' ||
      get_field('tuesday') != '' ||
      get_field('wednesday') != '' ||
      get_field('thursday') != '' ||
      get_field('friday') != '' ||
      get_field('saturday') != '' ||
      get_field('sunday') != ''
    ) : ?>

      <div id="openinghours" class="sidebar">
        <div class="sidebar__section">
          <h3 class="widget-title"><i class="icon-clock icon--before"></i>Opening Hours</h3>
          <div class="widget__inner">
            <ul>
            <?php foreach ( $opening_hours as $day => $time ) : ?>
              <?php if ( empty( $time ) ) : continue; endif; ?>
              <?php if ( strtolower( $time ) == "closed" ) {
                $hoursColor = "#D83434";
              } else {
                $hoursColor = "inherit";
              } ?>
              <li>
                <span class="business__hours__day"><?php echo ucfirst( $day ); ?></span>
                <span class="business__hours__time" style="color:<?php echo $hoursColor; ?>;"><?php echo ucFirst( $time ); ?></span>
              </li>
            <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

    <?php endif; ?>

    <?php if (
      get_field('pinterest_username') != '' ||
      get_field('twitter_username') != '' ||
      get_field('facebook_url') != '' ||
      get_field('youtube_username') != '' ||
      get_field('flickr_username') != '' ||
      get_field('vimeo_username') != '' ||
      get_field('instagram_username') != '' ||
      get_field('trip_advisor_url') != '' ||
      get_field('yelp_url') != ''
    ) : ?>

      <div id="links" class="sidebar">
        <div class="widget business__links">
          <h3 class="widget-title">Social Links</h3>
          <ul>
            <?php foreach ( $social as $site => $username ) : ?>
            <?php if ( empty( $username ) ) : continue; endif; ?>
            <li>
              <a
                href="http://<?php echo str_replace('-', '', $site) . '.com/' . $username; ?>"
                target="blank"
                class="business__social__item">
                <i class="icon-<?php echo $site; ?> icon--before icon--sign"></i>
                <?php echo ucwords( str_replace('-', ' ', $site) ); ?>
              </a>
            </li>
          <?php endforeach; ?>
          </ul>
        </div>
      </div>

    <?php endif; ?>

    <?php if ( get_the_terms($post->ID, 'business_filter' ) ) : ?>
      <div id="tags" class="sidebar">
        <div class="sidebar__section">
          <h3 class="widget-title"><i class="icon-tags icon--before"></i>Business Tags</h3>
          <div class="widget__inner">
            <ul class="tags">
              <?php the_terms($post->ID, 'business_filter', '<li class="tag__item">','</li><li class="tag__item">','</li>'); ?>
            </ul>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div> <!-- END .col -->

</div> <!-- END .row -->

<?php if ( get_field('alert_message') != '' ) : ?>
  </div>
<?php endif; ?>

<?php endwhile; endif; // end of the loop. ?>

<?php get_footer(); ?>
