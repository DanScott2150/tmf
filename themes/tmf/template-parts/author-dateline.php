<?php
/**
 * Note: Need to echo get_the_date() as opposed to just the_date()
 * Due to how wordpress handles... something. I forget the specifics, but in a feed
 * where multiple posts are being shown, it won't show duplicate of the same date.
 * Below method is easy workaround.
 *
 * @package tmf
 */

?>
<em>Posted by <?php the_author(); ?> on <?php echo get_the_date(); ?></em>
