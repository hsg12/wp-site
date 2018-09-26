<?php
/*
  @package wp-site

  Aside Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-aside' ); ?>>

  <div class="aside-container">
    <div class="row">
      <div class="col-12 col-sm-3 col-md-3 col-lg-2 text-center">

        <?php if ( has_post_thumbnail() ) : ?>
          <?php $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )) ?>
          <div class="aside-featured background-image" style="background-image: url(<?php echo $featured_image; ?>);"></div>
        <?php endif; ?>

      </div><!-- .col-lg-3 -->

      <div class="col-12 col-sm-9 col-md-9 col-lg-10">

        <header class="entry-header">
          <div class="entry-meta">
            <?php echo sunset_posted_meta(); ?>
          </div>
        </header>

        <div class="entry-content">
          <div class="entry-excerpt">
            <?php the_content(); ?>
          </div>
        </div>
        
      </div><!-- .col-lg-9 -->
    </div>

    <footer class="entry-footer">
      <div class="row">
        <div class="col-12 col-sm-9 offset-sm-3 col-md-9 offset-md-3 col-lg-10 offset-lg-2">
          <?php echo sunset_posted_footer(); ?>
        </div>
      </div>
    </footer>
  </div><!-- .aside-container -->
</article>
