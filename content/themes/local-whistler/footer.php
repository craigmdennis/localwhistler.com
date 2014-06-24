<?php get_sidebar(); ?>

<footer role="contentinfo">
  <p>&copy;<?php echo date("Y"); ?> <a href="#top" title="Jump back to top">&#8593;</a></p>
</footer>

<?php wp_footer(); ?>

<?php if (WP_ENV == 'local') : ?>
  <!-- Development -->

  <script src="<?php bloginfo('template_directory'); ?>/app/bower_components/jquery/dist/jquery.min.js/scripts/script.js"></script>
  <?php list_directory( '.tmp/styles', '.js'); // Load developement scripts ?>

  <!-- END Development -->
<?php else: ?>
  <!-- Production -->

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo bloginfo('template_directory'); ?>/assets/scripts/vendor/jquery.min.js"%3E%3C/script%3E'))</script>
  <script src="<?php bloginfo('template_directory'); ?>/assets/scripts/script.js"></script>

  <!-- END Production -->
<?php endif; // End if local ?>

<?php if ( is_singular() ) wp_print_scripts( 'comment-reply' ); ?>

</body>
</html>
