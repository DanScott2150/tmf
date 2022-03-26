<?php

	require get_template_directory() . '/inc/post-types/class-news-article.php';
	require get_template_directory() . '/inc/post-types/class-stock-recommendation.php';
	require get_template_directory() . '/inc/taxonomies/class-stock-ticker.php';

	new News_Article();
	new Stock_Recommendation();
	new Stock_Ticker();

	add_theme_support( 'title-tag' );
