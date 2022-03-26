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
			Error Code: <strong><?php echo wp_kses( $data['code'], 'post' ); ?> -- <?php echo wp_kses( $data['message'], 'post' ); ?></strong>
		</div>

		<?php
		else :
			$company_data = $data['body'][0];
			?>

			<div class="text-center"><h4><?php echo wp_kses( $company_data->companyName, 'post' ); ?></h4></div>
			<div style="text-align: center"><img src="<?php echo esc_attr( $company_data->image ); ?>" style="max-width:150px" /></div>
			<hr/>
			<div><strong>Exchange:</strong> <?php echo wp_kses( $company_data->exchange, 'post' ); ?> (<?php echo wp_kses( $company_data->exchangeShortName, 'post' ); ?>)</div>
			<div><strong>Industry:</strong> <?php echo wp_kses( $company_data->industry, 'post' ); ?></div>
			<div><strong>Sector:</strong> <?php echo wp_kses( $company_data->sector, 'post' ); ?></div>
			<div><strong>CEO:</strong> <?php echo wp_kses( $company_data->ceo, 'post' ); ?></div>
			<div><strong>Website:</strong> <a href="<?php echo esc_url( $company_data->website ); ?>" target="_blank"><?php echo wp_kses( $company_data->website, 'post' ); ?></a></div>
			<hr/>
			<div><?php echo wp_kses( $company_data->description, 'post' ); ?></div>

			<?php
		endif;
		?>

</div> <!-- callout-box -->
