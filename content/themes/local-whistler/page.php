<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article role="main" class="primary-content" id="post-<?php the_ID(); ?>">
      <h1><?php the_title(); ?></h1>

      <?php the_content(); ?>
    </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
