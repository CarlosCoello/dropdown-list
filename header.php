<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>

<!DOCTYPE html>
<html <?php language_attributes( ); ?>>
<head>
  <title><?php bloginfo( 'name' ); wp_title();?></title>
  <meta name="description" content="<?php bloginfo( 'description' );?>">
  <meta charset="<?php bloginfo( 'charset' ) ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if(  is_singular() && pings_open( get_queried_object() ) ): ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>
  <?php wp_head();?>
</head>

<body <?php body_class(); ?>>
  <div class="dropdown-list-sidebar sidebar-closed">
    <div class="dropdown-list-sidebar-container">
      <a class="js-toggleSidebar sidebar-close">
        <span class="dashicons dashicons-no dropdown-list-close"></span>
      </a><!-- .sidebar-close -->
      <div class="sidebar-scroll">
        <?php get_sidebar(); ?>
      </div><!-- .sidebar-scroll -->
    </div><!-- .dropdown-list-sidebar-container -->
  </div><!-- .dropdown-list-sidebar -->

  <div class="sidebar-overlay"></div>

  <?php if( has_header_image() ){ ;?>
  <div class="container-fluid theme-support-header-image">
  <img src="<?php header_image(); ?>"/>
  </div><!-- .theme-support-background-image -->
  <?php } else {

    } ;?>

  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( bloginfo( 'title' ) ) ;?></a>
      </div><!-- .navbar-header -->
      <?php wp_nav_menu( array(
                    'theme_location'       => 'primary',
                    'container'            => 'div',
                    'container_class'      => 'collapse navbar-collapse',
                    'container_id'         => 'bs-example-navbar-collapse-1',
                    'menu_class'           => 'nav navbar-nav',
                    'fallback_cb'          => 'wp_bootstrap_navwalker::fallback',
                    'walker'               => new wp_bootstrap_navwalker()
                ) ); ?>
    </div><!-- .container -->
  </nav><!-- nav -->
  <div class="sidebar-button">
      <a class="js-toggleSidebar sidebar-open">
        <span class="open-sidebar"><?php esc_html_e( 'O/S', 'dropdown-list' ) ;?></span>
      </a><!-- .sidebar-open -->
    </div><!-- .sidebar-button -->

    <?php

    if( is_plugin_active( 'nnscrolltop/nnscrolltop.php' ) ){
     echo plugin_scroll_shortcode_march();
   } else {
     return;

   } ?>
