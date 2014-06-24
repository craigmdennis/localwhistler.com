<div id="filter_search_area" class="filter__wrapper">
  <label for="filterSearch">Search by keyword</label>
  <input id="filterSearch" type="search" placeholder="e.g. Yam Fries">
</div>

<!-- Get all business_location -->
<div class="filter__wrapper">
  <label for="filterLocation">Select Location:</label>
  <select class="filter__location">
    <option value="">Any</option>
    <option value="village" selected>Whistler Village</option>
    <option value="creekside">Whistler Creekside</option>
    <option value="function">Function Junction</option>
    <option value="nesters">Nesters</option>
  </select>
</div>

<!-- Get all business_type -->
<div class="filter__wrapper">
  <label for="filterType">Select Type</label>
  <select id="filterType" class="filter__type">
    <option value="food-drink" selected>Food &amp; Drink</option>
    <option value="health">Health &amp; Wellness</option>
    <option value="activities">Activities</option>
    <option value="retail-shops">Retail Shops</option>
  </select>
</div>

<!-- Hard coded sort options -->
<div class="filter__wrapper">
  <label for="filterSort">Select Sort Order</label>
  <select id="filterSort">
    <option data-sort-target="result__title" data-sort-order="asc">A-Z</option>
    <option data-sort-target="result__title" data-sort-order="desc">Z-A</option>
    <option data-sort-target="result__date-published", data-sort-order="asc">Newest First</option>
    <option data-sort-target="result__date-published", data-sort-order="desc">Oldest First</option>
    <!-- <option value="">Popular</option> Not sure how to do this yet -->
  </select>
</div>

<!-- Get all filters selected in an options page somewhere -->
<!-- if business type == food-and-drink -->
<div id="results">
</div>

<!-- Initial loading in case JS fails-->
<!-- <noscript>
  <?php query_posts('post_type=business&order=asc'); ?>

  <?php if ( have_posts() ) : ?>

    <div id="results">
      <ul id="results__list">

        <?php while ( have_posts() ) : the_post(); ?>

          <li class="restul__item">
            <h2 class="result__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <a href="<?php the_permalink(); ?>"><img src="<?php the_field('logo'); ?>" /></a>
            <?php the_excerpt(); ?>
            <span class="result__date-published"><?php the_date(); ?></a>
          </li>

        <?php endwhile; ?>

      </ul>
    </div>

  <?php endif; ?>
<noscript> -->
