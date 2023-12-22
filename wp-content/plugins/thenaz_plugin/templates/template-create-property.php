<?php 
/*
* Template Name: Create Property Template;
*/?>


<?php

  function thenaz_image_validation($file_name){
    $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $exploded_arr = explode('.', $file_name);

    if(!empty($exploded_arr) && is_array($exploded_arr)){
      $ext = array_pop($exploded_arr);
      return in_array($ext, $valid_extensions);
    }else{
      return false;
    }
  };

  function thenaz_insert_attachment($file_handler, $post_id, $setthumb=false){
 
    if($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

    require_once(ABSPATH . "wp-admin" . "/includes/image.php");
    require_once(ABSPATH . "wp-admin" . "/includes/file.php");
    require_once(ABSPATH . "wp-admin" . "/includes/media.php");

    

    $attach_id = media_handle_upload($file_handler, $post_id);

    if($setthumb){
      update_post_meta($post_id, '_thumbnail_id', $attach_id);
    };

    return $attach_id;
  };


  $thenaz_plugin = new thenaz_plugin();
  $success = '';

  if(isset($_POST['action']) && is_user_logged_in()){
    if(wp_verify_nonce($_POST['property_nonce'], 'submit_property')){
      $thenaz_item = [];
      global $current_user; wp_get_current_user();
      
      $thenaz_item['post_title'] = sanitize_text_field($_POST['property_title']);
      $thenaz_item['post_type'] = 'property';
      $thenaz_item['post_content'] = sanitize_textarea_field($_POST['property_description']);
      $thenaz_item['post_author'] = $current_user->ID;

      $thenaz_action = $_POST['action'];

      if($thenaz_action == 'thenaz_add_property'){
        $thenaz_item['post_status'] = 'pending';
        $thenaz_item_id = wp_insert_post($thenaz_item);

      }else if($thenaz_action = 'thenaz_edit_property'){
        $thenaz_item['post_status'] = 'pending';
        $thenaz_item['ID'] = intval($_POST['property_id']);
        $thenaz_item_id = wp_update_post($thenaz_item);
      };

      
      if($thenaz_item_id > 0){ 
        do_action('wp_insert_post', 'wp_insert_post');
        wp_redirect('http://cars/list-properties/');


        if(isset($_POST['property_price']) && $_POST['property_price'] != ''){
          update_post_meta($thenaz_item_id, 'property_price', $_POST['property_price']);
        }

        if(isset($_POST['property_period']) && $_POST['property_period'] != ''){
          update_post_meta($thenaz_item_id, 'property_period', $_POST['property_period']);
        }

        
        if(isset($_POST['property_type']) && $_POST['property_type'] != ''){
          update_post_meta($thenaz_item_id, 'property-type', $_POST['property_type']);
        }

        if(isset($_POST['property_location']) && $_POST['property_location'] != ''){
          update_post_meta($thenaz_item_id, 'location', $_POST['property_location']);
        }

        if(isset($_POST['property_offer']) && $_POST['property_offer'] != ''){
          update_post_meta($thenaz_item_id, 'property_offer', $_POST['property_offer']);
        }

        if(isset($_POST['property_agent']) && $_POST['property_agent'] != ''){
          update_post_meta($thenaz_item_id, 'property_agent', $_POST['property_agent']);
        }

        // taxonomy

        if(isset($_POST['property_location'])){
          wp_set_object_terms($thenaz_item_id, intval($_POST['property_location']), 'location');
        }

        if(isset($_POST['property_type'])){
          wp_set_object_terms($thenaz_item_id, intval($_POST['property_type']), 'property-type');
        }


        // Featured Image
        if($_FILES){
          foreach($_FILES as $submitted_file => $file_array){
            if(thenaz_image_validation($_FILES[$submitted_file]['name'])){
              $size = intval($_FILES[$submitted_file]['size']);

              if($size > 0){
                thenaz_insert_attachment($submitted_file, $thenaz_item_id, true);
              }
            }

          }
        }
      };
    };
  }
?>


<?php  get_header()?>


<div class="container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php 
  if(is_user_logged_in()){ ?>

  <?php if($success != ''){ ?>
  <h1 class="animate__animated animate__bounce">Success!</h1>
  <?php } ?>


  <?php 
  
  if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $thenazTemplateLoader->get_template_part('parts/edit-property-form');
  }else{
    $thenazTemplateLoader->get_template_part('parts/create-property-form');
  }

} else { ?>
  <a href="<?php echo wp_registration_url(); ?>">Регистрация</a>
  <?php }?>


  <?php endwhile; endif; ?>
</div>



<?php get_footer()?>