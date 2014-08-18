<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="container">
    <article role="main">
      <div class="content" id="post-<?php the_ID(); ?>">
        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>
      </div>
    </article>
  </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
