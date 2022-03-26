<?php
/**
 * Page Template: Stock Recommendation (single post)
 *
 * @todo Stock info sidebar/callout box.
 *
 * @package tmf
 */

?>

<?php
get_header();

while ( have_posts() ) :
	the_post();
	?>

<article>

	<header>
		<h2>Stock Recommendation: <?php the_title(); ?> </h2>
		<?php get_template_part( 'template-parts/stock-ticker-list' ); ?>
		<?php get_template_part( 'template-parts/author-dateline' ); ?>
	</header>

	<div>
		<?php the_content(); ?>
	</div>

	<?php
	endwhile;

get_footer();
