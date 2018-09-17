<?php
/*
  @package wp-site

  Gallery Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-gallery' ); ?>>

  <header class="entry-header text-center">

    <?php if (sunset_get_gallery_attachment()) : $attachments = sunset_get_gallery_attachment(7); ?>

      <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators active">
              
          <?php 
            $i = 0;
            foreach ( $attachments as $attachment ) :  
          ?>
              
          <li data-target="#post-gallery-<?php the_ID(); ?>" data-slide-to="<?php echo $i; ?>" class=""></li>
  
          <?php $i++; endforeach; ?>  
        </ol>

        <div class="carousel-inner">
          <?php
            $i = 0;
            foreach ( $attachments as $attachment ) : 
            $active = $i == 0 ? 'active' : '';
          ?>
            
          <div class="carousel-item <?php echo $active ?>" >
            <img class="d-block w-100" src="<?php echo wp_get_attachment_url( $attachment->ID ); ?>" alt="" height='500'>
          </div>

          <?php
            $i++;
            endforeach; 
          ?>
        </div><!-- .carousel-inner -->

        <a class="carousel-control-prev" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
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
