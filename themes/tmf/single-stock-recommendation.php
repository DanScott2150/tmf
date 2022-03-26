<?php
	/**
	 * Page Template: Stock Recommendation
	 *
	 * Requirements:
	 * 	- Basic 'content' template: author name, publish date, content
	 *  - Stock ticker callout box [split out into separate file] based on Stock Ticker taxonomy for post
	 */
?>

<?php
get_header();

	while ( have_posts() ) :
		the_post();
?>

<article>

	<header>
		<h2>News Article: <?php the_title(); ?> </h2>
		<h2><?php the_title(); ?> </h2>
	</header>

	<div>
		<?php the_content(); ?>
	</div>

<?php
	endwhile;

get_footer();
