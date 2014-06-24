'use strict';

$(document).ready( function(){

  function getData( targetUrl ) {

    var data;

    $.ajax({
        async: false, //thats the trick
        url: targetUrl,
        dataType: 'json',
        success: function( response ){
           data = response;
        }
    });

    return data;

  }

  var businesses = getData( '/api/get_posts/?post_type=business' );

  console.log( businesses.posts );

  var view =  function( post ) {

    // todo: Get the ACF attachment ID then iterate through the 'attachment' object to find the correct URL

    return  '<li class="result">' +
            '<h2 class="result__title"><a href="' + post.url + '">' + post.title + '</a></h2>' +
            '<a href="' + post.url + '"><img src="' + post.attachments[0].url + '" /></a>' +
            post.excerpt +
            '<span class="result__date-published">' + post.date + '</span>' +
            '</li>'
  };

  var settings = {
    filter_criteria: {
      location: ['.filter__location', 'taxonomy_business_location.ARRAY.slug'],
      type: ['.filter__type', 'taxonomy_business_type.ARRAY.slug'],
    },
    // callbacks: filter_callbacks, // Defined below.
    // and_filter_on: false,
    // filter_on_init: true,
    search: { input: '#filterSearch' },
    // filter_types: filter_type_functions, // Defined below
    // streaming: streaming_functions // Defined below.
  };

  var filter_callbacks = {
    after_init: function( record_ids ){
       //Call after init of filter.
    },
    after_filter: function( result ){
      // googleMap.updateMarkers(result);
      // Tinysort integration
      // $('a[data-fjs]').tsort('.fs_price:visible', {order: 'asc'})
    },
    before_add: function( data ){
      // Process data before adding to filter while streaming.
    },
    after_add: function( data ){
      // Call after adding data to filter.
    }
  };

  var streaming_functions = {
    data_url: businesses,            // JSON data url
    stream_after: 1,                 // strat streaming data after in seconds
    batch_size: 50,                   // Fetch reacord limit (default 50)
    before_add: function(data){
      // Process data/update html/.etc before adding data to filter.
    },
    after_add: function(data){
      // Process data/update html/.etc after adding data to filter.
    }
  };

  return FilterJS( businesses.posts, "#results", view, settings );

});
