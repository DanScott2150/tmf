<?php

	/**
	 * Custom Post Type: News Article
	 *
	 * Requirements:
	 * 	- Basic content editing (standard post)
	 *  - Custom taxonomy: Stock Ticker
	 */

	class News_Article {

		public function __construct(){
			add_action( 'init', [ $this, 'register_cpt' ] );
		}


		public function register_cpt() {

			$labels = array(
				'name'          => __( 'News Articles' ),
				'singular_name' => __( 'News Article' ),
				'menu_name'     => __( 'News Articles' ),
				'add_new'       => __( 'Add New Article' ),
    			'add_new_item'  => __( 'Add New Article' ),
				'not_found'     => __( 'No News Articles Found' ),
			);

			$args = array(
				'label'         => __( 'News Article' ),
				'labels'        => $labels,
				'supports'      => [ 'title', 'editor', 'author', 'thumbnail' ],
				'taxonomies'    => [ 'stock_ticker' ],
				'public'        => true,
				'menu_position' => 5,
				'menu_icon'     => 'dashicons-media-document',
				'has_archive'   => true,
				'rewrite'       => [ 'slug' => 'news-article' ],

			);

			register_post_type( 'news_article', $args );

		}



	}
