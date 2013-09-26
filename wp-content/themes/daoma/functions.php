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

function hs_daoma_events_calendar() {
  global $post;

  $today = date(DATE_ATOM);
  $endDate = date(DATE_ATOM, strtotime("+355 days"));
        
  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
         
  global $wpdb;
  $querystr = "
     SELECT wposts.* 
     FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
     WHERE wposts.ID = wpostmeta.post_id 
     AND wpostmeta.meta_key = 'hs_daoma_event_date' 
     AND wpostmeta.meta_value >= '$today'
     AND wpostmeta.meta_value < '$endDate'
     AND wposts.post_status = 'publish' 
     AND wposts.post_type = 'events' 
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
      $event_date = $custom["hs_daoma_event_date"][0];
      $weekday = date('N', strtotime($event_date)); // 1-7
      $month = date('M', strtotime($event_date)); // JAN - DEC
      $day = date('d', strtotime($event_date)); // 01-31
      ?>

      <article class="events event">
        <a href="<?php the_permalink(); ?>" title="View Event Info">
          <div class="date">
            <p><?php echo $month; ?><br><span><?php echo $day; ?></span></p>
          </div>
          <?php if ( has_post_thumbnail() ) { ?>
            <div class="thumb">
              <?php the_post_thumbnail(); ?>
            </div>
          <?php } ?>
          <div class="content">
            <h3><?php echo get_the_title(); ?></h3>
            <p><?php echo get_the_excerpt(); ?></p>
          </div>
        </a>
      </article>

      <?php 
    }
  else :
    echo "<div class='day noEvents'><p>No Upcoming Events</p></div>";
  endif; 
}

