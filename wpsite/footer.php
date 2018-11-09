<?php
/*
  This is the template for the footer
  @package wp-site
*/
?>
  <footer class="sunset-footer">
    <div class="container">
      <div class="footer-outer">
        <div class="footer-menu">
          <?php 
            wp_nav_menu( array(
              'theme_location'  => 'primary',
              'container'       => false,
              'container_class' => false,
              'menu_class'      => 'list-unstyled',
              'walker'          => new Bootstrap_NavWalker,
            ) ); 
          ?>
        </div>
        <div class="footer-logo"> 
          <a href="<?php bloginfo( 'url' )?>">
            <span class="sunset-logo sunset-icon"></span>
            <?php bloginfo( 'name' )?>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <a id="back-to-top" 
     href="#" 
     class="btn btn-outline-secondary btn-lg back-to-top" 
     role="button" 
     data-toggle="tooltip" 
     data-placement="left">
      <i class="fa fa-arrow-up"></i>
  </a>

  <?php wp_footer(); ?>
  </body>
</html>
