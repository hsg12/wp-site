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
    wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.0.0' );
    wp_register_style( 'app-css', get_template_directory_uri() . '/css/app.css', array(), '1.0.0' );
    wp_register_style( 'google-font-raleway', get_template_directory_uri() . 'https://fonts.googleapis.com/css?family=Raleway' );

    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'app-css' );
    wp_enqueue_style( 'google-font-raleway' );

    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '4.0.0', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js' );
}

add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );
