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
require THENAZ_PROPERTY_PATH . 'inc/class-filter-widget.php';
require THENAZ_PROPERTY_PATH . 'inc/class-thenaz-elementor.php';
require THENAZ_PROPERTY_PATH . 'inc/class-thenaz-booking-form.php';
require THENAZ_PROPERTY_PATH . 'inc/class-property-wish-list.php';


class thenaz_plugin
{

  private $deepTaxLocation = '';


  public function get_terms_hierarchicle($tax_name, $current_term, $parent = 0, $html = ''){
    $html = '';
    $taxonomy_terms = get_terms($tax_name, ['hide_empty' => false, 'parent' => $parent]);


    if(!empty($taxonomy_terms)){
      foreach($taxonomy_terms as $term){
        if($current_term == $term->term_id){
        $html .= '<option value="'. $term->term_id .'" selected>
          '. $this->deepTaxLocation . $term->name .'
        </option>';
        } else{
          $html .= '<option value="' . $term->term_id . '">
          '. $this->deepTaxLocation . $term->name .'
          </option>';
        };

        if(count(get_terms($tax_name, ['hide_empty' => false, 'parent' => $term->term_id])) > 0){
          $this->deepTaxLocation .= '- ';
          $html .= $this->get_terms_hierarchicle($tax_name, $current_term, $term->term_id, $html);
        }else{
          $this->deepTaxLocation = substr($this->deepTaxLocation, 0, -2);
        };

        if($term->parent == 0){
          $this->deepTaxLocation = '';
        }
      };
    }

    return $html;
  }




  
  public function register(){
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_front']);

    add_action('widgets_init', [$this, 'register_widget']);
    add_action('admin_menu', [$this, 'add_menu_item']);
    add_filter('plugin_action_links_'. plugin_basename(__FILE__), [$this, 'add_plugin_setting_link']);
    add_action('admin_init', [$this, 'settings_init']);
  

  }

  public function register_widget(){
    register_widget('thenaz_filter_widget');
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
    wp_enqueue_script('jquery-form');

  }


  static function activation(){
    flush_rewrite_rules(); // Функция для обновления информации в бд чтобы ссылки на пост тайпы работали.
  }

  static function deactivation(){
    flush_rewrite_rules();
  }

  public function settings_init(){
    register_setting('thenaz_settings', 'thenaz_settings_options');
    
    add_settings_section(
      'thenaz_settings_section',
      'Settings',
      [$this, 'thenaz_settings_section_html'],
      'thenaz_settings'
    );

    add_settings_field(
      'filter_title',
      'Title for filter',
      [$this, 'filter_title_html'],
      'thenaz_settings',
      'thenaz_settings_section'
    );
  }

  public function filter_title_html(){

    $options = get_option('thenaz_settings_options');

    ?>

<input type="text" name="thenaz_settings_options[filter_title]"
  value="<?php echo isset($options['filter_title']) ? $options['filter_title'] : "" ?>">
<?php 
  }

  public function thenaz_settings_section_html(){
    echo 'Settings for thenaz Plugin';
  }

  public function add_plugin_setting_link($link){
    
    $thenaz_link = '<a href="admin.php?page=thenaz_settings">Settings Page</a>';
    array_push($link, $thenaz_link);

    return $link;
  }

  public function add_menu_item(){
    add_menu_page(
      'Thenaz Settings Page',
      'TheNaz',
      'manage_options',
      'thenaz_settings',
      [$this, 'main_admin_page'],
      'dashicons-admin-plugins',
      50
    ); 
  }

  public function main_admin_page(){
    require_once THENAZ_PROPERTY_PATH . 'admin/index.php';
  }
}



if(class_exists('thenaz_plugin')){
  $thenaz_plugin = new thenaz_plugin();
  $thenaz_plugin->register();
}


register_activation_hook(__FILE__, [$thenaz_plugin, 'activation']);
register_deactivation_hook(__FILE__, [$thenaz_plugin, 'deactivation']);


?>