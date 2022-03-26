<?php
/**
 * Page Template: Stock Recommendation (single post)
 *
 * @package tmf
 */

?>

<?php
get_header();

while ( have_posts() ) :
	the_post();
	?>

<article>

	<header class="pb-3 mb-3 border-bottom">
		<h2>Stock Recommendation: <?php the_title(); ?> </h2>
		<?php get_template_part( 'template-parts/author-dateline' ); ?>
		<?php get_template_part( 'template-parts/stock-ticker-list' ); ?>
	</header>

	<div class="container-fluid">
		<div class="row">

			<div class="col-12 col-lg-8">
				<?php the_content(); ?>
			</div> <!-- col-12 col-lg-6 -->

			<div class="col-12 col-lg-4">
				<?php get_template_part( 'template-parts/company-info-box' ); ?>
			</div> <!-- col-12 col-lg-6 -->

		</div> <!-- row -->
	</div> <!-- container-fluid -->

	<?php
	endwhile;

get_footer();
