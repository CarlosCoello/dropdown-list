<?php

/*
Register Nav Menu's
_______________________________________________________
 */

  function dropdown_list_register_nav_menu(){

    register_nav_menus( array(
  	'primary'    => 'Header Navigation Menu',
  	'footer_one' => 'Footer Nav One',
    'footer_two' => 'Footer Nav Two',
  ) );

  }

add_action( 'after_setup_theme', 'dropdown_list_register_nav_menu' );

/*
Adding Post Formats
___________________________________________________________
 */

  $options = get_option( 'post_formats' );
  $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
  $output = array();
  foreach ( $formats as $format ) {
    $output[] = ( @$options[ $format ] == 1 ? $format : '' );
  }

  if( !empty( $options ) ){

    add_theme_support( 'post-formats', $output );

  }

/*
Custom logo
_____________________________________________________________
*/

$logo = get_option('custom_logo');
if( @$logo == 1 ){
  add_theme_support( 'custom-logo' );
}

/*
Adding Custom Header
____________________________________________________________
 */

  $header = get_option('custom_header');
  if( @$header == 1 ){
    add_theme_support( 'custom-header' );
  }

/*
Adding Custom Background
__________________________________________________________
 */

  $background = get_option('custom_background');
  if( @$background == 1 ){
    add_theme_support( 'custom-background' );
  }

/*
Adding Post Thumbnail
___________________________________________________________
*/

  add_theme_support( 'post-thumbnails' );

  /*
  Adding HTML5 Support
  _________________________________________
   */

  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

  /*
  Footer Copyright
  ____________________________________________
   */

  function dropdown_list_copyright() {

  global $wpdb;

  $copyright_dates = $wpdb->get_results("

  SELECT
  YEAR(min(post_date_gmt)) AS firstdate,
  YEAR(max(post_date_gmt)) AS lastdate
  FROM

  $wpdb->posts

  WHERE
  post_status = 'publish'
  ");

  $output = '';

  if($copyright_dates) {

  $copyright = "&copy; " . $copyright_dates[0]->firstdate;

  if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {

  $copyright .= '-' . $copyright_dates[0]->lastdate;

  }

  $output = $copyright;

  }

  return $output;

  }


  /*
  Sidebar
  ________________________________________________
   */

  function dropdown_list_sidebar_init(){

    register_sidebar( $args = array(
      'name' => esc_html__( 'Dropdown List Sidebar', 'dropdown-list' ),
      'id' => 'dropdown-list-sidebar',
      'description' => 'Dynamic right sidebar',
      'before_widget' => '<section id="%1$s" class="dropdown-list-widget %2$s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="dropdown-list-widget-title">',
      'after_title' => '</h2>'
    ) );

  }

  add_action( 'widgets_init', 'dropdown_list_sidebar_init' );

  /*
  BLOG LOOP CUSTOM FUNCTIONS
  ___________________________________________
   */

  function dropdown_list_posted_meta(){

    $posted_on = human_time_diff( get_the_time( 'U'), current_time( 'timestamp') );
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    $i = 1;

    if ( !empty( $categories ) ){

      foreach ($categories as $category) {
        if( $i > 1 ){
          $output .= $separator;
        }
        $output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" alt="'.esc_attr( 'View all posts in%s', $category->name ).'">'.esc_html( $category->name ).'</a>';
        $i++;
      }

    }

    return '<span class="posted-on">Posted <a href="'.esc_url( get_permalink() ).'">'. $posted_on .'</a>ago</span>/<span class="posted-in">'. $output .'</span>';

  }

  /*
  Audio Post Format Custom Function
  _____________________________________________________
   */

  function dropdown_list_get_embedded_media( $type = array() ){

    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed = get_media_embedded_in_content( $content, $type );
    if( in_array( 'audio', $type ) ){
    $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
  } else {
    $output = $embed[0];
  }

    return $output;

  }

  /*
  Video Post Format Custom Function
  ____________________________________________
   */

  function dropdown_list_get_attachment( $num = 1 ){

    $output = '';
    if( has_post_thumbnail() && $num == 1 ):
     $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) );
   else:

    $attachments = get_posts( array(
         'post_type'        => 'attachment',
         'posts_per_page'   => $num,
         'post_parent'      => get_the_id()
     ) );

     if( $attachments && $num == 1 ):
       foreach( $attachments as $attachment ):
         $output = wp_get_attachment_url( $attachment->ID );
       endforeach;
       elseif( $attachments && $num > 1 ):
         $output = $attachments;
     endif;

     wp_reset_postdata();

   endif;

     return $output;

  }

  function dropdown_list_grab_url(){
    if( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ){
        return false;
    }

    return esc_url_raw( $links[1] );
  }

  /*
  Navigation
  ________________________________________________________
   */

  function dropdown_list_post_navigation(){

    $nav = '<div class="row">';

    $prev = get_previous_post_link( '<div class="post-link-nav-left"><span class="dashicons dashicons-arrow-left-alt2"></span>%link</div>', '%title' );
    $nav .= '<div class="col-xs-12 col-sm-6">'.$prev.'</div>';

    $next = get_next_post_link( '<div class="post-link-nav-right">%link<span class="dashicons dashicons-arrow-right-alt2"><span></div>', '%title' );
    $nav .= '<div class="col-xs-12 col-sm-6 text-right">'.$next.'</div>';

    $nav .= '</div>';

    return $nav;

  }

?>
