<?php
/**
 * Stock Recommendation Card
 * For displaying single posts within a feed
 *
 * @package tmf
 */

?>

<style>
	.stock-recommendation-card:hover{
		cursor:pointer;
		background-color: #D3D3D3;
	}
</style>

<div class="stock-recommendation-card border border-primary rounded my-2 p-3">
	<a href="<?php the_permalink(); ?>">
		<h3><?php the_title(); ?></h3>
		<?php get_template_part( 'template-parts/stock-ticker-list' ); ?>
	</a>
</div>
