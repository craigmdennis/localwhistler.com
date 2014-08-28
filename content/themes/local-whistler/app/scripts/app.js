'use strict';

$(document).ready( function( ){

  // Only initialise sorting when there are results
  if ( $('#results').length ) {
    window.filter.init();
  }

  // Initialise slider on premium businesses
  $('.bxslider').bxSlider({
    easing: 'ease-in-out',
    adaptiveHeight: true
  });

  // Initialise Chosen
  $('.js__chosen').chosen({
    disable_search: true,
    width: '100%'
  });

});
