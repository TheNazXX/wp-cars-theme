<?php
/**
 * Template name: Services Template
 */
?>


<?php get_header(); ?>


<div class="container-fluid py-5">
  <div class="container pt-5 pb-3">
    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part('partials/content', 'page');  


			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>
  </div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="container-fluid py-5">
  <div class="container py-5">
    <div class="bg-banner py-5 px-4 text-center"
      style="background-image: linear-gradient(rgba(28, 30, 50, .9), rgba(28, 30, 50, .9)) , url('<?php echo get_the_post_thumbnail_url(get_the_id(), 'full'); ?>');">
      <div class="py-5">
        <h1 class="display-1 text-uppercase text-primary mb-4">
          <?php esc_html_e(get_post_meta(get_the_ID(), 'discount_title', true)); ?>
        </h1>
        <h1 class="text-uppercase text-light mb-4">Special Offer For New Members</h1>
        <p class="mb-4">Only for Sunday from 1st Jan to 30th Jan 2045</p>
        <a class="btn btn-primary mt-2 py-3 px-5" href="">Register Now</a>
      </div>
    </div>
  </div>
</div>
<?php endwhile; endif; ?>



<?php
//get_sidebar();
get_footer();