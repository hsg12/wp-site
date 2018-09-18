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
          <?php
            $attachmentsCount = count($attachments) - 1;
            for ( $i = 0; $i <= $attachmentsCount; $i++ ) : 
            $active = $i == 0 ? 'active' : '';

            $n = $i == $attachmentsCount ? 0 : $i + 1;
            $nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );

            $p = $i == 0 ? $attachmentsCount : $i - 1;
            $prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );
          ?>
            
          <div class="carousel-item <?php echo $active ?>" >
            <img class="d-block w-100" src="<?php echo wp_get_attachment_url( $attachments[$i]->ID ); ?>" alt="" height='500'>

            <div class="hide next-image-preview" data-image="<?php echo $nextImg; ?>"></div>
            <div class="hide prev-image-preview" data-image="<?php echo $prevImg; ?>"></div>
          </div>

          <?php endfor; ?>
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
