<section class="related-news">
  <h1 class="section-headline">Related News</h1>
  <ul>
      <?php
      // First we try and get 3 posts in the same tags
      global $post;
      $tags = wp_get_post_tags($post->ID);
      $postIDs = array($post->ID);
      $postCount = 0;
      if ($tags) {
        $first_tag = $tags[0]->term_id;
        $args = array( 
          'tag__in' => array($first_tag),
          'post__not_in' => array($post->ID),
          'meta_key'    => '_thumbnail_id',
          'posts_per_page'=>3
        );
        $related = new WP_Query( $args );
        if ( $related->have_posts() ) { ?>
            <?php while ( $related->have_posts() ) : $related->the_post(); 
              global $post;
              $postCount++;
              array_push($postIDs, $post->ID);
              ?>
              <a href="<?php the_permalink(); ?> ">
                <li>
                  <?php the_post_thumbnail('medium43'); ?>
                  <h3><?php the_title(); ?></h3>
                </li>
              </a>
            <?php endwhile; ?>
      <?php } } ?>
      <?php
      // Then we get some recent posts
      if ($postCount < 3) {
        $postsNeeded = 3 - $postCount;
        global $post;
        $args = array( 
          'post__not_in' => $postIDs,
          'meta_key'    => '_thumbnail_id',
          'posts_per_page'=> $postsNeeded
        );
        $recent = new WP_Query( $args );
        $postCount = 0;
        if ( $recent->have_posts() ) { ?>
            <?php while ( $recent->have_posts() ) : $recent->the_post(); 
              global $post;
              ?>
              <a href="<?php the_permalink(); ?> ">
                <li>
                  <?php the_post_thumbnail('medium43'); ?>
                  <h3><?php the_title(); ?></h3>
                </li>
              </a>
            <?php endwhile; ?>
      <?php } } ?>
  </ul>
</section>