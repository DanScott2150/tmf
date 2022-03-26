<?php
/**
 * News Article Card
 * For displaying within feeds.
 *
 * @package tmf
 */

$permalink = get_the_permalink();

?>

<style>
	.news-article-card:hover{
		cursor:pointer;
		background-color: #D3D3D3;
	}
</style>

<div class="news-article-card border border-primary rounded my-2" >
	<a href="<?php echo esc_attr( $permalink ); ?>">

		<div class="p-3">

			<h4><?php the_title(); ?></h4>
			<div><?php get_template_part( 'template-parts/author-dateline' ); ?></div>
			<div><?php get_template_part( 'template-parts/stock-ticker-list' ); ?></div>

			<?php
			if ( $args && in_array( 'include_excerpt', $args, true ) ) {
				the_excerpt();
			}
			?>

		</div>

	</a>

</div>
