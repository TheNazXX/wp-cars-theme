<?php $thenaz_plugin = new thenaz_plugin();?>
<?php 

  $property_id_post = intval(trim($_GET['edit']));
  $post_property = get_post($property_id_post);

  if(!empty($post_property) && $post_property->post_type == 'property'){
    global $current_user; wp_get_current_user();

    if($post_property->post_author == $current_user->ID){ ?>

<div class="add-form">
  <form action="" method="post" id="thenaz-add-property" enctype="multipart/form-data">



    <?php $tax_terms = get_the_terms($post_property->ID, 'property-type');
    $current_type_id = wp_list_pluck($tax_terms, 'term_id');    ?>

    <?php $tax_terms = get_the_terms($post_property->ID, 'location');
    $current_location_id = wp_list_pluck($tax_terms, 'term_id');    ?>


    <div class="row flex-nowrap justify-content-between">
      <div style="width: 70%">

        <div class="row">
          <div class="col">
            <label for="title" class="form-label">Title</label>
            <input type="text" value="<?php echo $post_property->post_title?>" class="form-control" id="title"
              name="property_title" required>
          </div>

          <div class="col-3 mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="property_price" min="0"
              value="<?php echo get_post_meta($post_property->ID, 'property_price', true)?>">
          </div>

          <div class="col-3 mb-3">
            <label for="period" class="form-label">Period</label>
            <input type="text" class="form-control" id="period" name="property_period"
              value="<?php echo get_post_meta($post_property->ID, 'property_period', true)?>">
          </div>
        </div>

        <div class="row">
          <div class="col-3">
            <select class="form-control" name="property_type">
              <option selected>Choose Type</option>
              <?php echo $thenaz_plugin->get_terms_hierarchicle('property-type', $current_type_id[0]) ?>
            </select>
          </div>


          <div class="col-3">
            <select class="form-control" name="property_location">
              <option selected>Choose Location</option>
              <?php echo $thenaz_plugin->get_terms_hierarchicle('location', $current_location_id[0]) ?>
            </select>
          </div>


          <div class="col-3">
            <select class="form-control" name="property_offer"
              value="<?php echo get_post_meta($post_property->ID, 'property_offer', true)?>">
              <option selected>Choose Offer</option>

              <option value="sale"
                <?php if(get_post_meta($post_property->ID, 'property_offer', true) == 'sale'){echo 'selected';}?>>For
                sale
              </option>

              <option value="sold"
                <?php if(get_post_meta($post_property->ID, 'property_offer', true) == 'sold'){echo 'selected';}?>>For
                sold
              </option>

              <option value="rent"
                <?php if(get_post_meta($post_property->ID, 'property_offer', true) == 'rent'){echo 'selected';}?>>For
                rent
              </option>
            </select>
          </div>

          <div class="col-3 mb-3">
            <?php 
              
              $agents = get_posts(['post_type' => 'agent', 'numberspost' => -1]);
              $agents_list = '';

              foreach($agents as $agent){
                $selected = (get_post_meta($post_property->ID, 'property_agent', true) == $agent->ID) ? 'selected' : '';
                $agents_list .= '<option value="'.$agent->ID .'" '. $selected .'>'. $agent->post_title .'</option>'; 
              };
              
              ?>


            <select class="form-control" name="property_agent">
              <option selected>Choose Agent</option>
              <?php echo $agents_list?>
            </select>
          </div>
        </div>





        <div class="row">
          <div class="col mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="description"
              name="property_description" style="resize: none; height: 150px"
              required><?php esc_html_e(strip_tags($post_property->post_content)) ?></textarea>
          </div>
        </div>
      </div>


      <div class="custom-file-input-img">
        <input type="file" id="fileInput" class="inputfile" accept="image/*" name="img" />

        <label for="fileInput">
          <?php if(has_post_thumbnail($post_property->ID)){?>
          <img id="fileImg" src="<?php echo get_the_post_thumbnail_url($post_property->ID)?>" alt="#">
          <?php } ?>
          <?php 
            if(!has_post_thumbnail($post_property->ID)){ ?>
          <span id="mockFileImg" class="dashicons dashicons-embed-photo"></span>
          <?php }
          ?>
        </label>
      </div>
    </div>
    <?php wp_nonce_field('submit_property', 'property_nonce');?>
    <input type="hidden" name="action" value="thenaz_edit_property">
    <input type="hidden" name="property_id" value="<?php echo $post_property->ID;?>">
    <button name="submit" type="submit" class="btn btn-primary">Edit Property</button>
  </form>
</div>

<?php 
  };
};

?>

<?php 


?>