<?php 

/*

Plugin Name: thenaz_plugin
Plugin URI: https://thenaz_plugin
Description: First Plugin
Version: 1.0
Author: TheNazX
Author URI: https://example.com
Licence: GPLv2 or later
Text Domain: thenazx

*/

define('THENAZ_PROPERTY_PATH', plugin_dir_path(__FILE__));

require THENAZ_PROPERTY_PATH.'inc/class-custom-post-type.php';


if(!defined('ABSPATH')){
  die;
};


require THENAZ_PROPERTY_PATH . 'inc/class-gamajo-template-loader.php';
require THENAZ_PROPERTY_PATH . 'inc/class-thenaz-template-loader.php';
require THENAZ_PROPERTY_PATH . 'inc/class-custom-shortcodes.php';

class thenaz_plugin
{

  public function get_terms_hierarchicle($tax_name, $current_term){
    $taxonomy_terms = get_terms($tax_name, ['hide_empty' => false, 'parent'=>0]);

    if(!empty($taxonomy_terms)){
     foreach($taxonomy_terms as $term){
      if($current_term == $term->term_id){
        echo '<option value="' . $term->term_id . '" selected>
          '. $term->name .'
        </option>';
      }else{
        echo '<option value="' . $term->term_id . '">
          '. $term->name .'
        </option>';
      };

      $child_terms = get_terms($tax_name, ['hide_empty'=>false, 'parent' => $term->term_id]);

      if(!empty($child_terms)){
        foreach($child_terms as $child){
          if($current_term == $child->term_id){
            echo '<option value="' . $child->term_id . '" selected>
              - '. $child->name .'
            </option>';
          }else{
            echo '<option value="'  . $child->term_id . '">
               - '. $child->name .'
            </option>';
          };
        }
      }
     } 
    }
  }

  public function register(){
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_front']);
  }

  public function enqueue_admin(){
    wp_enqueue_style('thenaz-admin-style', plugins_url('/assets/css/admin/style.css', __FILE__));
    wp_enqueue_script('thenaz-admin-script', plugins_url('/assets/js/admin/index.js', __FILE__));
  }

  public function enqueue_front(){
    wp_enqueue_style('thenaz-front-swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_style('thenaz-front-style', plugins_url('/assets/css/front/style.css', __FILE__));
    wp_enqueue_script('thenaz-swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_script('thenaz-typed-script', 'https://cdn.jsdelivr.net/npm/typed.js@2.0.12');
  }


  static function activation(){
    flush_rewrite_rules(); // Функция для обновления информации в бд чтобы ссылки на пост тайпы работали.
  }

  static function deactivation(){
    flush_rewrite_rules();
  }
}

if(class_exists('thenaz_plugin')){
  $thenaz_plugin = new thenaz_plugin();
  $thenaz_plugin->register();
}


register_activation_hook(__FILE__, [$thenaz_plugin, 'activation']);
register_deactivation_hook(__FILE__, [$thenaz_plugin, 'deactivation']);


?>