<?php 

class thenaz_Shortcodes
{

  public $thenaz_plugin;
  public $agents;

  public function register(){
    add_action('init', [$this, 'register_shortcode']);
  }

  public function register_shortcode(){
    add_shortcode('thenaz_filter', [$this, 'filter_shortcode']);
  }

  public function filter_shortcode($atts = []){
    extract(shortcode_atts([
      'location' => '0',
      'type' => '0',
      'offer' => '0',
      'price' => '0',
      'agent' => '0'
    ], $atts));

    $this->thenaz_plugin = new thenaz_plugin();

    $this->agents = get_posts(['post_type' => 'agent', 'numberspost' => -1]);

    $agents_list = '';

    foreach($this->agents as $item) {
      $agents_list .= '<option value="'. $item->ID .'">'.$item->post_title .'</option>';     
    };

$output = '';
$output .= '<div class="filter-form d-flex justify-content-center">';

  $output .= '<form method="post" action="'. get_post_type_archive_link('property') . '">';
    if($price){
      $output .= '<div class="input-group mb-3 input-price">
        <span class="input-group-text" id="inputGroup-sizing-default">Price</span>
        <input type="number" class="form-control" placeholder="Maximum Price" name="thenaz_price" value="">
      </div>';
    }

    if($location){
      $output .= '<select name="thenaz_location">
        <option value="">Select Location</option>;
        '. $this->thenaz_plugin->get_terms_hierarchicle('location', '') .'
      </select>';
    }

    if($type){
      $output .= '<select name="thenaz_type-house">
        <option value="">Select Type House</option>;
        '. $this->thenaz_plugin->get_terms_hierarchicle('property-type', '') .'
      </select>';
    }

    if($offer){
      $output .= '<select name="thenaz_type">
        <option value="" selected>Choose Type</option>
        <option value="sale">For Sale</option>
        <option value="rent">For Rent</option>
        <option value="sold">Sold</option>
      </select>';
    }

    if($agent){
      $output .= '<select name="thenaz_agent">
        <option value="" selected>Choose Agent</option>
        '.$agents_list.'
      </select>';
    }

    $output .= '<input class="btn btn-secondary ml-auto" name="submit" type="submit" value="Filter" />';



    $output .= '
    <form />
</div>';

return $output;
}
}

$thenaz_shortcodes = new thenaz_Shortcodes();
$thenaz_shortcodes->register();


?>