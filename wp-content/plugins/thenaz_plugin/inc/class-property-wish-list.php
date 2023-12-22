<?php 

class thenaz_WishList
{

  private static $meta_id = 'thenaz_wishlist_properties';

  public function register(){
    add_action('wp_ajax_thenaz_action_wishlist', [$this, 'thenaz_action_wishlist']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue']);
  }

  public function enqueue(){
    wp_enqueue_script('thenaz_wishlist',  plugins_url('thenaz_plugin/assets/js/front/wishlist-ajax.js'), ['jquery'], '1.0', true);
  }

  public function thenaz_action_wishlist(){
    
    if(isset($_POST['property_id']) && isset($_POST['user_id'])){
      $user_id = intval($_POST['user_id']);
      $property_id = intval($_POST['property_id']);

      if($property_id > 0 && $user_id > 0){

        if($_POST['action_with_bd'] == 'add'){
          if(add_user_meta($user_id, self::$meta_id, $property_id)){
            echo 'Successful added to wishlist';
         }else{
          echo 'Something went wrong';
         }
        }else{
          if(delete_user_meta($user_id, self::$meta_id, $property_id)){
            echo 'Successful deleted to wishlist';
         }else{
          echo 'Something went wrong';
         }
        }
      }else{
        echo 'Bad';
      }
    }else{
      echo 'Bad';
    }

    wp_die();
  }

  public function in_wishlist($user_id, $property_id){
    global $wpdb;

    $result = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value = %d AND user_id = %d",
        self::$meta_id,
        $property_id,
        $user_id
    )
    );

    if(isset($result[0]->meta_value) && $result[0]->meta_value == $property_id){
      return true;
    }else{
      return false;
    }
  }
}

$thenaz_wish_list = new thenaz_WishList();
$thenaz_wish_list->register();