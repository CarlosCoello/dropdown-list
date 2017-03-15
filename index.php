<?php get_header() ;?>

<?php
/*
Dynamic Select Option Values
_____________________________________
*/
?>
<div class="container">
  <form class="select-form" action="#" method="post" data-url="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>">

    <div class="form-group">
      <label for="category">Category</label>
      <select id="category" name="Category">
      <?php
      function categories_select_list(){
        $categories = get_categories();
        $output = '<option value=""></option>';

        if ( !empty( $categories ) ){

          foreach ($categories as $category) {
            $output .= '<option value="'.$category->name.'" class="'.$category->name.'">'.$category->name.'</option>';
          }
        return $output;
        }
    }
    echo categories_select_list();

      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="tag">Tag</label>
    <select id="tag" name="Tag">
      <?php
      function tags_select_list(){
        $tags = get_tags();
        $output = '<option value=""></option>';

        if ( !empty( $tags ) ){

          foreach ($tags as $tag) {
            $output .= '<option value="'.$tag->name.'" class="'.$tag->name.'">'.$tag->name.'</option>';
          }
        return $output;
        }
    }
    echo tags_select_list();

      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-default formbutton" name="button">Submit</button>
<?php wp_nonce_field( 'select_option_my_action', 'select_option_nonce_field' ); ?>
</form>
</div>
<?php
/*
Select Option Ajax Data Response Container
____________________________________________
*/
 ?>
 <div class="container ajax-data">

 </div>
<?php
/*
Loop Container
_____________________________________
*/
?>
<div class="container ajax-response">

<?php if ( have_posts() ) {

 $i = 0;

      /* Start the Loop */
      while ( have_posts() ) { the_post(); ?>

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

      <?php } ?>

</div><!-- .ajax-response -->

<?php get_footer() ;?>
