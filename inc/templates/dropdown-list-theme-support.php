<?php settings_errors(); ?>

<form class="dropdown-list-general-form" action="options.php" method="post">
  <?php settings_fields( 'dropdown-list-theme-support' ); ?>
  <?php do_settings_sections( 'dropdown_list_theme' ); ?>
  <?php submit_button(); ?>
</form>
