'use strict';

$(document).ready( function( ){

  // Only initialise sorting when there are results
  if ( $('#results').length ) {
    window.filter.init();
  }

  // Initialise slider on premium businesses
  $('.bxslider').bxSlider();
  
  // Initialise Chosen
  $('.js__chosen--block').chosen({
    disable_search: true,
    width: '100%'
  });

  $('.js__chosen--inline').chosen({
    disable_search: true
  });

});
