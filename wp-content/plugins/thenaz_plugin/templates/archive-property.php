<?php 
 
 get_header();
  
?>

<div class="container-lg-c">

  <?php $thenazTempalteLoader->get_template_part('parts/filter')?>

  <div class="swiper mySwiper fade-side">
    <div class="swiper-wrapper">

      <?php 
      
      if(!empty($_POST['submit'])){

        $args = [
          'post_type' => 'property',
          'posts_per_page' => -1,
          'meta_query' => ['relation' => 'AND'],
          'tax_query' => ['relation' => 'AND']
        ];

        if(isset($_POST['thenaz_type']) && $_POST['thenaz_type'] != ''){
          array_push($args['meta_query'], [
            'key' => 'property_type',
            'value' => esc_attr($_POST['thenaz_type'])
          ]);
        }

        if(isset($_POST['thenaz_price']) && $_POST['thenaz_price'] != ''){
          array_push($args['meta_query'], [
            'key' => 'property_price',
            'value' => esc_attr($_POST['thenaz_price']),
            'type' => 'numeric',
            'compare' => '<='
          ]);
        }

        if(isset($_POST['thenaz_agent']) && $_POST['thenaz_agent'] != ''){
          array_push($args['meta_query'], [
            'key' => 'property_agent',
            'value' => esc_attr($_POST['thenaz_agent'])
          ]);
        }

   
  
        if(isset($_POST['thenaz_type-house']) && $_POST['thenaz_type-house'] != ''){

 
          array_push($args['tax_query'], [
            'taxonomy' => 'property-type',
            'terms' => $_POST['thenaz_type-house']
          ]);
        }
        
        
        $properties = new WP_Query($args);
        ?>


      <?php if ( $properties->have_posts() ) : while ( $properties->have_posts() ) : $properties->the_post(); ?>
      <div class="swiper-slide">
        <?php $thenazTempalteLoader->get_template_part('parts/content')?>
      </div>

      <?php endwhile; else : ?>
      <?php echo 'Sorry, no posts were found.'; ?>
      <?php endif; ?>

      <?php 

        
      } else { ?>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="swiper-slide">
        <?php $thenazTempalteLoader->get_template_part('parts/content')?>
      </div>

      <?php endwhile; else : ?>
      <?php echo 'Sorry, no posts were found.'; ?>
      <?php endif; ?>

      <?php } ?>


    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>
<?php 

  get_footer();

?>