<article class="article-layout">
  <div class="wrap">
    <header>
      <h1><a href="<?php echo get_permalink(); ?>" title="View Post"><?php the_title(); ?></a></h1>
      <div class="entry-details">
        <div class="byline"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?><p>By <?php the_author_posts_link(); ?> - <?php the_time('F j, Y'); ?></p></div>
        <?php the_tags( '<p class="meta-tags"> Tagged ', ', ', '</p>' ); ?></p>
        <aside class="article-toolbar">
          <?php get_template_part( 'partials/social', 'share' ); ?> 
          <?php get_template_part( 'partials/social', 'comments' ); ?>
        </aside>
      </div>
    </header>
    <div class="content">
      <?php if ( has_post_thumbnail() ) { ?>
        <?php the_post_thumbnail('small43'); ?>
      <?php } ?>
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>