<?php

  /*
  Messages Custom Post Type for Contact Form
  _________________________________________________
  */

  $contact = get_option( 'activate_contact' );

  if( @$contact == 1 ){

    add_action( 'init', 'dropdown_list_custom_post_type' );
    add_action( 'manage_dropdown-list-contact_posts_columns', 'dropdown_list_contact_columns' );
    add_action( 'manage_dropdown-list-contact_posts_custom_column', 'dropdown_list_contact_custom_columns', 10, 2 );
    add_action( 'add_meta_boxes', 'dropdown_list_email_meta_box' );
    add_action( 'save_post', 'dropdown_list_save_contact_email_data' );

  }

  function dropdown_list_custom_post_type(){

    $labels = array(
    'name'            => 'Messages',
    'singular_name'   => 'Message',
    'menu_name'       => 'Messages',
    'name_admin_bar'  => 'Message'
  );

  $args = array(
    'labels'          => $labels,
    'show_ui'         => true,
    'show_in_menu'    => true,
    'capability_type' => 'post',
    'hierarchical'    => false,
    'menu_position'   => 26,
    'menu_icon'       => 'dashicons-email',
    'supports'        => array( 'title', 'editor', 'author' )
  );

  register_post_type( 'dropdown-contact', $args );
}




function dropdown_list_contact_columns( $columns ){

  $newColumns = array();
  $newColumns[ 'title' ] = 'Full Name';
  $newColumns[ 'message' ] = 'Message';
  $newColumns[ 'email' ] = 'Email';
  $newColumns[ 'date' ] = 'Date';
  return $newColumns;

}

function dropdown_list_contact_custom_columns( $column, $post_id ){

  switch ( $column ){

    case 'message':
      echo get_the_excerpt();
      break;

    case 'email':
    $email = get_post_meta( $post_id, '_contact_email_value_key', true );
    echo '<a href="'.$email.'">'.$email.'</a>';
      break;

  }

}

function dropdown_list_email_meta_box(){

  add_meta_box( 'contact_email', 'User Email', 'dropdown_list_user_email_callback', $screen = 'dropdown-list-contact', $context = 'side' );

}

function dropdown_list_user_email_callback( $post ){

  wp_nonce_field( 'dropdown_list_save_contact_email_data', 'dropdown_list_contact_email_meta_box_nonce' );

  $value = get_post_meta( $post->ID, '_contact_email_value_key', true );

  echo '<label for="dropdown_list_contact_email_field">User Email Address: </label>';
  echo '<input type="email" id="dropdown_list_contact_email_field" name="dropdown_list_contact_email_field" value="'. esc_attr( $value ) .'" size="25" />';

}

function dropdown_list_save_contact_email_data( $post_id ){

  if( !isset( $_POST[ 'dropdown_list_contact_email_meta_box_nonce' ] ) ){
    return;
  }

  if( !wp_verify_nonce( $_POST[ 'dropdown_list_contact_email_meta_box_nonce' ], 'dropdown_list_save_contact_email_data' ) ){
    return;
  }

  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  if( !current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  if( !isset ( $_POST[ 'dropdown_list_contact_email_field' ] ) ){
    return;
  }

  $my_data = sanitize_text_field( $_POST[ 'dropdown_list_contact_email_field' ] );

  update_post_meta( $post_id, '_contact_email_value_key', $my_data );

}
