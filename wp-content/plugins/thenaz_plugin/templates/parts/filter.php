<div class="filter-form d-flex justify-content-center">

  <form method="post" action="<?php get_post_type_archive_link('property')?>">
    <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">Price</span>
      <input type="text" class="form-control" placeholder="Maximum Price" name="thenaz_price"
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
    <input class=' btn btn-secondary' name="submit" type="submit" value="Filter" />
  </form>
</div>