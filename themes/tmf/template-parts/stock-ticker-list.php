<?php
/**
 * Template Part for displaying stock ticker (or list of stock tickers) associated with given post.
 * Built it out this way to accomodate any posts that might have multiple stock tickers, but didn't fully follow-through on that elsewhere.
 * If this were an ongoing project that might be something to re-visit.
 *
 * @package tmf
 */

$postTickersTerms = Stock_Ticker::getPostTickers(); // Returns array of WP_Term objects.

$postTickersArray = array_map(
	function( $object ) {
		return '<a href="/stock-tickers/' . $object->slug . '" class="stock-ticker-badge badge bg-primary" >' . $object->name . '</a>';
	}, $postTickersTerms
);

$postTickersString = implode( ', ', $postTickersArray );


?>

<div>
	<strong>Stock Tickers: <?php echo wp_kses( $postTickersString, 'post' ); ?></strong>
</div>
