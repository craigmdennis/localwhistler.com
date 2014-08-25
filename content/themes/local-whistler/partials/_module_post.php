<div class="content context__copy" id="post-<?php the_ID(); ?>">
  <?php if ( !get_the_post_thumbnail() ) : ?>
    <h1 class="title--giant"><?php the_title(); ?></h1>
  <?php endif; ?>
  <?php the_content(); ?>
</div>
