<?php
/*
Comments
______________________
*/

if( post_password_required() ){

  return;

}


?>

<div id="comments" class="comments-area">

<?php if( have_comments() ){ ;?>
  <h2>
    <?php printf(
      esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'dropdownlist' ) ),
      number_format_i18n( get_comments_number() ),
      '<span>' . get_the_title() . '</span>'
    ); ?>
  </h2>
  <ol class="comment-list">
    <?php
    $args = array(
      'walker'            => null,
      'max_depth'         => '',
      'style'             => 'ol',
      'callback'          => null,
      'end-callback'      => null,
      'type'              => 'all',
      'reply_text'        => 'Reply',
      'page'              => '',
      'per_page'          => '',
      'avatar'            => 32,
      'reverse_top_level' => true,
      'reverse_childrend'   => true,
      'format'            => 'html5',
      'short_ping'        => false,
      'echo'              => true

    );
    wp_list_comments( $args ); ?>
  </ol>
    <?php if( !comments_open() && get_comments_number() ){;?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'dropdownlist' ); ?></p>
    <?php };?>
<?php }; ?>

<?php comment_form(  ); ?>

</div><!-- .comments-area -->
