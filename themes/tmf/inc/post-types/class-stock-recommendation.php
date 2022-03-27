<?php
/**
 * CUSTOM POST TYPE: Stock Recommendation
 *
 * Basic WordPress post, but with support for 'stock ticker' taxonomy.
 * Includes utility function to make modifications to CPT's archive page query.
 *
 * @package tmf
 */

/** Class Stock_Recommendation */
class Stock_Recommendation {

	/** Constructor */
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );
		add_filter( 'pre_get_posts', array( $this, 'modify_archive_wp_query' ) );
	}

	/** Register CPT with WordPress */
	public function register_cpt() {

		$labels = array(
			'name'          => __( 'Stock Recommendations' ),
			'singular_name' => __( 'Stock Recommendation' ),
			'menu_name'     => __( 'Stock Recommendations' ),
			'add_new'       => __( 'Add New Stock Recommendation' ),
			'add_new_item'  => __( 'Add New Stock Recommendation' ),
			'edit_item'     => __( 'Edit Recommendation' ),
			'view_item'     => __( 'View Recommendation' ),
			'search_items'  => __( 'Search Recommendations' ),
			'not_found'     => __( 'No Stock Recommendations Found' ),
		);

		$args = array(
			'label'         => __( 'Stock Recommendation' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'author' ),
			'taxonomies'    => array( 'stock-tickers' ),
			'public'        => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-money-alt',
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => 'stock-recommendation' ),

		);

		register_post_type( 'stock-recommendation', $args );

	}

	/**
	 * Set custom pagination & sort for our archive page.
	 *
	 * @param object $query - WP Query for the archive page.
	 */
	public function modify_archive_wp_query( $query ) {

		if ( $query->is_main_query() && $query->is_archive() && $query->is_post_type_archive( 'stock-recommendation' ) ) {

			$query->set( 'posts_per_archive_page', 10 );
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'DESC' );

			return $query;
		}
	}
}
