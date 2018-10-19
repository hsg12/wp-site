<?php 
  if ( ! is_active_sidebar( 'sunset_sidebar' ) ) {
    return;
  }
?>

<aside id="secondary" class="widget_area" role="complementary">
  
  <?php dynamic_sidebar( 'sunset_sidebar' ); ?>

</aside>