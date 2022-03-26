<?php
/**
 * Template Part for displaying stock ticker (or list of stock tickers) associated with given post.
 *
 * @todo find way to fix URL to stock ticker taxonomy page, would be better as /company/[slug], as opposed to /stock-ticker/[slug]
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
