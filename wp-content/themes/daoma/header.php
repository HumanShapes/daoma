<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php $site_description = get_bloginfo( 'description', 'display' ); ?>
    <title><?php
    global $page, $paged;
    wp_title( '|', true, 'right' );
    bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      echo " | $site_description";
    if ( $paged >= 2 || $page >= 2 )
      echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
    ?></title>

    <meta name="description" content="<?php echo $site_description; ?>">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#333333">
    <meta name="apple-mobile-web-app-title" content="daOMA">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-icon-57x57-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-icon-72x72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-icon-114x114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-icon-144x144-precomposed.png" />

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <script>
    /* grunticon Stylesheet Loader | https://github.com/filamentgroup/grunticon | (c) 2012 Scott Jehl, Filament Group, Inc. | MIT license. */
    window.grunticon=function(e){if(e&&3===e.length){var t=window,n=!!t.document.createElementNS&&!!t.document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect&&!!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1"),A=function(A){var o=t.document.createElement("link"),r=t.document.getElementsByTagName("script")[0];o.rel="stylesheet",o.href=e[A&&n?0:A?1:2],r.parentNode.insertBefore(o,r)},o=new t.Image;o.onerror=function(){A(!1)},o.onload=function(){A(1===o.width&&1===o.height)},o.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="}};
    grunticon( [ "", "<?php echo get_stylesheet_directory_uri(); ?>/style.data.png.css", "<?php echo get_stylesheet_directory_uri(); ?>/style.fallback.css" ] );</script>
    <noscript><link href="<?php echo get_stylesheet_directory_uri(); ?>/style.fallback.css" rel="stylesheet"></noscript>

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

    <meta property="og:title" content="<?php if(is_home() || is_front_page()) : bloginfo( 'name' ); else : the_title(); endif; ?>">
    <meta property="og:image" content="<?php bloginfo( 'template_directory' ); ?>/images/daoma-fb.png">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:description" content="<?php echo $site_description; ?>">

    <script>
      var config = {
        kitId: 'yfu3euq',
        scriptTimeout: 3000
      };
      var h=document.getElementsByTagName("html")[0];h.className+=" wf-loading";var t=setTimeout(function(){h.className=h.className.replace(/(\s|^)wf-loading(\s|$)/g," ");h.className+=" wf-inactive"},config.scriptTimeout);var tk=document.createElement("script"),d=false;tk.src='//use.typekit.net/'+config.kitId+'.js';tk.type="text/javascript";tk.async="true";tk.onload=tk.onreadystatechange=function(){var a=this.readyState;if(d||a&&a!="complete"&&a!="loaded")return;d=true;clearTimeout(t);try{Typekit.load(config)}catch(b){}};var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(tk,s)
    </script>

    <!--[if lt IE 9]>
      <script src="<?php bloginfo( 'template_directory' ); ?>/js/vendor/html5shiv.js"></script>
    <![endif]-->
    <script src="<?php bloginfo( 'template_directory' ); ?>/js/vendor/modernizr.js"></script>
  	<?php wp_head(); ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-46952901-1', 'daoma.org');
      ga('send', 'pageview');

    </script>
  </head>
  <body <?php body_class(); ?>>
    <nav id="main-nav" role="navigation">
      <h1 id="logo"><a href="/" title="Home">design alliance Omaha</a></h1>
      <div id="nav-icon" role="button" title="Navigate">
        <span class="mobile-icon">&nbsp;</span>
        <span class="mobile-icon">&nbsp;</span>
        <span class="mobile-icon">&nbsp;</span>
      </div>
      <?php wp_nav_menu( array( 'container' => 'nav', 'container_id' => 'main-nav', 'theme_location' => 'primary_nav' ) ); ?>
    </nav>
    <div class="fadein_interior">
