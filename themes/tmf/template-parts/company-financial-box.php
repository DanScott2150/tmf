<?php
/**
 * Callout-box to display Company data for ticker of current post.
 * Using Javascript per project requirements.
 *
 * Div#js-stock-data gets overwritten via javascript, following the stock API response.
 * Ref: src/js/stock-data-api.js
 *
 * @package tmf
 */

?>

<div class="callout-box border border-secondary rounded p-3 mb-5">

	<h3 class="text-center mb-3">Stock Info</h3>
	<hr/>

	<div id="js-stock-data">Loading...</div>

</div> <!-- callout-box -->
