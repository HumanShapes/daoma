<nav class="meta-filters">
  <ul>
    <form role="search" id="search" action="/" method="get" >
      <label for="search-wdgt">Search</label>
      <input type="text" id="search-wdgt" name="s" placeholder="Search" >
      <input type="submit" id="search-submit" value="Search">
    </form>
    <li>
      <a href="">The Latest</a>
      <ul>
        <li><a href="">Popular</a></li>
      </ul>
    </li>
    <li>
      <a href="">All Months</a>
      <ul>
        <?php echo wp_get_archives( array( 'type' => 'monthly', 'limit' => 12, 'echo' => 0 ) ); ?>
      </ul>
    </li>
    <li>
      <a href="">All Authors</a>
      <ul>
        <?php wp_list_authors('show_fullname=1&orderby=post_count'); ?>
      </ul>
    </li>
    <li>
      <a href="">All Tags</a>
      <ul>
      <?php $tags = get_tags();
        if ($tags) {
          foreach ($tags as $tag) {
            echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name.'</a> </li> ';
          }
        }
      ?>
      </ul>
    </li>
  </ul>
</nav>
