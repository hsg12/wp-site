<?php

function sunset_add_admin_page() {

  // Generate Sunset Admin Page
  add_menu_page( 
    'Sunset Theme Options',     // page_title
    'Sunset',                   // menu_title
    'manage_options',           // capability
    'sunset-slug',              // menu_slug
    'sunset_theme_create_page', // function
    'dashicons-marker',         // icon_url
    110                         // position
  );

  // Generate Sunset Admin Sub Pages
  add_submenu_page(
    'sunset-slug',             // parent_slug
    'Sunset Sidebar Options',  // page_title
    'Sidebar',                 // menu_title
    'manage_options',          // capability
    'sunset-slug',             // menu_slug
    'sunset_theme_create_page' // function
  );

  add_submenu_page(
    'sunset-slug',              // parent_slug
    'Sunset Theme Options',     // page_title
    'Theme Options',            // menu_title
    'manage_options',           // capability
    'sunset-theme-slug',        // menu_slug
    'sunset_theme_support_page' // function
  );

  add_submenu_page(
    'sunset-slug',               // parent_slug
    'Sunset Contact Form',       // page_title
    'Contact Form',              // menu_title
    'manage_options',            // capability
    'sunset-theme-contact-slug', // menu_slug
    'sunset_contact_form_page'   // function
  );

  add_submenu_page(
    'sunset-slug',             // parent_slug
    'Sunset Custom CSS',       // page_title
    'Custom CSS',              // menu_title
    'manage_options',          // capability
    'sunset-theme-custom-css', // menu_slug
    'sunset_custom_css_page'   // function
  );

  // Activate custom settings

  add_action( 'admin_init', 'sunset_custom_settings' );
}

add_action( 'admin_menu', 'sunset_add_admin_page' );

function sunset_theme_create_page() {
  require_once( get_template_directory() . '/inc/templates/sunset-admin.php');
}

function sunset_theme_support_page() {
  require_once( get_template_directory() . '/inc/templates/sunset-theme-support.php');
}

function sunset_contact_form_page() {
  require_once( get_template_directory() . '/inc/templates/sunset-contact-form.php');
}

function sunset_custom_css_page() {
  require_once( get_template_directory() . '/inc/templates/sunset-custom-css.php');
}

function sunset_custom_settings() {
  // Sidebar Options
  register_setting( 'sunset-settings-group', 'profile_picture' );
  register_setting( 'sunset-settings-group', 'first_name' );
  register_setting( 'sunset-settings-group', 'last_name' );
  register_setting( 'sunset-settings-group', 'user_description' );
  register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_form_data' );
  register_setting( 'sunset-settings-group', 'facebook_handler', 'sunset_sanitize_form_data' );
  register_setting( 'sunset-settings-group', 'google_plus_handler', 'sunset_sanitize_form_data' );

  add_settings_section( 'sinset-sidebar-options', 'Sidebar Option', 'sunset_sidebar_options', 'sunset-slug' );

  add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile_picture', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-user-description', 'User Description', 'sunset_sidebar_user_description', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-google-plus', 'Google Plus handler', 'sunset_sidebar_google_plus', 'sunset-slug', 'sinset-sidebar-options' );

  // Theme Support Options

  register_setting( 'sunset-theme-support', 'post_formats', 'sunset_post_formats_callback' );
  register_setting( 'sunset-theme-support', 'custom_header' );
  register_setting( 'sunset-theme-support', 'custom_background' );

  add_settings_section( 'sunset-theme-options', 'Theme Option', 'sunset_theme_options', 'sunset-theme-slug' );

  add_settings_field( 'post-formats', 'Post Formats', 'sunset_post_formats', 'sunset-theme-slug', 'sunset-theme-options' );
  add_settings_field( 'custom-header', 'Custom header', 'sunset_custom_header', 'sunset-theme-slug', 'sunset-theme-options' );
  add_settings_field( 'custom-background', 'Custom background', 'sunset_custom_background', 'sunset-theme-slug', 'sunset-theme-options' );

  // Contact Form Options

  register_setting( 'sunset-contact-options', 'activate_contact_form' );

  add_settings_section( 'sunset-contact-section', 'Contact Form', 'sunset_contact_section', 'sunset-theme-contact-slug' );

  add_settings_field( 'activate-form', 'Activate Contact Form', 'sunset_activate_contact', 'sunset-theme-contact-slug', 'sunset-contact-section' );

  // Custom CSS Options

  register_setting( 'sunset-custom-css-options', 'sunset_css', 'sunset_sanitize_custom_css' );

  add_settings_section( 'sunset-custom-css-section', 'Custom CSS', 'sunset_custom_css_section_callback', 'sunset-theme-custom-css' );

  add_settings_field( 'custom-css', 'Insert your Custom CSS', 'sunset_custom_css_callback', 'sunset-theme-custom-css', 'sunset-custom-css-section' );
}

// Sidebar Options Functions

function sunset_sidebar_options() {
  echo "Customize your Sidebar Information";
}

function sunset_sidebar_name() {
  $firstName = esc_attr(get_option( 'first_name' ));
  $lastName = esc_attr(get_option( 'last_name' ));

  echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="First Name">';
  echo '<input type="text" name="last_name" value="' . $lastName . '" placeholder="Last Name">';
}

function sunset_sidebar_user_description() {
  $userDescription = esc_attr(get_option( 'user_description' ));

  echo '<input type="text" name="user_description" value="' . $userDescription . '" placeholder="User Description" title="' . $userDescription . '">';
  echo '<p class="description">Write something smart.</p>';
}

function sunset_sidebar_twitter() {
  $twitter = esc_attr(get_option( 'twitter_handler' ));

  echo '<input type="text" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter handler">';
  echo '<p class="description">Input your Twitter username without the @ character.</p>';
}

function sunset_sidebar_facebook() {
  $facebook = esc_attr(get_option( 'facebook_handler' ));

  echo '<input type="text" name="facebook_handler" value="' . $facebook . '" placeholder="Facebook handler">';
}

function sunset_sidebar_google_plus() {
  $google_plus = esc_attr(get_option( 'google_plus_handler' ));

  echo '<input type="text" name="google_plus_handler" value="' . $google_plus . '" placeholder="Google Plus handler">';
}

function sunset_sidebar_profile_picture() {
  $profilePicture = esc_attr(get_option( 'profile_picture' ));

  if ( empty($profilePicture) ) {
    echo '<input type="hidden" name="profile_picture" id="profile-picture" value="' . $profilePicture . '">';
    echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button">';
  } else {
    echo '<input type="hidden" name="profile_picture" id="profile-picture" value="' . $profilePicture . '">';
    echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button">&nbsp;';
    echo '<input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
  }
}






// Theme Support Options Functions

function sunset_post_formats_callback( $input ) {
  return $input;
  // var_dump($input);
  exit();
}

function sunset_theme_options() {
  echo 'Activate and Deactivate specific Theme Support Options';
}

function sunset_post_formats() {
  $options = get_option( 'post_formats' );
  $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
  
  $output = '';
  foreach ($formats as $format) {
    if (isset($options[$format]) && $options[$format] == 1) {
      $checked = 'checked';
    } else {
      $checked = '';
    }
    
    $output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats['.$format.']" value="1" ' . $checked . '>' . $format . '</label><br>';
  }
  echo $output;
}

function sunset_custom_header() {
  $customHeader = get_option( 'custom_header' );

  if (isset($customHeader) && $customHeader == 1) {
    $checked = 'checked';
  } else {
    $checked = '';
  }

  echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" ' . $checked . '>Activate the Custom Header</label>';
}

function sunset_custom_background() {
  $customBackground = get_option( 'custom_background' );

  if (isset($customBackground) && $customBackground == 1) {
    $checked = 'checked';
  } else {
    $checked = '';
  }

  echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" ' . $checked . '>Activate the Custom Background</label>';
}



// Contact Form Options Functions

function sunset_contact_section() {
  echo "Activate and Deactivate the built-in Contact Form";
}

function sunset_activate_contact() {
  $activateContactForm = get_option( 'activate_contact_form' );

  if (isset($activateContactForm) && $activateContactForm == 1) {
    $checked = 'checked';
  } else {
    $checked = '';
  }

  echo '<label><input type="checkbox" id="activate_contact_form" name="activate_contact_form" value="1" ' . $checked . '></label>';
}



// Custom CSS Options Functions

function sunset_custom_css_section_callback() {
  echo "Customize Sunset Theme with your own CSS";
}

function sunset_custom_css_callback() {
  $css = get_option( 'sunset_css' );
  $css = empty($css) ? '/* Sunset Theme Custom CSS */' : $css;

  // ace code editor from https://github.com/ajaxorg/ace-builds ( src-min folder )
  echo '<div id="customCss">' . $css . '</div><textarea id="sunset_css" name="sunset_css" style="display: none; visibility: hidden;">' . $css . '</textarea>'; 
}






// Sanitization settings

function sunset_sanitize_form_data( $input ) {
  $output = sanitize_text_field( $input );
  $output = str_replace( '@', '', $output );
  return $output;
}

function sunset_sanitize_custom_css( $input ) {
  $output = esc_textarea( $input );
  return $output;
}
