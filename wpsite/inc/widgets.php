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
      <a href="<?php echo $twitter_icon; ?>"><span class="fa fa-twitter"></span></a>
    <?php endif; ?>
    <?php if ( !empty($facebook_icon) ) : ?>
      <a href="<?php echo $facebook_icon; ?>"><span class="fa fa-facebook"></span></a>
    <?php endif; ?>
    <?php if ( !empty($google_icon) ) : ?>
      <a href="<?php echo $google_icon; ?>"><span class="fa fa-google-plus"></span></a>
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





