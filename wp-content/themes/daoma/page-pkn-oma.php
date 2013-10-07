<?php get_header(); ?>
<section  class="interior">
  <div class="wrapper">
    <h2 class="column"><?php the_title(); ?> <?php edit_post_link(' Edit', '<small>', '</small>'); ?></h2>
    <div class="content">
      <p>Pecha Kucha Night was devised in Tokyo in February 2003 as an event for young designers to meet, network, and show their work in public. It has turned into a massive celebration, with events happening in hundreds of cities around the world, inspiring creatives worldwide. Drawing its name from the Japanese term for the sound of “chit chat,” it rests on a presentation format that is based on a simple idea: 20 images x 20 seconds. It’s a format that makes presentations concise, and keeps things moving at a rapid pace.</p>
    </div>
  </div>
</section>
<!--parallax-->
<section class="imagebreak">
  <div class="triangle1-med" data-type="background" data-speed="-10"></div>
  <img src="<?php bloginfo( 'template_directory' ); ?>/images/page-pkn.jpg" alt="PKN-OMA">
</section>
<div class="activities">
  <section class="interior">
    <div class="wrapper">
      <h2 class="column"> Past Events</h2>
      <div class="content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
