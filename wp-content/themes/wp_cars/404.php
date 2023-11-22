<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Geniuscourses
 */

get_header();
?>


<div class="container-fluid py-5">
	<div class="container pt-5 pb-3">
		
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'geniuscourses' ); ?></p>
			
	</div>
</div>



<?php
get_footer();
