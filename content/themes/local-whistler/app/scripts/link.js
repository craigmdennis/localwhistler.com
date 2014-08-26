'use strict';

$(document).on('click', '.pseudo-link', function(){

  window.location = $(this).data('url');

});
