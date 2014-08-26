<div class="content context__copy" id="post-<?php the_ID(); ?>">

  <?php if ( !get_the_post_thumbnail() ) : ?>

    <h1 class="title--giant">
      <?php if ( is_day() ) : ?>
            <?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
        <?php elseif ( is_month() ) : ?>
            <?php printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
        <?php elseif ( is_year() ) : ?>
            <?php printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
        <?php else: ?>
            <?php the_title(); ?>
        <?php endif; ?>
    </h1>

  <?php endif; ?>

  <?php the_content(); ?>

</div>
