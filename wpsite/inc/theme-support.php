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

add_theme_support( 'post-thumbnails' );

/* Activate Nav Menu Option */

function sunset_register_nav_menu() {
  register_nav_menu( 'primary', 'Header Navigation Menu' );
}

add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/* Blog Loop Custom Functions */

function sunset_posted_meta() {
  $posted_on  = human_time_diff( get_the_time('U'), current_time('timestamp') );
  $categories = get_the_category();
  $separator  = ', ';
  $cat_output = '';
  $i = 1;

  if ( !empty($categories) ) {
    foreach ($categories as $category) {
      if ( $i > 1 ) {
        $cat_output .= $separator;
      }

      $cat_output .= '<a href="' . esc_url(get_category_link( $category->term_id )) . '" alt="' . esc_attr( 'View all posts in %s', $category->name ) . '">';
      $cat_output .= esc_html( $category->name ); 
      $cat_output .= '</a>';

      $i++;
    }
  }

  $output  = '<span class="posted-on">Posted <a href="' . esc_url( get_permalink() ) . '">' . $posted_on . '</a> ago</span> / ';
  $output .= '<span class="posted-in">' . $cat_output . '</span>';
  
  return $output;
}

function sunset_posted_footer() {
  $comments_num = get_comments_number();
  if ( comments_open() ) {

    if ( $comments_num == 0 ) {
      $comments = __( 'No Comments' );
    } elseif ( $comments_num > 1 ) {
      $comments = $comments_num . __( ' Comments' );
    } else {
      $comments = $comments_num . __( ' Comment' );
    }

    if ( $comments_num >= 1 ) {
      $comments = '<a href="' . get_comments_link() . '">' . $comments . '</a> <span class="sunset-icon sunset-comment"></span>';
    } else {
      $comments = '<span class="comment-text">' . $comments . '</span><span class="sunset-icon sunset-comment"></span>';
    }
    
  } else {
    $comments = __( 'Comments are closed' );
  }

  $output  = '<div class="post-footer-container">';
  $output .= '<div class="row">';

  $output .= '<div class="col-12 col-sm-6">';
  $output .= get_the_tag_list( '<div class="tags-list"><span class="sunset-icon sunset-tag"></span><span class="tags-box">', ' ', '</span></div>' );
  $output .= '</div>';

  $output .= '<div class="col-12 col-sm-6 text-right comments-box">';
  $output .= $comments;
  $output .= '</div>';

  $output .= '</div>';
  $output .= '</div>';

  return $output;
}
