<?php
/**
 * Callout-box to display Company data for ticker of current post.
 *
 * @package tmf
 */

$api    = new Data_API();
$ticker = Stock_Ticker::getPostTickers();
$data   = $api->fetchCompanyInfo( $ticker );

?>

<div class="callout-box border border-secondary rounded p-3 mb-5">

	<h3 class="text-center mb-3">Company Info</h3>
	<hr/>

	<?php
	if ( 200 !== $data['code'] ) :
		?>

		<div class="alert alert-danger">
			There was an error with the API request<br/>
			Error Code: <strong><?php echo $data['code']; ?> -- <?php echo $data['message']; ?></strong>
		</div>

		<?php
		else :
			$company_data = $data['body'][0];
			?>

			<div class="text-center"><h4><?php echo $company_data->companyName; ?></h4></div>
			<div style="text-align: center"><img src="<?php echo $company_data->image; ?>" style="max-width:150px" /></div>
			<hr/>
			<div><strong>Exchange:</strong> <?php echo $company_data->exchange; ?> (<?php echo $company_data->exchangeShortName; ?>)</div>
			<div><strong>Industry:</strong> <?php echo $company_data->industry; ?></div>
			<div><strong>Sector:</strong> <?php echo $company_data->sector; ?></div>
			<div><strong>CEO:</strong> <?php echo $company_data->ceo; ?></div>
			<div><strong>Website:</strong> <a href="<?php echo $company_data->website; ?>" target="_blank"><?php echo $company_data->website; ?></a></div>
			<hr/>
			<div><?php echo $company_data->description; ?></div>

			<?php
		endif;
		?>

</div> <!-- callout-box -->
