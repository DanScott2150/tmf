<?php
/**
 * CUSTOM POST TYPE: Stock Recommendation
 *
 * Basic WordPress post, but with support for 'stock ticker' taxonomy.
 *
 * @package tmf
 */

/** Class Stock_Recommendation */
class Stock_Recommendation {

	/** Constructor */
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );
	}

	/** Register CPT with WordPress */
	public function register_cpt() {

		$labels = array(
			'name'          => __( 'Stock Recommendations' ),
			'singular_name' => __( 'Stock Recommendation' ),
			'menu_name'     => __( 'Stock Recommendations' ),
			'add_new'       => __( 'Add New Stock Recommendation' ),
			'add_new_item'  => __( 'Add New Stock Recommendation' ),
			'not_found'     => __( 'No Stock Recommendations Found' ),
		);

		$args = array(
			'label'         => __( 'Stock Recommendation' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'author', 'thumbnail' ),
			'taxonomies'    => array( 'stock_ticker' ),
			'public'        => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-money-alt',
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => 'stock-recommendation' ),

		);

		register_post_type( 'stock-recommendation', $args );

	}
}
