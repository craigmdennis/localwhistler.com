<?php if ( $taxonomy->name == 'business_filter' ) : // If it's the filters we need to do something different ?>

  <div class="filter__wrapper">

    <?php foreach ( $terms as $term ) : ?>

      <?php

        $termName = $term->name;
        $termSlug = $term->slug;
        $termSlugCapital = ucfirst( $termSlug );

      ?>

      <div class="filter__promoted">
        <label for="filter<?php echo $termSlugCapital ?>">
          <input id="filter<?php echo $termSlugCapital ?>"
                 type="checkbox"
                 class="promoted__input"
                 value="<?php echo $termSlug ?>"
          />
          <?php echo $termName ?>
        </label>
      </div>

    <?php endforeach; ?>

  </div>

<?php else: ?>
