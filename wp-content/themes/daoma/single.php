<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <section class="primary">
    <article class="article-layout">
      <div class="wrap">
        <header>
          <h1><?php the_title(); ?> <?php edit_post_link('Edit', '<small>', '</small>'); ?></h1>
          <div class="entry-details">
            <div class="byline"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?><p>By <?php the_author_posts_link(); ?> - <?php the_time('F j, Y'); ?></p></div>
            <?php the_tags( '<p class="meta-tags"> Tagged ', ', ', '</p>' ); ?></p>
            <aside class="article-toolbar">
              <?php get_template_part( 'partials/social', 'share' ); ?> 
              <?php get_template_part( 'partials/social', 'comments' ); ?> 
              <nav class="next-prev">
                <?php previous_post_link('%link', '<p class="btn-prev"></p>'); ?>
                <?php next_post_link('%link', '<p class="btn-next"></p>'); ?>
                <p class="msg"></p>
              </nav>
            </aside>
          </div>
        </header>
        <div class="content">
          <?php if(!empty($post->post_excerpt)) { ?>
            <p class="intro"><?php echo get_the_excerpt(); ?></p>
          <?php } ?>
          <?php the_content(); ?>
        </div>
        <footer>
          <div class="footer-share">
            <a class="facebook" onClick="return BOLD.fbs_click(400, 300);"  href="http://www.facebook.com/share.php?u=<?php echo the_permalink(); ?>" title="Share on Facebook"><span>Share on Facebook</span></a>
            <a class="twitter" href='https://twitter.com/intent/tweet?&url=<?php echo the_permalink(); ?>/&text="<?php echo the_title(); ?>"&via=BoldNebraska' title="Share on Twitter"><span>Share on Twitter</span></a>
          </div>
          <div class="author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
            <p><strong><?php the_author_posts_link(); ?></strong> <?php the_author_meta('description'); ?> Email at: <a href="mailto:<?php the_author_meta('email'); ?>"><?php the_author_meta('email'); ?></a></p>
            <p>
              <a href="https://twitter.com/<?php the_author_meta('twitter'); ?>" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow <?php the_author_meta('twitter'); ?></a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </p>
          </div>
        </footer>
      </div>
    </article>
  </section>
  <section id="comments">
    <h1 class="section-headline">Join the Discussion</h1>
    <div class="wrap">
      <div class="fb-comments" data-href="<?php echo get_permalink(); ?>" data-width="470"></div>
    </div>
  </section>
  <?php get_template_part( 'partials/loop', 'related' ); ?> 
<?php endwhile; endif; ?>
<?php get_template_part( 'partials/newsletter', 'signup' ); ?> 
<?php get_footer(); ?>