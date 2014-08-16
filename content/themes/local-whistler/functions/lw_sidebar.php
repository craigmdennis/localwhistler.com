<?php

  if ( function_exists('register_sidebar') ) :
    register_sidebar(array(
      'before_widget' => '<aside>',
      'after_widget' => '</aside>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
    ));
  endif;

?>
