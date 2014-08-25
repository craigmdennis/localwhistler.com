<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article role="main">

    <?php if ( get_the_post_thumbnail() ) : ?>
      <?php include_once('partials/_module_media--featured.php'); ?>
    <?php endif; ?>

    <div class="row">
      <div class="col-xs-12 col-lg-9">
        <div class="content context__copy" id="post-<?php the_ID(); ?>">
          <?php if ( !get_the_post_thumbnail() ) : ?>
            <h1 class="title--giant"><?php the_title(); ?></h1>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>
      </div>

      <div class="col-xs-12 col-lg-3">
        <?php get_sidebar('meta'); ?>
        <?php get_sidebar(); ?>
      </div>

  </article>

<?php endwhile; ?>

<?php comments_template( '', true ); ?>

<ul class="navigation">
    <li class="older">
<?php previous_post_link( '%link', '&larr; %title' ); ?>
    </li>
    <li class="newer">
<?php next_post_link( '%link', '%title &rarr;' ); ?>
    </li>
</ul>

<?php endif; ?>

<?php get_footer(); ?>
