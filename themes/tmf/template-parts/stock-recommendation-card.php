<?php
/**
 * Stock Recommendation Card
 * For displaying single posts within a feed
 *
 * @package tmf
 */

?>

<div class="stock-recommendation-card border border-primary rounded my-2 p-3">
	<a href="<?php the_permalink(); ?>">
		<h4><?php the_title(); ?></h4>
		<?php get_template_part( 'template-parts/author-dateline' ); ?>
		<?php get_template_part( 'template-parts/stock-ticker-list' ); ?>
	</a>
</div>
