<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php if ( have_posts() ) : ?>
            
              <?php while ( have_posts() ) : the_post(); ?>
                
                <!-- Every time post have been viewed, increase count in database -->
                <?php sunset_save_post_views( get_the_ID() ) ?>

                <?php get_template_part( 'template-parts/single', get_post_format() ) ?>

                <?php echo sunset_post_navigation(); ?>
                
                <?php 
                  if ( comments_open()) {
                    comments_template();
                  }
                ?>

              <?php endwhile; ?>

          <?php endif; ?>
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container -->

  </main>
</div><!-- #primary -->

<?php get_footer(); ?>
