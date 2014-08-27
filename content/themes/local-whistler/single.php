<?php get_header(); ?>
<?php $logo = get_field('logo'); ?>

<?php

  if ( !empty($logo) ) {
    $width   = $logo['sizes']['media--thumb-width'];
    $height  = $logo['sizes']['media--thumb-height'];
    $alt     = $logo['alt'];
    $src     = $logo['sizes']['media--thumb'];
  }

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article role="main">

    <?php if ( get_the_post_thumbnail() ) : ?>
      <?php include_once('partials/_module_media--featured.php'); ?>
    <?php endif; ?>

    <div class="row">
      <div class="col-xs-12 col-lg-9">

        <?php if ( !empty($logo) ): ?>
        <div class="content-header">
          <div class="media media--single js-color-container js-color-target">
            <img
              class="js-color-trigger"
              src="<?php echo $src; ?>"
              alt="<?php echo $alt; ?>"
              width="<?php echo $width; ?>"
              height="<?php echo $height; ?>"
            />
          </div>
        </div>
        <?php endif; ?>
        <div class="content context__copy" id="post-<?php the_ID(); ?>">
          <?php if ( !get_the_post_thumbnail() ) : ?>
            <h1 class="title--giant"><?php the_title(); ?></h1>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>
      </div>

      <div class="col-xs-12 col-lg-3">
        <?php if ( 'post' == get_post_type() ) : ?>
          <?php get_sidebar('meta'); ?>
        <?php endif; ?>
        <?php get_sidebar(); ?>
      </div>

  </article>

<?php endwhile; ?>

<?php // comments_template( '', true ); ?>

<?php get_template_part('partials/_pagination'); ?>

<?php endif; ?>

<?php get_footer(); ?>
