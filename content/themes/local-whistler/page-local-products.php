<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h1><?php the_title(); ?></h1>
<p><?php the_content(); ?></p>

<?php endwhile; endif; ?>

<?php rewind_posts(); ?>

<?php $the_query = new WP_Query( 'post_type=product' ); ?>

<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <article role="main" class="primary-content" id="post-<?php the_ID(); ?>">
      <h1><?php the_title(); ?></h1>

      <?php the_content(); ?>
    </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
