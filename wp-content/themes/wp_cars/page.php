<?php get_header(); ?>

	
<div class="container-fluid py-5">
	<div class="container pt-5 pb-3">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part('partials/content', 'page');  

			wp_link_pages();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</div>
</div>

<?php
//get_sidebar();
get_footer();
