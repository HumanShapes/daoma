<?php get_header(); ?>
  <section class="primary">
    <h1 class="section-headline">
		<?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?>
    </h1>
    <div class="posts">
      <?php  
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          get_template_part( 'partials/loop', 'excerpt-post');
        endwhile; 
        
        else : ?>
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
        <?php endif;
      ?>
    </div>
  </section>
<?php get_footer(); ?>