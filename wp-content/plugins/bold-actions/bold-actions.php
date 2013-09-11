<?php
/*
Plugin Name: Bold Actions
Description: A custom post type for Action Center posts that link to 3rd party user participation sites.
Version: 1.0
Author URI: http://codyjamespeterson.com
*/

function bold_actions() {
  $labels = array(
    'name'               => _x( 'Actions', 'post type general name' ),
    'singular_name'      => _x( 'Action', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'action' ),
    'add_new_item'       => __( 'Add New Action' ),
    'edit_item'          => __( 'Edit Action' ),
    'new_item'           => __( 'New Action' ),
    'all_items'          => __( 'All Actions' ),
    'view_item'          => __( 'View Action' ),
    'search_items'       => __( 'Search Actions' ),
    'not_found'          => __( 'No actions found' ),
    'not_found_in_trash' => __( 'No actions found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Actions'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Actions link out to 3rd party sites for user participation.',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', /* 'editor', */'thumbnail', 'excerpt' ),
    'has_archive'   => true,
  );
  register_post_type( 'actions', $args );  
}
add_action( 'init', 'bold_actions' );



function bold_actions_messages( $messages ) {
  global $post, $post_ID;
  $messages['actions'] = array(
    0 => '', 
    1 => sprintf( __('Action updated. <a href="%s">View Action</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Action updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Action restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Action published. <a href="%s">View action</a> or <a href="/wp-admin/nav-menus.php?action=edit&menu=4">Add to Featured Actions</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Action saved.'),
    8 => sprintf( __('Action submitted. <a target="_blank" href="%s">Preview action</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Action scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview action</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Action draft updated. <a target="_blank" href="%s">Preview action</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'bold_actions_messages' );


add_action( 'add_meta_boxes', 'bold_more_info_box' );
function bold_more_info_box() {
    add_meta_box( 
        'bold_more_info_box',
        __( 'More Info', 'bold_actions' ),
        'bold_more_info_box_content',
        'actions',
        'normal',
        'low'
    );
}

// Register datepicker ui for properties
function admin_bold_actions_javascript($hook){
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
      if ( 'actions' === $post->post_type ) {     
        wp_enqueue_script('jquery-ui-datepicker', WP_CONTENT_URL . '/plugins/bold-actions/js/jquery-ui-1.10.3.custom.min.js');  
        wp_enqueue_script('moment-js', WP_CONTENT_URL . '/plugins/bold-actions/js/moment.js');  
      }
    }
}
add_action('admin_enqueue_scripts', 'admin_bold_actions_javascript');

// Register ui styles for properties
function admin_bold_actions_styles($hook){
    global $post;
    // TODO: Make this only happen when needed.
    wp_enqueue_style('jquery-ui', WP_CONTENT_URL . '/plugins/bold-actions/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
}
add_action('admin_print_styles', 'admin_bold_actions_styles');


add_action( 'save_post', 'more_info_box_save' );
function more_info_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if ( isset($_POST['post_type']) && ('actions' == $_POST['post_type']) ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    return;
  }
  $bold_action_redirect_url = $_POST['bold_action_redirect_url'];
  update_post_meta( $post_id, 'bold_action_redirect_url', $bold_action_redirect_url );
  $bold_action_event_date = $_POST['bold_action_event_date'];
  update_post_meta( $post_id, 'bold_action_event_date', $bold_action_event_date );
  $bold_action_event_date_pretty = $_POST['bold_action_event_date_pretty'];
  update_post_meta( $post_id, 'bold_action_event_date_pretty', $bold_action_event_date_pretty );
  $bold_action_event_time = $_POST['bold_action_event_time'];
  update_post_meta( $post_id, 'bold_action_event_time', $bold_action_event_time );
  $bold_action_event_location = $_POST['bold_action_event_location'];
  update_post_meta( $post_id, 'bold_action_event_location', $bold_action_event_location );
  $bold_action_calltoaction = $_POST['bold_action_calltoaction'];
  update_post_meta( $post_id, 'bold_action_calltoaction', $bold_action_calltoaction );
}

function bold_more_info_box_content( $post ) { ?>
  <p>
    <label for="bold_action_redirect_url">Redirect URL*: (FB, Rally.org, Etc) </label><br />
    <input class="widefat" type="text" name="bold_action_redirect_url" id="bold_action_redirect_url" value="<?php echo esc_attr( get_post_meta( $post->ID, 'bold_action_redirect_url', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="bold_action_calltoaction">Call to Action (appears next to icon):</label><br />
    <input class="widefat" type="text" name="bold_action_calltoaction" id="bold_action_calltoaction" value="<?php echo esc_attr( get_post_meta( $post->ID, 'bold_action_calltoaction', true ) ); ?>" size="30" />
  </p>
  <p>
    <script>
    jQuery(document).ready(function(){
      jQuery( "input[name='bold_action_event_date_pretty']" ).datepicker({
        dateFormat: 'DD, MM d, yy',
        numberOfMonths: 1,
        onSelect: function(date) {
          jQuery('#bold_action_event_date').val(moment(date).format());
        }
      });
      jQuery( "#ui-datepicker-div" ).hide();});
    </script>
    <label for="bold_action_event_date">Event Date:</label><br />
    <input class="widefat" type="text" name="bold_action_event_date_pretty" id="bold_action_event_date_pretty" value="<?php echo esc_attr( get_post_meta( $post->ID, 'bold_action_event_date_pretty', true ) ); ?>" size="30" />
    <input class="widefat" type="hidden" name="bold_action_event_date" id="bold_action_event_date" value="<?php echo esc_attr( get_post_meta( $post->ID, 'bold_action_event_date', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="bold_action_event_time">Event Time:</label><br />
    <input class="widefat" type="text" name="bold_action_event_time" id="bold_action_event_time" value="<?php echo esc_attr( get_post_meta( $post->ID, 'bold_action_event_time', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="bold_action_event_location">Event Location:</label><br />
    <input class="widefat" type="text" name="bold_action_event_location" id="bold_action_event_location" value="<?php echo esc_attr( get_post_meta( $post->ID, 'bold_action_event_location', true ) ); ?>" size="30" />
  </p>
<?php }


function bold_actions_categories() {
  $labels = array(
    'name'              => _x( 'Action Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Action Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Action Type' ),
    'all_items'         => __( 'All Action Types' ),
    'parent_item'       => __( 'Parent Action Type' ),
    'parent_item_colon' => __( 'Parent Action Type:' ),
    'edit_item'         => __( 'Edit Action Type' ), 
    'update_item'       => __( 'Update Action Type' ),
    'add_new_item'      => __( 'Add New Action Type' ),
    'new_item_name'     => __( 'New Action Type' ),
    'menu_name'         => __( 'Action Types' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'action_types', 'actions', $args );
}
add_action( 'init', 'bold_actions_categories', 0 );