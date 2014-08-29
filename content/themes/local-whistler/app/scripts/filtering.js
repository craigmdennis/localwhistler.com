var filter;

filter = {};

(function($, window) {

  'use strict';

  filter = {

    filterCount: 0,

    include: 'title,date,url,excerpt,taxonomy_business_filter',

    apiLocation: '/api/get_posts/?post_type=business&count=-1' + filter.include,

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
          if ( $('body').hasClass('view-map') ) {
            window.googleMap.update_markers( result );
          }

          // Send custom analytics events
          filter.push_analytics();

          // Change the URL and store data
          filter.push_history();

          // Show the current count
          filter.result_count( result );

          // Update the sort only on the first filter
          filter.result_sort();

          // Add styling hooks
          filter.update_styles();

          // Increment the count
          filter.filterCount++;

        }
      }
    },

    init: function(){

      // Get the first page data
      var data = filter.get_api_data( filter.apiLocation );

      if ( $('body').hasClass('view-map') ) {
        window.googleMap.init();
      }

      // Bind the event handlers
      filter.bind();

      // Create the empty results markup
      filter.create_results();

      // Pass the data and initialiase the filtering
      // Store filter object
      filter.fJS = filter.filter_init( data );

    },

    filter_init: function( data ){

      return FilterJS( data.posts, '#resultsList', filter.view, filter.settings );

    },

    bind: function(){

      if (Modernizr.history) {
        window.onpopstate = filter.set_current_state;
      }

      // Stop the form from being manually submitted
      $('form').on('submit', filter.override );

      $('#filterOrder').on('change', filter.result_sort );

      // $('.sub-menu').on('click.submenu', 'a', filter.override );

    },

    create_results: function(){

      // If we don't have results, create the ol
      if ( !$('#resultsList ').length ) {

        $('#results').html(
          '<ol id="resultsList" class="media__list"></ol>'
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

      console.log( $media.filter(':' + visible + ':' + first) );

      $('.' + first + '-' + visible).removeClass( first + '-' + visible );
      $('.' + last + '-' + visible).removeClass( last + '-' + visible );

      $media.filter(':' +  visible + ':' + first).addClass( first + '-' + visible );
      $media.filter(':' +  visible + ':' + last).addClass( last + '-' + visible );

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

      if ( filter.get_current_state().location !== '' ) { return true; }
      else { return false; }

    },

    is_type: function(){

      if ( filter.get_current_state().type !== '' ) { return true; }
      else { return false; }

    },

    is_search: function(){
      if ( filter.get_current_state().search !== '' ) { return true; }
      else { return false; }
    },

    is_order: function(){
      if ( filter.get_current_state().order !== '' ) { return true; }
      else { return false; }
    },

    get_current_state: function(){

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

    set_current_state: function(){

      // Replace the current text to match the history state
      if ( history.state.search ) {
        $('#filterSearch').attr('value', history.state.search );
      }

      // Trigger tinysort
      filter.result_sort();

      // Get all the select boxes
      var $selects = $('#filterForm').find('select');

      // Iterate through the selects
      $selects.each( function(){

        // Remove all selected attributes
        $(this).find('option:selected').removeAttr('selected');

        // Get all the options in the selects
        var $options = $(this).find('option');

        $options.each( function(){

          // Get the value
          var value = $(this).val();

          // if option value matches history state value
          if ( (value === history.state.location) || (value === history.state.type) || (value === history.state.order ) ) {

            // Set this as the selected option
            $(this).attr('selected', 'selected');

            // Tell chosen to update
            $(this).trigger('chosen:updated');

            // // Tell the filter that something has changed
            // $(this).trigger('change');
          }

        });

      });

    },

    generate_url: function(){

      var url = filter.get_url(),
          currentLocation = filter.get_current_state().location,
          currentOrder = filter.get_current_state().order,
          currentType = filter.get_current_state().type,
          currentSearch = filter.get_current_state().search,
          currentView = filter.get_current_state().view;

        url += '?s=' + currentSearch;
        url += '&business_location=' + currentLocation;
        url += '&business_type=' + currentType;
        url += '&order=' + currentOrder;
        url += '&view=' + currentView;

      return url;

    },

    generate_title: function(){

      var currentLocationText = filter.get_current_state().locationText,
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

      return title;

    },

    push_history: function(){

      if ( Modernizr.history) {
        if ( ($('#filterSearch').is(':focus')) || ( filter.filterCount === 0 ) ) {
          // Replace current history state
          window.history.replaceState( filter.get_current_state(), filter.generate_title(), filter.generate_url() );
        } else {
          // Add a new history state
          window.history.pushState( filter.get_current_state(), filter.generate_title(), filter.generate_url() );
        }
      }

    },

    push_analytics: function(){

      ga('send', 'event', 'select', 'filter', {
        'nonInteraction': 1 // So it doesn't affect bounce rate
      });

      // Set custom analytics dimensions
      ga('set', 'dimension1', filter.get_current_state.typeText);
      ga('set', 'dimension2', filter.get_current_state.locationText);
      ga('set', 'dimension4', filter.get_current_state.search);
      ga('set', 'dimension3', filter.get_current_state.orderText);

    },

    result_sort: function(){

      var $this = $('#filterOrder').find('option:selected');
      var sortBy = '.' + $this.attr('data-sort-target');
      var sortOrder = $this.attr('data-sort-order');

      console.log(sortOrder);
      console.log(sortBy);

      $('ol .media').tsort( sortBy, {order: sortOrder} );

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
        dataType: 'json',
        success: function( response ){
           data = response;
        }
      });

      return data;

    },

    get_logo: function( post ) {

      var logo = post.acf.logo;
      var height = logo.sizes['media--thumb-height'];
      var width = logo.sizes['media--thumb-width'];
      var style = 'style="margin-left:-' + width/2 + 'px;' + 'margin-top:-' + height/2 + 'px;"';

      if ( logo !== '' ) {

          // Make sure we get the logo and not any old attachment
          return  '<a class="media__link--logo media__link--left media__thumb js-color-target" href="' + post.url + '">' +
                    '<img class="media__logo js-color-trigger" src="' + logo.sizes['media--thumb'] + '" alt="' + logo.description + ' Logo"' + style  + ' />' +
                  '</a>';
        }
    },

    get_tags: function( post ) {

      var tags = ['<ul class="tags">'];
      var elem;

      if ( post.taxonomy_business_filter !== '' ) {

        // Iterate over each attachment in the array
        $.each( post.taxonomy_business_filter, function(){

          // Make sure we get the logo and not any old attachment
          elem = '<li class="tag__item"><a class="tag__link" href="/filter/' + this.slug + '">' + this.title + '</a>';
          tags.push( elem );

        });

        elem = '</ul>';
        tags.push( elem );
        tags = tags.join(',') + '';
        tags = tags.replace(/,/g, '');
      }

      return tags;

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
        iso: date,
        pretty: monthName + ' ' + day + ', ' + year
      };

      return dateArray;

    },

    view: function( post ){

      var datetime = filter.format_date( post.date ).iso,
          prettyDate = filter.format_date( post.date ).pretty;

          // Get todat
          // If post is within the last week add a class of new

      if ( $('body').hasClass('view-map') ) {
        window.googleMap.add_marker( post );
      }

      // todo: use Mustache templates
      return  '<li class="media pseudo-link" data-url="' + post.url + '">' +
                '<div class="has-logo">' +
                  filter.get_logo( post ) +
                    '<div class="media__heading">' +
                      '<h2 class="media__title">' +
                        '<a class="media__link--title" href="' + post.url + '">' + post.title + '</a>' +
                      '</h2>' +
                    '</div>' +
                    '<div class="media__body">' +
                      '<p>' + post.excerpt + '</p>' +
                    '</div>' +
                  '<time class="media__date" datetime="' + datetime + '">' + prettyDate + '</time>' +
                  '<div class="media__footer">' +
                    filter.get_tags( post ) +
                  '</div>' +
                '</div>' +
              '</li>';

    }
  };

  return filter;

})(jQuery, window, document);
