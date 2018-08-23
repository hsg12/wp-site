<h1>Sunset Sidebar Options</h1>

<?php settings_errors() ?>

<?php 
  $profilePicture = esc_attr(get_option( 'profile_picture' ));
  $firstName = esc_attr(get_option( 'first_name' ));
  $lastName = esc_attr(get_option( 'last_name' ));
  $fullName = $firstName . ' ' . $lastName;
  $userDescription = esc_attr(get_option( 'user_description' ));
?>
<div class="sunset-sidebar-preview">
  <div class="sunset-sidebar">
    <div class="image-container">
      <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php echo $profilePicture ?>);"></div>
    </div>
    <h2 class="sunset-username"><?php echo $fullName ?></h2>
    <h3 class="sunset-description"><?php echo $userDescription ?></h3>
    <div class="icons-wrapper">
      
    </div>
  </div>
</div>

<form action="options.php" method="post" class="sunset-general-form">
  <?php settings_fields( 'sunset-settings-group' ) ?>
  <?php do_settings_sections( 'sunset-slug' ) ?>
  <?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ) ?>
</form>
