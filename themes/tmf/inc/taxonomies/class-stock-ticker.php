<?php

/**
 * Custom Taxonomy: Stock Ticker
 *
 * Requirements:
 * 	- Applicable for CPTs: News Article, Stock Recommendation
 *  - Tag-type of taxonomy (i.e. possible for multiple tickers per post)
 *  - ..?
 */

class Stock_Ticker{

	public function __construct(){
		add_action( 'init', [ $this, 'register_taxonomy' ] );
	}

	public function register_taxonomy() {

		$labels = [
			'name'          => 'Stock Ticker',
			'singular_name' => 'Ticker',
			'menu_name'     => 'Stock Tickers',
			'all_items'     => 'All Tickers',
			'edit_item'     => 'Edit Ticker',
			'view_item'     => 'View Ticker',
			'update_item'   => 'Update Ticker',
			'add_new_item'  => 'Add New Ticker',
			'not_found'     => 'No Tickers Found',
		];

		$args = [
			'labels'            => $labels,
			'public'            => true,
			'show_admin_column' => true,
		];

		register_taxonomy( 'stock-tickers', [ 'news-article', 'stock-recommendation' ], $args );

	}
}
