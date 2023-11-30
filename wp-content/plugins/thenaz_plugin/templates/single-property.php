<?php 
 
 get_header();
  
?>


<div class="container">


  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php $thenazTempalteLoader->get_template_part('parts/content')?>

  <?php endwhile; else : ?>
  <?php echo 'Sorry, no posts were found.'; ?>
  <?php endif; ?>
</div>
<?php 

  get_footer();

?>