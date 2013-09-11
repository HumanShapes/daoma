<section class="calendar" id="events">
  <h1 class="section-headline">Events</h1>
  <div class="posts">
    <div class="wrap">
      <?php
        // Create an array of the next 12 months
        $months = array();
        $currentMonth = (int)date('m');
        for($x = $currentMonth; $x < $currentMonth+12; $x++) {
          $monthYear[] = date('F Y', mktime(0, 0, 0, $x, 1));
          $months[] = date('F', mktime(0, 0, 0, $x, 1));
        }
        // Echo the base HTML that will have events added with JS
        foreach ($months as $key=>$val) {
          echo '<div class="month month-'.$key.'" rel="'.$months[$key].'"><h2>'.$monthYear[$key].'</h2><ul></ul></div>';
        }
      ?>
      <div class="event-data">
        <?php bold_events_calendar(); ?>
      </div>
    </div>
    <nav class="next-prev">
      <a href="#"><p class="btn-prev">Prev</p></a>
      <p class="msg">&nbsp;</p>
      <a href="#"><p class="btn-next">Mext</p></a>
    </nav>
  </div>
</section>
