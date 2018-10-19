<?php
/*
  This is the template for the header
  @package wp-site
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>

    <title><?php bloginfo( 'name' ); wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta charset="<?php bloginfo( 'charset' )?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>

  </head>
  
  <body <?php body_class(); ?>>
    <div class="sunset-sidebar">
      <div class="sidebar-scroll">
        <?php get_sidebar(); ?>
      </div>
    </div>


    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <div class="col-12">
          <header class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>);">
            <div class="header-content app-table">
              <div class="app-table-cell">
                <h1 class="site-title">
                  <a href="<?php bloginfo( 'url' ); ?>" class="logo-link">
                  <span class="sunset-logo sunset-icon"></span>
                  <span class="d-none"><?php bloginfo( 'name' ); ?></span>
                  </a>
                </h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
              </div><!-- table-cell -->
            </div><!-- header-content -->
            <div class="nav-container">
              <nav class="navbar navbar-expand-lg navbar-sunset">           
                <?php 
                  wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'container_class' => false,
                    'menu_class'      => 'navbar-nav mr-auto',
                    'walker'          => new Bootstrap_NavWalker,
                  ) ); 
                ?>
              </nav>
            </div><!-- nav-container -->
          </header><!-- header-container -->
        </div><!-- .col-xs-12 -->
      </div><!-- .row -->
    </div><!-- .container-fluid -->
