'use strict';

// No conflict
$(document).ready( function(){

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
