<?php settings_errors(); ?>

<form class="dropdown-list-general-form" action="options.php" method="post">
  <?php settings_fields( 'dropdown-list-contact-options' ); ?>
  <?php do_settings_sections( 'dropdown_list_contact' ); ?>
  <?php submit_button(); ?>
</form>
