<?php get_header(); ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
    <section class="interior" style="border-bottom: none;"> <!-- TODO: Remove and figure out style settings -->
      <div class="wrapper">
        <h2 class="column"><?php the_title(); ?><?php edit_post_link(' Edit', '<small>', '</small>'); ?></h2>
        <div class="content">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <?php the_content(); ?>
          <?php endwhile; endif; ?>
        </div>
      </div>
    </section>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>