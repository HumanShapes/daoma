<?php get_header(); ?>
  <section class="primary">
    <h1 class="section-headline"><?php the_title(); ?><?php edit_post_link(' Edit', '<small>', '</small>'); ?></h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
    <article class="article-layout">
      <div class="wrap">
        <header>
          <h1><?php echo get_the_excerpt(); ?></h1>
        </header>
        <div class="content">
          <?php the_content(); ?>
        </div>
      </div>
    </article>
    <?php endwhile; endif; ?>
  </section>
<?php get_footer(); ?>