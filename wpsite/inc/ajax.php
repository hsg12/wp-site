<?php

/* Ajax functions */

function sunset_load_more() {
  $paged = $_POST['page'] + 1; // we want to load posts from 2 page

  $query = new WP_Query( array(
    'post_type'   => 'post',
    'post_status' => 'publish',
    'paged'       => $paged,
  ) );

  if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
      get_template_part( 'template-parts/content', get_post_format() );
    endwhile; 
  endif;

  wp_reset_postdata();

  exit; // we must use exit in ajax functions always
}

add_action( 'wp_ajax_nopriv_sunset_load_more', 'sunset_load_more' ); // For all users
add_action( 'wp_ajax_sunset_load_more', 'sunset_load_more' ); // Only for admins
