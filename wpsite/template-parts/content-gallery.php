<?php
/*
  @package wp-site

  Gallery Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-gallery' ); ?>>

  <header class="entry-header text-center">

    <?php if (sunset_get_gallery_attachment()) : $attachments = sunset_get_gallery_attachment(7); ?>

      <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide sunset-carousel-thumb" data-ride="carousel">

        <div class="carousel-inner">
          <?php $attachments = sunset_get_bs_slides( $attachments ); ?>
          <?php foreach ( $attachments as $attachment ) : ?>
            
          <div class="carousel-item <?php echo $attachment['class']; ?>" >
            <img class="d-block w-100" src="<?php echo $attachment['url']; ?>" alt="" height='500'>

            <div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
            <div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>

            <div class="entry-excerpt text-center image-caption">
              <div><?php echo $attachment['caption']; ?></div>
            </div>
          </div>

          <?php endforeach; ?>
        </div><!-- .carousel-inner -->

        <a class="left carousel-control-prev carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
          <div class="preview-container">
            <span class="thumbnail-container background-image"></span>
            <span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </div>
        </a>
        <a class="right carousel-control-next carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
          <div class="preview-container">
            <span class="thumbnail-container background-image"></span>
            <span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </div>
        </a>
      </div><!-- .carousel -->
      
    <?php endif; ?>

    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    <div class="entry-meta">
      <?php echo sunset_posted_meta(); ?>
    </div>
  </header>

  <div class="entry-content">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )) ?>

      <a href="<?php the_permalink(); ?>" class="standard-featured-link">
        <div class="standard-featured" style="background-image: url(<?php echo $featured_image; ?>);"></div>
      </a>
    <?php endif; ?>
    <div class="entry-excert text-center">
      <?php the_excerpt(); ?>
    </div>
    <div class="button-container text-center">
      <a href="<?php the_permalink(); ?>" class="btn-sunset"><?php _e( 'Read More' ); ?></a>
    </div>
  </div><!-- .entry-content -->
  
  <footer class="entry-footer">
    <?php echo sunset_posted_footer(); ?>
  </footer>

</article>
