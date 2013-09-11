<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
$postType = (isset($_GET['postType'])) ? $_GET['postType'] : 'post';
$loopMonth = (isset($_GET['month'])) ? $_GET['month'] : null;
$loopYear = (isset($_GET['year'])) ? $_GET['year'] : null;
$postCategory = (isset($_GET['postCategory'])) ? $_GET['postCategory'] : null;
$postTag = (isset($_GET['postTag'])) ? $_GET['postTag'] : null;

echo $loopMonth;
echo $loopYear;
// echo $numPosts;
// echo $page;

// For the Actions section we need to ignore the "Feautured Actions" since they get their own loop
$featured_actions = array();
if ($postType == 'actions') {
	// Get the IDs of the Actions in the "Featured Actions" menu.
	$menus = wp_get_nav_menus();
	$menu_items = wp_get_nav_menu_items($menus[2]); // The Featured Actions menu
	
	foreach ($menu_items as $menu_item):
	  array_push($featured_actions, $menu_item->object_id);
	endforeach;
}

// The Query
query_posts(array(
  'posts_per_page' => $numPosts,
  'paged' => $page,
  'post_type' => $postType,
  'post__not_in' => $featured_actions, 
  'monthnum' => $loopMonth,
  'year' => $loopYear,
  'tag' => $postTag,
  'cat' => $postCategory  
));
//echo $GLOBALS['wp_query']->request;
// our loop
if ( have_posts() ) : while ( have_posts() ) : the_post();
	global $post;
	$post_type = get_post_type( $post->ID );
  get_template_part( 'partials/loop', 'excerpt-'.$post_type);
endwhile; endif;

wp_reset_query();
?>