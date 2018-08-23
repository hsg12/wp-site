<h1>Sunset Theme Support</h1>

<?php settings_errors() ?>

<?php 
  $options = get_option( 'post_formats' );
?>

<form action="options.php" method="post" class="sunset-general-form">
  <?php settings_fields( 'sunset-theme-support' ) ?>
  <?php do_settings_sections( 'sunset-theme-slug' ) ?>
  <?php submit_button() ?>
</form>
