<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Geniuscourses
 */

get_header();
?>


<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <div class="row">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$cars = new WP_Query(array('post_type'=>'car','posts_per_page'=>3,'paged' => $paged));
				
				if($cars->have_posts()) : while($cars->have_posts()) : $cars->the_post(); ?>
				

					<?php get_template_part('partials/content', 'car'); ?> 

				<?php endwhile; ?>
					<div class="pagination">
						<?php geniuscourses_paginate($cars); ?>
					</div>
				<?php
				else : ?>

					<?php get_template_part('partials/content', 'none'); ?> 

				<?php endif;
				wp_reset_postdata();
				?>


                
                




            </div>
        </div>
    </div>
    <!-- Rent A Car End -->



		



<?php
get_footer();
