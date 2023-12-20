<?php 
/*
* Template Name: List Personal Properties
*/
?>

<?php get_header()?>
<?php $edit_propery_url = 'http://cars/create-property/';?>

<div class="container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php  ?>
  <?php endwhile; endif; ?>


  <div class="list">

    <?php if(is_user_logged_in()){
      
      global $current_user; wp_get_current_user();

      $args = [
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post_status' => ['publish', 'pending', 'draft', 'future'],
        'author' => $current_user->ID
      ];

      $listing = new WP_Query($args);
      
      

      if($listing->have_posts()): while($listing->have_posts()): $listing->the_post(); ?>

    <?php 
      
      if($edit_propery_url){
        $edit_propery_url = add_query_arg('edit', $post->ID, $edit_propery_url);
      };
      
      ?>

    <div class="property">
      <h3><?php the_title()?></h3>
      <a href="<?php the_permalink()?>">Read More</a>
      <a href="<?php echo $edit_propery_url?>">Edit Property</a>
    </div>

    <?php endwhile; endif;
    }?>

  </div>
</div>

<?php get_footer()?>