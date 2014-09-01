'use strict';

$(document).on('click touchstart', '.pseudo-link', function(){

  window.location = $(this).data('url');

});
