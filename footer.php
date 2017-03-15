<footer id="footer">

  <div class="container-fluid inner-footer">

    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-4 text-center">

        <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

      </div><!-- .text-center -->

      <div class="col-xs-12 col-sm-12 col-md-4 text-center">

        <?php the_widget( 'WP_Widget_Categories' ); ?>

      </div><!-- .text-center -->

      <div class="col-xs-12 col-sm-12 col-md-4 text-center">

        <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

      </div><!-- .text-cnter -->

    </div><!-- .row -->

  </div><!-- .inner-footer -->

</footer><!-- #footer -->

<?php wp_footer() ;?>

</body>
</html>
