<?php

/*
ADMIN PAGE
___________________________________________
*/

function dropdown_list_add_admin_page(){

  //Generate Admin Page
  add_menu_page( 'dropdown list Options', 'dropdown', 'manage_options', 'dropdown_list', 'dropdown_list_list_menu_page', 'dashicons-analytics', 101);

  //Generat Admin Subpages
  add_submenu_page( 'dropdown_list', 'Sidebar Options', 'Sidebar', 'manage_options', 'dropdown_list', 'dropdown_list_list_menu_page' );
  add_submenu_page( 'dropdown_list', 'Theme Options', 'Theme Options', 'manage_options', 'dropdown_list_theme', 'dropdown_list_theme_sub_page' );
  add_submenu_page( 'dropdown_list', 'Contact Form', 'Contact Form', 'manage_options', 'dropdown_list_contact', 'dropdown_list_contact_sub_page' );

  //Activate Custom script_concat_settings
  add_action( 'admin_init', 'dropdown_list_custom_Settings' );
}

add_action( 'admin_menu', 'dropdown_list_add_admin_page' );

function dropdown_list_custom_Settings(){

  //Sidebar Options Regiter Setting
  register_setting( 'dropdown-list-settings-group', 'profile_picture' );
  register_setting( 'dropdown-list-settings-group', 'first_name' );
  register_setting( 'dropdown-list-settings-group', 'last_name' );
  register_setting( 'dropdown-list-settings-group', 'user_description' );
  register_setting( 'dropdown-list-settings-group', 'twitter_handler', 'dropdown_list_sanitize_twitter_handler' );
  register_setting( 'dropdown-list-settings-group', 'facebook_handler' );

  //Sidebar Options Section and Field
  add_settings_section( 'dropdown-list-sidebar-option', 'Sidebar Options', 'dropdown_list_sidebar_options', 'dropdown_list' );
  add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'dropdown_list_profile_picture', 'dropdown_list', 'dropdown-list-sidebar-option' );
  add_settings_field( 'sidebar-name', 'Full Name', 'dropdown_sidebar_name', 'dropdown_list', 'dropdown-list-sidebar-option' );
  add_settings_field( 'sidebar-description', 'Description', 'dropdown_list_sidebar_description', 'dropdown_list', 'dropdown-list-sidebar-option' );
  add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'dropdown_list_sidebar_twitter', 'dropdown_list', 'dropdown-list-sidebar-option' );
  add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'dropdown_list_sidebar_facebook', 'dropdown_list', 'dropdown-list-sidebar-option' );

  //Theme Support Options Register Settings
  register_setting( 'dropdown-list-theme-support', 'post_formats' );
  register_setting( 'dropdown-list-theme-support', 'custom_logo' );
  register_setting( 'dropdown-list-theme-support', 'custom_header' );
  register_setting( 'dropdown-list-theme-support', 'custom_background' );

  //Theme Support Options Section and Field
  add_settings_section( 'dropdown-list-theme', 'Theme Support Options', 'dropdown_list_theme_support_options', 'dropdown_list_theme' );
  add_settings_field( 'post-formats', 'Post Formats', 'dropdown_list_post_formats', 'dropdown_list_theme', 'dropdown-list-theme' );
  add_settings_field( 'custom-logo', 'Custom Logo', 'dropdown_list_custom_logo', 'dropdown_list_theme', 'dropdown-list-theme' );
  add_settings_field( 'custom-header', 'Custom Header', 'dropdown_list_custom_header', 'dropdown_list_theme', 'dropdown-list-theme' );
  add_settings_field( 'custom-background', 'Custom Background', 'dropdown_list_cutom_background', 'dropdown_list_theme', 'dropdown-list-theme' );

  //Contact Form Register Settings
  register_setting( 'dropdown-list-contact-options', 'activate_contact' );

  //Contact Form Section and Field
  add_settings_section( 'dropdown-list-contact-section', 'Contact Form', 'dropdown_list_contact_section', 'dropdown_list_contact' );
  add_settings_field( 'activate-form', 'Activate Contact Form', 'dropdown_list_activate_contact', 'dropdown_list_contact', 'dropdown-list-contact-section' );

}

/* Add Admin Page Functions */

function dropdown_list_list_menu_page(){

  require_once( get_template_directory() . '/inc/templates/dropdown-list-admin.php' );

}

function dropdown_list_theme_sub_page(){

  require_once( get_template_directory() . '/inc/templates/dropdown-list-theme-support.php' );

}

function dropdown_list_contact_sub_page(){

  require_once( get_template_directory() . '/inc/templates/dropdown-list-contact-form.php' );

}

/* Custom Settings Functions */

function dropdown_list_sidebar_options(){

  echo 'Customize your sidebar!';

}

function dropdown_list_profile_picture(){

  $picture = esc_attr( get_option( 'profile_picture' ) );

  if( empty( $picture ) ){
    echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" /> <input type="hidden" id="profile-picture" name="profile_picture" value="" />';
  } else {
    echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" /> <input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
  }

}

function dropdown_sidebar_name(){

  $firstName = esc_attr( get_option( 'first_name' ) );
  $lastName = esc_attr( get_option( 'last_name' ) );
  echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';

}

function dropdown_list_sidebar_description(){

  $description = esc_attr( get_option( 'user_description' ) );
  echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /> <p class="description">Type a brief description of yourself</p>';

}

function dropdown_list_sidebar_twitter(){

  $twitter = esc_attr( get_option( 'twitter_handler' ) );
  echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" /> <p class="description">Type your Twitter Handler without the @ character</p>';

}

function dropdown_list_sidebar_facebook(){

  $facebook = esc_attr( get_option( 'facebook_handler' ) );
  echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler" />';

}

function dropdown_list_theme_support_options(){

  echo 'Activate and Deactivate specific Theme Support Options';

}

function dropdown_list_post_formats(){

  $options = get_option( 'post_formats' );
  $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
  $output = '';
  foreach ( $formats as $format ) {
    $checked = ( @$options[ $format ] == 1 ? 'checked' : '' );
    $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.'</label><br>';
  }

  echo $output;

}

function dropdown_list_custom_logo(){

  $options = get_option( 'custom_logo' );
  $checked =( @$options == 1 ? 'checked' : '' );
  echo '<label><input type="checkbox" id="custom_logo" name="custom_logo" value="1" '.$checked.'/> Activate the custom logo</label>';

}

function dropdown_list_custom_header(){

  $options = get_option( 'custom_header' );
  $checked =( @$options == 1 ? 'checked' : '' );
  echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'/> Activate the custom header</label>';

}

function dropdown_list_cutom_background(){

  $options = get_option( 'custom_background' );
  $checked = ( @$options == 1 ? 'checked' : '' );
  echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.'/> Activate the custom background</label>';

}

/* Sanitize Settings */

function dropdown_list_sanitize_twitter_handler( $input ){

  $output = sanitize_text_field( $input );
  $output = str_replace( '@', '', $output );
  return $output;

}

function dropdown_list_contact_section(){

  echo '<p>By clicking the input field and saving the the page you will activate a contact form custom post type</p>';

}

function dropdown_list_activate_contact(){

  $options = get_option( 'activate_contact' );
  $checked = ( @$options == 1 ? 'checked' : '' );
  echo '<input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.'/>';

}
