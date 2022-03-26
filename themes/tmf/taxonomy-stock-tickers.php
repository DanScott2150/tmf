<?php
/**
 * COMPANY PAGE for individual stock-ticker taxonomy terms.
 *
 * Display:
 * -- Company name [tax custom field, OR API call]
 * -- Logo [tax custom field, OR API call]
 * -- Description [tax custom field, OR API call]
 * -- Financial Data [API call]
 *
 * Post feed: Stock Recommendations (newest first)
 * Post feed: News Articles (header "Other Coverage", newest first, pagination 10)
 *
 * @package tmf
 */

get_header();

$company_ticker = single_term_title( '', false );
?>

<h2>Company Page: <?php echo wp_kses( $company_ticker, 'post' ); ?></h2>

<div>
	<h3>Company Info</h3>
	<p>Content ipsum placeholder</p>
</div>

<div>
	<h3>Company Stock Recommendations</h3>

	<?php

	$rec_posts = Stock_Ticker::fetchCompanyRecommendations( $company_ticker );

	if ( $rec_posts->have_posts() ) {
		while ( $rec_posts->have_posts() ) {
			$rec_posts->the_post();
			get_template_part( 'template-parts/stock-recommendation-card' );
		}
	} else {
		?>

		<h4>No Stock Recommendations for <?php echo wp_kses( $company_ticker, 'post' ); ?></h4>

		<?php
	}
	?>


</div>


<div>
	<h3>Other Coverage</h3>

	<?php

	$news_posts = Stock_Ticker::fetchCompanyNews( $company_ticker );

	if ( $news_posts->have_posts() ) {
		while ( $news_posts->have_posts() ) {
			$news_posts->the_post();
			get_template_part( 'template-parts/news-article-card' );
		}
	} else {
		?>

		<h4>No News Coverage for <?php echo wp_kses( $company_ticker, 'post' ); ?></h4>

		<?php
	}
	?>

</div>
