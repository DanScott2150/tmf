<?php
/**
 * ARCHIVE PAGE for 'Stock Recommendation' CPT
 *
 * Displays list of links to all Stock Rec posts.
 * Sort: Newest First
 * Pagination: 10
 * Feed: Post Title, Post Ticker(s), Link
 *
 * Modifications to archive WP_Query made via class-stock-recommendation.php CPT.
 *
 * @todo Break individual posts in feed out into separate template part (re-use in taxonomy-stock-tickers.php for feed there).
 *
 * @package tmf
 */

get_header();

if ( have_posts() ) : ?>

	<header>
		<?php the_archive_title(); ?>
	</header>

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/stock-recommendation-card' );

	endwhile;
	?>

	<div><?php previous_posts_link( '<< Older Stock Recommendations' ); ?></div>
	<div><?php next_posts_link( 'Newer Stock Recommendations >>' ); ?></div>

<?php else : ?>
	<h3>No Stock Recommendations to Show</h3>
<?php endif; ?>


<?php

get_footer();
