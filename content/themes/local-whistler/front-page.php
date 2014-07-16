<?php get_header(); ?>

<?php

  // If pinned blog post exists
    // Get the first pinned post
    // Show featured image
    // Show category with link
    // Show title
    // Show excerpt
    // If image credit exists
      // Show image credit (need to add image credit field to featured image picker)
  // Else
    // Get latest blog post
    // Show the same as above

?>

<img src="http://placehold.it/960x500" />
<a href="#">Category</a>
<h1>Post title</h1>
<p>This is the excerpt</p>

<hr>

<?php query_posts( $query_string . '&post_type=post' ); ?>
<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>

  <div>
    <figure><?php the_post_thumbnail(); ?></figure>
    <h2><?php the_title(); ?></h2>
    <p><?php the_excerpt(); ?></p>
  </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
