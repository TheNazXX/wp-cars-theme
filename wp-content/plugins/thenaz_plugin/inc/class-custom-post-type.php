<?php 

if(!class_exists('thenaz_Custom_Post_Types')){

  class thenaz_Custom_Post_Types
{

  public function register(){
    add_action('init', [$this, 'custom_post_type']);
    add_action('add_meta_boxes', [$this, 'add_meta_box_property']);
    add_action('save_post', [$this, 'save_metabox'], 10, 2); // Приоритет количество перед параметров
  }

  public function add_meta_box_property(){
    add_meta_box(
      'thenaz_settings',
      'Property Settings',
      [$this, 'metabox_property_html'],
      'property',
      'normal',
      'default'
    );
  }

  public function metabox_property_html($post){
    $price = get_post_meta($post->ID, 'property_price', true); // 3 параметр возвращает строку значение, а не ввиде массиова в случае с false
    $period = get_post_meta($post->ID, 'property_period', true);
    $type = get_post_meta($post->ID, 'property_type', true);

    wp_nonce_field('thenazfields', '_thenaz');

    
    echo '
    <p>
      <label for="property_price">Price</label>
      <input type="number" id="property_price" name="property_price" value="'. esc_html($price) .'">   
    </p>

    <p>
      <label for="property_period">Period</label>
      <input type="text" id="property_period" name="property_period" value="'. esc_html($period) .'">   
    </p>

    <p>
      <label for="property_type">Type</label>
      <select id="property_type" name="property_type">
        <option value="empty" selected >Select Type</option>
        <option value="sale" '. selected('sale', $type, false) .'>For Sale</option>
        <option value="rent" '. selected('rent', $type, false) .'>For Rent</option>
        <option value="sold" '. selected('sold', $type, false) .'>For Sold</option>
      </select>
    </p>
    ';

    $agents = get_posts(['post_type'=>'agent', 'numberposts'=>-1]);
    $agent_meta = get_post_meta($post->ID, 'property_agent', true);


    if($agents){
      echo '  
      <p>
        <label for="property_agent">Agent</label>
        <select id="property_agent" name="property_agent">
        <option value="empty" selected >Select Agent</option>';
          foreach($agents as $agent){ ?>
<option value="<?php echo esc_html($agent->ID)?>"
  <?php if(selected($agent->ID, $agent_meta, false)){echo 'selected';};?>>
  <?php esc_html_e($agent->post_title); ?>
</option>
<?php };
        '</select>
      </p>
      ';
  
    }
  }

  public function save_metabox($post_id, $post){

    if(!isset($_POST['_thenaz']) || !wp_verify_nonce($_POST['_thenaz'], 'thenazfields')){
      return $post_id;
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
      return $post_id;
    }

    if($post->post_type != 'property'){
      return $post_id;
    }

    $post_type = get_post_type_object($post->post_type);
    
    if(!current_user_can($post_type->cap->edit_post, $post_id)){
      return $post_id;
    }
  

    if(is_null($_POST['property_price'])){
      delete_post_meta($post_id, 'property_price');
    }else{
      update_post_meta($post_id, 'property_price', sanitize_text_field($_POST['property_price']));
    }

    if(is_null($_POST['property_period'])){
      delete_post_meta($post_id, 'property_period');
    }else{
      update_post_meta($post_id, 'property_period', sanitize_text_field($_POST['property_period']));
    }

    if(is_null($_POST['property_type'])){
      delete_post_meta($post_id, 'property_type');
    }else{
      update_post_meta($post_id, 'property_type', sanitize_text_field($_POST['property_type']));
    }

    var_dump($_POST['property_agent']);

    if(is_null($_POST['property_agent'])){
      delete_post_meta($post_id, 'property_agent');
    }else{
      update_post_meta($post_id, 'property_agent', sanitize_text_field($_POST['property_agent']));
    }

    return $post_id;
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