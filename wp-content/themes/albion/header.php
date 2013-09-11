<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Bold Nebraska</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

  	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

    <script>
      var config = {
        kitId: 'yfu3euq',
        scriptTimeout: 3000
      };
      var h=document.getElementsByTagName("html")[0];h.className+=" wf-loading";var t=setTimeout(function(){h.className=h.className.replace(/(\s|^)wf-loading(\s|$)/g," ");h.className+=" wf-inactive"},config.scriptTimeout);var tk=document.createElement("script"),d=false;tk.src='//use.typekit.net/'+config.kitId+'.js';tk.type="text/javascript";tk.async="true";tk.onload=tk.onreadystatechange=function(){var a=this.readyState;if(d||a&&a!="complete"&&a!="loaded")return;d=true;clearTimeout(t);try{Typekit.load(config)}catch(b){}};var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(tk,s)
    </script>

    <script src="<?php bloginfo( 'template_directory' ); ?>/js/vendor/modernizr.js"></script>
  	<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header id="main-header">
      <div class="container">
        <h1 id="logo"><a href="/" title="Home">BOLD Nebraska</a></h1>
        <a href="#main-nav" class="mobile-menu-icon">Jump to navigation</a>
        <?php wp_nav_menu( array( 'container' => 'nav', 'container_id' => 'main-nav', 'theme_location' => 'primary_nav' ) ); ?>
      </div>
      <div class="utility-nav">
        <div class="container">
          <div id="popular">
            <p>Popular</p>
            <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'popular_posts' ) ); ?>
            <?php
              if ( current_user_can('edit_theme_options') ) {
                echo '<a class="admin-edit" href="/wp-admin/nav-menus.php?action=edit&menu=10" target="_blank">Edit</a>';
              }
            ?>
          </div>
          <div class="wrap">
            <nav>
              <ul>
                <li id="signup"><a href="/#newsletter"><span class="hide">Email</span> Signup</a></li>
                <li id="about">
                  <p>About</p>
                  <?php wp_nav_menu( array( 'container' => '', 'container_class' => false, 'theme_location' => 'bold_links' ) ); ?>
                  <?php
                    if ( current_user_can('edit_theme_options') ) {
                      echo '<a class="admin-edit" href="/wp-admin/nav-menus.php?action=edit&menu=11" target="_blank">Edit</a>';
                    }
                  ?>
                </li>
                <li id="follow">
                  <p>Follow Us</p>
                  <?php wp_nav_menu( array( 'container' => '', 'container_class' => false, 'theme_location' => 'follow_us' ) ); ?>
                  <?php
                    if ( current_user_can('edit_theme_options') ) {
                      echo '<a class="admin-edit" href="/wp-admin/nav-menus.php?action=edit&menu=13" target="_blank">Edit</a>';
                    }
                  ?>
                </li>
              </ul>
            </nav>
            <form role="search" id="search" action="/" method="get" >
              <label for="search-wdgt">Search</label>
              <input type="text" id="search-wdgt" name="s" placeholder="Search" >
              <input type="submit" id="search-submit" value="Search">
            </form>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </header>
    <div id="mobile-nav">
      <ul>
        <li class="mobile-nav-home"><a href="/" title="Home"><strong>BOLD Nebraska</strong></a></li>
        <?php wp_nav_menu_no_ul('primary_nav'); ?>
        <li id="signup"><a href=""><span class="hide">Email</span> Signup</a></li>
        <li id="about"><strong>About</strong></li>
        <?php wp_nav_menu_no_ul('bold_links'); ?>
        <li id="follow"><strong>Follow Us</strong></li>
        <?php wp_nav_menu_no_ul('follow_us'); ?>
      </ul>
    </div>