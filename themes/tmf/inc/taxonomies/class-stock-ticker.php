<?php
/**
 * CUSTOM TAXONOMY: Stock Ticker
 *
 * Creates custom taxonomy for usage with 'News Article' & 'Stock Recommendation' CPTs
 * 'tag' type taxonomy (i.e. possible for multiple tickers per post)
 *
 * Includes utility functions for:
 * - outputting tickers to front end for a given post.
 * - Fetching (via WP_Query) all news article posts for a given ticker.
 * - Fetching (via WP_Query) all stock recommendation posts for a given ticker.
 *
 * @package tmf
 */

/** Class Stock_Ticker */
class Stock_Ticker {

	/** Constructor */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	}

	/** Register taxonomy within WordPress */
	public function register_taxonomy() {

		$labels = array(
			'name'          => __( 'Stock Ticker' ),
			'singular_name' => __( 'Ticker' ),
			'menu_name'     => __( 'Stock Tickers' ),
			'all_items'     => __( 'All Tickers' ),
			'edit_item'     => __( 'Edit Ticker' ),
			'view_item'     => __( 'View Ticker' ),
			'update_item'   => __( 'Update Ticker' ),
			'add_new_item'  => __( 'Add New Ticker' ),
			'not_found'     => __( 'No Tickers Found' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_admin_column' => true,
		);

		register_taxonomy( 'stock-tickers', array( 'news-article', 'stock-recommendation' ), $args );

	}

	/**
	 * Function: getPostTickers()
	 *
	 * Get list of all stock tickers (terms) associated with a given post.
	 * Broken out here so we can use across various CPTs.
	 *
	 * @return array - Array of WP_Term Objects (or false if none)
	 */
	public static function getPostTickers() {
		return get_the_terms( get_the_ID(), 'stock-tickers' );
	}


	/**
	 * Function: fetchCompanyNews()
	 *
	 * Runs custom WP_Query to fetch all 'news-article' CPTs associated for given stock ticker.
	 * Used on Company-specific pages.
	 *
	 * @param string $ticker - slug of stock-ticker taxonomy we want to fetch.
	 * @return object WP_Query - posts matching critera.
	 */
	public static function fetchCompanyNews( $ticker ) {

		$news_args = array(
			'post_type'      => 'news-article',
			'posts_per_page' => 10,
			'tax_query'      => array(
				array(
					'taxonomy' => 'stock-tickers',
					'field'    => 'slug',
					'terms'    => strtolower( $ticker ),
				),
			),
		);

		$news_posts = new WP_Query( $news_args );

		return $news_posts;
	}

	/**
	 * Function: fetchCompanyRecommendations()
	 *
	 * Runs custom WP_Query to fetch all 'stock-recommendation' CPTs associated for given stock ticker.
	 * Used on Company-specific pages.
	 *
	 * @param string $ticker - slug of stock-ticker taxonomy we want to fetch.
	 * @return object WP_Query - posts matching critera.
	 */
	public static function fetchCompanyRecommendations( $ticker ) {

		$rec_args = array(
			'post_type'      => 'stock-recommendation',
			'posts_per_page' => 10,
			'tax_query'      => array(
				array(
					'taxonomy' => 'stock-tickers',
					'field'    => 'slug',
					'terms'    => strtolower( $ticker ),
				),
			),
		);

		$rec_posts = new WP_Query( $rec_args );

		return $rec_posts;
	}
}
