<?php

/*
Contact Form Ajax Submission and Saving Input Data for Custom Post Type called Messages
_____________________________________________________________________________________________
*/

add_action( 'wp_ajax_dropdown_list_save_user_contact_form', 'dropdown_list_save_user_contact_form' );
add_action( 'wp_ajax_nopriv_dropdown_list_save_user_contact_form', 'dropdown_list_save_user_contact_form' );

function dropdown_list_save_user_contact_form(){

if (
    ! isset( $_POST['dropdown_list_nonce_field'] )
    || ! wp_verify_nonce( $_POST['dropdown_list_nonce_field'], 'dropdown_list_my_action' )
) {

   print 'Sorry, your nonce did not verify.';
   exit;

} else {



$name = wp_strip_all_tags( $_POST["name"] );
$email = wp_strip_all_tags( $_POST["email"] );
$message = wp_strip_all_tags( $_POST["message"] );

    $args = array(
      'post_title'    => $name,
      'post_content'  => $message,
      'post_author'   => 1,
      'post_status'   => 'publish',
      'post_type'     => 'dropdown-list-contact',
      'meta_input'    => array(
          '_contact_email_value_key' => $email
      )
    );

  $postID =  wp_insert_post( $args );

  if($postID !== 0){
    $to = get_bloginfo( 'admin_email' );
    $subject = 'Email from '. $name;
    $headers[] = 'From: '. get_bloginfo('name') . '<'.$to.'>';
    $headers[] = 'Reply-To: '.$name.'<'.$email.'>';
    $headers[] = 'Content-Type: text/html: charset=UTF-8';
    //$message = file_get_contents(TEMPLATEPATH . '/inc/hero.php');
    $message = $message;
    wp_mail( $to, $subject, $message, $headers );

  } else {
    echo 0;
  }


  echo $postID;

die();
  }
}

/*
Select Option Ajax Request
__________________________________
*/

add_action( 'wp_ajax_select_option_data_request_form', 'select_option_data_request_form' );
add_action( 'wp_ajax_nopriv_select_option_data_request_form', 'select_option_data_request_form' );

function select_option_data_request_form(){

  if (
      ! isset( $_POST['select_option_nonce_field'] )
      || ! wp_verify_nonce( $_POST['select_option_nonce_field'], 'select_option_my_action' )
  ) {

     print 'Sorry, your nonce did not verify.';
     exit;

  } else {

  $category = wp_strip_all_tags( $_POST['category'] );
  $tag = wp_strip_all_tags( $_POST['tag'] );

      //Conditional if category and tag are empty
      if( empty($category) && empty($tag) ){
        echo 'error';
        exit;

      } else {

  //Category Loop Starts
  $query = new WP_Query( array( 'category_name' => $category, 'tag' => $tag, 'post_status' => 'publish', 'posts_per_page' => -1  ) );

  if ( $query->have_posts() ) {

   $i = 0;

        while ( $query->have_posts() ) { $query->the_post(); ?>

        <?php
        if( $i % 4 == 0) { ?>
          <div class="row">
            <?php } ?>

        <div class="col-xs-12 col-sm-12 col-md-3">
          <div class="index-posts">
            <hr class="hr-style">
              <?php get_template_part( 'template-parts/content', get_post_format() ) ;?>
            <hr class="hr-style">
          </div><!-- .index-posts -->
        </div><!-- .col-md-3 -->

        <?php
           if( $i % 4 == 3 ) { ?>
            </div><!-- .row -->
            <?php } $i++; ?>

      <?php } ?>

      <?php  wp_reset_postdata(); } else { ?>

        <p><?php esc_html_e( 'Sorry, no posts matche your criteria.', 'dropdownlist' ) ;?></p>

        <?php }



      }//else closing curly brace for empty cat and tag

  }//else closing curly brace

  die();
}
