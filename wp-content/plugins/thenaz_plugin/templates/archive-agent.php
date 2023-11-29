<?php 
 
 get_header();
  
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div><a href="<?php the_permalink()?>"><?php esc_html_e(the_title()); ?></a></div>
<?php endwhile; endif; ?>

<?php 

  get_footer();

?>