<?php get_header(); ?>
  <section class="primary">
    <h1 class="section-headline">Action</h1>
    <div class="posts">
      <?php
        // Get the IDs of the Actions in the "Featured Actions" menu.
        $menus = wp_get_nav_menus();
        //print_r($menus);
        $menu_items = wp_get_nav_menu_items($menus[2]); // The Featured Actions menu
        
        $featured_actions = array();
        foreach ($menu_items as $menu_item):
          array_push($featured_actions, $menu_item->object_id);
        endforeach;

        // If it's the first page then show the Featured Actions
        if (get_query_var('paged') == 0) {
          // The Loop
          $args = array( 
            'post_type' => 'actions',
            'post__in' => $featured_actions
          );
          $actions = new WP_Query( $args );
          if ( $actions->have_posts() ) : while ( $actions->have_posts() ) : $actions->the_post(); 
            get_template_part( 'partials/loop', 'excerpt-actions' );
          endwhile; endif;
        }
      ?>
      <div class="js-unhide-before-trying-ajax">
        <?php
          // The Loop
          $args = array( 
            'post_type' => 'actions',
            'post__not_in' => $featured_actions
          );
          $actions = new WP_Query( $args );
          if ( $actions->have_posts() ) : while ( $actions->have_posts() ) : $actions->the_post(); 
            get_template_part( 'partials/loop', 'excerpt-actions' );
          endwhile; endif;
        ?>
      </div>
    </div>
      <a class="btn-large-grey" href="" title="" id="load-more-posts">Load More</a>
  </section>
<?php get_template_part( 'partials/loop', 'calendar' ); ?> 
<?php get_template_part( 'partials/newsletter', 'signup' ); ?> 
<?php get_footer(); ?>