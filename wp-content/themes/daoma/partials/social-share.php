<?php
  global $post;
  $actionRedirectUrl = get_post_meta($post->ID, 'bold_action_redirect_url', true);
  if ($actionRedirectUrl) {
  	$shareUrl = $actionRedirectUrl;
  } else {
  	$shareUrl = get_permalink();
  }
?>
<div class="social-share">
  <span class="btn-share">0</span>
  <div class="share-popup">
    <ul class="socialcount" data-url="<?php echo $shareUrl; ?>" data-counts="true" data-share-text="Bold Nebraska dot Org">
      <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl; ?>" title="Share on Facebook"><span class="count"></span>Facebook</a></li>
      <li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo $shareUrl; ?>" title="Share on Twitter"><span class="count"></span>Twitter</a></li>
      <li class="googleplus"><a href="https://plus.google.com/share?url=<?php echo $shareUrl; ?>" title="Share on Google Plus"><span class="count"></span>Google</a></li>
      <li><input type="text" value="<?php echo $shareUrl; ?>" class="cp-link"></li>
    </ul>
  </div>
</div>