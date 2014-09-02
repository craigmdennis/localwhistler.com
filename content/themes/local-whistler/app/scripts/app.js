'use strict';

// No conflict
$(document).ready( function(){

  // Initialise slider on premium businesses
  $('.slider').owlCarousel({
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      transitionStyle: 'scaleUp'
  });

  // Initialise Chosen
  $('.js__chosen').chosen({
    disable_search: true,
    width: '100%'
  });

});
