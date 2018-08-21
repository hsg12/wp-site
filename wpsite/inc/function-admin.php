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
    'Sunset Theme Options',    // page_title
    'Settings',                // menu_title
    'manage_options',          // capability
    'sunset-slug',             // menu_slug
    'sunset_theme_create_page' // function
  );

  add_submenu_page(
    'sunset-slug',                 // parent_slug
    'SubPage For Example',         // page_title
    'Page Example',                // menu_title
    'manage_options',              // capability
    'sunset-slug-css',             // menu_slug
    'sunset_theme_subpage_example' // function
  );

  // Activate custom settings

  add_action( 'admin_init', 'sunset_custom_settings' );
}

add_action( 'admin_menu', 'sunset_add_admin_page' );

function sunset_theme_create_page() {
  require_once( get_template_directory() . '/inc/templates/sunset-admin.php');
}

function sunset_theme_subpage_example() {
  require_once( get_template_directory() . '/inc/templates/sunset-subpage-for-example.php');
}

function sunset_custom_settings() {
  add_settings_section( 'sinset-sidebar-options', 'Sidebar Option', 'sunset_sidebar_options', 'sunset-slug' );

  register_setting( 'sunset-settings-group', 'profile_picture' );
  register_setting( 'sunset-settings-group', 'first_name' );
  register_setting( 'sunset-settings-group', 'last_name' );
  register_setting( 'sunset-settings-group', 'user_description' );
  register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_form_data' );
  register_setting( 'sunset-settings-group', 'facebook_handler', 'sunset_sanitize_form_data' );
  register_setting( 'sunset-settings-group', 'google_plus_handler', 'sunset_sanitize_form_data' );

  add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile_picture', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-user-description', 'User Description', 'sunset_sidebar_user_description', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'sunset-slug', 'sinset-sidebar-options' );
  add_settings_field( 'sidebar-google-plus', 'Google Plus handler', 'sunset_sidebar_google_plus', 'sunset-slug', 'sinset-sidebar-options' );
}

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

  echo '<input type="hidden" name="profile_picture" id="profile-picture" value="' . $profilePicture . '">';
  echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button">';
}

// Sanitization settings

function sunset_sanitize_form_data( $input ) {
  $output = sanitize_text_field( $input );
  $output = str_replace( '@', '', $output );
  return $output;
}
