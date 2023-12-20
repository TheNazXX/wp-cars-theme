<?php $thenaz_plugin = new thenaz_plugin();?>



<div class="add-form">
  <form action="" method="post" id="thenaz-add-property" enctype="multipart/form-data">




    <div class="row flex-nowrap justify-content-between">
      <div style="width: 70%">

        <div class="row">
          <div class="col">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="property_title" required>
          </div>

          <div class="col-3 mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="property_price" min="0">
          </div>

          <div class="col-3 mb-3">
            <label for="period" class="form-label">Period</label>
            <input type="text" class="form-control" id="period" name="property_period">
          </div>
        </div>

        <div class="row">
          <div class="col-3">
            <select class="form-control" name="property_type">
              <option selected>Choose Type</option>
              <?php echo $thenaz_plugin->get_terms_hierarchicle('property-type', '') ?>
            </select>
          </div>


          <div class="col-3">
            <select class="form-control" name="property_location">
              <option selected>Choose Location</option>
              <?php echo $thenaz_plugin->get_terms_hierarchicle('location', '') ?>
            </select>
          </div>


          <div class="col-3">
            <select class="form-control" name="property_offer">
              <option selected>Choose Offer</option>
              <option value="sale">For sale</option>
              <option value="sold">For sold</option>
              <option value="rent">For rent</option>
            </select>
          </div>

          <div class="col-3 mb-3">
            <?php 
              
              $agents = get_posts(['post_type' => 'agent', 'numberspost' => -1]);
              $agents_list = '';

              foreach($agents as $agent){
                $agents_list .= '<option value="'.$agent->ID .'">'. $agent->post_title .'</option>'; 
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
              name="property_description" style="resize: none; height: 150px" required></textarea>
          </div>
        </div>
      </div>


      <div class="custom-file-input-img">
        <input type="file" id="fileInput" class="inputfile" accept="image/*" name="img" />

        <label for="fileInput">
          <img id="fileImg" src="" alt="#" style="display: none">
          <span id="mockFileImg" class="dashicons dashicons-embed-photo"></span>
        </label>
      </div>
    </div>
    <?php wp_nonce_field('submit_property', 'property_nonce');?>
    <input type="hidden" name="action" value="thenaz_add_property">
    <button name="submit" type="submit" class="btn btn-primary">Create Property</button>
  </form>
</div>