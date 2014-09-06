var filter;

filter = {};

(function($, window) {

  'use strict';

  filter = {

    filterCount: 0,

    apiLocation:  '/api/get_posts/?post_type=business&count=-1' +
                  '&include=title,date,url,excerpt,taxonomy_business_filter,' +
                  'taxonomy_business_location,taxonomy_business_type,custom_fields',

    settings: {
      filter_on_init: true,
      filter_criteria: {
        location: ['.js__filter-location .TYPE.any', 'taxonomy_business_location.ARRAY.slug'],
        type: ['.js__filter-type .TYPE.any', 'taxonomy_business_type.ARRAY.slug']
      },
      search: {
        input: '#filterSearch',
        search_in: '.media__title, .media__footer'
      },
      filter_types: {
        any: function( current_value, option ){
          if ( current_value === '') { return true; }
          else { return current_value === option; }
        }
      },

      streaming: {
        data_url: filter.apiLocation,
        stream_after: 1,
        batch_size: 10
      },

      callbacks: {
        after_filter: function( result ){

          // Update the map
          window.googleMap.update_markers( result );

          // Show the current count
          filter.result_count( result );

          // Update the sort only on the first filter
          filter.result_sort();

          // Update the view links to reflect new filters
          filter.update_links();

          // Push custom analytics
          filter.push_analytics();

          // Add styling hooks
          filter.update_styles();

          // Check whether we need to affix
          filter.affix();

          // Show info if no results
          if ( !result.length ) {

            if ( !$('#noResults').length ) {
              $('<div id="noResults" class="content context__copy">' +

                '<h2>There are no local businesses that match your search</h2>' +
                '<p>Please select some different filters</p>' +

              '</div>').insertAfter('#resultsList');
            }
            else {
              $('#noResults').show();
            }

          }
          else {
            if ( $('#noResults').length ) {
              $('#noResults').hide();
            }
          }
        }
      }
    },

    init: function(){

      // Get the first page data
      var data = filter.get_api_data( filter.apiLocation );

      // Show the map if the body class is set correctly
      // if ( $('body').hasClass('view-map') ) {
      window.googleMap.init();
      // }

      // Bind the event handlers
      filter.bind();

      // Create the empty results markup
      filter.create_results();

      // Pass the data and initialiase the filtering
      // Store filter object
      filter.fJS = filter.filter_init( data );

      // Upda the history on first page load
      filter.push_history();

      // Increment the count
      filter.filterCount++;

    },

    filter_init: function( data ){

      return FilterJS( data.posts, '#resultsList', filter.view, filter.settings );

    },

    bind: function(){

      if (Modernizr.history) {
        window.onpopstate = filter.set_state;
      }

      // Stop the form from being manually submitted
      $('form').on('submit', function(e){
          e.preventDefault();
      });

      // Change the URL and store data when a change event detected
      $(document).on('change', '#filterForm', filter.push_history);

      // Sort the results when select box changed
      $('#filterOrder').on('change', filter.result_sort );

      // $('.sub-menu').on('click.submenu', 'a', filter.override );

    },

    affix: function(){

      var controlHeight = $('#controls').height();
      var resultsHeight = $('#results').height();
      var $controls = $('#controls');

      // console.log( 'controlHeight', controlHeight );
      // console.log( 'resultsHeight', resultsHeight );

      if ( $(window).width() < 1100 ) {
        return false;
      }

      if ( controlHeight < resultsHeight ) {

        // console.log( 'Control height is larger than Results height.' );

        $controls.affix({
          offset: {
            top: function () {
              return ( this.top = $controls.offset().top - 20 );
            },

            bottom: function () {
              return ( this.bottom = $('.footer').outerHeight(true) + 41 );
            }
          }
        });
      }

      else {

        filter.kill_affix( $controls );

      }

    },

    kill_affix: function( el ){

      // Check if data exists on th element
      if ( typeof el.data('bs.affix') !== 'undefined') {

        // console.log( 'Kill affixed plugin');

        $(window).off('.affix');
        el
          .removeClass('affix affix-top affix-bottom')
          .removeData('bs.affix');
      }

    },

    create_results: function(){

      // If we don't have results, create the ol
      if ( !$('#resultsList ').length ) {

        $('#results').html(
          '<ol id="resultsList" class="media--list js-color-container"></ol>'
        );

      }

      // If we do have results, remove any HTML before injeting JS templates
      else {
        $('#resultsList').html('');
      }

    },

    update_styles: function(){

      var first = 'first',
          last = 'last',
          visible = 'visible',
          $media = $('.media');

      // console.log( $media.filter(':' + visible + ':' + first) );

      $('.' + first + '-' + visible).removeClass( first + '-' + visible );
      $('.' + last + '-' + visible).removeClass( last + '-' + visible );

      $media.filter(':' +  visible + ':' + first).addClass( first + '-' + visible );
      $media.filter(':' +  visible + ':' + last).addClass( last + '-' + visible );

    },

    get_url: function(){

      var location = window.location,
          pathArray = location.pathname.split( '/' ),
          host = location.host,
          base = 'http://' + host + pathArray[0] +'/';

      return base;

    },

    get_state: function(){

      var $type = $('#filterType :selected'),
          $location = $('#filterLocation :selected'),
          $order = $('#filterOrder :selected'),
          $search = $('#filterSearch'),
          $view = $('#filterView');

      var current = {
            type: $type.val(),
            order: $order.val(),
            location: $location.val(),
            search: $search.val(),
            typeText: $type.text(),
            orderText: $order.text(),
            locationText: $location.text(),
            view: $view.val()
          };

      return current;

    },

    // On Popstate
    set_state: function( e ) {

      var state;

      if ( e.type === 'popstate' ) {
        state = e.state;
        console.log('Popstate:',state);
      }

      // It's an object
      else {
        state = e;
        console.log('Object:', state );
      }

      // Replace the current text to match the history state
      if ( state ) {
        $('#filterSearch').val( state.search );
      }
      else {
        $('#filterSearch').val('');
      }

      // Update Filters to match state options
      // Get all the select boxes
      var $selects = $('#filterForm').find('select');

      // Iterate through the selects
      $selects.each( function(){

        // Remove all selected attributes
        $(this).find('option:selected').removeAttr('selected');

        // Get all the options in the selects
        var $options = $(this).find('option');

        // For each option in the select
        $options.each( function(){

          // Get the value
          var value = $(this).val();

          // if option value matches history state value
          if ( (value === state.location) || (value === state.type) || (value === state.order ) ) {

            // Set this as the selected option
            $(this).prop('selected', true);

            // Tell chosen to update
            $(this).trigger('chosen:updated');

          }

        });

      });

      // Tell the filter that something has changed
      filter.fJS.filter();

      // Trigger tinysort
      filter.result_sort();

      // Make sure the filters are back where they should be
      $(window).trigger('scroll');

    },

    generate_url: function(){

      var url = filter.get_url(),
          currentLocation = filter.get_state().location,
          currentOrder = filter.get_state().order,
          currentType = filter.get_state().type,
          currentSearch = filter.get_state().search;
          // currentView = filter.get_state().view;

        url += '?s=' + currentSearch;
        url += '&business_location=' + currentLocation;
        url += '&business_type=' + currentType;
        url += '&order=' + currentOrder;
        // url += '&view=' + currentView;

      return url;

    },

    generate_title: function(){

      var currentLocationText = filter.get_state().locationText,
          currentTypeText = filter.get_state().typeText,
          currentSearchText = filter.get_state().search,
          title;

      if ( currentLocationText !== 'Any' ) {
        title = currentLocationText;
      }

      else if ( currentTypeText !== 'Any' ) {
        title = currentTypeText;
      }

      else if ( currentSearchText !== '' ) {
        title = currentSearchText;
      }

      else if ( currentTypeText === 'Any' && currentLocationText === 'Any') {
        title = 'All Businesses';
      }

      else {
        title = 'Filtering: ' + currentTypeText + ' in ' + currentLocationText;
      }

      title += ' | Local Whistler';

      return title;

    },

    push_history: function(){
      document.title = filter.generate_title();

      if ( Modernizr.history) {
        if ( ($('#filterSearch').is(':focus')) || ( filter.filterCount === 0 ) ) {
          // Replace current history state
          window.history.replaceState( filter.get_state(), filter.generate_title(), filter.generate_url() );
        } else {
          // Add a new history state
          window.history.pushState( filter.get_state(), filter.generate_title(), filter.generate_url() );
        }
      }

    },

    push_analytics: function() {

      // console.log('URL for analytics', filter.generate_url() );
      // console.log('Title for analytics', filter.generate_title() );

      ga('send', {
        'hitType': 'pageview',
        'page': filter.generate_url(),
        'title': filter.generate_title()
        // 'nonInteraction': 1
      });

    },

    result_sort: function(){

      var $this = $('#filterOrder').find('option:selected');
      var sortTarget = '.' + $this.attr('data-sort-target');
      var sortOrder = $this.attr('data-sort-order').toLowerCase();

      $('ol .media').tsort( sortTarget, { order: sortOrder } );

      filter.update_styles();

    },

    result_count: function( result ) {

      // Needs to match exactly with taxonomy.php
      if ( !result.length ){
        $('.js__count').text( 'No matches' );
      }
      else {
        $('.js__count').text( result.length + ' businesses match' );
      }

    },

    get_api_data: function( api_location ){

      var data;

      $.ajax({
        async: false, //thats the trick
        url: api_location,
        cache: true,
        dataType: 'json',
        success: function( response ){
           data = response;
        }
      });

      return data;

    },

    get_logo: function( post ) {

      var logo = post.acf.logo;
      var height = logo.sizes['media--thumb-retina-height'];
      var width = logo.sizes['media--thumb-retina-width'];
      var src = logo.sizes['media--thumb-retina'];
      var style = 'style="margin-left:-' + width/4 + 'px;' + 'margin-top:-' + height/4 + 'px;"';

      if ( width <= 300 && height <= 300) {
        height = logo.sizes['media--thumb-height'];
        width = logo.sizes['media--thumb-width'];
        src = logo.sizes['media--thumb'];
        style = 'style="margin-left:-' + width/2 + 'px;' + 'margin-top:-' + height/2 + 'px;"';
      }

      if ( logo !== '' ) {

        // Make sure we get the logo and not any old attachment
        return  '<a class="media__link--logo media__link--left media__thumb js-color-target" href="' + logo.url + '">' +
                  '<img class="media__logo js-color-trigger" src="' + src + '" alt="' + logo.description + ' Logo"' + style  + ' />' +
                '</a>';
      }
    },

    get_tags: function( post ) {

      var tags = '';

      if ( post.taxonomy_business_filter.length ) {

        tags = ['<div class="media__footer"><ul class="tags">'];
        var elem;

        // Iterate over each attachment in the array
        $.each( post.taxonomy_business_filter, function(){

          // Make sure we get the logo and not any old attachment
          elem = '<li class="tag__item"><a class="tag__link" href="/filter/' + this.slug + '">' + this.title + '</a></li>';
          tags.push( elem );

        });

        elem = '</ul></div>';
        tags.push( elem );
        tags = tags.join(',') + '';
        tags = tags.replace(/,/g, '');

      }

      return tags;

    },

    update_links: function(){

      var url = filter.generate_url();

      // console.log( url + '&view=gallery' );

      // Update the view change buttons
      $('#view-gallery').attr('href', url + '&view=gallery');
      $('#view-list').attr('href', url + '&view=list');
      $('#view-map').attr('href', url + '&view=map');

    },

    format_date: function( dateString ) {

      var monthNames = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
      ],
        date = new Date( dateString ),
        day = date.getDate(),
        month = date.getMonth(),
        year = date.getFullYear(),
        monthName = monthNames[month];

      var dateArray = {
        iso: date.toUTCString(),
        pretty: monthName + ' ' + day + ', ' + year
      };

      return dateArray;

    },

    view: function( post ){

      var datetime = filter.format_date( post.date ).iso,
          prettyDate = filter.format_date( post.date ).pretty;

      var tags = filter.get_tags( post );
      var bodyStyle = '';

      // Get todo
      // If post is within the last week add a class of new

      window.googleMap.add_marker( post );

      return  '<li class="media">' +
                '<div class="has-logo">' +
                  '<div class="media__logo-container">' +
                    filter.get_logo( post ) +
                  '</div>' +
                  '<a class="media__link--container" href="' + post.url + '">' +
                    '<div class="media__heading">' +
                      '<h2 class="media__title">' + post.title + '</h2>' +
                    '</div>' +
                    '<div class="media__body" style="' + bodyStyle + '">' +
                      '<p>' + post.excerpt + '</p>' +
                    '</div>' +
                  '</a>' +
                  '<time class="media__date" datetime="' + datetime + '">' + prettyDate + '</time>' +
                  tags +
                '</div>' +
              '</li>';

    }
  };

  return filter;

})(jQuery, window, document);

$(document).ready( function(){

  'use strict';

  // Only initialise sorting when there are results
  if ( $('#results').length ) {
    window.filter.init();
  }


  // When clicking on a tag
  $(document).on('click', '.tag__link', function(e){
    e.preventDefault();

    var state = filter.get_state();

    filter.set_state({
      'type' : '',
      'location' : '',
      'search' : $(this).text()
    });

    // Change the search value without loading a new page
    // $('#filterSearch').val( $(this).text() );
    //
    // // Trigger filtering
    // filter.fJS.filter();

    // Create new history state
    filter.push_history();

  });

  $(document).on('click', '.btn--control', function(e){
    e.preventDefault();

    var view = $(this).attr('id'),
        viewText = view.replace('view-', '');

    // Drop a cookie to persist the view
    $.cookie('view', viewText, { expires: 7 });

    // Update the body class
    $('body')
      .removeClass('view-gallery view-list view-map')
      .addClass( view );

    // // If the button is for map and the body doesn't have a map class
    if (view === 'view-map') {

      // Tell google maps to resize
      $(window).trigger('resize');
      google.maps.event.trigger(window.googleMap.map, 'resize');

      // Update the filtering for the view
      $('select').trigger('change');

      // Kill the affix plugin
      window.filter.kill_affix( $('#controls') );

      // Update Analitics
      ga('send', 'event', 'button', 'click', 'Map View');
    }

    if (view === 'view-list') {

      // Initialise afix if needed
      window.filter.affix( $('#controls') );

      // Update Analitics
      ga('send', 'event', 'button', 'click', 'List View');
    }

  });

});
