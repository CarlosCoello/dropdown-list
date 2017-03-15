<?php

get_header(); ?>

	<section id="primary" class="content-area">

		<main id="main" class="site-main" role="main">


		 <?php

		<?php if ( have_posts() ) : ?>

		<div class="container index-posts before-load-posts">

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title dashicons-before dashicons-category">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>



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
