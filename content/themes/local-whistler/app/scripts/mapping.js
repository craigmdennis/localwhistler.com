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
        maxZoom: 17
      };

      this.create_map();

      this.map = new google.maps.Map(document.getElementById("resultsMap"), options);

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
      marker.info_window_content = post.title;
      this.markers[post.id] = marker;

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

      // Add new markers
      $.each( result, function(i, id){

        // Update the map with new pins
        googleMap.markers[id].setMap( googleMap.map );

        // Add the locations to the bounds
        googleMap.bounds.extend( new google.maps.LatLng( googleMap.markers[id].position.k, googleMap.markers[id].position.A ) );

      });

      //Set map center
      if( result.length) {
        this.set_center_point();
      }
    },

    set_center_point: function(){

      // todo: If no markers, center on Whistler, zoom 15

      // console.log( this.bounds.getCenter() );
      this.map.setCenter( this.bounds.getCenter() );
      this.map.fitBounds( this.bounds );

    }

  }

})(jQuery, window, document);
