$(document).ready( function( ){

  // Only initialise sorting when there are results
  if ( $("#resultsList").length ) {
    // filter.init();
  }

});


var filter;

filter = {};

(function($, window, document) {

  'use strict';

  return filter = {

    apiLocation: '/api/get_posts/?post_type=business',

    settings: {
      filter_on_init: true,
      filter_criteria: {
        location: ['.js__filter-location .TYPE.any', 'taxonomy_business_location.ARRAY.slug'],
        type: ['.js__filter-type .TYPE.any', 'taxonomy_business_type.ARRAY.slug'],
        // filters: ['.js__filter-promoted input:checkbox', 'taxonomy_business_filter.ARRAY.slug']
      },
      search: {
        input: '#filterSearch',
        search_in: '.media__title, .media__body'
      },
      filter_types: {
        any: function( current_value, option ){
          if ( current_value == '') { return true; }
          else { return current_value == option; }
        }
      },
      streaming: {
        data_url: filter.apiLocation,
        stream_after: 1,
        batch_size: 50,
      },
      callbacks: {
        after_filter: function( result ){

          // googleMap.updateMarkers( result );
          filter.push_history(); // Need to stop sending every keystroke
          filter.result_count( result );
          filter.result_sort();
        }
      }
    },

    init: function(){

      filter.bind();
      filter.remove_existing_results();

      return FilterJS( filter.get_api_data( filter.apiLocation ).posts, "#resultsList", filter.view, filter.settings );

    },

    bind: function(){

      if (Modernizr.history) {
        window.onpopstate = filter.set_current_state();
      }

      // Stop the form from being manually submitted
      $('form').on('submit', filter.override );

      $('#filterOrder').on('change.sort', filter.result_sort );

      // $('.sub-menu').on('click.submenu', 'a', filter.override );

    },

    remove_existing_results: function(){

      // If we have results
      if ( $("#resultsList").length ) {
        // Remove them form the DOM
        $('#resultsList').html('');
      }

    },

    override: function(){

      event.preventDefault();

    },

    get_url: function(){

      var location = window.location,
          pathArray = location.pathname.split( '/' ),
          host = location.host,
          base = 'http://' + host + pathArray[0] +'/';

      return base;

    },

    is_location: function(){

      if ( filter.get_current_state().location != '' ) { return true; }
      else { return false; }

    },

    is_type: function(){

      if ( filter.get_current_state().type != '' ) { return true; }
      else { return false; }

    },

    is_search: function(){
      if ( filter.get_current_state().search != '' ) { return true; }
      else { return false; }
    },

    is_order: function(){
      if ( filter.get_current_state().order != '' ) { return true; }
      else { return false; }
    },

    get_current_state: function(){

      var $type = $('#filterType :selected'),
          $location = $('#filterLocation :selected'),
          $order = $('#filterOrder :selected'),
          $search = $('#filterSearch');

      var current = {
            type: $type.val(),
            order: $order.val(),
            location: $location.val(),
            search: $search.val(),
            typeText: $type.text(),
            orderText: $order.text(),
            locationText: $location.text()
          }

      return current;

    },

    set_current_state: function(){

      console.log( 'History state changed' );
      console.log( history.state );

      // for each form control
        // for each option
          // if $_GET var matches option value
            // Add :selected

      // call the filter again
      // fJS.filter();

    },

    generate_url: function(){

      var url = filter.get_url(),
          currentLocation = filter.get_current_state().location,
          currentOrder = filter.get_current_state().order,
          currentType = filter.get_current_state().type,
          currentSearch = filter.get_current_state().search;

        url += '?s=' + currentSearch;
        url += '&business_location=' + currentLocation;
        url += '&business_type=' + currentType;
        url += '&order=' + currentOrder;

      return url;

    },

    generate_title: function(){

      var currentLocationText = filter.get_current_state().locationText,
          currentOrderText = filter.get_current_state().orderText,
          currentTypeText = filter.get_current_state().typeText,
          title;

      if ( filter.is_location() ) {
        title = currentLocationText;
      }

      else if ( filter.is_type() ) {
        title = currentTypeText;
      }

      else if ( filter.is_search() ) {
        title = currentTypeText;
      }

      else {
        title = 'Filtering:' + currentTypeText + ' in ' + currentLocationText;
      }

      title += ' | Local Whistler';

      return title

    },

    push_history: function(){

      if ( Modernizr.history) {
        if ( !$('#filterSearch').is(':focus') ) {
          console.log('Search does not have focus');
          window.history.pushState( filter.get_current_state(), filter.generate_title(), filter.generate_url() );
        } else {
          console.log('Search has focus');
          window.history.replaceState( filter.get_current_state(), filter.generate_title(), filter.generate_url() );
        }
      }

    },

    result_sort: function(){
      // Tinysort
      // $('a[data-fjs]').tsort('.fs_price:visible', {order: 'asc'};

      console.log( this );
      window.event.preventDefault();

      // var $this = $(this).find('option:selected');
      // var sortBy = '.' + $this.attr('data-sort-target');
      // var sortOrder = $this.attr('data-sort-order');
      //
      // console.log( "sort order", sortOrder );
      // console.log( "sort by", sortBy );
      //
      // $('ul#results__list>li').tsort( sortBy, {order: sortOrder} );

    },

    result_count: function( result ) {

      // Needs to match exactly with taxonomy.php
      if ( !result.length ){
        $('.js-result-count').text( "No businesses found" );
      }
      else {
        $('.js-result-count').text( 'Found: ' + result.length );
      }

    },

    get_api_data: function( api_location ){

      var data;

      $.ajax({
        async: false, //thats the trick
        url: api_location,
        dataType: 'json',
        success: function( response ){
           data = response;
        }
      });

      return data;

    },

    googleMap: function( result ) {

    },

    get_logo: function( post ) {

      var logo = '';

      if ( post.custom_fields.logo[0] !== '' ) {

        // Iterate over each attachment in the array
        $.each( post.attachments, function( $key, $value ){

          // Make sure we get the logo and not any old attachment
          if ( post.custom_fields.logo[0] == $value['id'] ) {
            logo =  '<a class="media__link--logo media__link--left media__thumb" href="' + post.url + '">' +
                      '<img class="media__logo" src="' + post.attachments[$key].url + '" alt="' + post.title + ' Logo" />' +
                    '</a>';
          }

        });
      }

      return logo;

    },

    get_tags: function( post ){

    },

    format_date: function( dateString ) {

      var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
          date = new Date( dateString ),
          day = date.getDate(),
          month = date.getMonth(),
          year = date.getFullYear(),
          monthName = monthNames[month]

      var dateArray = {
        iso: date.toISOString,
        pretty: monthName + ' ' + day + ', ' + year
      }

      return dateArray;

    },

    view: function( post ){

      var datetime = filter.format_date( post.date ).iso,
          prettyDate = filter.format_date( post.date ).pretty;

      // todo: use Mustache templates
      return  '<li class="media">' +
                filter.get_logo( post ) +
                  '<div class="media__body context__copy">' +
                  '<h2 class="media__title">' +
                    '<a class="media__link--title" href="' + post.url + '">' + post.title + '</a>' +
                  '</h2>' +
                  post.excerpt +
                '</div>' +
                '<div class="media__footer>"' +
                  '<time datetime="' + datetime + '" class="media__date">' + prettyDate + '</time>' +
                '</div>' +
                filter.get_tags( post ) +
              '</li>'

    },
  }

})(jQuery, window, document);
