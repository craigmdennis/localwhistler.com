'use strict';

$(document).ready( function( ){

  // Only initialise sorting when there are results
  if ( $('#results').length ) {
    window.filter.init();
  }

  $('.bxslider').bxSlider({
    adaptiveHeight: true
  });

});
