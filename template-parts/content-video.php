<?php


/*
VIDEO POST CONTENT
____________________________________________
*/

$class = get_query_var( 'posts-class' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'dropdown-list-format-video', $class ) ); ?>>

   <header class="entry-header text-center">
      <?php the_title( '<h1 class="entry-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">', '</a></h1>' ); ?>
      <div class="entry-meta">
        <?php echo dropdown_list_posted_meta(); ?>
      </div>
   </header>

   <div class="entry-content">
     <div class="embed-responsive embed-responsive-16by9">
       <?php echo dropdown_list_get_embedded_media( array( 'video', 'iframe') ); ?>
     </div><!-- .embed-responsive -->
     <div class="entry-tags">
       <?php the_tags( 'Tags: ',' > ' ); ?>
     </div><!-- .entry-tags -->
     <div class="entry-excerpt">
       <?php the_excerpt(); ?>
     </div><!-- .entry-excerpt -->
     <div class="button-container text-center">
       <a href="<?php the_permalink();?>" class="btn btn-default">
         <?php _e( 'Read More' ); ?>
       </a><!-- .btn -->
     </div><!-- .button-container -->
   </div><!-- .entry-content -->

 </article><!-- article -->
