$(document).ready( function( ){

  // Only initialise sorting when there are results
  if ( $('#results').length ) {
    filter.init();
  }

});
