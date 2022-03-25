<?php
	/**
	 * Page Template: [ARCHIVE] Stock Recommendation
	 *
	 * Requirements:
	 * 	- WP QUERY for stock rec CPTs, newest first
	 *  - Pagination: 10
	 *  - Show title + ticker (separate template file?)
	 */
?>

<?php
get_header();

if ( have_posts() ) : ?>

	<header>
		<?php the_archive_title(); ?>
	</header>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

			<h3><?php the_title(); ?></h3>
			<p>Ticker: </p>
	<?php endwhile; ?>



<?php else : ?>
	<h3>No Stock Recommendations to Show</h3>
<?php endif; ?>


<?php

get_footer();
