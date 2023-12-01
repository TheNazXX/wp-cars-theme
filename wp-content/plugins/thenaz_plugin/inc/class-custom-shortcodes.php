<?php 

class thenaz_Shortcodes
{

  public function register(){
    add_action('init', [$this, 'register_shortcode']);
  }

  public function register_shortcode(){
    add_shortcode('thenaz_filter', [$this, 'filter_shortcode']);
  }

  public function filter_shortcode($atts = [], $content = null){


    extract(shortcode_atts([
      'location' => '0',
      'type' => '0'
    ], $atts));

    return '
    
    <div> '. $location . ' </div>
    ';
  }
}

$thenaz_shortcodes = new thenaz_Shortcodes();
$thenaz_shortcodes->register();


?>