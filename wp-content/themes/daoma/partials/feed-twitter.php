<div class="twitter">
  <header>
    <h3><a href="http://twitter.com/boldnebraska">@BoldNebraska</a></h3>
    <a href="https://twitter.com/boldnebraska" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @twitterapi</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </header>
<?php 
// http://wordpress.org/extend/plugins/oauth-twitter-feed-for-developers/
$tweets = getTweets(3);
if(is_array($tweets)){
  // to use with intents
  echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script><ul>';
  
  foreach($tweets as $tweet){
  
    if($tweet['text']){
      $the_tweet = $tweet['text'];
      /*
      Twitter Developer Display Requirements
      https://dev.twitter.com/terms/display-requirements
  
      2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
        i. User_mentions must link to the mentioned user's profile.
       ii. Hashtags must link to a twitter.com search with the hashtag as the query.
      iii. Links in Tweet text must be displayed using the display_url
         field in the URL entities API response, and link to the original t.co url field.
      */
  
      if(is_array($tweet['entities']['user_mentions'])){
        foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
          $the_tweet = preg_replace(
            '/@'.$user_mention['screen_name'].'/i',
            '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
            $the_tweet);
        }
      }
  
      if(is_array($tweet['entities']['hashtags'])){
        foreach($tweet['entities']['hashtags'] as $key => $hashtag){
          $the_tweet = preg_replace(
            '/#'.$hashtag['text'].'/i',
            '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
            $the_tweet);
        }
      }
  
      if(is_array($tweet['entities']['urls'])){
        foreach($tweet['entities']['urls'] as $key => $link){
          $the_tweet = preg_replace(
            '`'.$link['url'].'`',
            '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
            $the_tweet);
        }
      }
  
      echo '<li>'.$the_tweet;
  
      // echo '
      // <div class="twitter_intents">
      //   <p><a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a></p>
      //   <p><a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a></p>
      //   <p><a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a></p>
      // </div>';

      echo '
      <p class="date">
        <a href="https://twitter.com/boldnebraska/status/'.$tweet['id_str'].'" target="_blank">
          '.date('F jS, Y',strtotime($tweet['created_at']. '- 8 hours')).'
        </a>
      </p>
      </li>';// -8 GMT for Pacific Standard Time
    }
  }
    echo '</ul>';

} ?>

</div>
