<?php
/**
 * Financial Data API Manager
 *
 * Company Data: https://site.financialmodelingprep.com/developer/docs/companies-key-stats-free-api
 *
 * @package tmf
 */

/** Data_API */
class Data_API {

	private const API_KEY = '2fbb16c2b70e1ecf2958597f887aec2f'; // I know this is bad practice. Just doing it for ease of testing/review.

	/**
	 * Fetch company info (used for Stock Rec posts, sidebar/callout box)
	 *
	 * @param array $ticker - Array of WP_Term objects.
	 *
	 * @todo if time, ideally refactor this + getPostTickers() function so that we just pass a single-ticker string to this, rather than array of objects.
	 */
	public function fetchCompanyInfo( $ticker ) {

		$api_url_base   = 'https://financialmodelingprep.com/api/v3/profile/';
		$current_ticker = $ticker[0]->slug;
		$api_url        = $api_url_base . $current_ticker . '?apikey=' . self::API_KEY;
		$api_data       = wp_remote_get( $api_url );

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
