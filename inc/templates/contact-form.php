<div class="container form-container">
  <div class="contact-title">
    <header>
      <h1><?php esc_html_e( 'Contact Form', 'dropdownlist' ) ;?></h1>
    </header>
  </div><!-- .contact-title -->
  <form class="contactForm" action="#" method="post" data-url="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>">

    <div class="form-group">
        <input type="text" id="name" class="form-control" name="name" value="" placeholder="Your Name" >
        <small class="text-danger form-control-msg"><?php esc_html_e( 'Your name is Required', 'dropdownlist' ) ;?></small>
    </div><!-- .form-group -->
    <div class="form-group">
        <input type="email" id="email" class="form-control" name="email" value="" placeholder="Your Email" >
        <small class="text-danger form-control-msg"><?php esc_html_e( 'Your email is Required', 'dropdownlist' ) ;?></small>
    </div><!-- .form-group -->
    <div class="form-group">
        <textarea class="form-control" id="message" name="message" placeholder="Your Message"  rows="8" cols="80"></textarea>
        <small class="text-danger form-control-msg"><?php esc_html_e( 'Your message is Required', 'dropdownlist' ) ;?></small>
    </div><!-- .form-group -->
    <button type="submit" class="btn btn-default formbutton" name="button">Submit</button>
    <small class="text-info form-control-msg js-form-submission"><?php esc_html_e( 'Submission in process, please wait..', 'dropdownlist' ) ;?></small>
    <small class="text-info form-control-msg js-form-success"><?php esc_html_e( 'Message sent!', 'dropdownlist' ) ;?></small>
    <small class="text-info form-control-msg js-form-error"><?php esc_html_e( 'There was a problem submitting the form.', 'dropdownlist' ) ;?></small>
    <?php wp_nonce_field( 'dropdown_list_my_action', 'dropdown_list_nonce_field' ); ?>
  </form><!-- form -->

</div><!-- .form-container -->
