'use strict';

$(document).ready( function(){

  // Function to help us get the JSON data
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

  // Store JSON data in variable
  var businesses = getData( '/api/get_posts/?post_type=business' );

  // Log it out so we can look at it
  console.log( businesses.posts[0] );

  // Construct HTML view
  var view = function( post ) {

    // todo: Get the ACF attachment ID then iterate through the 'attachment' object to find the correct URL

    return  '<li class="result">' +
            '<h2 class="result__title"><a href="' + post.url + '">' + post.title + '</a></h2>' +
            '<a href="' + post.url + '"><img src="' + post.attachments[0].url + '" /></a>' +
            '<div class="result__excerpt">' + post.excerpt + '</div>' +
            '<span class="result__date-published">' + post.date + '</span>' +
            '</li>'
  };

  // Settings
  var settings = {

    filter_criteria: {
      location: ['#filterLocation .TYPE.any', 'taxonomy_business_location.ARRAY.slug'],
      type: ['.filter__type .TYPE.any', 'taxonomy_business_type.ARRAY.slug'],
      // filters: ['.filter__promoted input:checkbox', 'taxonomy_business_filter.ARRAY.slug']
    },

    search: {
      input: '#filterSearch',
      search_in: '.result__title'
    },

    // and_filter_on: false,
    callbacks: {

      after_init: function( record_ids ){
         console.log( "After Init" );
      },

      after_filter: function( result ){

        var $currentType = $('#filterType :selected').val()
        var $currentLocation = $('#filterLocation :selected').val()
        // var $currentTypeText = // Get the current type from the URL to start
        var $currentLocationText = $('#filterLocation :selected').text()

        // window.history.pushState('', $currentLocationText + ' | ' + $currentType, 'http://localwhistler.local/' + $currentType + '/' + $currentLocation + '/');

        // Update a google map
        // googleMap.updateMarkers(result);

        // Tinysort integration
        // $('a[data-fjs]').tsort('.fs_price:visible', {order: 'asc'})

        if ( !result.length ){
          $('.result__count').text( "No results found" );
        }
        else {
          $('.result__count').text( 'Found : ' + result.length );
        }

      }
    },
     // Defined below.
    filter_types: { any: selectAny }, // Definde below.
    streaming: streaming_functions // Defined below.

  };

  // Define custom filter functions
  function selectAny( current_value, option ){

    if ( current_value == '') {
      return true;
    } else {
      return current_value == option;
    }

  };

  // Load lost of data in chunks
  var streaming_functions = {
    data_url: businesses.posts,
    stream_after: 1,
    batch_size: 50,
  };

  // Initialise the flitering mechanism
  return FilterJS( businesses.posts, "#results", view, settings );

});
