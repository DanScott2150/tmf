<?php

require get_template_directory() . '/inc/post-types/class-news-article.php';
require get_template_directory() . '/inc/post-types/class-stock-recommendation.php';
require get_template_directory() . '/inc/taxonomies/class-stock-ticker.php';
require get_template_directory() . '/inc/data-api/class-data-api.php';

// Setup CPTs and Taxonomies.
new News_Article();
new Stock_Recommendation();
new Stock_Ticker();

add_action( 'init', 'tmf_theme_init' );
add_action( 'wp_enqueue_scripts', 'tmf_enqueue_assets' );

/**
 * Theme init
 */
function tmf_theme_init() {
	// Add WP support for auto-title.
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
		wp_add_inline_script( 'stock-data-api', 'const php_term = "' . single_term_title( '', false ) . '"', 'before' );
	}
}
