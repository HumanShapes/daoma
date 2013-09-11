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
//add_image_size( 'square', 425, 425, true );

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