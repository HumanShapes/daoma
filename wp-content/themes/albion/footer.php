    <section id="dashboard">
      <hr>
      <div class="social">
        <?php get_template_part( 'partials/feed', 'twitter' ); ?>
        <div class="flickr">
          <header>
            <h3><a href="http://www.flickr.com/photos/boldnebraska/">Latest on Flickr</a></h3>
          </header>
          <?php echo do_shortcode('[slickr-flickr]'); ?>
        </div>
        <div class="other">
          <div class="fb-like-box" data-href="https://www.facebook.com/BoldNebraska" data-width="283" data-height="200" data-show-faces="true" data-stream="false" data-show-border="false" data-header="false"></div>
          <?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-nav', 'theme_location' => 'footer_primary' ) ); ?>
          <address><strong>BOLD Nebraska</strong><br>208 S. Burlington Ave., Ste 103, Box 325, Hastings, NE 68901</address>
        </div>
      </div>
      <div class="bold-logos">
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
        <div class="b-logo-column"><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div><div class="b-logo"><i></i></div></div>
      </div>
      <footer id="main-footer">
        <div class="container">
          <p>BOLD Nebraska &copy;2013. All Rights Reserved.</p>
          <?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => false, 'theme_location' => 'bold_links' ) ); ?>
        </div>
      </footer>
    </section>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=177839069016831";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Modernizr.load({
    //   test: Modernizr.input.placeholder,
    //   yep: console.log('yep'),
    //   nope: [
    //           'css/vendor/placeholder_polyfill.css',
    //           'js/vendor/placeholder_polyfill.min.js'
    //         ]
    // });
    </script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/js/compiled.js" async></script>
    <?php wp_footer(); ?>
  </body>
</html>