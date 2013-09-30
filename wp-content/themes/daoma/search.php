<?php get_header(); ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
    <section class="interior" style="border-bottom: none;"> <!-- TODO: Remove and figure out style settings -->
      <div class="wrapper">
        <h2 class="column"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
        <div class="content">
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
        </div>
      </div>
    </section>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>