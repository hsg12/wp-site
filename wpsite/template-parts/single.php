<?php
/*
  @package wp-site

  Single Post Template
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header text-center">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
    <div class="entry-meta">
      <?php echo sunset_posted_meta(); ?>
    </div>
  </header>

  <div class="entry-content clearfix"> 
      <?php the_content(); ?>  
  </div>
  
  <footer class="entry-footer">
    <?php echo sunset_posted_footer(); ?>
  </footer>

</article>
