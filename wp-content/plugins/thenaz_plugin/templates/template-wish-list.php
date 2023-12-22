<?php

/*
  Template name: Template WishList 
*/


get_header();
?>

<div class="container-lg-c">

  <?php ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  
  the_content();

  endwhile; endif; ?>

  <?php 
    if(is_user_logged_in()){
      $user_id = get_current_user_id();
      $wishlist_items = get_user_meta($user_id, 'thenaz_wishlist_properties');

      $args = [
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post__in' => $wishlist_items,
        'orderby' => 'post__in'
      ];
      
      $properties = new WP_Query($args);
    }

    ?>

  <div class="swiper mySwiper fade-side">
    <div class="swiper-wrapper">

      <?php

    if ($properties->have_posts() ) : while ($properties->have_posts() ) : $properties->the_post(); 



    ?>
      <div class="swiper-slide">
        <?php $thenazTemplateLoader->get_template_part("parts/content");?>
      </div>

      <?php



    endwhile; endif; ?>


    </div>
  </div>
</div>

<?php 
  get_footer();
?>