<?php
/**
 * Page Template: News Article
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

	<header class="pb-3 mb-3 border-bottom">
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
