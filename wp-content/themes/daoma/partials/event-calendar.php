<?php
  setup_postdata($post);
  $custom = get_post_custom($post->ID);
  $event_date = $custom["hs_daoma_event_date"][0];
  if ($event_date) {
    $weekday = date('N', strtotime($event_date)); // 1-7
    $month = date('M', strtotime($event_date)); // JAN - DEC
    $day = date('d', strtotime($event_date)); // 01-31
  }
?>
<article class="events event">
  <a href="<?php the_permalink(); ?>" title="View Event Info">
    <div class="date">
      <p>
        <?php if ($event_date) { ?>
          <?php echo $month; ?><br><span><?php echo $day; ?></span>
        <?php } else {
            echo '<span class="event-tbd">TBD</span>';
        } ?>
      </p>
    </div>
    <?php if ( has_post_thumbnail() ) { ?>
      <?php $postThumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); ?>
      <div class="thumb" style="background-image: url(<?php echo $postThumbURL['0']; ?>);">
      </div>
    <?php } ?>
    <div class="content">
      <h3><?php echo get_the_title(); ?></h3>
      <p><?php echo get_the_excerpt(); ?></p>
    </div>
  </a>
</article>