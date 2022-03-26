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

<h2 class="text-center pb-3 mb-3 border-bottom">Company Page: <?php echo wp_kses( $company_ticker, 'post' ); ?></h2>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-lg-8">
			<h3 class="text-center">Foolish Recommendations for <?php echo wp_kses( $company_ticker, 'post' ); ?></h3>

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

		</div> <!-- col-12 col-lg-6 -->

		<div class="col-12 col-lg-4">

			<h3 class="text-center">Company Info</h3>

			<p>Placeholder for API call data </p>

		</div> <!-- col-12 col-lg-6 -->

	</div> <!-- row -->


	<div class="row mt-3 pt-3 border-top">

		<div class="col-12">
			<h3 class="text-center">Other Coverage</h3>

			<?php

			$news_posts = Stock_Ticker::fetchCompanyNews( $company_ticker );

			if ( $news_posts->have_posts() ) {
				while ( $news_posts->have_posts() ) {
					$news_posts->the_post();
					get_template_part( 'template-parts/news-article-card', '', array( 'include_excerpt' ) );
				}
			} else {
				?>

				<h4>No News Coverage for <?php echo wp_kses( $company_ticker, 'post' ); ?></h4>

				<?php
			}
			?>

		</div>


	</div>
