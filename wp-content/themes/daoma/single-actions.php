<?php get_header(); ?>
  <section class="primary">
    <h1 class="section-headline">Action</h1>
    <div class="posts">
      <?php  
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
          get_template_part( 'partials/loop', 'excerpt-actions' );
        endwhile; endif;
      ?>
    </div>
  </section>
<?php get_template_part( 'partials/newsletter', 'signup' ); ?> 
<?php get_footer(); ?>