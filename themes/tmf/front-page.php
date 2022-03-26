<?php
/**
 * Front page
 *
 * Bunch of hardcoded WP_Querys, just for ease of navigation for testing/review.
 *
 * @package tmf
 */

get_header();?>

<h2>Front Page</h2>

<h3>News Articles</h3>

<?php
	$news_args = array(
		'post_type'      => 'news-article',
		'posts_per_page' => -1,
	);

	$news_posts = new WP_Query( $news_args );

	if ( $news_posts->have_posts() ) {
		while ( $news_posts->have_posts() ) {
			$news_posts->the_post();
			get_template_part( 'template-parts/news-article-card' );
		}
	}
	?>

<hr/>

<h3>Stock Recommendations</h3>
<a href="/stock-recommendation">Archive</a>

<?php
	$rec_args = array(
		'post_type'      => 'stock-recommendation',
		'posts_per_page' => -1,
	);

	$rec_posts = new WP_Query( $rec_args );

	if ( $rec_posts->have_posts() ) {
		while ( $rec_posts->have_posts() ) {
			$rec_posts->the_post();
			get_template_part( 'template-parts/stock-recommendation-card' );
		}
	}
	?>

<hr/>


<h3>Companies</h3>

<?php
	$terms_args = array(
		'taxonomy' => 'stock-tickers',
	);

	$terms = get_terms( $terms_args );

	foreach ( $terms as $ticker ) {
		echo '<a href="/stock-tickers/' . esc_html( $ticker->slug ) . '">'
				. esc_html( $ticker->name )
				. '</a>, ';
	}

	get_footer();
