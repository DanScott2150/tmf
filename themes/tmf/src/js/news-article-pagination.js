/**
 * Custom pagination for 'news article' CPTs, as shown on 'Company' archive pages.
 * Doing it this way because there are two different post feeds on Company pages, so standard WP pagination gets wonky
 * Plus updating via javascript prevents a full page reload, way better UX in my opinion.
 *
 * If this were an ongoing project, would probably make this CPT-agnostic, so it could also be used on Stock Recommendations.
 * ^^ Probably also lots of other opportunities for improvements too.
 *
 * @param string $PHP_TERM -- Populates via wp_add_inline_script(). WP Term (stock ticker) for the current company archive page that we're viewing.
 */

const loadMoreButton    = document.getElementById('loadMoreButton');
const loadMoreContainer = document.getElementById('loadMoreContainer');

// Passed in via wp_inline_script(), current taxonomy term. In this case, it's the specific stock ticker for the Company page we're on.
let term = $PHP_TERM;

loadMoreButton.addEventListener( 'click', (e) => {
	e.preventDefault();
	loadMoreArticles();
});

// Hits custom endpoint via functions.php
// Runs WP_Query for news articles CPTs with current stock ticker, with calculated offset based on current pagination.
function loadMoreArticles() {

	// Current 'page number' (for WP_Query) stored via data attribute.
	const loadMorePageNum = loadMoreButton.dataset.pagenum;
	const restRoute       = `/wp-json/news-articles/all?stock-ticker=${term}&page=${loadMorePageNum}`;

	fetch(restRoute)
		.then(response => response.json())
		.then(data => {
			data ? loadMoreContainer.innerHTML += data : loadMoreContainer.innerHTML += "No More Results!";
		})
		.then( () => loadMoreButton.dataset.pagenum++ );
}
