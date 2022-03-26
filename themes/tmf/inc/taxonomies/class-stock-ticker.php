<?php
/**
 * CUSTOM TAXONOMY: Stock Ticker
 *
 * Creates custom taxonomy for usage with 'News Article' & 'Stock Recommendation' CPTs
 * 'tag' type taxonomy (i.e. possible for multiple tickers per post)
 *
 * Includes utility function for outputting tickers to front end for a given post.
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
}
