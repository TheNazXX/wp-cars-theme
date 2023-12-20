<?php 
 
 get_header();
  
?>


<div class="container">


  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php $price = get_post_meta(get_the_ID(), 'property_price', true)?>

  <div class="d-flex">
    <?php $thenazTempalteLoader->get_template_part('parts/content')?>
    <?php echo do_shortcode('[thenaz_booking price="'. $price . '"]'); ?>
  </div>

  <?php endwhile; else : ?>
  <?php echo 'Sorry, no posts were found.'; ?>
  <?php endif; ?>
</div>
<?php 

  get_footer();

?>