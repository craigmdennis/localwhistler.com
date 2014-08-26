<?php

// -------------------------------------------------------------------------- //
// All actions are called at the top.
// They should be self explanitory and in the order in which the functions
// appear in the file.
// ---------------------------------------------------------------------------//

add_action( 'widgets_init', 'footer_widgets_init' );
add_action( 'widgets_init', 'main_sidebar_init' );
add_action( 'widgets_init', 'news_sidebar_init' );


// Custom Footer Sidebars ------------------------------------------------- //
function footer_widgets_init() {

  register_sidebar( array(
    'name' => 'Footer Sidebar 1',
    'id' => 'sidebar-footer-1',
    'class' => 'menu--footer',
    'description' => 'First Column',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => 'Footer Sidebar 2',
    'id' => 'sidebar-footer-2',
    'class' => 'menu--footer',
    'description' => 'Second Column',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => 'Footer Sidebar 3',
    'id' => 'sidebar-footer-3',
    'class' => 'menu--footer',
    'description' => 'Third Column',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => 'Footer Sidebar 4',
    'id' => 'sidebar-footer-4',
    'class' => 'menu--footer',
    'description' => 'Fourth Column',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

}



// Custom Footer Sidebars ------------------------------------------------- //
function main_sidebar_init() {

  register_sidebar( array(
    'name' => 'Main Sidebar',
    'id' => 'sidebar-main',
    'description' => 'This will appear on the right hand side of news articles and pages',
    'before_widget' => '<div class="sidebar__section">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

};



// Custom Footer Sidebars ------------------------------------------------- //
function news_sidebar_init() {

  register_sidebar( array(
    'name' => 'News Sidebar',
    'id' => 'sidebar-news',
    'description' => 'This will appear on the right hand side of a list of posts',
    'before_widget' => '<div class="sidebar__section">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

};

?>
