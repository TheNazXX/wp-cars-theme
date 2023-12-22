<?php 

  $taxonomies = wp_get_post_terms(get_the_ID(), ['location', 'property-type']);
  $terms_by_taxonomies = [];

  foreach($taxonomies as $term){
    $taxonomy = $term->taxonomy;

    if(!isset($terms_by_taxonomies[$taxonomy])){
      $terms_by_taxonomies[$taxonomy] = [];
    }

    $terms_by_taxonomies[$taxonomy][] = $term;
  };

?>


<article id='post-<?php echo the_ID()?>' <?php post_class()?>>
  <div class="property-card">
    <div class="property-image">
      <?php echo get_the_post_thumbnail() ?>
    </div>
    <div class="property-details">
      <div class="d-flex flex-row justify-content-between align-items-center">
        <h3 class="mr-2"><?php esc_html_e(the_title()); ?></h3>

        <?php if($terms_by_taxonomies): ?>

        <div>

          <?php if($terms_by_taxonomies['location']): ?>

          <div><strong>Locations:</strong>
            <?php foreach($terms_by_taxonomies['location'] as $location){ ?>
            <a href="<?php echo esc_url(get_term_link($location))?>"><?php esc_html_e($location->name); ?></a>
            <?php } ?>
          </div>

          <?php endif; ?>



          <?php if($terms_by_taxonomies['property-type']): ?>

          <div><strong>Type House:</strong>
            <?php foreach($terms_by_taxonomies['property-type'] as $type){ ?>
            <a href="<?php echo esc_url(get_term_link($type))?>"><?php esc_html_e($type->name); ?></a>
            <?php } ?>
          </div>

          <?php endif; ?>

        </div>

        <?php endif; ?>


      </div>


      <?php if(!empty(get_post_meta(get_the_ID(), 'property_price', true))){ ?>
      <p class="price"><strong style="color: black">Price:</strong>
        $<?php esc_html_e(get_post_meta(get_the_ID(), 'property_price', true)); ?>
      </p>
      <?php } ?>


      <?php if(!empty(get_post_meta(get_the_ID(), 'property_period', true))){ ?>
      <p class="period"><strong style="color: black">Period:
          &nbsp;</strong><?php esc_html_e(get_post_meta(get_the_ID(), 'property_period', true)); ?>
      </p>
      <?php } ?>


      <?php if(get_post_meta(get_the_ID(), 'property_offer', true) != 'empty'){ ?>
      <p class="type"><strong style="color: black">Type:
          &nbsp;</strong><?php esc_html_e(get_post_meta(get_the_ID(), 'property_offer', true)); ?></p>
      <?php } ?>


      <?php if(get_post(get_post_meta(get_the_ID(), 'property_agent', true)) != null){ ?>

      <p class="type"><strong style="color: black">Agent:
          &nbsp;</strong><?php echo get_post(get_post_meta(get_the_ID(), 'property_agent', true))->post_title; ?>
      </p>

      <?php }?>



      <div class="property-details-description">
        <span id="typed-output"></span>
        <div id="typed-input"><?php the_content()?></div>
      </div>
    </div>

    <div class='d-flex justify-content-between mt-auto'>

      <?php 
      
      if(is_page_template('templates/template-wish-list.php')){ ?>
      <a class="btn btn-primary" href="<?php echo admin_url('admin-ajax.php') ?>" id="thenaz_remove_property"
        data-property-id="<?php echo get_the_ID()?>" data-user-id="<?php echo get_current_user_id()?>">Remove</a>
      <?php }
      
      ?>

      <a href="<?php the_permalink()?>" class="btn btn-secondary">More</a>
    </div>

  </div>
</article>