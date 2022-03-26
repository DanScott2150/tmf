<?php
/**
 * Front page
 *
 * Bunch of hardcoded WP_Querys, just for ease of navigation for testing/review.
 *
 * @package tmf
 */

get_header();?>

<h2 class="text-center pb-3 mb-3 border-bottom">Front Page</h2>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-lg-6">
			<h3 class="text-center">News Articles</h3>

			<?php
				$news_args = array(
					'post_type'      => 'news-article',
					'posts_per_page' => 10,
				);

				$news_posts = new WP_Query( $news_args );

				if ( $news_posts->have_posts() ) {
					while ( $news_posts->have_posts() ) {
						$news_posts->the_post();
						get_template_part( 'template-parts/news-article-card' );
					}
				}
				?>

				<p class="mt-3"><a href="/news-article">View All News Articles >></a></p>
		</div>

		<div class="col-12 col-lg-6">

			<h3 class="text-center">Stock Recommendations</h3>

			<?php
				$rec_args = array(
					'post_type'      => 'stock-recommendation',
					'posts_per_page' => 10,
				);

				$rec_posts = new WP_Query( $rec_args );

				if ( $rec_posts->have_posts() ) {
					while ( $rec_posts->have_posts() ) {
						$rec_posts->the_post();
						get_template_part( 'template-parts/stock-recommendation-card' );
					}
				}
				?>

			<p class="mt-3"><a href="/stock-recommendation">View All Stock Recommendations >></a></p>

		</div>

	</div>
</div>

<hr/>

<div class="mb-5">
	<h3>Companies Covered</h3>

	<?php
		$terms_args = array(
			'taxonomy' => 'stock-tickers',
		);

		$terms = get_terms( $terms_args );

		foreach ( $terms as $ticker ) {
			echo '<a class="stock-ticker-badge badge bg-primary" href="/stock-tickers/' . esc_html( $ticker->slug ) . '">'
					. esc_html( $ticker->name )
					. '</a>'
					. '</span> ';
		}
		?>
</div>

<?php
	get_footer();
