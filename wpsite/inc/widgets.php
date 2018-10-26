<?php 

/*
================
  Widget Class
================
*/

class Sunset_Profile_Widget extends WP_Widget {
  function __construct() {
    $args = array(
      'classname'   => 'sunset-profile-widget',
      'description' => esc_html__( 'A Sunset Profile Widget', 'wp-site' ),
    );

    parent::__construct(
      'sunset_profile', // Base ID
      esc_html__( 'Sunset Profile Widget', 'wp-site' ), // Name
      $args // Args
    );
  }

  
  public function widget( $args, $instance ) {
    $profilePicture = esc_attr(get_option( 'profile_picture' ));
    $firstName = esc_attr(get_option( 'first_name' ));
    $lastName = esc_attr(get_option( 'last_name' ));
    $fullName = $firstName . ' ' . $lastName;
    $userDescription = esc_attr(get_option( 'user_description' ));

    $twitter_icon = esc_attr(get_option( 'twitter_handler' ));
    $facebook_icon = esc_attr(get_option( 'facebook_handler' ));
    $google_icon = esc_attr(get_option( 'google_plus_handler' ));
    
    echo $args['before_widget'];

?>

  <div class="image-container">
    <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php echo $profilePicture ?>);"></div>
  </div>
  <h2 class="sunset-username"><?php echo $fullName ?></h2>
  <h3 class="sunset-description"><?php echo $userDescription ?></h3>
  <div class="icons-wrapper">
    <?php if ( !empty($twitter_icon) ) : ?>
      <a href="<?php echo $twitter_icon; ?>" target="_blank"><span class="fa fa-twitter"></span></a>
    <?php endif; ?>
    <?php if ( !empty($facebook_icon) ) : ?>
      <a href="<?php echo $facebook_icon; ?>" target="_blank"><span class="fa fa-facebook"></span></a>
    <?php endif; ?>
    <?php if ( !empty($google_icon) ) : ?>
      <a href="<?php echo $google_icon; ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
    <?php endif; ?>
  </div>
  <hr class="white-hr">

<?php

    echo $args['after_widget'];
  }
  
  public function form( $instance ) {
    echo "<p><strong>No options for this Widget!</strong><br />";
    echo "You can control the fields of this Widget from <a href='./admin.php?page=sunset-slug'>This Page</a></p>";
  }
}

// register Foo_Widget widget
function register_sunset_profile_widget() {
    register_widget( 'Sunset_Profile_Widget' );
}
add_action( 'widgets_init', 'register_sunset_profile_widget' );

/*
==================================
  Edit Default WordPress widgets
==================================
*/

function sunset_tag_cloud_font_change( $args ) {
  // Equal tag sizes. No matter how many times a tag is used.
  $args['smallest'] = 8;
  $args['largest'] = 8;

  return $args;
}

add_filter( 'widget_tag_cloud_args', 'sunset_tag_cloud_font_change' );

function sunset_list_categories_output_change( $links ) {
  
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  
  return $links;
  
}
add_filter( 'wp_list_categories', 'sunset_list_categories_output_change' );

/*
====================
  Save Posts views
====================
*/

function sunset_save_post_views( $postID ) {
  $metaKey = 'sunset_post_views';
  $views = get_post_meta( $postID, $metaKey, true );

  $count = empty( $views ) ? '0' : $views;
  $count++;

  update_post_meta( $postID, $metaKey, $count ); // If post meta does not exists, will be created
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/*
=======================
  Popular Post Widget
=======================
*/

class Sunset_Popular_Posts_Widget extends WP_Widget {
  function __construct() {
    $args = array(
      'classname'   => 'sunset-popular-posts-widget',
      'description' => esc_html__( 'A Sunset Popular Posts Widget', 'wp-site' ),
    );

    parent::__construct(
      'sunset_popular_posts', // Base ID
      esc_html__( 'Sunset Popular Posts', 'wp-site' ), // Name
      $args // Args
    );
  }

  
  public function widget( $args, $instance ) {

    $tot = absint( $instance['tot'] );

    $posts_args = array(
      'post_type'      => 'post',
      'posts_per_page' => $tot,
      'meta_key'       => 'sunset_post_views',
      'orderby'        => 'meta_value_num',
      'order'          => 'DESC',
    );

    $posts_query = new WP_Query( $posts_args );
    
    echo $args['before_widget'];
    if ( !empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    if ( $posts_query->have_posts() ) {
      echo "<ul>";
      while ( $posts_query->have_posts() ) {
        $posts_query->the_post();

        echo '<li>' . get_the_title() . '</li>';
      }
      echo "</ul>";
    }

    echo $args['after_widget'];
  }
  
  public function form( $instance ) {
    $title = !empty( $instance['title'] ) ? $instance['title'] : 'Popular Posts';
    $tot = !empty( $instance['tot'] ) ? absint($instance['tot']) : 4;

    $output  = '<p>';
    $output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
    $output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '">';
    $output .= '</p>';

    $output .= '<p>';
    $output .= '<label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Posts:</label>';
    $output .= '<input type="number" class="widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tot' ) ) . '" value="' . esc_attr( $tot ) . '">';
    $output .= '</p>';

    echo $output;
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['tot'] = !empty( $new_instance['tot'] ) ? absint( $new_instance['tot'] ) : 0;

    return $instance;
  }
}

// register Foo_Widget widget
function register_sunset_popular_posts_widget() {
    register_widget( 'Sunset_Popular_Posts_Widget' );
}
add_action( 'widgets_init', 'register_sunset_popular_posts_widget' );
