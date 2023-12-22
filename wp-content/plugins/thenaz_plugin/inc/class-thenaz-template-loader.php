<?php 

class thenaz_Template_Loader extends Gamajo_Template_Loader
{
  protected $filter_prefix = 'thenaz';
  protected $theme_template_directory = 'thenaz';
  protected $plugin_directory = THENAZ_PROPERTY_PATH;
  protected $plugin_template_directory = 'templates';
  public $templates;

  public function register(){
    add_filter('template_include', [$this, 'thenazproperties_templates']);


    $this->templates = [
      'templates/template-create-property.php' => 'Crete Property Template',
      'templates/template-listproperty.php' => 'List Properties Template',
      'templates/template-wish-list.php' => 'Wish List Properties Template'
    ];

    add_filter('theme_page_templates', [$this, 'create_property_template']);
    add_filter('template_include', [$this, 'load_template']);
  }

  public function create_property_template($templates){
    $templates = array_merge($templates, $this->templates);
    return $templates;
  }

  public function load_template($template){
    global $post;

    $template_name = get_post_meta($post->ID, '_wp_page_template', true);
    
    if(array_key_exists($template_name, $this->templates)){

      $file = THENAZ_PROPERTY_PATH . $template_name;

      if(file_exists($file)){
        return $file;        
      };

    };

    return $template;
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

$thenazTemplateLoader = new thenaz_Template_Loader();
$thenazTemplateLoader->register();

?>