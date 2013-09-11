<?php get_header(); ?>
<section class="feature">
  <?php 

  $args = array( 
    'post_type' => 'slides'
  );
  $slides = new WP_Query( $args );
  $slideImage = null;
  $slideText = null;
  if ( $slides->have_posts() ) : while ( $slides->have_posts() ) : $slides->the_post(); 
    global $post;
    $slideLink = get_post_meta($post->ID, 'bold_slide_redirect_url', true);
    $slideImage .= '<div class="slide" style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).');"></div>';
    $slideText .= '<p><a href="'.$slideLink.'">'.get_the_excerpt().' <span>→</span></a></p>';
  endwhile; endif;
  ?>
  <div class="slides">
    <div class="slide-wrap">
      <?php echo $slideImage; ?>
    </div>
    <?php
      if ( current_user_can('edit_theme_options') ) {
        echo '<a class="admin-edit" href="/wp-admin/edit.php?post_type=slides" target="_blank">Edit</a>';
      }
    ?>
  </div>
  <div class="slides-text">
    <div class="slide-wrap">
      <div>
        <?php echo $slideText; ?>
      </div>
    </div>
  </div>
</section>
<section class="news">
  <h1 class="section-headline">News</h1>
  <div class="container">
    <?php 
    $args = array( 
      'post_type' => 'post',
      'posts_per_page' => 5
    );
    $posts = new WP_Query( $args );
    $postNum = 0;
    if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post(); 
      $postNum++;
      if ($postNum === 1) {
    ?> 
      <article class="main">
        <header>
          <h1><a href="<?php echo get_permalink(); ?>" title=""><?php the_title(); ?></a></h1>
          <div class="wrap">
            <div class="byline"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?> <p>By <?php the_author_posts_link(); ?> - <?php the_time('F j, Y'); ?></p></div>
            <aside class="article-toolbar">
              <?php get_template_part( 'partials/social', 'share' ); ?> 
            </aside>
          </div>
        </header>
        <div class="content">
          <?php if ( has_post_thumbnail() ) { ?>
            <figure class="hero">
              <?php the_post_thumbnail('medium'); ?>
            </figure>
          <?php } ?>
          <?php the_excerpt(); ?>
        </div>
      </article>
      <ul class="roll">
    <?php } else { ?>
      <li>
        <a href="<?php echo get_permalink(); ?>" title="View Post">
          <?php if ( has_post_thumbnail() ) { ?>
              <?php the_post_thumbnail('thumbnail'); ?>
          <?php } ?>
          <h3><?php the_title() ;?></h3>
          <p>By <?php the_author(); ?><br><b><?php the_time('F j, Y'); ?></b></p>
        </a>
      </li>
    <?php } ?>
    <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No relevant posts.</p>
    <?php endif; ?>
  </div>
  <a class="btn-large" href="/news/page/2">Additional Posts</a>
</section>
<section class="top-five">
  <h1 class="section-headline">
    Top 5 News and Action
    <?php
      if ( current_user_can('edit_theme_options') ) {
        echo '<a class="admin-edit" href="/wp-admin/nav-menus.php?action=edit&menu=7" target="_blank">Edit</a>';
      }
    ?>
  </h1>
  <?php 
  $topFive = wp_get_nav_menu_items(7);  
  $postCount = 0;
  if ($topFive) {
    foreach ($topFive as $singlePost) {
        $singlePost = $singlePost->object_id;
        $singlePost = get_post($singlePost);
        $postCount++;
        if ($postCount > 2) {
          $imageSize = 'oneandonefourth';
        } else {
          $imageSize = 'almostsquare';
        }
      ?>
        <div class="top-5-<?php echo $postCount; ?>">
          <?php echo get_the_post_thumbnail($singlePost->ID, $imageSize); ?>
          <a href="<?php echo get_post_permalink( $singlePost->ID ); ?>">
            <h3 class="information"><span><?php echo get_the_title($singlePost->ID); ?></span></h3>
          </a>
        </div>
      <?php
    }
  }
  ?>
</section>
<section class="get-involved">
  <div class="wrap">
    <div class="container">
      <h1>We are Bold Nebraska</h1>
      <p>Educate yourself and those that matter to you. This is our home and we shold be heard. We love our Nebraska political history and take lessons from the past to build a better future. We are Bold Nebraska.</p>
      <p><a class="btn" href="/actions/">Get Involved</a></p>
    </div>
  </div>
  <ul class="container">
    <li><a href="/news/"><span class="issues"></span><h3>Understand <br>the Issues</h3></a></li>
    <li><a href=""><span class="share"></span><h3>Share with <br>your Networks</h3></a></li>
    <li><a href="/actions/#events"><span class="events"></span><h3>Attend <br>Events</h3></a></li>
    <li><a href="http://nebraskalegislature.gov"><span class="contact"></span><h3>Contact your <br>Elected Officials</h3></a></li>
    <li><a href="https://rally.org/citizensvpipeline/donate"><span class="donate"></span><h3>Support <br>BOLD Nebraska</h3></a></li>
  </ul>
</section>
<?php get_template_part( 'partials/newsletter', 'signup' ); ?> 
<?php get_footer(); ?>