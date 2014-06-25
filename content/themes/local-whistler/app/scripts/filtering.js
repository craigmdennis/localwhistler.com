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
      location: ['.js__filter-location .TYPE.any', 'taxonomy_business_location.ARRAY.slug'],
      type: ['.js__filter-type .TYPE.any', 'taxonomy_business_type.ARRAY.slug'],
      // filters: ['.js__filter-promoted input:checkbox', 'taxonomy_business_filter.ARRAY.slug']
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

        var pathArray = window.location.pathname.split( '/' );
        var host = window.location.host;
        var protocol = window.location.protocol;

        var $currentType = $('#filterType :selected').val()
        var $currentLocation = $('#filterLocation :selected').val()
        var $currentTypeText = $('#filterType :selected').text()
        var $currentLocationText = $('#filterLocation :selected').text()

        var pushTitle = '';
        var pushUrl = 'http://' + host + pathArray[0] +'/';

        var pushData = {};

        if ( $currentLocation !== '' && $currentType == '' ) {
          pushTitle = $currentLocationText;
          pushUrl += 'location/' + $currentLocation + '/';
        }

        else if ( $currentLocation == '' && $currentType !== '' ) {
          pushTitle = $currentTypeText;
          pushUrl += 'location/' + $currentType + '/';
        }

        // Generate a URL scheme that we can $_GET
        // Might be able to rewrite it to /location/creekside/type/food-drink/activities/
        else {
          pushTitle = 'Filtering';
          pushUrl += '?business_location=' + $currentLocation + '&business_type=' + $currentType; // Plus search string
        }

        pushTitle += ' | Local Whistler';

        // todo: use history.js
        // Check if it's safe to use pushstate
        if ( history.replaceState ) {
          // window.history.replaceState( pushData, pushTitle, pushUrl );
        }

        // todo: Google map integration
        // googleMap.updateMarkers(result);

        // todo: tiny sort integration
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
