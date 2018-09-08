<?php
/*
  @package wp-site

  Image Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-image' ); ?>>

  <?php

    $featured_image = sunset_get_attachment();
    
  ?>

  <header class="entry-header text-center" style="background-image: url(<?php echo $featured_image; ?>);">
    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    <div class="entry-meta">
      <?php echo sunset_posted_meta(); ?>
    </div>

    <div class="entry-excert text-center image-caption">
      <?php the_excerpt(); ?>
    </div>
  </header>

  <footer class="entry-footer">
    <?php echo sunset_posted_footer(); ?>
  </footer>

</article>
