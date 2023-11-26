<?php 

function wp_register_post_types(){
  register_post_type('cars', [
    'label' => esc_html('Cars', 'cars'),
    'labels' => [
      'name'                  => esc_html_x( 'Cars', 'Post type general name', 'geniuscourses' ),
			'singular_name'         => esc_html_x( 'Car', 'Post type singular name', 'geniuscourses' ),
			'menu_name'             => esc_html_x( 'Cars', 'Admin Menu text', 'geniuscourses' ),
    ],
    'public' => true,
    'has_archive' => true,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments','revisions','page-attributes','post-formats'),
    'menu_position' => 5,
    'menu_icon' => 'dashicons-car',
    'show_in_rest' => true
  ]);
};
add_action('init', 'wp_register_post_types');

?>