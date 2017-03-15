<?php

/*
Quote Post format
___________________________________________
*/

$class = get_query_var( 'posts-class' );


 ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(array( 'dropdown-list-format-quote', $class)); ?>>

   <header class="entry-header text-center">
     <div class="row">
      <div class="cpl-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <?php the_title( '<h1 class="quote-author">' ,'</h1>' ); ?>
        <h2 class="quote-content">
          <span class="dashicons dashicons-format-quote"></span>
          <?php echo get_the_content();?>
          <span class="dashicons dashicons-format-quote"></span>
        </h2><!-- .quote-content -->
      </div><!-- col-md-offset-2 -->
      </div><!-- .row -->
   </header><!-- .entry-header -->

 </article><!-- article -->
