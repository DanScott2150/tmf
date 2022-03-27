<?php
/**
 * Note: Need to echo get_the_date() as opposed to just using the_date()
 * Due to how wordpress handles... something. I forget the specifics, but in a feed
 * where multiple posts are being shown, it won't show duplicate of the same date.
 * Below method is easy workaround.
 *
 * @package tmf
 */

?>
<em>Posted by <strong><?php the_author(); ?></strong> on <?php echo get_the_date(); ?></em>
