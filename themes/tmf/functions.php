<?php
/**
 * Theme Functions
 *
 * This file is a bit of a mess. Could have planned things out a bit better here.
 * Given more time I would definitely split aspects of this (CPT registration, enqueue assets, pagination functionality) into their own standalone files/classes.
 * Would probably make sense to split some of these out into a standalone plugin(s) so they're theme-agnostic.
 *
 * @package tmf
 */

add_action( 'init', 'tmf_register_taxonomies', 0 ); // Need taxonomy to register before CPTs.
add_action( 'init', 'tmf_register_cpts', 1 );
add_action( 'init', 'tmf_misc_theme_init', 99 );
add_action( 'wp_enqueue_scripts', 'tmf_enqueue_assets' );
add_action( 'rest_api_init', 'create_endpoints' );

require get_template_directory() . '/inc/data-api/class-data-api.php';

/**
 * Register custom taxonomies: Stock Ticker
 * Includes support for 'Company' archive pages.
 */
function tmf_register_taxonomies() {
	require get_template_directory() . '/inc/taxonomies/class-stock-ticker.php';
	new Stock_Ticker();
}

/**
 * Register custom post types: News Article; Stock Recommendation
 */
function tmf_register_cpts() {
	require get_template_directory() . '/inc/post-types/class-news-article.php';
	require get_template_directory() . '/inc/post-types/class-stock-recommendation.php';

	new News_Article();
	new Stock_Recommendation();
}

/**
 * Theme init
 * Add WP support for auto-title. Not mission critical.
 */
function tmf_misc_theme_init() {
	add_theme_support( 'title-tag' );
}

/**
 * Enqueue assets & scripts
 */
function tmf_enqueue_assets() {
	wp_enqueue_style( 'bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'tmf-styles', get_stylesheet_uri() );

	// On single-company archive page ('stock ticker' taxonomy page), need to use JS fetch() for API call.
	if ( is_tax( 'stock-tickers' ) ) {

		wp_enqueue_script( 'stock-data-api', get_template_directory_uri() . '/src/js/stock-data-api.js', array(), '1.0', true );
		wp_add_inline_script( 'stock-data-api', 'const $PHP_TERM = "' . single_term_title( '', false ) . '"', 'before' );
		wp_enqueue_script( 'news-article-pagination', get_template_directory_uri() . '/src/js/news-article-pagination.js', array(), '1.0', true );
	}
}

/**
 * Custom endpoint for news-article CPT pagination via javascript
 * Doing it this way because 'Company' archive page has multiple post feeds.
 * Standard WP pagination doesn't really work
 *
 * Would probably make sense to break out into own file. Leaving here for ease of testing/review since it's the only one.
 */
function create_endpoints() {
	register_rest_route(
		'news-articles',
		'all',
		array(
			'methods'             => 'GET',
			'callback'            => 'news_articles_pagination',
			'permission_callback' => '__return_true',
		)
	);
}

/**
 * Custom pagination via javascript fetch() api.
 * `/wp-json/news-articles/all?stock-ticker=${term}&page=${loadMorePageNum}`
 *
 * Not sure if it would make more sense to split this into class-news-article.php CPT file
 *
 * Related, possible pain point: this depends on 'posts_per_page' being the same both HERE, as well as in
 * our helper function in class-stock-ticker.php -> Stock_Ticker::fetchCompanyNews( $company_ticker ), or else
 * pagination will either skip or duplicate certain posts. Probably coulda planned that out better.
 * If this was an ongoing project, would look into make this more foolproof.
 *
 * IMPORTANT: 'Load more' button html element needs to have a 'data-pagenum=[#]' attribute for this to work. There's probably a better way to foolproof this.
 *
 * @param Object $request -- WP_REST_Request Object.
 */
function news_articles_pagination( $request ) {

	$page_num = intval( $request->get_param( 'page' ) );
	$ticker   = strtolower( $request->get_param( 'stock-ticker' ) );
	$ppp      = 10;
	$response = '';

	$args = array(
		'post_type'      => 'news-article',
		'posts_per_page' => $ppp,
		'offset'         => $page_num * $ppp,
		'tax_query'      => array(
			array(
				'taxonomy' => 'stock-tickers',
				'field'    => 'slug',
				'terms'    => $ticker,
			),
		),
	);

	/**
	 * Fetch posts
	 * Using get_posts() rather than WP_Query because it gives us a simple array, easier to work with for this use case.
	 * Also need to invoke global $post so that our template parts can generate based on the current post in the loop.
	 */
	global $post;
	$paginatedPosts = get_posts( $args );

	foreach ( $paginatedPosts as $post ) {
		ob_start();
		get_template_part( 'template-parts/news-article-card', '', array( 'include_excerpt' ) );
		$response .= ob_get_clean();
	}

	wp_reset_query();

	return $response;

}
