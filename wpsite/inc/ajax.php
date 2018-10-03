<?php

/* Ajax functions */

function sunset_load_more() {
  $paged = $_POST['page'] + 1; // we want to load posts from 2 page
  $prev  = $_POST['prev'];

  if ( $prev == 1 && $_POST['page'] != 1 ) { // this mean we want to load previous page
    $paged = $_POST['page'] - 1;
  }

  $query = new WP_Query( array(
    'post_type'   => 'post',
    'post_status' => 'publish',
    'paged'       => $paged,
  ) );

  if ( $query->have_posts() ) : 
    echo '<div class="page-limit" data-page="' . get_site_url(null , null , "http") . '/page/' . $paged . '">';
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
