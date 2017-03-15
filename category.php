<?php

get_header(); ?>

	<section id="primary" class="content-area">

		<main id="main" class="site-main" role="main">


		 <?php

          // $idObj = get_category_by_slug( 'sports' );
          //  $id = $idObj->term_id;
            $current_category = single_cat_title("", false);


          $query = new WP_Query( array( 'category_name' => $current_category, 'post_status' => 'publish', 'posts_per_page' => -1  ) ); ?>

		<?php if ( $query->have_posts() ) : ?>

		<div class="container index-posts before-load-posts">

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title dashicons-before dashicons-category">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( $query->have_posts() ) : $query->the_post(); ?>



    				<?php get_template_part( 'template-parts/content', get_post_format() );?>



		<?php	// End the loop.
			endwhile; ?> </div> <?php else : ?>
		 <div class="container sorry-no-posts-message">

			<p><?php esc_html_e( 'Sorry, no posts matche your criteria.', 'dropdownlist' ) ;?></p>

  		</div><!-- .sorry-no-posts-message -->

  		<?php wp_reset_postdata(); endif; ?>


		</main><!-- .site-main -->

	</section><!-- .content-area -->

<?php get_footer(); ?>
