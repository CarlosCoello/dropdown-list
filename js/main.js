jQuery(document).ready(function($) {

  /*
 Main Navigation Toggle Open or Close
 _______________________________________
 */
 $(document).on('click', '.nav-toggleSidebar', function() {
        $('.navbar-default').toggleClass('sidebar-closed');
        $('html').toggleClass('no-scroll');
        $('.sidebar-overlay').fadeToggle(500);
    });

  /*
 Sidebar Toggle Open or Close
 _______________________________________
 */
 $(document).on('click', '.js-toggleSidebar', function() {
        $('.dropdown-list-sidebar').toggleClass('sidebar-closed');
        $('html').toggleClass('no-scroll');
        $('.sidebar-overlay').fadeToggle(500);
    });

  /*
  ScrollTop
  ______________________________________
  */

  //window on scroll show scroll top button
  $(document).on('scroll', function(){


      if ($(document).scrollTop() > 400) { // this refers to window
          $('.ninety-nine-scroll-top').removeClass('hide');
      } else {
        $('.ninety-nine-scroll-top').addClass('hide');
      }


  });

  //On Click
  $('.ninety-nine-scroll-top').on('click', function(){

    $('html, body').animate({
           scrollTop: $('html').position().top
       }, 1500);

  });
  /*
  Contact Form Submission
  _____________________________________
  */

  $('.contactForm').on('submit', function(e) {
       e.preventDefault();

       $('.has-error').removeClass('has-error');

       var form = $(this);

       var name = form.find('#name').val();
       var email = form.find('#email').val();
       var message = form.find('#message').val();
       var ajaxurl = form.data('url');
       var dropdown_list_nonce_field = form.find('#dropdown_list_nonce_field').val();

       if (name === '') {
           $('#name').parent('.form-group').addClass('has-error');
           return;
       }
       if (email === '') {
           $('#email').parent('.form-group').addClass('has-error');
           return;
       }
       if (message === '') {
           $('#message').parent('.form-group').addClass('has-error');
           return;
       }
       form.find('input, textarea, button').attr('disabled', 'disabled');
       $('.js-form-submission').addClass('js-show-feedback');


       $.ajax({

           url: ajaxurl,
           type: 'post',
           data: {
               dropdown_list_nonce_field: dropdown_list_nonce_field,
               name: name,
               email: email,
               message: message,
               action: 'dropdown_list_save_user_contact_form'

           },
           error: function(response) {
               $('.js-show-feedback').removeClass('js-show-feedback');
               $('.js-form-error').addClass('js-show-feedback');
               form.find('input, textarea, button').removeAttr('disabled');
           },
           success: function(response) {
               $('#name').val('');
               $('#email').val('');
               $('#message').val('');
               $('.js-show-feedback').removeClass('js-show-feedback');
               $('.js-form-success').addClass('js-show-feedback');
           }
       });


   });

   /*
   Select Option Ajax Data Request
   ____________________________________________
   */

   $('.select-form').on('submit', function(e){
     e.preventDefault();

     var form = $(this);
      var category = form.find('#category option:selected').val();
      var tag = form.find('#tag option:selected').val();
      var select_option_nonce_field = form.find('#select_option_nonce_field').val();
      var ajaxurl = form.data('url');

      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            select_option_nonce_field: select_option_nonce_field,
            category: category,
            tag: tag,
            action: 'select_option_data_request_form'
        },
        error: function(response) {
            // $('.js-show-feedback').removeClass('js-show-feedback');
            // $('.js-form-error').addClass('js-show-feedback');
            // form.find('input, textarea, button').removeAttr('disabled');
        },
        success: function(response) {

          if( response == 'error' ){

          } else {
          $('.ajax-response').hide();
          $('.ajax-data').empty();
          $('.ajax-data').append(response);
                }
            // $('#name').val('');
            // $('#email').val('');
            // $('#message').val('');
            // $('.js-show-feedback').removeClass('js-show-feedback');
            // $('.js-form-success').addClass('js-show-feedback');
        }
      });

   });

}); //document ends
