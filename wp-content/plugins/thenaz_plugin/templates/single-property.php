<?php 
 
 get_header();
  
?>


<div class="container">


  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php $price = get_post_meta(get_the_ID(), 'property_price', true)?>

  <div class="d-flex">
    <?php $thenazTemplateLoader->get_template_part('parts/content')?>
    <?php echo do_shortcode('[thenaz_booking price="'. $price . '"]'); ?>
  </div>

  <?php

    if(is_user_logged_in()){
      
    $property_id = get_the_ID();
    $user_id = get_current_user_id();

    $wishlist = new thenaz_WishList();


    ?>


  <form action="<?php echo admin_url('admin-ajax.php') ?>" method="post" id="wishlist-form_<?php echo $property_id?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
    <input type="hidden" name="property_id" value="<?php echo $property_id?>">
    <input type="hidden" name="action_with_bd"
      value="<?php echo ($wishlist->in_wishlist($user_id, $property_id)) ? 'rm' : 'add'?>">
    <input type="hidden" name="action" value="thenaz_action_wishlist">
  </form>

  <?php if($wishlist->in_wishlist($user_id, $property_id)){ ?>

  <button data-property-id="<?php echo $property_id?>" id="btn-action-wishlist" class="btn btn-primary">Remove from
    wishlist</button>

  <?php }else{ ?>

  <button data-property-id="<?php echo $property_id?>" id="btn-action-wishlist" class="btn btn-primary">Add to
    wishlist</button> <?php }  ?>

  <?php } ?>




  <?php endwhile; else : ?>
  <?php echo 'Sorry, no posts were found.'; ?>
  <?php endif; ?>
</div>
<?php 

  get_footer();

?>