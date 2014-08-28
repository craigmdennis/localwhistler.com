var body = document.body,
    timer;

window.addEventListener('scroll', function() {
  clearTimeout(timer);
  document.body.style.pointerEvents='none';

  timer = setTimeout(function(){
    document.body.style.pointerEvents='auto';
  },100);
}, false);
