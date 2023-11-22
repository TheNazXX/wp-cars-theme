<?php

get_header();
?>


<div class="container-fluid py-5">
	<div class="container pt-5 pb-3">

		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		
			<?php get_template_part('partials/content'); ?> 

		<?php endwhile; ?>
			<div class="pagination">
				<?php echo paginate_links(); ?>
			</div>
		<?php else : ?>

			<?php get_template_part('partials/content', 'none'); ?> 

		<?php endif; ?>

	</div>
</div>

<?php
get_footer();
