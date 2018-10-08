<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="container">
      <?php if ( have_posts() ) : ?>
        
          <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/single', get_post_format() ) ?>

            <?php the_post_navigation(); ?>
            
            <?php 
              if ( comments_open()) {
                comments_template();
              }
            ?>

          <?php endwhile; ?>

      <?php endif; ?>
    </div><!-- .container -->

  </main>
</div><!-- #primary -->

<?php get_footer(); ?>
