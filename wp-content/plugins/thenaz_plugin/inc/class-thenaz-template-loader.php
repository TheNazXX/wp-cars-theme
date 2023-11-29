<?php 

class thenaz_Template_Loader extends Gamajo_Template_Loader
{
  protected $filter_prefix = 'thenaz';
  protected $theme_template_directory = 'thenaz';
  protected $plugin_directory = THENAZ_PROPERTY_PATH;
  protected $plugin_template_directory = 'templates';

  public function register(){
    add_filter('template_include', [$this, 'thenazproperties_templates']);
  }

  public function thenazproperties_templates($template){


    $custom_post_types = array_filter(get_post_types(), function($post_type) {
        return in_array($post_type, array('property', 'cars', 'agent'));
    });

    foreach($custom_post_types as $post_name){
      if(is_post_type_archive($post_name)){
        $theme_files = ['archive-'.$post_name.'.php', 'thenazproperty/archive-'.$post_name.'.php'];
        $exist = locate_template($theme_files, false);
        if($exist != ''){
          return $exist;
        }else{
          return plugin_dir_path(__DIR__).'templates/archive-'.$post_name.'.php';
        }
      }else if(is_singular($post_name)){
        $theme_files = ['single-'.$post_name.'.php', 'thenazproperty/single-'.$post_name.'.php'];
        $exist = locate_template($theme_files, false);
        if($exist != ''){
          return $exist;
        }else{
          return plugin_dir_path(__DIR__).'templates/single-'.$post_name.'.php';
        }
      }
    }

    return $template;
  }
}

$thenazTempalteLoader = new thenaz_Template_Loader();
$thenazTempalteLoader->register();

?>