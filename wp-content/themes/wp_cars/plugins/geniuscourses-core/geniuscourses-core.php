<?php 
/*
Plugin Name: Geniuscourses Core
Plugin URI: https://geniuscourses.com
Description: A plugin that impliments Geniuscourses Functionality;
Version: 1.9\0
Author: CRIK0VA
Author URI: https://geniuscourses.com
License: GPLv2 or later
Text Domain: geniuscourses-core
 */

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require plugin_dir_path( __FILE__ ) . '/inc/widget-about.php';
require plugin_dir_path( __FILE__ ) . '/inc/metaboxes.php';
require plugin_dir_path( __FILE__ ) . '/inc/acf.php';
require plugin_dir_path( __FILE__ ) . '/inc/custom_post_type.php';
require plugin_dir_path( __FILE__ ) . '/inc/elementor.php';
require plugin_dir_path( __FILE__ ) . '/inc/gutenberg.php';

if(defined('WPB_VC_VERSION')){
	require plugin_dir_path( __FILE__ ) . '/inc/wpbakery.php';
}