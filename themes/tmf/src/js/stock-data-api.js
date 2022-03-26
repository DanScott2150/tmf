const API_URL_BASE = 'https://financialmodelingprep.com/api/v3/quote/';
const API_KEY = '2fbb16c2b70e1ecf2958597f887aec2f'; // I know this is bad practice. Just doing it for ease of testing/review.'
const CURRENT_TICKER = term; // Passed in via wp_add_inline_script(), will populate based on the term of the current archive page.

const URL = API_URL_BASE + CURRENT_TICKER + '?apikey=' + API_KEY;

const targetElement = document.querySelector('#js-stock-data');


const generateHTML = ( data ) => {
	let output = '';

	// Modify data for output
	let price             = data.price.toLocaleString();
	let priceChange       = data.change.toLocaleString();
	let percentChange     = data.changesPercentage.toFixed(2);
	let percentChangeSign = percentChange >= 0 ? '+' : ''; //api data includes minus-sign if negative
	let yearLow           = data.yearLow.toLocaleString();
	let yearHigh          = data.yearHigh.toLocaleString();
	let avgVolume         = data.avgVolume.toLocaleString();
	let mktCap            = Math.round(data.marketCap/1000000).toLocaleString();
	let lastDivOutput     = lastDiv ? `$${lastDiv} (${(lastDiv / price * 100).toFixed(2)}% yield)` : 'N/A';

	output = `
		<table>
			<tr>
				<td>Price</td>
				<td>$${price}</td>
			</tr>
			<tr>
				<td>Price Change</td>
				<td>$${priceChange} (${percentChangeSign}${percentChange}%)</td>
			</tr>
			<tr>
				<td>52 week range</td>
				<td>$${yearLow} - $${yearHigh}</td>
			</tr>
			<tr>
				<td>Avg Daily Volume:</td>
				<td>${avgVolume} shares</td>
			</tr>
			<tr>
				<td>Market Cap:</td>
				<td>$${mktCap} million</td>
			</tr>
			<tr>
				<td>Stock Beta:</td>
				<td>${beta}</td>
			</tr>
			<tr>
				<td>Last Dividend:</td>
				<td>${lastDivOutput}</td>
			</tr>
		</table>
	`;

	targetElement.innerHTML = output;

}

const generateError = (error) => {
	let output = '';

	output = `
		<div class="alert alert-danger">
			There was an error with the API request<br/>
			<strong>${error}</strong>
		</div>
	`;

	targetElement.innerHTML = output;
}

fetch(URL)
	.then(response => {
		if(200 !== response.status || !response.ok){
			throw new Error( `There was an Error with the API: ${response.status} -- ${response.statusText}` );
		}
		return response.json()
	})
	.then(data => generateHTML(data[0]))
	.catch(error => {
		generateError(error);
		console.error(error);
	});
