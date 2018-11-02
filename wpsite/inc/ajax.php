<?php

/* Ajax functions */

function sunset_load_more() {
  $paged   = $_POST['page'] + 1; // we want to load posts from 2 page
  $prev    = $_POST['prev'];
  $archive = $_POST['archive'];

  if ( $prev == 1 && $_POST['page'] != 1 ) { // this mean we want to load previous page
    $paged = $_POST['page'] - 1;
  }

  $args = array(
    'post_type'   => 'post',
    'post_status' => 'publish',
    'paged'       => $paged,
  );

  if ( $archive != '0' ) {
    $archive_values = explode( '/', $archive );
    $flipped = array_flip( $archive_values );

    switch ( isset( $flipped ) ) {
      case $flipped['category'] :
        $type = 'category_name';
        $key  = 'category';
        break;
      
      case $flipped['tag'] :
        $type = 'tag';
        $key  = $type;
        break;

      case $flipped['author'] :
        $type = 'author';
        $key  = $type;
        break;
    }

    $currentKey = array_keys( $archive_values, $key );
    $nextKey = $currentKey[0] + 1;
    $value = $archive_values[$nextKey];
    $args[$type] = $value;

    //if ( in_array( 'page', $archive_values ) ) {
    if ( isset( $flipped['page'] ) ) {
      $uri_values = explode( 'page', $archive );
      $page_trail = $uri_values[0];
    } else {
      $page_trail = $archive;
    }

  } else {
    $page_trail = '/';
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) : 
    echo '<div class="page-limit" data-page="' . $page_trail . 'page/' . $paged . '/">';
      while ( $query->have_posts() ) : $query->the_post();
        get_template_part( 'template-parts/content', get_post_format() );
      endwhile; 
    echo '</div>';
  else :
    echo "0";
  endif;

  wp_reset_postdata();

  exit; // we must use exit in ajax functions always
}

add_action( 'wp_ajax_nopriv_sunset_load_more', 'sunset_load_more' ); // For all users
add_action( 'wp_ajax_sunset_load_more', 'sunset_load_more' ); // Only for admins

function sunset_check_paged( $num = null ) {
  $output = '';

  if ( is_paged() ) {
    $output = 'page/' . get_query_var( 'paged' );
  }

  if ( $num == 1 ) {
    $paged = get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' );
    return $paged;
  } else {
    return $output;
  }
}

function sunset_save_contact() {
  $name    = wp_strip_all_tags( $_POST['name'] );
  $email   = wp_strip_all_tags( $_POST['email'] );
  $message = wp_strip_all_tags( $_POST['message'] );

  $args = array(
    'post_title' => $name,
    'post_content' => $message,
    'post_author' => 1,
    'post_status' => 'publish',
    'post_type' => 'sunset-contact',
    'meta_input' => array(
      '_contact_email_value_key' => $email
    ),
  );

  $res = wp_insert_post( $args );

  if ($res != 0) {
    $to = get_bloginfo( 'admin_email' );
    $subject = 'Sunset Contact Form - ' . $name;
    $headers[] = 'From: ' . get_bloginfo( 'name' ) . ' <' . $to . '>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';

    wp_mail($to, $subject, $message, $headers);

    echo $res;
  } else {
    echo 0;
  }

  exit;
}

add_action( 'wp_ajax_nopriv_sunset_save_user_contact_form', 'sunset_save_contact' ); // For all users
add_action( 'wp_ajax_sunset_save_user_contact_form', 'sunset_save_contact' ); // Only for admins
