<?php
/*
  @package wp-site

  Audio Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-audio' ); ?>>

  <header class="entry-header">
    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    <div class="entry-meta">
      <?php echo sunset_posted_meta(); ?>
    </div>
  </header>

  <div class="entry-content text-center">
    <?php echo sunset_get_embedded_media( array( 'audio', 'iframe' ) ) ?>
  </div><!-- .entry-content -->
  
  <footer class="entry-footer">
    <?php echo sunset_posted_footer(); ?>
  </footer>

</article>
