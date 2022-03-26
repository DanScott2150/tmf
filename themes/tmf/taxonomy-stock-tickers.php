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
$data_api       = new Data_API();
$api_response   = $data_api->fetchCompanyInfo( strtolower( $company_ticker ) );
$company_info   = $api_response['body'][0];

$company = array(
	'name'     => $company_info->companyName,
	'ticker'   => $company_info->symbol,
	'exchange' => $company_info->exchangeShortName,
	'logo'     => $company_info->image,
	'beta'     => $company_info->beta,
	'lastDiv'  => $company_info->lastDiv,
);
?>

<?php
	/**
	 * Beta & Last Div pull from a different API endpoint than the one we use for our stock info callout box.
	 * I don't think wp_localize_script works for this specific use-case.
	 * So we just pass them to javascript here manually.
	 */
?>
<script>
	const beta = <?php echo $company['beta']; ?>;
	const lastDiv = <?php echo $company['lastDiv']; ?>;
</script>

<div class="text-center pb-3 mb-3 border-bottom">
	<img src="<?php echo $company['logo']; ?>" style="display: block; margin: 0 auto;"/>
	<h2 class="">Company Page: <?php echo $company['name'] ?></h2>
	<span>(<?php echo $company['exchange'] . ' : ' . $company['ticker']; ?>)</span>
</div>


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


			<?php
				/**
				 * Since 'beta' and 'lastDiv' data pull from the "company info" API we're using on this page,
				 * as opposed to the "Financial Info" API we use in the callout box, pass that data through to
				 * the template, so we can output it there.
				 */
				get_template_part( 'template-parts/company-financial-box', null, array( $company ) );
			?>

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

<?php
get_footer();
