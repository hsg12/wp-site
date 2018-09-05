<?php

$options = get_option( 'post_formats' );

if ( !empty($options) ) {
  $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
  
  $output = array();
  foreach ($formats as $format) {
    if (isset($options[$format])) {
      $output[] = $format;
    }
  }

  add_theme_support( 'post-formats', $output );
}

$customHeader = get_option( 'custom_header' );
if (isset($customHeader) && $customHeader == 1) {
  add_theme_support( 'custom-header' );
}

$customBackground = get_option( 'custom_background' );
if (isset($customBackground) && $customBackground == 1) {
  add_theme_support( 'custom-background' );
}

/* Activate Nav Menu Option */

function sunset_register_nav_menu() {
  register_nav_menu( 'primary', 'Header Navigation Menu' );
}

add_action( 'after_setup_theme', 'sunset_register_nav_menu' );
