<?php get_header(); ?>
<header id="join">
  <div data-type="background" data-speed="2">
    <div>
      <div class="wrapper">
        <div class="content">
          <h1>JOIN<br>daOMA</h1>
          <p>We will continue to push our state and community to become a better place to practice the art of architecture and design. We will continue to establish a community that will attract and help a new design generation flourish here in the beautiful region known as flyover country. Join daOMA and help support our mission.</p>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="interior single-column">
  <div class="wrapper">
    <div class="content">
      <p>It has always been our goal to provide lectures without ticketed admissions as a public service that advocates for the value of architecture and the design arts. We hope that you will embrace this philosophy, because without your support of our mission we would be unable to make such a bold move. We recognize the risk we assume, but it is a goal we have been working to achieve since daOMA was established in 2006. We hope that we can continue to count on the support of our members and patrons to make it happen again this season.</p>
      <br><br>
      <ul class="memberships">
        <li>
          <p><em>Student or Senior </em>$20 a year</p>
          <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="2046082">
              <input class="btn" type="submit" border="0" name="submit" value="Join">
              <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        <!-- <a class="btn" href="#">Join</a> --></p>
        </li>
        <li>
          <p><em>Member </em>$75 a year</p>
          <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="2046149">
              <input type="submit" value="Join" class="btn" name="submit">
              <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
          </p>
        </li>
        <li>
          <p><em>Friend </em>$150 a year</p>
          <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="2046159">
              <input type="submit" value="Join" class="btn" name="submit" alt="">
              <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
          </p>
        </li>
        <li>
          <p><em>Supporter </em>$300 a year</p>
          <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="2046722">
              <input type="submit" value="Join" class="btn" name="submit" alt="">
              <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
          </p>
        </li>
      </ul>
  </div>
</section>

<!--parallax-->
<section class="imagebreak">
  <div class="triangle1-med" data-type="background" data-speed="-10"></div>
  <img src="<?php bloginfo( 'template_directory' ); ?>/images/flyovergray.jpg" alt="">
</section>

<section class="interior">
  <div class="wrapper">
    <h2 class="column">Patron, Sponsor and<br>Benefactor Levels</h2>
    <div class="content">
      <p>To guarantee that significant contributions (Patron level and above) are tax deductible except for the fair market value of membership benefits please make your check payable to “design alliance OMAha”, a 501 (c)(3) non-profit organization. To become a member at Patron, Sponsor, Season Sponsor, or Season Benefactor levels, please send your name, address, city/state/zip, phone number and e-mail, along with a check for the amount of your selected commitment level, to:</p>
      <address>
        <h3>daOMA (design alliance OMAha, Inc.)</h3>
        <h4>17116 Burdette Street </h4>
        <h4>Omaha, NE 68116</h4>
      </address>
      <ul class="price">
        <li><em>Patron</em> $600 a year</li>
        <li><em>Sponsor</em> $2400 a year</li>
        <li><em>Season Sponsor</em> $1200 a year</li>
        <li><em>Season Benefactor</em> $5000 a year</li>
      </ul>
  </div>
</section>
<section class="interior">
  <div class="wrapper">
    <?php wp_nav_menu( array( 'container' => 'nav', 'container_id' => 'footer-nav', 'theme_location' => 'primary_nav' ) ); ?>
  </div>
</section>
<?php get_footer(); ?>
