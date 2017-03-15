<?php

/*
Image Post Format
____________________________________________
*/

$class = get_query_var( 'posts-class' );


 ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'dropdown-list-format-image', $class ) ); ?>>

   <header class="entry-header text-center">
     <?php the_title( '<h1 class="entry-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">', '</a></h1>' ); ?>
     <div class="entry-meta">
       <?php echo dropdown_list_posted_meta(); ?>
     </div><!-- entry-meta -->
     <div class="image">
       <img src="<?php the_post_thumbnail_url(); ?>">
    </div>
   </header><!-- .entry-header -->
   <div class="entry-excerpt image-caption">
     <div class="entry-tags">
       <?php the_tags( 'Tags: ',' > ' ); ?>
     </div><!-- .entry-tags -->
   </div><!-- .entry-excerpt -->
 </article><!-- article -->
