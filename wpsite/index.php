<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="container sunset-posts-container">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'template-parts/content', get_post_format() ) ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div><!-- .container -->

    <div class="container text-center">
      <a href="#" class="btn btn-lg btn-default sunset-load-more" 
         data-page="1"
         data-url="<?php echo admin_url( 'admin-ajax.php' )?>"
      >
        <span class="sunset-icon sunset-loading"></span> Load More
      </a>
    </div><!-- .container -->
  </main>
</div><!-- #primary -->

<?php get_footer(); ?>
