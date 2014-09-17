var setBackgroundColorToImage;

setBackgroundColorToImage = {};

setBackgroundColorToImage = {

  init: function() {

    'use strict';

    if (Modernizr.canvas) {

      $('.js-color-trigger').fadeTo(0);

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

          // Add class to show completion
          $(this).closest('.media').addClass('color-attained');

          var rgba = 'rgba(' +
            pixelData[0] + ',' +
            pixelData[1] + ',' +
            pixelData[2] + ',' +
            pixelData[3] + ')';

          var clip = '';
          var border = '';

          if ( (pixelData[0] > 250 && pixelData[1] > 250 && pixelData[2] > 250) || (rgba === 'rgba(0,0,0,0)' || rgba === 'rgba(255,255,255,255)') ) {
            rgba = '#FFF';
            clip = 'padding-box';
            border = '#C2C8D0';
          }

          // Set the parent background
          $(this).parent().css({
            'background-color': rgba,
            'background-clip': clip,
            'border-color': border
          });

        });
      });
    }
  }

};
