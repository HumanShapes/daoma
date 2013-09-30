<?php 
  global $post;
  $actionRedirectUrl = get_post_meta($post->ID, 'bold_action_redirect_url', true);
  $actionEventDate = get_post_meta($post->ID, 'bold_action_event_date', true);
  $actionEventDatePretty = get_post_meta($post->ID, 'bold_action_event_date_pretty', true);
  $actionEventTime = get_post_meta($post->ID, 'bold_action_event_time', true);
  $actionEventLocation = get_post_meta($post->ID, 'bold_action_event_location', true);
  $actionCallToAction = get_post_meta($post->ID, 'bold_action_calltoaction', true);

  if ( $actionEventDatePretty ) { ?>
  <span>
    <?php echo $actionEventDatePretty; ?>
    <?php if ( $actionEventTime ) { ?>
      - <?php echo $actionEventTime; ?>
    <?php } ?>
  </span>
  <br />
<?php } ?>
<?php if ( $actionEventLocation ) { ?>
  <?php echo $actionEventLocation; ?>
  <br />
<?php } ?>
<?php if ( $actionCallToAction ) { ?>
  <?php echo $actionCallToAction; ?>
<?php } ?>