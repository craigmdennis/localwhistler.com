<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article role="main">

    <?php if ( get_the_post_thumbnail() ) : ?>
      <?php include_once('partials/_module_media--featured.php'); ?>
    <?php endif; ?>

    <div class="row">
      <div class="col-xs-12">
        <div class="content context__copy" id="post-<?php the_ID(); ?>">
          <?php if ( !get_the_post_thumbnail() ) : ?>
            <h1 class="title--giant"><?php the_title(); ?></h1>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>
      </div>
    </div>

  </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
