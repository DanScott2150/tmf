<?php
	/**
	 * Page Template: News Article
	 *
	 * Requirements:
	 * 	- Basic 'content' template: author name, publish date, content
	 *  -
	 */
?>

<?php
get_header();

	while ( have_posts() ) :
		the_post();
?>

<article>

	<header>
		<h2><?php the_title(); ?> </h2>
	</header>

	<div>
		<?php the_content(); ?>
	</div>

<?php
	endwhile;

get_footer();
