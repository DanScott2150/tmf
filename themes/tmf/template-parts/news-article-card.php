<?php
/**
 * News Article Card
 * For displaying within feeds.
 *
 * @package tmf
 */

?>

<h4><?php the_title(); ?></h4>
<?php get_template_part( 'template-parts/author-dateline' ); ?><br/>
<a href="<?php the_permalink(); ?>">Read More >></a>
