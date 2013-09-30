    <footer>
      <nav>
        <h6 id="ftr-logo"><a href="/">design alliance Omaha</a></h6>
        <ul>
          <li class="next"><a href="partners.html">Partners</a></li>
          <li class="facebook"><a href="https://www.facebook.com/pages/daOMA-design-alliance-OMAha-Inc/304226363724?fref=ts">Facebook</a></li>
          <li class="twitter"><a href="">Twitter</a></li>
        </ul>
      </nav>
    </footer>
  <!-- fade in end-->
  </div>
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
  <script src="<?php bloginfo( 'template_directory' ); ?>/js/compiled.js" async></script><!-- TODO: Add the compiled.min.js once done developing -->
  <?php wp_footer(); ?>
</body>
</html>