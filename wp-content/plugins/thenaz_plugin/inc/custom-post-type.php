<?php 

if(!class_exists('thenaz_Custom_Post_Types')){

  class thenaz_Custom_Post_Types
{
  
  public function register(){
    add_action('init', [$this, 'custom_post_type']);
  }

  public function custom_post_type(){  
    register_post_type('property', [
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'properties'],
      'label' => 'Property',
      'supports' => [
        'title',
        'editor',
        'thumbnail'
      ]
    ]);

    register_post_type('agent', [
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'agents'],
      'label' => 'Agent',
      'supports' => [
        'title',
        'editor',
        'thumbnail'
      ],
      'show_in_rest' => true
    ]);

    register_taxonomy('location', 'property', [
      'hierarchicle' => true, // Включает древовиднную систему
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewire' => ['slug' => 'properties/location'],
      'labels' => [
        'name'              => esc_html_x( 'Location', 'taxonomy general name', 'thenaz' ),
        'singular_name'     => esc_html_x( 'Location', 'taxonomy singular name', 'thenaz' ),
        'search_items'      => esc_html__( 'Search Locations', 'thenaz' ),
        'all_items'         => esc_html__( 'All Locations', 'thenaz' ),
        'parent_item'       => esc_html__( 'Parent Location', 'thenaz' ),
        'parent_item_colon' => esc_html__( 'Parent Location:', 'thenaz' ),
        'edit_item'         => esc_html__( 'Edit Location', 'thenaz' ),
        'update_item'       => esc_html__( 'Update Location', 'thenaz' ),
        'add_new_item'      => esc_html__( 'Add New Location', 'thenaz' ),
        'new_item_name'     => esc_html__( 'New Location Name', 'thenaz' ),
        'menu_name'         => esc_html__( 'Location', 'thenaz' ),
      ]
    ]);

    register_taxonomy('property-type', 'property', [
      'hierarchicle' => true, // Включает древовиднную систему
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewire' => ['slug' => 'properties/type'],
      'labels' => [
        'name'              => esc_html_x( 'Type', 'taxonomy general name', 'thenaz' ),
        'singular_name'     => esc_html_x( 'Type', 'taxonomy singular name', 'thenaz' ),
        'search_items'      => esc_html__( 'Search Types', 'thenaz' ),
        'all_items'         => esc_html__( 'All Types', 'thenaz' ),
        'parent_item'       => esc_html__( 'Parent Type', 'thenaz' ),
        'parent_item_colon' => esc_html__( 'Parent Type:', 'thenaz' ),
        'edit_item'         => esc_html__( 'Edit Type', 'thenaz' ),
        'update_item'       => esc_html__( 'Update Type', 'thenaz' ),
        'add_new_item'      => esc_html__( 'Add New Type', 'thenaz' ),
        'new_item_name'     => esc_html__( 'New Type Name', 'thenaz' ),
        'menu_name'         => esc_html__( 'Type', 'thenaz' ),
      ]
    ]);
  }
}
  
}


if(class_exists('thenaz_Custom_Post_Types')){
  $thenaz_ctf = new thenaz_Custom_Post_Types();
  $thenaz_ctf->register();
}


?>