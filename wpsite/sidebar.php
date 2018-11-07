<?php 
  if ( ! is_active_sidebar( 'sunset_sidebar' ) ) {
    return;
  }
?>

<aside id="secondary" class="widget_area" role="complementary">
  <div class="d-block d-sm-none">
    <?php 
      wp_nav_menu( array(
        'theme_location'  => 'primary',
        'container'       => false,
        'container_class' => false,
        'menu_class'      => 'navbar-nav mr-auto navbar-collapse',
        'walker'          => new Bootstrap_NavWalker,
      ) ); 
    ?>
  </div>
  
  <?php dynamic_sidebar( 'sunset_sidebar' ); ?>

</aside>