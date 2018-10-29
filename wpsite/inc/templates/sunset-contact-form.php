<h1>Sunset Contact Form</h1>

<?php settings_errors() ?>

<p>Use this <strong>shortcode</strong> to activate the Contact Form inside a Page or a Post</p>
<p><code>[contact_form]</code></p>

<form action="options.php" method="post" class="sunset-general-form">
  <?php settings_fields( 'sunset-contact-options' ) ?>
  <?php do_settings_sections( 'sunset-theme-contact-slug' ) ?>
  <?php submit_button() ?>
</form>
