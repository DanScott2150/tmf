<?php
/**
 * News Article Card
 * For displaying within feeds.
 *
 * @package tmf
 */

?>

<style>
	.news-article-card:hover{
		cursor:pointer;
		background-color: #D3D3D3;
	}
</style>

<div class="news-article-card border border-primary rounded my-2 p-3">
	<a href="<?php the_permalink(); ?>">
		<h4><?php the_title(); ?></h4>
		<?php get_template_part( 'template-parts/author-dateline' ); ?>
	</a>
</div>
