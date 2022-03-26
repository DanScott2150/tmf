<?php
/**
 * Financial Data API Manager
 *
 * Company Data: https://site.financialmodelingprep.com/developer/docs/companies-key-stats-free-api
 * Stock Info Data: https://site.financialmodelingprep.com/developer/docs/stock-api
 *
 * Note Stock Info API is being accessed via JavaScript on the front end, not here.
 *
 * @package tmf
 */

/** Data_API */
class Data_API {

	private const API_KEY         = '2fbb16c2b70e1ecf2958597f887aec2f'; // I know this is bad practice. Just doing it for ease of testing/review.
	private const API_URL_COMPANY = 'https://financialmodelingprep.com/api/v3/profile/';
	/**
	 * Fetch company info (used for Stock Rec posts, sidebar/callout box)
	 *
	 * @param array $ticker - Array of WP_Term objects. (or, sometimes, just a string for a single ticker).
	 * @todo Probably beyond scope of this project, but since the data we fetch here presumably won't change super often, might be worth looking into
	 *       ways to cut down on excessive API calls for every page load. Maybe run API on each ticker's creation, and save as custom metadata attached
	 *       to the WP Term Object? Or store as a wp transient that expires/re-updates every [x] days?
	 */
	public function fetchCompanyInfo( $ticker ) {

		/**
		 * Due to poor planning, $ticker is sometimes an array, sometimes a string.
		 * If this were an ongoing project, I'd work on a more elegant fix to make sure $ticker is always a string for a single-ticker.
		 */
		if ( is_array( $ticker ) ) {
			$current_ticker = $ticker[0]->slug;
		} else {
			$current_ticker = $ticker;
		}

		$api_url  = self::API_URL_COMPANY . $current_ticker . '?apikey=' . self::API_KEY;
		$api_data = wp_remote_get( $api_url );

		if ( 200 !== $api_data['response']['code'] ) {
			return array(
				'code'    => $api_data['response']['code'],
				'message' => $api_data['response']['message'],
			);
		} else {
			return array(
				'code' => $api_data['response']['code'],
				'body' => json_decode( $api_data['body'] ),
			);
		}

	}

}
