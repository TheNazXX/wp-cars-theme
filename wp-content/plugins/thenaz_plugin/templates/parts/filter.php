<div class="filter-form d-flex justify-content-center">

  <?php $thenaz_plugin = new thenaz_plugin();?>

  <form method="post" action="<?php get_post_type_archive_link('property')?>">
    <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">Price</span>
      <input type="number" class="form-control" placeholder="Maximum Price" name="thenaz_price"
        value="<?php if(!empty($_POST['thenaz_price'])){echo esc_attr($_POST['thenaz_price']);}?>">
    </div>


    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="thenaz_type">
      <option value="" selected>Choose Type</option>
      <option value="sale"
        <?php if(isset($_POST['thenaz_type']) && $_POST['thenaz_type'] === 'sale'){ echo 'selected';}?>>For Sale
      </option>
      <option value="rent"
        <?php if(isset($_POST['thenaz_type']) && $_POST['thenaz_type'] === 'rent'){ echo 'selected';}?>>For Rent
      </option>
      <option value="sold"
        <?php if(isset($_POST['thenaz_type']) && $_POST['thenaz_type'] === 'sold'){ echo 'selected';}?>>Sold</option>
    </select>



    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="thenaz_agent">

      <option value="" selected>Choose Agent</option>

      <?php 
      
      $agents = get_posts(['post_type' => 'agent', 'numberspost' => -1]);

      ?>

      <?php foreach($agents as $agent) {?>

      <option value="<?php echo $agent->ID?>"
        <?php if(selected($agent->ID, $_POST['thenaz_agent'], false)){echo 'selected';};?>>
        <?php esc_html_e($agent->post_title); ?>
      </option>

      <?php }?>

    </select>

    <select name="thenaz_location">
      <option value="">Select Location</option>
      <?php  $thenaz_plugin->get_terms_hierarchicle('location', $_POST['thenaz_location'])?>
    </select>

    <select name="thenaz_type-house">
      <option value="">Select Type</option>
      <?php  $thenaz_plugin->get_terms_hierarchicle('property-type', $_POST['thenaz_type-house'])?>
    </select>

    <input class=' btn btn-secondary' name="submit" type="submit" value="Filter" />
  </form>
</div>