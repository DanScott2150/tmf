<?php
/**
 * CUSTOM POST TYPE: News Article
 *
 * Basic WordPress post, but with support for 'stock ticker' taxonomy.
 *
 * @package tmf
 */

/** News Article */
class News_Article {

	/** Constructor */
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );
	}

	/** Register CPT */
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
			'supports'      => array( 'title', 'editor', 'author' ),
			'taxonomies'    => array( 'stock_ticker' ),
			'public'        => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-media-document',
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => 'news-article' ),

		);

		register_post_type( 'news-article', $args );

	}
}
