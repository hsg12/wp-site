<?php

/*
  Admin Enqueue Functions
*/

function sunset_load_admin_scripts( $page ) {

  if ( $page === 'toplevel_page_sunset-slug' ) {
    wp_register_style( 'sunset_admin', get_template_directory_uri() . '/css/sunset.admin.css', array(), '1.0.0' );
    wp_enqueue_style( 'sunset_admin' );

    wp_enqueue_media();

    wp_register_script( 'sunset-admin-script', get_template_directory_uri() . '/js/sunset.admin.js', array('jquery'), null, true );
    
    wp_enqueue_script( 'sunset-admin-script' );
  } elseif ( $page === 'sunset_page_sunset-theme-custom-css' ) {
    wp_register_style( 'ace', get_template_directory_uri() . '/css/sunset.ace.css', array(), '1.0.0' );
    wp_enqueue_style( 'ace' );

    wp_register_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array(), '1.4.1', true );
    wp_register_script( 'sunset-custom-css-script', get_template_directory_uri() . '/js/sunset.custom-css.js', array(), '1.0.0', true );
    
    wp_enqueue_script( 'ace' );
    wp_enqueue_script( 'sunset-custom-css-script' );
  } else {
    return;
  }
  
}

add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts' );


/*
  Front-End Enqueue Functions
*/

function sunset_load_scripts( $page ) {
    wp_register_style( 'sunset-css', get_template_directory_uri() . '/css/sunset.css', array(), '1.0.0' );
    wp_register_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'sunset-css' );
    wp_enqueue_style( 'font-awesome' );

    wp_register_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array(), null, true );
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
    wp_register_script( 'app-js', get_template_directory_uri() . '/js/app-script.js', array('jquery'), '1.0.0', true );
    
    wp_enqueue_script( 'popper' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_script( 'app-js' );
}

add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );
