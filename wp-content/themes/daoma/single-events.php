<?php
  get_header();
  if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
  <?php
    global $post;
    $daomaEventDate = get_post_meta($post->ID, 'hs_daoma_event_date', true);
    $daomaEventDatePretty = get_post_meta($post->ID, 'hs_daoma_event_date_pretty', true);
    $daomaEventTime = get_post_meta($post->ID, 'hs_daoma_event_time', true);
    $daomaEventLocation = get_post_meta($post->ID, 'hs_daoma_event_location', true);
  ?>
  <?php if ( has_post_thumbnail() ) { ?>
    <?php $postThumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); ?>
    <header class='post_pg_header' style="background-image: url(<?php echo $postThumbURL['0']; ?>);"></header>
  <?php } ?>
  <section class='interior'>
    <article class='wrapper post'>
      <h1><?php the_title(); ?> <?php edit_post_link('Edit', '<small>', '</small>'); ?></h1>
      <h3>
        <?php
          if ( $daomaEventDatePretty ) { ?>
          <span>
            <?php echo $daomaEventDatePretty; ?>
            <?php if ( $daomaEventTime ) { ?>
              / <?php echo $daomaEventTime; ?>
            <?php } ?>
          </span>
        <?php } ?>
        <?php if ( $daomaEventLocation ) { ?>
          / <?php echo $daomaEventLocation; ?>
        <?php } ?>
      </h3>
      <?php if ( has_excerpt() ) { ?>
      <h4><?php echo get_the_excerpt(); ?></h4>
      <?php } ?>
      <?php the_content(); ?>
      <?php
        $prevPostID = $post->ID - 1;
        $nextPostID = $post->ID + 1;
        $prevPostCity = get_post_meta($prevPostID, 'hs_daoma_speaker_city', true);
        $nextPostCity = get_post_meta($nextPostID, 'hs_daoma_speaker_city', true);
        ?>
      <nav class="event-nav" role="navigation">
        <div class="prev-post"><?php previous_post_link('%link', '< ' . $prevPostCity); ?></div>
        <div class="next-post"><?php next_post_link('%link', $nextPostCity . ' >'); ?></div>
        <ul class="social-share">
          <!-- <li><span>Share</span></li> -->
          <li><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&via=da_OMA" class="twitter">Twitter</a></li>
          <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook">Facebook</a></li>
          <li><a href="" class="google-plus">Google+</a></li>
          <li><a href="" class="copy-link">Copy URL</a></li>
        </ul>
      </nav>
    </article>
  </section>
<?php
  endwhile; endif;
  get_footer();
?>
