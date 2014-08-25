<?php get_header(); ?>

    <?php $the_query = new WP_Query( 'page_id=116' ); ?>

    <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts()) : $the_query->the_post(); ?>

      <article role="main">

        <?php if ( get_the_post_thumbnail() ) : ?>
          <?php get_template_part('partials/_module_media--featured'); ?>
        <?php endif; ?>

        <div class="row">
          <div class="col-xs-12">
            <?php get_template_part('partials/_module_post'); ?>
          </div>
        </div>

      </article>

    <?php endwhile; endif; ?>

    <?php rewind_posts(); ?>

    <?php $the_query = new WP_Query( 'post_type=product' ); ?>

      <?php if ( $the_query->have_posts() ) : ?>

        <div class="content">

          <ol class="media__list">

            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

              <li>

                <?php get_template_part('partials/_module_media'); ?>

              </li>

            <?php endwhile; ?>

          </ol>

        </div>

      <?php endif; ?>

  </div>

<?php get_footer(); ?>
