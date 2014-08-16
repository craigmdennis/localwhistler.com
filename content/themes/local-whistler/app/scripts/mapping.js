var googleMap;

googleMap = {};

(function($, window, document) {

  'use strict';

  return googleMap = {

    center_lat_lng: [50.116320, -122.957356],
    map: null,
    markers: {},
    bounds: null,

    init: function(){

      var options = {
        scrollwheel: false,
        center: new google.maps.LatLng(this.center_lat_lng[0], this.center_lat_lng[1]),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        maxZoom: 17,
        suppressInfoWindows: true
      };

      this.create_map();

      this.map = new google.maps.Map(document.getElementById("resultsMap"), options);
      this.infowindow = new google.maps.InfoWindow({ maxWidth: 300 });

    },

    create_map: function() {

      $('#results').prepend('<div id="resultsMap" class="map--full js-mapping"></div>');

    },

    add_marker: function( post ){

      // Get the coords from Wordpress
      var latlng = post.custom_fields.martygeocoderlatlng[0].slice(1, - 1);

      // Create an array from the string
      var coords = latlng.split(', ');

      var that = this;
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(coords[0], coords[1] ),
        title: post.title,
        map: this.map
      });

      // Add the markers to the map
      marker.setMap( this.map );

      // Set the info windows
      marker.info_window_content = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h1 id="firstHeading" class="firstHeading">' + post.title + '</h1>'+
        '<div id="bodyContent">'+ post.excerpt + ' <br><a href="' + post.url + '">More info</a></div>'+
        '</div>'

      this.markers[post.id] = marker;

      // WIP
      google.maps.event.addListener(marker, 'click', function() {
        that.infowindow.setContent(marker.info_window_content)
        that.infowindow.open(that.map,marker);
      });
    },

    update_markers: function( result ){

      // Remove all the bounds
      this.bounds = new google.maps.LatLngBounds();

      // Unset all the markers
      $.each( this.markers, function(){
        this.setMap(null);
      });

      if ( result.length ) {

        // Add new markers
        $.each( result, function(i, id){

          // Update the map with new pins
          googleMap.markers[id].setMap( googleMap.map );

          // Add the locations to the bounds
          googleMap.bounds.extend( new google.maps.LatLng( googleMap.markers[id].position.k, googleMap.markers[id].position.B ) );

        });

      }

      // If no results use the default coords to set the bounds
      else {

        googleMap.bounds.extend( new google.maps.LatLng( googleMap.center_lat_lng[0], googleMap.center_lat_lng[1] ) );

      }

      this.set_center_point();

    },

    set_center_point: function(){

      this.map.setCenter( this.bounds.getCenter() );
      this.map.fitBounds( this.bounds );

    }

  }

})(jQuery, window, document);
