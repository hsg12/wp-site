<?php
/*
  @package wp-site

  Page Template
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header text-center">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
  </header>

  <div class="entry-content clearfix"> 
      <?php the_content(); ?>  
  </div>

</article>
