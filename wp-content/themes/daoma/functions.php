<?php 

register_nav_menus( array(
  'primary_nav' => 'Primary Navigation'
) );

add_filter( 'show_admin_bar', '__return_false' );

// Remove some of the default Wordpress Dashboard Widgets
function disable_default_dashboard_widgets() {
  remove_meta_box('dashboard_plugins', 'dashboard', 'core');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
  remove_meta_box('dashboard_primary', 'dashboard', 'core');
  remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

// Custom Image Sizes
add_theme_support( 'post-thumbnails' );
// square size - for top 5 news and such
add_image_size( 'fourbytwo', 430, 215, true );
add_image_size( 'fivebytwo', 1140, 456, true );

// Let's add another featured image to events for the speaker photo
if (class_exists('MultiPostThumbnails')) {

  new MultiPostThumbnails(
    array(
      'label' => 'Speaker Portrait',
      'id' => 'speaker-portrait',
      'post_type' => 'events'
    ) 
  );
}