<?php
/*
Plugin Name: daOMA Events
Description: A custom post type for events.
Version: 1.0
Author URI: http://codyjamespeterson.com
*/

function hs_daoma_events() {
  $labels = array(
    'name'               => _x( 'Events', 'post type general name' ),
    'singular_name'      => _x( 'Event', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'event' ),
    'add_new_item'       => __( 'Add New Event' ),
    'edit_item'          => __( 'Edit Event' ),
    'new_item'           => __( 'New Event' ),
    'all_items'          => __( 'All Events' ),
    'view_item'          => __( 'View Event' ),
    'search_items'       => __( 'Search Events' ),
    'not_found'          => __( 'No events found' ),
    'not_found_in_trash' => __( 'No events found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Events'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'daOMA Events',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'has_archive'   => true
  );
  register_post_type( 'events', $args );  
}
add_action( 'init', 'hs_daoma_events' );

function hs_daoma_events_messages( $messages ) {
  global $post, $post_ID;
  $messages['events'] = array(
    0 => '', 
    1 => sprintf( __('event updated. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('event updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('event published. <a href="%s">View event</a> or <a href="/wp-admin/nav-menus.php?event=edit&menu=4">Add to Featured events</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('event saved.'),
    8 => sprintf( __('event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'hs_daoma_events_messages' );


add_action( 'add_meta_boxes', 'hs_daoma_more_info_box' );
function hs_daoma_more_info_box() {
    add_meta_box( 
        'hs_daoma_more_info_box',
        __( 'More Info', 'hs_daoma_events' ),
        'hs_daoma_more_info_box_content',
        'events',
        'normal',
        'low'
    );
}

// Register datepicker ui for properties
function admin_hs_daoma_events_javascript($hook){
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
      if ( 'events' === $post->post_type ) {     
        wp_enqueue_script('jquery-ui-datepicker', WP_CONTENT_URL . '/plugins/daoma-events/js/jquery-ui-1.10.3.custom.min.js');  
        wp_enqueue_script('moment-js', WP_CONTENT_URL . '/plugins/daoma-events/js/moment.js');  
      }
    }
}
add_action('admin_enqueue_scripts', 'admin_hs_daoma_events_javascript');

// Register ui styles for properties
function admin_hs_daoma_events_styles($hook){
    global $post;
    // TODO: Make this only happen when needed.
    wp_enqueue_style('jquery-ui', WP_CONTENT_URL . '/plugins/daoma-events/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
}
add_action('admin_print_styles', 'admin_hs_daoma_events_styles');


add_action( 'save_post', 'more_info_box_save' );
function more_info_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if ( isset($_POST['post_type']) && ('events' == $_POST['post_type']) ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    return;
  }
  $hs_daoma_event_time = $_POST['hs_daoma_event_time'];
  update_post_meta( $post_id, 'hs_daoma_event_time', $hs_daoma_event_time );
  $hs_daoma_event_location = $_POST['hs_daoma_event_location'];
  update_post_meta( $post_id, 'hs_daoma_event_location', $hs_daoma_event_location );
  $hs_daoma_speaker_city = $_POST['hs_daoma_speaker_city'];
  update_post_meta( $post_id, 'hs_daoma_speaker_city', $hs_daoma_speaker_city );
  $hs_daoma_event_price = $_POST['hs_daoma_event_price'];
  update_post_meta( $post_id, 'hs_daoma_event_price', $hs_daoma_event_price );
  $hs_daoma_ticket_url = $_POST['hs_daoma_ticket_url'];
  update_post_meta( $post_id, 'hs_daoma_ticket_url', $hs_daoma_ticket_url );
  $hs_daoma_speaker_title = $_POST['hs_daoma_speaker_title'];
  update_post_meta( $post_id, 'hs_daoma_speaker_title', $hs_daoma_speaker_title );
  $hs_daoma_speaker_bio = $_POST['hs_daoma_speaker_bio'];
  update_post_meta( $post_id, 'hs_daoma_speaker_bio', $hs_daoma_speaker_bio );

  $hs_daoma_event_date = $_POST['hs_daoma_event_date'];
  $hs_daoma_event_date_pretty = $_POST['hs_daoma_event_date_pretty'];
  update_post_meta( $post_id, 'hs_daoma_event_date_pretty', $hs_daoma_event_date_pretty );
  if ($hs_daoma_event_date_pretty) {
    update_post_meta( $post_id, 'hs_daoma_event_date', $hs_daoma_event_date );
  } else {
    update_post_meta( $post_id, 'hs_daoma_event_date', '');    
  }

}

function hs_daoma_more_info_box_content( $post ) { ?>
  <p>
    <script>
    jQuery(document).ready(function(){
      jQuery( "input[name='hs_daoma_event_date_pretty']" ).datepicker({
        dateFormat: 'DD, MM d, yy',
        numberOfMonths: 1,
        onSelect: function(date) {
          jQuery('#hs_daoma_event_date').val(moment(date).format());
        }
      });
      jQuery( "#ui-datepicker-div" ).hide();});
    </script>
    <label for="hs_daoma_event_date">Event Date <small>(Leave blank for TBD)</small>:</label><br />
    <input class="widefat" type="text" name="hs_daoma_event_date_pretty" id="hs_daoma_event_date_pretty" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_event_date_pretty', true ) ); ?>" size="30" />
    <input class="widefat" type="hidden" name="hs_daoma_event_date" id="hs_daoma_event_date" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_event_date', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_event_time">Event Time:</label><br />
    <input class="widefat" type="text" name="hs_daoma_event_time" id="hs_daoma_event_time" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_event_time', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_event_location">Event Location:</label><br />
    <input class="widefat" type="text" name="hs_daoma_event_location" id="hs_daoma_event_location" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_event_location', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_event_price">Event Price Text:</label><br />
    <input class="widefat" type="text" name="hs_daoma_event_price" id="hs_daoma_event_price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_event_price', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_ticket_url">Ticket or RSVP URL:</label><br />
    <input class="widefat" type="text" name="hs_daoma_ticket_url" id="hs_daoma_ticket_url" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_ticket_url', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_speaker_city">Speaker City Abbreviation <small>(e.g. OMA, NYC): <br />*If Omaha, leave blank</small></label><br />
    <input class="widefat" type="text" name="hs_daoma_speaker_city" id="hs_daoma_speaker_city" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_speaker_city', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_speaker_title">Speaker Title <small>(e.g. Creative Director and Writer for Design): </small></label><br />
    <input class="widefat" type="text" name="hs_daoma_speaker_title" id="hs_daoma_speaker_title" value="<?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_speaker_title', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="hs_daoma_speaker_bio">Speaker Bio <small>(Bio starts with first name so leave that off of first sentence): </small></label><br />
    <textarea class="widefat" name="hs_daoma_speaker_bio" id="hs_daoma_speaker_bio" size="30"><?php echo esc_attr( get_post_meta( $post->ID, 'hs_daoma_speaker_bio', true ) ); ?></textarea>
  </p>
<?php }

function hs_daoma_events_categories() {
  $labels = array(
    'name'              => _x( 'Event Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Event Type' ),
    'all_items'         => __( 'All Event Types' ),
    'parent_item'       => __( 'Parent Event Type' ),
    'parent_item_colon' => __( 'Parent Event Type:' ),
    'edit_item'         => __( 'Edit Event Type' ), 
    'update_item'       => __( 'Update Event Type' ),
    'add_new_item'      => __( 'Add New Event Type' ),
    'new_item_name'     => __( 'New Event Type' ),
    'menu_name'         => __( 'Event Types' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'hs_event_types', 'events', $args );
}
add_action( 'init', 'hs_daoma_events_categories', 0 );