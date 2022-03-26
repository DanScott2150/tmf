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
		<?php get_template_part( 'template-parts/author-dateline' ); ?>
	</header>

	<div>
		<?php the_content(); ?>
	</div>

</article>

<?php
	endwhile;

get_footer();
