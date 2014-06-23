<?php get_header(); ?>
<!-- taxonomy.php -->

<?php if ( have_posts() ) : the_post(); ?>

<?php $term =	$wp_query->queried_object; ?>

<h1>
<?php if ( is_tax( 'business_location' ) ) : ?>
	Businesses in <?php echo $term->name; ?>
<?php else : ?>
	Businesses offering <?php echo $term->name; ?>
<?php endif; ?>
</h1>


<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 get_template_part( 'partials/loop', 'archive' );
?>

<?php endif; ?>

<?php get_footer(); ?>