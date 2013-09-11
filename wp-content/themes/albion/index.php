<?php get_header(); ?>
  <section class="primary">
    <h1 class="section-headline">
      News
      <?php
      if ( is_day() ) :
        printf( __( '%s', 'boldne' ), '<span>' . get_the_date() . '</span>' );
      elseif ( is_month() ) :
        printf( __( '%s', 'boldne' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'boldne' ) ) . '</span>' );
      elseif ( is_year() ) :
        printf( __( '%s', 'boldne' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'boldne' ) ) . '</span>' );
      elseif ( is_category() ) :
        printf( __( 'Category: %s', 'boldne' ), '<span>' . single_cat_title( '', false ) . '</span>' );
      elseif ( is_tag() ) :
        printf( __( 'Tagged #%s', 'boldne' ), '<span>' . single_tag_title( '', false ) . '</span>' );
      endif;

      if ( is_author() ) :
        $author = get_userdata( get_query_var('author') );
        printf( __( '%s', 'boldne' ), '<span>by ' . $author->display_name . '</span>' );
      endif;
      ?>
    </h1>
    <?php get_template_part( 'partials/filter', 'posts' ); ?> 
    <div class="posts">
      <?php  
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          get_template_part( 'partials/loop', 'excerpt-post');
        endwhile; endif;
      ?>
    </div>
    <a class="btn-large-grey" href="" title="" id="load-more-posts">Load More</a>
  </section>
<?php get_footer(); ?>