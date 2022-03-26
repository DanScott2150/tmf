<?php
/**
 * Template Part for displaying stock ticker (or list of stock tickers) associated with given post.
 *
 * @todo Auto-link tickers to company page [once that's been built]
 * @package tmf
 */

$postTickersTerms = Stock_Ticker::getPostTickers(); // Returns array of WP_Term objects.

$postTickersArray = array_map(
	function( $object ) {
		return $object->name;
	}, $postTickersTerms
);

$postTickersString = implode( ', ', $postTickersArray );

?>

<div>
	<strong>Stock Tickers: <?php echo esc_html( $postTickersString ); ?></strong>
</div>
