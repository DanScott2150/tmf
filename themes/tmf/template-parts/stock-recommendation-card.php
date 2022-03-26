<?php
/**
 * Stock Recommendation Card
 * For displaying single posts within a feed
 *
 * @package tmf
 */

?>

<h3><?php the_title(); ?></h3>
<?php get_template_part( 'template-parts/stock-ticker-list' ); ?>
<a href="<?php the_permalink(); ?>">Read More >></a>
