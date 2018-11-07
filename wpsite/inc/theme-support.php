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

/* Activate HTML5 Features */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/* Activate Nav Menu Option */

function sunset_register_nav_menu() {
  register_nav_menu( 'primary', 'Header Navigation Menu' );
}

add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/*
  =================
  Sidebar Functions
  =================
*/

function sunset_sidebar_init() {
  register_sidebar(
    array(
      'name'          => __( 'Sinset Sidebar', 'wp-site' ),
      'id'            => 'sunset_sidebar',
      'description'   => 'Dynamic Right Sidebar',
      'before_widget' => '<section id="%1$s" class="sunset-widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="sunset-widget-title">',
      'after_title'   => '</h2>'
    )
  );
}

add_action( 'widgets_init', 'sunset_sidebar_init' );

/*
  ==========================
  Blog Loop Custom Functions
  ==========================
*/

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

function sunset_posted_footer( $only_comments = false ) {
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
      if ($only_comments) {
        // For most popular posts in widgets area
        $comments = '<span class="sunset-icon sunset-comment mr-1"></span> <a href="' . get_comments_link() . '">' . $comments . '</a>';
        return $comments;
      }
      $comments = '<a href="' . get_comments_link() . '">' . $comments . '</a> <span class="sunset-icon sunset-comment"></span>';
    } else {
      if ($only_comments) {
        // For most popular posts in widgets area
        $comments = '<span class="sunset-icon sunset-comment mr-1"></span> <span class="comment-text">' . $comments . '</span>';
        return $comments;
      }
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

function sunset_get_image_attachment(){
  global $post;
  $output = '';
  
  if( has_post_thumbnail() ) {
    $output = wp_get_attachment_url(get_post_thumbnail_id( get_the_ID() ) );
  } else {
    $first_image = preg_match_all('/img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $output = $matches[1][0];

    wp_reset_postdata();
  }

  return $output;
}

function sunset_get_gallery_attachment( $num = 1 ) {
    $output = '';

    if ( has_post_thumbnail() && $num == 1 ) {
      $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ));
    } else {
      $attachments = get_posts( array(
        'post_type'   => 'attachment',
        'posts_per_page' => $num,
        'post_parent' => get_the_ID(),
      ) );

      if ( $attachments && $num == 1 ) {
        foreach ( $attachments as $attachment ) {
          $output = wp_get_attachment_url( $attachment->ID );
        }
      } elseif ( $attachments && $num > 1 ) {
          $output = $attachments;
      }

      wp_reset_postdata();
    }

  return $output;
}

function sunset_get_embedded_media( $type = array() ) {
  $content = do_shortcode( apply_filters( 'the_content', get_the_content()) );
  $embed = get_media_embedded_in_content( $content, $type );

  if ( in_array( 'audio', $type ) ) {
    $output = str_replace( '?visual=true', '?visual=false', $embed[0]);
  } else {
    $output = $embed[0];
  }
  
  return $output;
}

function sunset_get_bs_slides( $attachments ) {
  
  $output = array();
  $attachmentsCount = count($attachments) - 1;

  for ( $i = 0; $i <= $attachmentsCount; $i++ ) : 
    $active = $i == 0 ? 'active' : '';

    $n = $i == $attachmentsCount ? 0 : $i + 1;
    $nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );

    $p = $i == 0 ? $attachmentsCount : $i - 1;
    $prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );

    $output[$i] = array( 
      'class'    => $active,
      'url'      => wp_get_attachment_url( $attachments[$i]->ID ),
      'next_img' => $nextImg,
      'prev_img' => $prevImg,
      'caption'  => $attachments[$i]->post_excerpt
    );
  endfor;

  return $output;
}

function sunset_grab_url() {
  $match = preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]>/i', get_the_content(), $links );

  if ( ! $match ) {
    return false;
  }

  return esc_url_raw( $links[1] );
}

function sunset_grab_current_uri() {
  $archive_uri = '';

  $http = isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
  $referer = $http . $_SERVER['HTTP_HOST'];
  $archive_uri =  $referer . $_SERVER['REQUEST_URI'];

  return $archive_uri;
}

/*
  ============================
  Single Post Custom Functions
  ============================
*/

function sunset_post_navigation() {
  $nav  = '<div class="row">';

  $prev = get_previous_post_link( '<div class="post-link-nav"><span class="mr-1">&laquo;</span> %link</div>', '%title' );
  $nav .= '<div class="col-12 col-sm-6">' . $prev . '</div>';

  $next = get_next_post_link( '<div class="post-link-nav justify-content-end">%link <span class="ml-1">&raquo;</span></div>', '%title' );
  $nav .= '<div class="col-12 col-sm-6">' . $next . '</div>';

  $nav .= '</div>';

  return $nav;
}

function sunset_share_this( $content ) {

  if ( is_single() ) {
    $output = '<div class="sunset-shareThis">';
    $output .= '<h4 class="text-center">Share This</h4>';

    $title = get_the_title();
    $permalink = get_permalink();

    $twitterHandler = get_option( 'twitter_handler' ) ? '&amp;via=' . esc_attr( get_option( 'twitter_handler' ) ) : '';

    $twitter = 'https://twitter.com/intent/tweet?text=Hey! Read this: ' . $title . '&amp;url=' . $permalink . $twitterHandler;
    $facebook = 'https://facebook.com/sharer/sharer.php?u=' . $permalink;
    $google = 'https://plus.google.com/share?url=' . $permalink;

    $output .= '<ul class="sunset-soc-icons">';
    $output .= '<li><a href="' . $twitter . '" rel="nofollow"><span class="fa fa-twitter-square"></span></a></li>';
    $output .= '<li><a href="' . $facebook . '" rel="nofollow"><span class="fa fa-facebook-square"></span></a></li>';
    $output .= '<li><a href="' . $google . '" rel="nofollow"><span class="fa fa-google-plus-square"></span></a></li>';
    $output .= '</ul>';

    $output .= '</div>';

    return $content . $output;
  } else {
    return $content;
  }
}

add_filter( 'the_content', 'sunset_share_this' );

function sunset_get_post_navigation () {
  if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
    require( get_template_directory() . '/inc/templates/sunset-comment-nav.php' );
  } 
}

function wpb_move_comment_field_to_bottom( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}
 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

/*
  ==========================
  Do Mobile Detect to global
  ==========================
*/

  function mobile_detect_global() {
    global $detect;
    $detect = new Mobile_Detect;
  }

  add_action( 'after_setup_theme', 'mobile_detect_global' );

/*
  ====================
  mailtrap.io settings
  ====================
*/

/*function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = 'fd927e1d933593';
  $phpmailer->Password = '08dd585b335bcb';
}

add_action('phpmailer_init', 'mailtrap');*/
