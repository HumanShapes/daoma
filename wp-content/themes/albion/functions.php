<?php 

register_nav_menus( array(
  'top_five_events_news' => 'Top 5 Events and News',
  'primary_nav' => 'Primary Navigation',
  'footer_primary' => 'Primary Navigation in Footer',
  'featured_actions' => 'Featured Actions',
  'popular_posts' => 'Popular Posts',
  'follow_us' => 'Follow Us',
  'custom_filters' => 'Custom News Filters',
  'bold_links' => 'Bold Links'
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

// Add custom dashboard widgets
function custom_dashboard_widget() {
  echo "<p><a href='/wp-admin/nav-menus.php?action=edit&menu=10' title='Edit'>Header Popular Posts</a></p>";
  echo "<p><a href='/wp-admin/nav-menus.php?action=edit&menu=7' title='Edit'>Top 5 Events and News</a></p>";
  echo "<p><a href='/wp-admin/nav-menus.php?action=edit&menu=9' title='Edit'>Featured Actions</a></p>";
}
function add_custom_dashboard_widget() {
  wp_add_dashboard_widget('custom_dashboard_widget', 'Quick Links', 'custom_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

add_action('init', 'add_excerpt_to_pages');
function add_excerpt_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}

// Custom Image Sizes
add_theme_support( 'post-thumbnails' );
// square size - for top 5 news and such
add_image_size( 'square', 425, 425, true );
add_image_size( 'small43', 260, 195, true );
add_image_size( 'medium43', 400, 300, true );
add_image_size( 'oneandonefourth', 425, 340, true );
add_image_size( 'almostsquare', 640, 340, true );

// 
// // medium size
add_image_size( 'medium', 635, 400, true );
//   
// // large thumbnails
// add_image_size( 'large', 960, '' );

/* BEGIN Custom User Contact Info */
function extra_contact_info($contactmethods) {
  unset($contactmethods['aim']);
  unset($contactmethods['yim']);
  unset($contactmethods['jabber']);
  $contactmethods['twitter'] = 'Twitter';
  return $contactmethods;
}
add_filter('user_contactmethods', 'extra_contact_info');
/* END Custom User Contact Info */

// Get Facebook Comment Count for a URL
function fb_comment_count($url) {
  $json = json_decode(file_get_contents('https://graph.facebook.com/?ids=' . $url));
  return ($json->$url->comments) ? $json->$url->comments : 0;
}

// Remove ULs from WP Nav Menus
function wp_nav_menu_no_ul($theme_location) {
  $options = array(
      'echo' => false,
      'container' => false,
      'theme_location' => $theme_location,
      'fallback_cb'=> 'fall_back_menu'
  );

  $menu = wp_nav_menu($options);
  echo preg_replace(array(
      '#^<ul[^>]*>#',
      '#</ul>$#'
  ), '', $menu);
}

function fall_back_menu(){
    return;
}

function bold_events_calendar() {
  global $post;

  $today = date(DATE_ATOM);
  $endDate = date(DATE_ATOM, strtotime("+355 days"));
        
  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
       
  $months = array('','January','February','March','April','May','June','July','August','September','October','November','December');
  
  global $wpdb;
  $querystr = "
     SELECT wposts.* 
     FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
     WHERE wposts.ID = wpostmeta.post_id 
     AND wpostmeta.meta_key = 'bold_action_event_date' 
     AND wpostmeta.meta_value >= '$today'
     AND wpostmeta.meta_value < '$endDate'
     AND wposts.post_status = 'publish' 
     AND wposts.post_type = 'actions' 
     ORDER BY wpostmeta.meta_value ASC
  ";
  $pageposts = $wpdb->get_results($querystr, OBJECT);
  // Start Displaying the Calendar
  $dates = array();
  if ($pageposts) : 
      global $post; 
      foreach ($pageposts as $post) { 
      setup_postdata($post);
      $custom = get_post_custom($post->ID);
      $event_date = $custom["bold_action_event_date"][0];
      $weekday = date('N', strtotime($event_date)); // 1-7
      $month = date('m', strtotime($event_date)); // 1-12
      $day = date('d', strtotime($event_date)); // 01-31
      ?>
        <li class="date-<?php echo $day; ?>-<?php echo $months[$month]; ?> event" rel="<?php echo $months[$month]; ?>">
          <a href="<?php the_permalink(); ?>">
            <span class="date"><?php echo $day; ?></span>
            <div class="content">
              <h4><?php echo get_the_title(); ?></h4>
              <p>
                <?php get_template_part( 'partials/action', 'details' ); ?>
              </p>
            </div>
          </a>
        </li>
      <?php 
    }
  else :
    echo "<div class='day noEvents'><p>No Upcoming Events</p></div>";
  endif; 
}