<?php get_header(); ?>

<!-- page-locations.php -->
  <div class="content">
    <h1 class="content__title">Filter by business types</h1>

    <?php // todo: create fuction to iterate all taxonomies with map or image ?>

    <div class="hero--spaced">
      <a class="hero__link--image" href="/location/alpine/">
        <img class="hero__image" src="http://maps.googleapis.com/maps/api/staticmap?scale=2&center=Alpine, Whistler, BC,&zoom=15&size=960x300&maptype=road" />
      </a>
      <div class="hero__overlay">
        <h2 class="hero__title">
          <a class="hero__link--title" href="#">Alpine</a>
        </h2>
      </div>
    </div>

    <div class="hero--spaced">
      <a class="hero__link--image" href="/location/function/">
        <img class="hero__image" src="http://maps.googleapis.com/maps/api/staticmap?scale=2&center=Function Junction, Whistler, BC,&zoom=15&size=960x300&maptype=road" />
      </a>
      <div class="hero__overlay">
        <h2 class="hero__title">
          <a class="hero__link--title" href="#">Function Junction</a>
        </h2>
      </div>
    </div>

    <div class="hero--spaced">
      <a class="hero__link--image" href="/location/nesters/">
        <img class="hero__image" src="http://maps.googleapis.com/maps/api/staticmap?scale=2&center=Nesters, Whistler, BC,&zoom=15&size=960x300&maptype=road" />
      </a>
      <div class="hero__overlay">
        <h2 class="hero__title">
          <a class="hero__link--title" href="#">Nesters</a>
        </h2>
      </div>
    </div>

    <div class="hero--spaced">
      <a class="hero__link--image" href="/location/creekside/">
        <img class="hero__image" src="http://maps.googleapis.com/maps/api/staticmap?scale=2&center=Whistler Creekside, Whistler, BC,&zoom=15&size=960x300&maptype=road" />
      </a>
      <div class="hero__overlay">
        <h2 class="hero__title">
          <a class="hero__link--title" href="#">Whistler Creekside</a>
        </h2>
      </div>
    </div>

    <div class="hero--spaced">
      <a class="hero__link--image" href="/location/village/">
        <img class="hero__image" src="http://maps.googleapis.com/maps/api/staticmap?scale=2&center=Whistler Village, Whistler, BC,&zoom=15&size=960x300&maptype=road" />
      </a>
      <div class="hero__overlay">
        <h2 class="hero__title">
          <a class="hero__link--title" href="#">Whistler Village</a>
        </h2>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
