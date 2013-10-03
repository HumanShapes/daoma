<?php get_header(); ?>
  <div class="fadeout_opening"></div>
  <?php
    // The Loop
    $args = array(
      'post_type' => 'events',
      'hs_event_types' => 'Homepage Cover',
      'posts_per_page' => 1
    );
    $eventFeature = new WP_Query( $args );
    if ( $eventFeature->have_posts() ) : while ( $eventFeature->have_posts() ) : $eventFeature->the_post();
      global $post;
      $daomaEventDate = get_post_meta($post->ID, 'hs_daoma_event_date', true);
      $daomaEventDatePretty = get_post_meta($post->ID, 'hs_daoma_event_date_pretty', true);
      $daomaEventTime = get_post_meta($post->ID, 'hs_daoma_event_time', true);
      $daomaEventLocation = get_post_meta($post->ID, 'hs_daoma_event_location', true);
      $daomaEventPrice = get_post_meta($post->ID, 'hs_daoma_event_price', true);
      $daomaTicketURL = get_post_meta($post->ID, 'hs_daoma_ticket_url', true);
      $daomaEventLocation = get_post_meta($post->ID, 'hs_daoma_event_location', true);
      $daomaSpeakerCity = get_post_meta($post->ID, 'hs_daoma_speaker_city', true);
      $daomaSpeakerTitle = get_post_meta($post->ID, 'hs_daoma_speaker_title', true);
      $daomaSpeakerBio = get_post_meta($post->ID, 'hs_daoma_speaker_bio', true);
      $hasFeature = true;
    ?>
    <section id="hero">
      <?php if ( has_post_thumbnail() ) { ?>
        <?php $postThumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); ?>
        <div class="content" style="background-image: url(<?php echo $postThumbURL['0']; ?>);">
      <?php } else { ?>
        <div class="content">
      <?php } ?>
        <div class="shape-circles-up right" data-type="background" data-speed="1"></div>
        <div class="shape-circles-down" data-type="background" data-speed="-1"></div>
        <a href="<?php the_permalink(); ?>" title="View Event Details">
          <div class="wrapper" id="hero-details">
            <div class="details">
              <h1>
                <?php the_title(); ?><br>
                <strong>
                  <?php if ($daomaSpeakerCity) { ?>
                    <?php echo $daomaSpeakerCity; ?> <span>></span>
                  <?php } ?>
                  OMA
                </strong>
              </h1>
              <?php if ($daomaSpeakerTitle) { ?>
                <h3><?php echo $daomaSpeakerTitle; ?></h3>
              <?php } ?>
              <p>
                <?php echo $daomaEventDatePretty; ?>
                <?php if ( $daomaEventTime ) { ?>
                  at <?php echo $daomaEventTime; ?>
                <?php } ?>
                <br />
                <?php echo $daomaEventLocation; ?>
                <br />
                <?php echo $daomaEventPrice; ?>
              </p>
            </div>
          </a>
        </div>
      </div>
      <!--
        TODO: How would these work in WP? Is there a clean way to do this? Should we just grab the first two image attachements (that aren't the cover photo or speaker portrait)?
        <div class="sub-content">
          <img src="img/event-austinHowe_book.jpg" alt="">
          <img src="img/event-austinHowe_book.jpg" alt="">
        </div>
      -->
      <div class="info wrapper">
        <p><a href="<?php the_permalink(); ?>" title="View Event"><?php the_title(); ?></a> <?php echo $daomaSpeakerBio; ?></p>
        <?php if ($daomaTicketURL) { ?>
          <p><a class="btn" href="<?php echo $daomaTicketURL; ?>" tite="Register">RSVP</a></p>
        <?php } ?>
      </div>
    </section>
    <section id="about" class="interior">
      <div class="wrapper">
        <h1>Design, in the middle<br>of everywhere.</h1>
        <p>daOMA is about design in all forms and the education and community that perpetuate it. This is accomplished by fostering a continuing and challenging public discourse on the design disciplines and their relationship to our cities, workplace, home and culture.</p>
      </div>
    </section>
  <?php endwhile; else : ?>
    <section id="about-feature" class="">
      <div class="content-wrap">
        <div class="shape-circles-up right" data-type="background" data-speed="1"></div>
        <div class="shape-circles-down" data-type="background" data-speed="-1"></div>
        <div class="content">
          <h1 class="wrapper">Design,<br>in the middle<br>of everywhere.</h1>
        </div>
      </div>
      <div class="interior wrapper">
        <p>daOMA is about design in all forms and the education and community that perpetuate it. This is accomplished by fostering a continuing and challenging public discourse on the design disciplines and their relationship to our cities, workplace, home and culture.</p>
      </div>
    </section>
  <?php endif; ?>

  <?php
    // Only highlight upcoming speaker if there isn't one featured
    if (!$hasFeature) {
      // The Loop

      $today = date(DATE_ATOM);
      $endDate = date(DATE_ATOM, strtotime("+355 days"));

      global $wpdb;
      $querystr = "
         SELECT wposts.*
         FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
         WHERE wposts.ID = wpostmeta.post_id
         AND wpostmeta.meta_key = 'hs_daoma_event_date'
         AND wpostmeta.meta_value >= '$today'
         AND wpostmeta.meta_value < '$endDate'
         AND wposts.post_status = 'publish'
         AND wposts.post_type = 'events'
         ORDER BY wpostmeta.meta_value ASC
      ";
      $upcomingevents = $wpdb->get_results($querystr, OBJECT);
      // Start Displaying the Calendar
      $dates = array();
      if ($upcomingevents) {
          foreach ($upcomingevents as $post) {
          global $post;
          if( has_term( 'speaker', 'hs_event_types' ) ) {
            $daomaEventDate = get_post_meta($post->ID, 'hs_daoma_event_date', true);
            $daomaEventDatePretty = get_post_meta($post->ID, 'hs_daoma_event_date_pretty', true);
            $daomaEventTime = get_post_meta($post->ID, 'hs_daoma_event_time', true);
            $daomaEventLocation = get_post_meta($post->ID, 'hs_daoma_event_location', true);
            $daomaEventPrice = get_post_meta($post->ID, 'hs_daoma_event_price', true);
            $daomaTicketURL = get_post_meta($post->ID, 'hs_daoma_ticket_url', true);
            $daomaEventLocation = get_post_meta($post->ID, 'hs_daoma_event_location', true);
            $daomaSpeakerCity = get_post_meta($post->ID, 'hs_daoma_speaker_city', true);
            $daomaSpeakerTitle = get_post_meta($post->ID, 'hs_daoma_speaker_title', true);
            $daomaSpeakerBio = get_post_meta($post->ID, 'hs_daoma_speaker_bio', true);
      ?>

      <section class="featured-event interior">
        <article class="wrapper">
          <div class="hero">
            <?php if ( has_post_thumbnail() ) { ?>
              <?php the_post_thumbnail('fivebytwo'); ?>
            <?php } ?>
            <h1>
              <strong>
                <?php if ($daomaSpeakerCity) { ?>
                  <?php echo $daomaSpeakerCity; ?> <span>></span>
                <?php } ?>
              OMA
              </strong>
              <br /><?php the_title(); ?>
            </h1>
          </div>
          <div class="content-wrap">
            <div class="column info">
              <p>
                <?php if ($daomaSpeakerTitle) { ?>
                  <strong><?php echo $daomaSpeakerTitle; ?></strong><br />
                <?php } ?>
                <?php echo $daomaEventDatePretty; ?>
                <?php if ( $daomaEventTime ) { ?>
                  at <?php echo $daomaEventTime; ?>
                <?php } ?>
                <br />
                <?php echo $daomaEventLocation; ?>
                <br />
                <?php echo $daomaEventPrice; ?>
              </p>
              <p><a class="btn" href="<?php echo $daomaTicketURL; ?>" tite="Register">RSVP</a></p>
            </div>
            <p class="content description"><a href="<?php the_permalink(); ?>" title="View Event"><?php the_title(); ?></a> <?php echo $daomaSpeakerBio; ?></p>
          </div>
        </article>
      </section>
  <?php } } } } ?>

  <section class="interior upcoming">
    <div class="wrapper">
      <h2>Upcoming Events</h2>
      <?php
        // First show upcoming events
        $today = date(DATE_ATOM);
        global $wpdb;
        $querystr = "
           SELECT wposts.*
           FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
           WHERE wposts.ID = wpostmeta.post_id
           AND wpostmeta.meta_key = 'hs_daoma_event_date'
           AND wpostmeta.meta_value >= '$today'
           AND wposts.post_status = 'publish'
           AND wposts.post_type = 'events'
           ORDER BY wpostmeta.meta_value ASC
        ";
        $pageposts = $wpdb->get_results($querystr, OBJECT);
        // Start Displaying the Calendar
        $dates = array();
        $count = 0;
        if ($pageposts) :
          global $post;
          foreach ($pageposts as $post) {
            $count++;
            get_template_part( 'partials/event', 'calendar');
          }
        endif;
        // Then show TBD events
        global $wpdb;
        $querystr = "
           SELECT wposts.*
           FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
           WHERE wposts.ID = wpostmeta.post_id
           AND wpostmeta.meta_key = 'hs_daoma_event_date'
           AND wpostmeta.meta_value = ''
           AND wposts.post_status = 'publish'
           AND wposts.post_type = 'events'
           ORDER BY wpostmeta.meta_value ASC
        ";
        $pageposts = $wpdb->get_results($querystr, OBJECT);
        $dates = array();
        if ($pageposts) :
          global $post;
          foreach ($pageposts as $post) {
            $count++;
            get_template_part( 'partials/event', 'calendar');
          }
        endif;
        if (!$count) {
          echo "<div class='day noEvents'><p>No Upcoming Events</p></div>";
        }
      ?>
    </div>
  </section>

  <section class="past-speakers">
    <div data-type="background" data-speed="-10"></div>
    <div class="wrapper">
      <h2>Past Speakers</h2>
      <p>daOMA has established a world class lecture series that has brought many of the world’s best architects and designers to the city of Omaha and the state of Nebraska for the first time.</p>
    </div>
    <div class="speaker-list">
      <ul>
        <?php
        $today = date(DATE_ATOM);
        global $wpdb;
        $querystr = "
           SELECT wposts.*
           FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
           WHERE wposts.ID = wpostmeta.post_id
           AND wpostmeta.meta_key = 'hs_daoma_event_date'
           AND wpostmeta.meta_value < '$today'
           AND wposts.post_status = 'publish'
           AND wposts.post_type = 'events'
           ORDER BY wpostmeta.meta_value DESC
        ";
        $pageposts = $wpdb->get_results($querystr, OBJECT);
        // Start Displaying the Calendar
        $dates = array();
        $count = 0;
        if ($pageposts) :
          foreach ($pageposts as $post) {
            setup_postdata($post);
            $daomaEventDate = get_post_meta($post->ID, 'hs_daoma_event_date', true);
            $daomaSpeakerCity = get_post_meta($post->ID, 'hs_daoma_speaker_city', true);
            if ( (has_term( 'speaker', 'hs_event_types')) && ($daomaEventDate) ) { ?>
              <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php
                    if (class_exists('MultiPostThumbnails')) :
                      MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'speaker-portrait', null, 'fourbytwo');
                    endif;
                  ?>
                  <p>
                    <?php if ($daomaSpeakerCity) { ?>
                      <?php echo $daomaSpeakerCity; ?> <span>></span>
                    <?php } ?>
                    OMA
                  </p>
                </a>
              </li>
        <?php  } } endif; ?>
      </ul>
    </div>
  </section>

  <!--parallax-->
  <section class='imagebreak border'>
    <!-- TODO: Make this with multiple small triangles -->
    <div class="triangle3" data-type="background" data-speed="-10"></div>
    <img src="<?php bloginfo('template_directory');?>/images/oma.png" alt="Omaha, NE">
  </section>

  <section class="classification">
    <div class="wrapper">
        <h5>The Anthropologic Classification of the Nebraska Creative Class</h5>
        <p>Each of these classes in and of themselves is strong, but it is their symbiosis that creates the fertile environment that positions the state and community to experience a renaissance of significance in the coming decade. The cooperative nature of a two-way support system that has been created and nurtured continues to grow allowing for a greater draw and retention of these types in our community and state.</p>
    </div>
  </section>
  <section class="creative-class">
    <div class="wrapper">
      <h3 class="one">Stalwart Native</h3>
      <div class="content">
        <p>The native Nebraskan that has maintained a steadfast commitment to their community translating their work/art through a strict interpretation of native influences around them.</p>
      </div>
    </div>
  </section>
  <section class="creative-class">
    <div class="wrapper">
      <h3 class="two">Pioneer Traditionalist</h3>
      <div class="content">
        <p>In the classic sense of pioneer families that sent their sons and daughters to the coasts to learn and experience the world, but with the full intention of returning and making a contribution to their native home.</p>
      </div>
    </div>
  </section>
  <section class="creative-class">
    <div class="wrapper">
      <h3 class="three">Tethered<br>Ex&ndash;Patriot</h3>
      <div class="content">
        <p>Born, raised and influenced by Nebraska these outstanding talents have left to represent. Flexible but strong roots allow them to travel the world, but as far as they roam the world around us they maintain a connection to the state and their communities serving as cultural ambassadors, but also as conduits of the influence that allow us to keep pace and reduce the traditional lag from coast to plains.</p>
      </div>
    </div>
  </section>
  <section class="creative-class">
    <div class="wrapper">
      <h3 class="four">Inquisitive<br>Import</h3>
      <div class="content">
        <p>Something or someone convinced these talents to travel to the middle of the country. Here they found a new home and opportunity. What might have began as a 3 year experimental stay has turned into a decade(s) of contribution and service.</p>
      </div>
    </div>
  </section>

  <section class="interior distance">
    <div class="wrapper">
      <div class="content">
        <p class="label">Middle of Everywhere</p>
        <p class="city">
          <span>Toronto</span>
          <button class="refresh" name="refresh">refresh</button>
        </p>
      </div>
      <p class="miles"><strong>976.2</strong><br>miles</p>
    </div>
  </section>
<?php get_footer(); ?>
