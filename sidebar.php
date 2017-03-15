<?php

  /*
  ==================================
  Sidebar
  ==================================
  */

  if ( !is_active_sidebar( 'dropdown-list-sidebar' ) ){

      return;

  }

  ?>

  <aside id="secondary" class="widget-area" role="complementary">

    <?php dynamic_sidebar( 'dropdown-list-sidebar' );?>

  </aside><!-- #secondary -->
