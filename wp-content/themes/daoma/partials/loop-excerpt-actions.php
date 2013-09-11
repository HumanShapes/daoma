<?php
  global $post;
  $actionRedirectUrl = get_post_meta($post->ID, 'bold_action_redirect_url', true);

  //Returns Array of Term Names for "my_term"
  $term_list = wp_get_post_terms($post->ID, 'action_types', array("fields" => "all"));
  //print_r($term_list);
  if ($term_list) {
    $actionTypeName = $term_list[0]->name;
    $actionTypeSlug = $term_list[0]->slug;
    $term_link = get_term_link( $actionTypeSlug, 'action_types' );
  } else {
    $actionTypeName = 'Event';
    $actionTypeSlug = 'event';
    $term_link = get_term_link( 'event', 'action_types' );
  }
?>
<article class="action type-<?php echo $actionTypeSlug; ?>">
  <?php if ( has_post_thumbnail() ) { ?>
    <figure class="hero">
      <?php the_post_thumbnail('oneandonefourth'); ?>
    </figure>
  <?php } ?>
  <div class="wrap">
    <?php if ( $actionTypeName ) { ?>
      <p class="category"><a href="<?php echo $term_link; ?>"><?php echo $actionTypeName; ?></a></p>
    <?php } ?>
    <h1>
      <?php if ( $actionRedirectUrl ) { ?>
        <a href="<?php echo $actionRedirectUrl; ?>"><?php the_title(); ?></a>
      <?php } else {
        the_title();
      }?>
    </h1>
    <div class="entry-details">
      <i></i>
      <p>
        <?php get_template_part( 'partials/action', 'details' ); ?>
      </p>
    </div>
    <div class="content">
      <p>
        <?php echo get_the_excerpt(); ?>
        <?php if ( $actionRedirectUrl ) { ?>
          <a href="<?php echo $actionRedirectUrl; ?>">Visit this Action</a>
        <?php } ?>
      </p>
    </div>
    <aside class="article-toolbar">
      <?php get_template_part( 'partials/social', 'share' ); ?>
    </aside>
  </div>
</article> <!-- End of article -->