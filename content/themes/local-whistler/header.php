<?php

  // If we're on a page capable of showing a map
  if ( (isset( $_GET['business_type'] ) || isset( $_GET['business_location'] ) || is_search() || taxonomy_exists('business_location') || taxonomy_exists('business_type') || taxonomy_exists('business_filter') || is_post_type_archive( 'business' ) ) && !is_single() ) {

    // Read the cookie
    if (isset($_COOKIE['view'])) {
      $view = $_COOKIE['view'];
    }

    // If the cookie doesn't exist
    else {
      $view = get_view_type();
      setcookie('view',$view,time() + (86400 * 7)); // Set for 7 days
    };

  }

  else {
    $view = '';
  }

  $options = get_option('lw_options');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <title><?php wp_title(''); ?></title>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />

  <!-- Icons -->
  <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
  <meta name="apple-mobile-web-app-title" content="<?php echo bloginfo('name'); ?>">
  <link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
  <link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/mstile-144x144.png">
  <meta name="application-name" content="<?php echo bloginfo('name'); ?>">

  <!-- The little things -->
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="author" type="text/plain" href="<?php echo bloginfo('template_directory'); ?>/humans.txt" />
  <!-- The little things -->

  <!--[if !IE]> -->
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <!-- <![endif]-->

  <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/old-ie.css">
  <![endif]-->

  <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

  <?php if (WP_ENV == 'local') : ?>
    <script src="<?php echo bloginfo('template_directory'); ?>/app/bower_components/modernizr/modernizr.js"></script>
  <?php else: ?>
    <script src="<?php echo bloginfo('template_directory'); ?>/scripts/modernizr-custom.js"></script>
  <?php endif; ?>

  <?php wp_head(); ?>

</head>

<?php global $deviceType; ?>

<body <?php body_class( 'device-' . $deviceType . ' view-' . $view ); ?> id="top">

  <div class="wrapper">

      <!--[if lt IE 9]>
        <div class="browsehappy">
          <div class="container">
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          </div>
        </div>
      <![endif]-->


    <div class="container">

      <nav role="navigation">
        <div class="row">
          <div class="col-xs-12">
            <?php

              $navArgs = array(
                'menu' => 'Main Menu',
                'container' => 'div',
                'container_class' => 'menu',
                'menu_id' => false,
                'menu_class' => 'menu__list'
              );

              wp_nav_menu( $navArgs );

            ?>
          </div>
        </div> <!-- END .row -->
      </nav>
