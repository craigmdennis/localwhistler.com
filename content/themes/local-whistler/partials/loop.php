<?php ?>
<section class="primary-content">
<?php $firstClass = 'first-post'; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
  <?php if ( ! have_posts() ) : ?>
        <article role="main" class="the-content">
          <div class="content context__copy">
            <h1 class="title--giant">Oops...</h1>
            <h2>The page you're looking for can't be found</h3>
            <p>Please check the url or go back to the <a href="<?php echo bloginfo('url'); ?>">homepage</a>.</p>
          </div>
        </article>
    <?php endif; ?>
<?php ?>

    <h1>
        <?php if ( is_day() ) : ?><?php printf( __( '<span>Daily Archive</span> %s' ), get_the_date() ); ?>
          <?php elseif ( is_month() ) : ?><?php printf( __( '<span>Monthly Archive</span> %s' ), get_the_date('F Y') ); ?>
          <?php elseif ( is_year() ) : ?><?php printf( __( '<span>Yearly Archive</span> %s' ), get_the_date('Y') ); ?>
          <?php elseif ( is_category() ) : ?><?php echo single_cat_title(); ?>
          <?php elseif ( is_search() ) : ?><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?>
          <?php elseif ( is_home() ) : ?>
            Latest Posts
          <?php else : ?>
        <?php endif; ?>
    </h1>

<?php while ( have_posts() ) : the_post(); ?>
  <?php /* How to display standard posts and search results */ ?>

        <article class="article-archive <?php echo $firstClass; ?>" id="post-<?php the_ID(); ?>">
          <div class="content context__copy">
      <?php $firstClass = ""; ?>
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            	<h2><?php the_title(); ?></h2>
            </a>
            <?php the_excerpt(); ?>
            <p class="entry-meta"><time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l jS F Y'); ?></time>
            </p>
          </div>
        </article>

    <?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <ul class="navigation">
        <li class="older">
            <?php next_posts_link( __( 'Older posts' ) ); ?>
        </li>
        <li class="newer">
            <?php previous_posts_link( __( 'Newer posts' ) ); ?>
        </li>
    </ul>
<?php endif; ?>
</section>
