  </div> <!-- END .container -->

  <footer>
    <div class="footer">
      <div class="container">
        <div class="row">

          <div class="col-xs-12 col-md-3 widget-col">

            <?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
              <div class="widget widget--inline" role="complementary">
                <?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
                <p>
                  &copy;<?php echo date("Y"); ?> <a href="<?php echo bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a>
                  <br>
                  Made by <a href="http://simplebitdesign.com" target="_blank">Simple Bit</a>
                </p>
              </div>
            <?php endif; ?>

          </div>

          <div class="col-xs-12 col-md-3 widget-col">

            <?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
              <div class="widget widget--inline" role="complementary">
                <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
              </div>
            <?php endif; ?>

          </div>

          <div class="col-xs-12 col-md-3 widget-col">

            <?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
              <div class="widget widget--inline" role="complementary">
                <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
              </div>
            <?php endif; ?>

          </div>

          <div class="col-xs-12 col-md-3 widget-col">

            <?php if ( is_active_sidebar( 'sidebar-footer-4' ) ) : ?>
              <div class="widget widget--inline" role="complementary">
                <?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
              </div>
            <?php endif; ?>

          </div>

        </div>
      </div>
    </div>
  </footer>

</div> <!-- END .wrapper -->

<script>

  if('querySelector' in document
    && 'localStorage' in window
    && 'addEventListener' in window) {

    // Add a class to say we're in a fancypants browser
    document.querySelector('html').classList.add('mustard');

    // Add jQuery 2.0+
    document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"><\/script>')

    // Only give modern browsers full filtering
    document.write('<script src="<?php echo get_template_directory_uri(); ?>/scripts/filtering.js"><\/script>')

  } else {

    // Add jQuery 1.9.0+
    document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"><\/script>');
  }

</script>

<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo get_template_directory_uri(); ?>/assets/scripts/vendor/jquery.min.js"%3E%3C/script%3E'))</script>

<script
  src="<?php echo get_template_directory_uri() ?>/scripts/script.js"
  type="text/javascript">
</script>

<script
  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBWcRdeBybFQUpx5tyfIw1QbwskiRuFsdc&sensor=true"
  type="text/javascript">
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
</script>

<script>!function(d,s,id){
  var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<?php if (WP_ENV == 'production') : ?>
  <script>ga('create', 'UA-52905442-1', 'auto');</script>
<?php else : ?>
  <script>ga('create', 'UA-52905442-1', { 'cookieDomain': 'none' });</script>
<?php endif; ?>

<script>ga('send', 'pageview');</script>

<?php wp_footer(); ?>

</body>
</html>
