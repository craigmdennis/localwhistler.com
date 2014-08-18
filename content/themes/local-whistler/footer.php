<?php get_sidebar(); ?>

<footer role="contentinfo">
  <div class="container">
    <p>&copy;<?php echo date("Y"); ?> <a href="#top" title="Jump back to top">&#8593;</a></p>
  </div>
</footer>

<?php wp_footer(); ?>

<!--[if lt IE 9]>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
<!--[if !IE]> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- <![endif]-->

<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo bloginfo('template_directory'); ?>/assets/scripts/vendor/jquery.min.js"%3E%3C/script%3E'))</script>

<script src="<?php echo bloginfo('template_directory'); ?>/scripts/script.js"></script>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBWcRdeBybFQUpx5tyfIw1QbwskiRuFsdc&sensor=true"
      type="text/javascript"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
</script>

<?php if (WP_ENV == 'production') : ?>
  <script>ga('create', 'UA-52905442-1', 'auto');</script>
<?php else : ?>
  <script>ga('create', 'UA-52905442-1', { 'cookieDomain': 'none' });</script>
<?php endif; ?>

<script>ga('send', 'pageview');</script>

</script>

</body>
</html>
