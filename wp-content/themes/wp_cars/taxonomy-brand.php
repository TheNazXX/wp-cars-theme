<?php 

get_header();

$term = get_term_by('slug', get_query_var('term'),get_query_var('taxonomy'));

echo esc_html($term->name); ?>    

    <div>

		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<?php get_template_part('partials/content', 'car'); ?> 

		<?php endwhile; else : ?>

			<?php get_template_part('partials/content', 'none'); ?> 

		<?php endif; ?>

	</div>


    <?php
	get_sidebar('cars');
    get_footer();