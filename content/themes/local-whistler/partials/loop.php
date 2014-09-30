<?php get_header(); ?>

<?php // If there is a page with the same slug, pull in the content; ?>

<?php global $page, $paged; ?>

<?php if ( 'product' == get_post_type() ) : ?>
  <?php query_posts('page_id=116'); ?>


  <?php if ( have_posts() ) : ?>

    <div class="row">
      <div class="col-xs-12">

        <?php while ( have_posts()) : the_post(); ?>
          <?php if ( $page == 1 && $paged < 2 ) : ?>
            <?php get_template_part('partials/_module_post'); ?>
          <?php endif; ?>
        <?php endwhile; ?>

      </div>
    </div>

  <?php endif; ?>
<?php endif; ?>

<?php // Reset the quesry back to posts rather than what was set above ?>
<?php wp_reset_query(); ?>

<div class="row">
  <?php if ( is_active_sidebar( 'sidebar-news' ) && 'product' != get_post_type() ) : ?>
    <div class="col-xs-12 col-lg-9">
  <?php else : ?>
    <div class="col-xs-12">
    <?php endif; ?>

    <?php if ( 'product' == get_post_type() ) : ?>
      <?php query_posts('post_type=product&order=ASC&orderby=title'); ?>
    <?php endif; ?>

    <?php if ( have_posts() ) : ?>

      <ol class="media--list js-color-container">

        <?php while ( have_posts() ) : the_post(); ?>

          <li class="media">

            <?php get_template_part('partials/_module_media'); ?>

          </li>

        <?php endwhile; ?>

      </ol>

      <?php comments_template( '', true ); ?>

    <?php else : ?>

      <div class="content context__copy">

        <h1>Oops...</h1>
        <h2>It looks like we can't find that page right now</h2>
        <p>Please check the URL or go back to the <a href="<?php echo bloginfo('url'); ?>">homepage</a>.</p>

      </div>


    <?php endif; ?>

  </div>

  <?php if ( is_active_sidebar( 'sidebar-news' ) && 'product' != get_post_type() ) : ?>
    <div class="col-xs-12 col-lg-3">
      <?php get_sidebar('news'); ?>
    </div>
  <?php endif; ?>

  <div class="col-xs-12">
    <?php get_template_part('partials/_pagination'); ?>
  </div>

</div>

<?php get_footer(); ?>
