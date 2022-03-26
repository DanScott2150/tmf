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
		<h2>News Article: <?php the_title(); ?> </h2>
		<?php get_template_part( 'template-parts/stock-ticker-list' ); ?>
		<em>Posted by <?php the_author(); ?> on <?php the_date(); ?></em>
	</header>

	<div>
		<?php the_content(); ?>
	</div>

</article>

<?php
	endwhile;

get_footer();
