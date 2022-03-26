<?php

/**
 * @todo: Clean this up
 */

	require get_template_directory() . '/inc/post-types/class-news-article.php';
	require get_template_directory() . '/inc/post-types/class-stock-recommendation.php';
	require get_template_directory() . '/inc/taxonomies/class-stock-ticker.php';
	require get_template_directory() . '/inc/data-api/class-data-api.php';

	new News_Article();
	new Stock_Recommendation();
	new Stock_Ticker();

	add_theme_support( 'title-tag' );

	add_action( 'wp_enqueue_scripts', 'tmf_theme_init' );

	function tmf_theme_init() {
		wp_enqueue_style( 'bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
		wp_enqueue_style( 'tmf-styles', get_stylesheet_uri() );

	}
