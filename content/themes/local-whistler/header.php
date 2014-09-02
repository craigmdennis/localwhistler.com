<?php

  // Read the cookie
  $cookieView = $_COOKIE['view'];

  // If the cookie exists
  if ( $cookieView != '' ) {
    $view = $cookieView;
  }

  // If the cookie doesn't exist
  else {
    $view = get_view_type();
    setcookie('view',$view,time() + (86400 * 7)); // Set for 7 days
  };

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <title>
    <?php
      global $page, $paged;

      wp_title( '|', true, 'right' );
      bloginfo( 'name' );
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
      if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );
    ?>
  </title>
  <meta name="description" content="<?php if ( is_single() ) {
    single_post_title('', true);
    } else {
    bloginfo('name'); echo " - "; bloginfo('description');
    }
  ?>" />
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />

  <!-- The little things -->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo bloginfo('template_directory'); ?>/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo bloginfo('template_directory'); ?>/apple-touch-icon-precomposed.png"/>
    <link rel="author" type="text/plain" href="<?php echo bloginfo('template_directory'); ?>/humans.txt" />
  <!-- The little things -->

  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
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
                'menu' => 'mainnav',
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
