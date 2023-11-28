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

require plugin_dir_path(__FILE__).'inc/custom-post-type.php';


if(!defined('ABSPATH')){
  die;
};


class thenaz_plugin
{


  static function activation(){
    flush_rewrite_rules(); // Функия для обновления информации в бд чтобы ссылки на пост тайпы работали.
  }


  static function deactivation(){
    flush_rewrite_rules();
  }

}

if(class_exists('thenaz_plugin')){
  $thenaz_plugin = new thenaz_plugin();
}



register_activation_hook(__FILE__, [$thenaz_plugin, 'activation']);
register_deactivation_hook(__FILE__, [$thenaz_plugin, 'deactivation']);


?>