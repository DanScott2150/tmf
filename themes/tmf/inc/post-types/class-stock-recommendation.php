<?php

	/**
	 * Custom Post Type: Stock Recommendation
	 *
	 * Requirements:
	 * 	- Basic content editing (standard post)
	 *  - Custom taxonomy: Stock Ticker
	 */

	class Stock_Recommendation{

		public function __construct(){
			add_action( 'init', [ $this, 'register_cpt' ] );
		}


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
				'supports'      => [ 'title', 'editor', 'author', 'thumbnail' ],
				'taxonomies'    => [ 'stock_ticker' ],
				'public'        => true,
				'menu_position' => 5,
				'menu_icon'     => 'dashicons-money-alt',
				'has_archive'   => true,
				'rewrite'       => [ 'slug' => 'stock-recommendation' ],

			);

			register_post_type( 'stock-recommendation', $args );

		}
	}
