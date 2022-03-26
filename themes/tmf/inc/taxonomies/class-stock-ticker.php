<?php

/**
 * Class Stock_Ticker
 *
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
			'name'          => __( 'Stock Ticker' ),
			'singular_name' => __( 'Ticker' ),
			'menu_name'     => __( 'Stock Tickers' ),
			'all_items'     => __( 'All Tickers' ),
			'edit_item'     => __( 'Edit Ticker' ),
			'view_item'     => __( 'View Ticker' ),
			'update_item'   => __( 'Update Ticker' ),
			'add_new_item'  => __( 'Add New Ticker' ),
			'not_found'     => __( 'No Tickers Found' ),
		];

		$args = [
			'labels'            => $labels,
			'public'            => true,
			'show_admin_column' => true,
		];

		register_taxonomy( 'stock-tickers', [ 'news-article', 'stock-recommendation' ], $args );

	}

	/**
	 * Get list of all stock tickers (terms) associated with a given post.
	 * Broken out here so we can use across various CPTs.
	 *
	 * return Array of WP_Term Objects (or false if none)
	 */
	public static function getPostTickers() {

		return get_the_terms( get_the_ID(), 'stock-tickers' );

	}
}
