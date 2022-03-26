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
 * @todo If this was an ongoing project, would probably look at more elegant/better UI pagination solution.
 *
 * @package tmf
 */

get_header();

if ( have_posts() ) : ?>

	<header class="pb-3 mb-3 border-bottom">
		<h2><?php the_archive_title(); ?></h2>
	</header>

	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/stock-recommendation-card' );
	endwhile;
	?>

	<div><?php previous_posts_link( '<< Newer Stock Recommendations' ); ?> || <?php next_posts_link( 'Older Stock Recommendations >>' ); ?> </div>

<?php else : ?>
	<h3>No Stock Recommendations to Show</h3>
<?php endif; ?>


<?php

get_footer();
