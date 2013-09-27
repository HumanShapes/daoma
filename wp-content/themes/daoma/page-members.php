<?php get_header(); ?>
<header id="members">
  <div data-type="background" data-speed="1">
    <div class="wrapper">
      <div class="content">
        <h1>daOMA<br>MEMBERS</h1>
        <p>daOMA is an open forum for everyone non-professionals and professionals alike. Rooted in the intellectual and social foundations of design culture, daOMA’s primary mission is to expand and grow design appreciation and awareness. Central to this mission is the organizations core programs of public lectures and presentations featuring local, regional, and world renowned designers, critics, historians and patrons. Members are granted free admission to this lecture series and other daOMA&nbsp;events.</p>
      </div>
    </div>
  </div>
</header>

<section class="interior" style="border-bottom: none;"> <!-- TODO: Remove and figure out style settings -->
  <div class="wrapper">
    <h2 class="column">Current Members</h2>
    <div class="content">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>