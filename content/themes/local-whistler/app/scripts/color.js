$(document).ready( function(){

  'use strict';

  if (Modernizr.canvas) {

    // Make sure all images are laoded
    $('.js-color-container').imagesLoaded( function(){

      // For each image
      $('.js-color-trigger').each(function(){

        // Get the colour for the outside edge
        if(!this.canvas) {
            this.canvas = $('<canvas />')[0];
            this.canvas.width = this.width;
            this.canvas.height = this.height;
            this.canvas.getContext('2d').drawImage(this, 0, 0, this.width, this.height);
        }

        var pixelData = this.canvas.getContext('2d').getImageData(2, 2, 1, 1).data;

        var rgba = 'rgba(' +
          pixelData[0] + ',' +
          pixelData[1] + ',' +
          pixelData[2] + ',' +
          pixelData[3] + ')';

        // If the colour is not transparent
        if (rgba !== 'rgba(0,0,0,0)') {
          // Set the parent background
          $(this).parent().css('background-color', rgba);
        }

      });
    }).progress( function( instance, image ) {
      $(image.img).closest('.media').addClass('loaded');
    });
  }

});
