
<div class="container single-post before-load-posts">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header text-center">
			<?php the_title( '<h1 class="entry-title">', '</h1>'); ?>
			<div class="entry-meta"></div>
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">

			<?php the_content(); ?>
			<?php the_post_thumbnail();?>

		</div><!-- .entry-content -->

		<div class="dropdown-list-share-it">

			<?php

				$title = get_the_title();
				$permalink = get_permalink();

				$twitterHandler = ( get_option('twitter_handler') ? '&amp;via='.esc_attr( get_option('twitter_handler') ) : '' );

				$twitter = 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$permalink.$twitterHandler.'';

				$facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;

				$google = 'https://plus.google.com/share?url='.$permalink;


			 ?>

			 <ul>
			 	<li><a href="<?php echo $twitter; ?>" target="_blank" rel="nofollow"><span class="dashicons dashicons-twitter"></spa></a></li>
			 	<li><a href="<?php echo $facebook; ?>" target="_blank" rel="nofollow"><span class="dashicons dashicons-facebook"></spa></a></li>
			 </ul>

		</div><!-- .dropdown-list-share-it -->

		<footer class="entry-footer">
			<p><?php the_tags(); ?></p>
			<?php echo dropdown_list_post_navigation(); ?>
		</footer><!-- entry-footer -->

	</article><!-- article -->

</div><!-- .before-load-posts -->
